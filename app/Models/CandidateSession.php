<?php 

namespace App\Models;

use App\Core\Database;
use PDO;

class CandidateSession {
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
        $sql = "SELECT * FROM candidate_sessions cs
                LEFT JOIN candidate c ON cs.candidate_id = c.candidate_id
                WHERE c.candidate_id = :candidate_id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':candidate_id', $candidate_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO candidate_sessions (
                    candidate_id,
                    total_session,
                    total_attended,
                    attended_rate,
                    created_at
                ) VALUES (
                    :candidate_id,
                    :total_session,
                    :total_attended,
                    :attended_rate,
                    NOW()
                )";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':candidate_id', $data['candidate_id'], PDO::PARAM_INT);
        $stmt->bindParam(':total_session', $data['total_session']);
        $stmt->bindParam(':total_attended', $data['total_attended']);
        $stmt->bindParam(':attended_rate', $data['attended_rate']);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM candidate_sessions WHERE session_id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
?>