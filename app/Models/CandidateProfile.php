<?php 

namespace App\Models;

use App\Core\Database;
use PDO;

class CandidateProfile {
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
        $sql = "SELECT * FROM candidate_profile cp
                LEFT JOIN candidate c ON cp.candidate_id = c.candidate_id
                WHERE c.candidate_id = :candidate_id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':candidate_id', $candidate_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO candidate_profile (
                    candidate_id,
                    platform_summary,
                    key_advocacies,
                    priority_issues,
                    slogan
                ) VALUES (
                    :candidate_id,
                    :platform_summary,
                    :key_advocacies,
                    :priority_issues,
                    :slogan
                )";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':candidate_id', $data['candidate_id'], PDO::PARAM_INT);
        $stmt->bindParam(':platform_summary', $data['platform_summary']);
        $stmt->bindParam(':key_advocacies', $data['key_advocacies']);
        $stmt->bindParam(':priority_issues', $data['priority_issues']);
        $stmt->bindParam(':slogan', $data['slogan']);

        return $stmt->execute();
    }

    public function update($candidateId, $data)
    {
        $sql = "UPDATE candidate_profile
                SET
                    platform_summary = :platform_summary,
                    key_advocacies = :key_advocacies,
                    priority_issues = :priority_issues,
                    slogan = :slogan
                WHERE candidate_id = :candidate_id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':candidate_id', $candidateId, PDO::PARAM_INT);
        $stmt->bindParam(':platform_summary', $data['platform_summary']);
        $stmt->bindParam(':key_advocacies', $data['key_advocacies']);
        $stmt->bindParam(':priority_issues', $data['priority_issues']);
        $stmt->bindParam(':slogan', $data['slogan']);

        return $stmt->execute();
    }
}
?>