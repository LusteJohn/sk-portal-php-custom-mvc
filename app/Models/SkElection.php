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