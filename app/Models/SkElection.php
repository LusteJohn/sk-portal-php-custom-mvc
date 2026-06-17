<?php

namespace App\Models;

use App\Core\Database;

class SkElection
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // 🔹 SANITIZE helper
    private function clean($value)
    {
        return htmlspecialchars(strip_tags(trim($value)));
    }

    // 🔹 CREATE with bindParam + sanitization
    public function create($data)
    {
        $sql = "INSERT INTO sk_election (
                    election_year, barangay, municipality, province, region,
                    status, chairman_seat, councilor_seat,
                    voter_age_min, voter_age_max
                )
                VALUES (
                    :election_year, :barangay, :municipality, :province, :region,
                    :status, :chairman_seat, :councilor_seat,
                    :voter_age_min, :voter_age_max
                )";

        $stmt = $this->db->prepare($sql);

        // 🔹 Sanitize inputs
        $election_year  = $this->clean($data['election_year']);
        $barangay       = $this->clean($data['barangay']);
        $municipality   = $this->clean($data['municipality']);
        $province       = $this->clean($data['province']);
        $region         = $this->clean($data['region']);
        $status         = $this->clean($data['status'] ?? 'pending');

        $chairman_seat  = (int) $data['chairman_seat'];
        $councilor_seat = (int) $data['councilor_seat'];
        $voter_age_min  = (int) $data['voter_age_min'];
        $voter_age_max  = (int) $data['voter_age_max'];

        // 🔹 Bind parameters securely
        $stmt->bindParam(':election_year', $election_year);
        $stmt->bindParam(':barangay', $barangay);
        $stmt->bindParam(':municipality', $municipality);
        $stmt->bindParam(':province', $province);
        $stmt->bindParam(':region', $region);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':chairman_seat', $chairman_seat, \PDO::PARAM_INT);
        $stmt->bindParam(':councilor_seat', $councilor_seat, \PDO::PARAM_INT);
        $stmt->bindParam(':voter_age_min', $voter_age_min, \PDO::PARAM_INT);
        $stmt->bindParam(':voter_age_max', $voter_age_max, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    // 🔹 READ
    public function getAll()
    {
        $sql = "SELECT * FROM sk_election ORDER BY election_id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM sk_election WHERE election_id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE sk_election SET
                    election_year = :election_year,
                    barangay = :barangay,
                    municipality = :municipality,
                    province = :province,
                    region = :region,
                    status = :status,
                    chairman_seat = :chairman_seat,
                    councilor_seat = :councilor_seat,
                    voter_age_min = :voter_age_min,
                    voter_age_max = :voter_age_max,
                    updated_at = CURRENT_TIMESTAMP
                WHERE election_id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        $stmt->bindParam(':election_year', $data['election_year']);
        $stmt->bindParam(':barangay', $data['barangay']);
        $stmt->bindParam(':municipality', $data['municipality']);
        $stmt->bindParam(':province', $data['province']);
        $stmt->bindParam(':region', $data['region']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':chairman_seat', $data['chairman_seat'], \PDO::PARAM_INT);
        $stmt->bindParam(':councilor_seat', $data['councilor_seat'], \PDO::PARAM_INT);
        $stmt->bindParam(':voter_age_min', $data['voter_age_min'], \PDO::PARAM_INT);
        $stmt->bindParam(':voter_age_max', $data['voter_age_max'], \PDO::PARAM_INT);

        return $stmt->execute();
    }

    // 🔹 DELETE (secure bindParam)
    public function delete($id)
    {
        $sql = "DELETE FROM sk_election WHERE election_id = :id";
        $stmt = $this->db->prepare($sql);

        $id = (int) $id;
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }
}