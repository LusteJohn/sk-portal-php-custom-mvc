<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Candidate {
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    private function clean($value)
    {
        return htmlspecialchars(strip_tags(trim($value)));
    }

    public function getAll()
    {
        $sql = "SELECT c.*, e.election_year, p.partylist_name
                FROM candidate c
                INNER JOIN partylist p ON c.partylist_id = p.partylist_id
                INNER JOIN sk_election e ON p.election_id = e.election_id
                ORDER BY c.candidate_id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM candidate
                WHERE candidate_id = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO candidate (
                    election_id,
                    partylist_id,
                    first_name,
                    middle_name,
                    last_name,
                    ext_name,
                    position,
                    gender,
                    birthdate,
                    photoUrl,
                    address,
                    isIncumbent,
                    status
                )
                VALUES (
                    :election_id,
                    :partylist_id,
                    :first_name,
                    :middle_name,
                    :last_name,
                    :ext_name,
                    :position,
                    :gender,
                    :birthdate,
                    :photoUrl,
                    :address,
                    :isIncumbent,
                    :status
                )";
        $stmt = $this->db->prepare($sql);

        $election_id = (int) $data['election_id'];
        $partylist_id = (int) $data['partylist_id'];
        $first_name = $this->clean($data['first_name']);
        $middle_name = $this->clean($data['middle_name']);
        $last_name = $this->clean($data['last_name']);
        $ext_name = $this->clean($data['ext_name']);
        $position = $this->clean($data['position']);
        $gender = $this->clean($data['gender']);
        $birthdate = $this->clean($data['birthdate']);
        $photoUrl = $this->clean($data['photoUrl']);
        $address = $this->clean($data['address']);
        $isIncumbent = (bool) $data['isIncumbent'];
        $status = $this->clean($data['status']);

        $stmt->bindParam(':election_id', $election_id, PDO::PARAM_INT);
        $stmt->bindParam(':partylist_id', $partylist_id, PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':middle_name', $middle_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':ext_name', $ext_name, PDO::PARAM_STR);
        $stmt->bindParam(':position', $position, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
        $stmt->bindParam(':photoUrl', $photoUrl, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':isIncumbent', $isIncumbent, PDO::PARAM_BOOL);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function update($id, $data) {
        $sql = "UPDATE candidate SET
                    election_id = :election_id,
                    partylist_id = :partylist_id,
                    first_name = :first_name,
                    middle_name = :middle_name,
                    last_name = :last_name,
                    ext_name = :ext_name,
                    position = :position,
                    gender = :gender,
                    birthdate = :birthdate,
                    photoUrl = :photoUrl,
                    address = :address,
                    isIncumbent = :isIncumbent,
                    status = :status
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $election_id = (int) $data['election_id'];
        $partylist_id = (int) $data['partylist_id'];
        $first_name = $this->clean($data['first_name']);
        $middle_name = $this->clean($data['middle_name']);
        $last_name = $this->clean($data['last_name']);
        $ext_name = $this->clean($data['ext_name']);
        $position = $this->clean($data['position']);
        $gender = $this->clean($data['gender']);
        $birthdate = $this->clean($data['birthdate']);
        $photoUrl = $this->clean($data['photoUrl']);
        $address = $this->clean($data['address']);
        $isIncumbent = (bool) $data['isIncumbent'];
        $status = $this->clean($data['status']);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':election_id', $election_id, PDO::PARAM_INT);
        $stmt->bindParam(':partylist_id', $partylist_id, PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':middle_name', $middle_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':ext_name', $ext_name, PDO::PARAM_STR);
        $stmt->bindParam(':position', $position, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
        $stmt->bindParam(':photoUrl', $photoUrl, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':isIncumbent', $isIncumbent, PDO::PARAM_BOOL);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM candidate WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
?>