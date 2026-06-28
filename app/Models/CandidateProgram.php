<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class CandidateProgram {
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    private function clean($value)
    {
        $value = $value ?? '';
        return htmlspecialchars(strip_tags(trim($value)));
    }

    public function getByCandidateId($candidate_id) {
        $sql = "SELECT * FROM programs p
                LEFT JOIN candidate c ON p.candidate_id = c.candidate_id
                WHERE c.candidate_id = :candidate_id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':candidate_id', $candidate_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO programs (
                    candidate_id,
                    title,
                    description,
                    beneficiary,
                    status
                ) VALUES (
                    :candidate_id,
                    :title,
                    :description,
                    :beneficiary,
                    :status
                )";

        $stmt = $this->db->prepare($sql);

        $title = $this->clean($data['title']);
        $description = $this->clean($data['description']);
        $beneficiary = $this->clean($data['beneficiary']);
        $status = $this->clean($data['status'] ?? 'pending');

        $stmt->bindParam(':candidate_id', $data['candidate_id'], PDO::PARAM_INT);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':beneficiary', $data['beneficiary']);
        $stmt->bindParam(':status', $data['status']);

        return $stmt->execute();
    }

    public function update($id, $data) {
        $sql = "UPDATE programs SET 
                    title = :title,
                    description = :description,
                    beneficiary = :beneficiary,
                    status = :status
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $title = $this->clean($data['title']);
        $description = $this->clean($data['description']);
        $beneficiary = $this->clean($data['beneficiary']);
        $status = $this->clean($data['status'] ?? 'pending');

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':beneficiary', $beneficiary);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM programs WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>