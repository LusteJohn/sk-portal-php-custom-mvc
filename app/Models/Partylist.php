<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Partylist
{
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
        $sql = "SELECT p.*, e.election_year
                FROM partylist p
                INNER JOIN sk_election e
                    ON p.election_id = e.election_id
                ORDER BY p.partylist_id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM partylist
                WHERE partylist_id = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO partylist (
                    election_id,
                    partylist_name,
                    acronym,
                    status
                )
                VALUES (
                    :election_id,
                    :partylist_name,
                    :acronym,
                    :status
                )";

        $stmt = $this->db->prepare($sql);

        $election_id = (int)$data['election_id'];
        $partylist_name = $this->clean($data['partylist_name']);
        $acronym = strtoupper($this->clean($data['acronym']));
        $status = $this->clean($data['status'] ?? 'pending');

        $stmt->bindParam(':election_id', $election_id, PDO::PARAM_INT);
        $stmt->bindParam(':partylist_name', $partylist_name);
        $stmt->bindParam(':acronym', $acronym);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $sql = "UPDATE partylist
                SET
                    election_id = :election_id,
                    partylist_name = :partylist_name,
                    acronym = :acronym,
                    status = :status,
                    updated_at = CURRENT_TIMESTAMP
                WHERE partylist_id = :id";

        $stmt = $this->db->prepare($sql);

        $election_id = (int)$data['election_id'];
        $partylist_name = $this->clean($data['partylist_name']);
        $acronym = strtoupper($this->clean($data['acronym']));
        $status = $this->clean($data['status']);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':election_id', $election_id, PDO::PARAM_INT);
        $stmt->bindParam(':partylist_name', $partylist_name);
        $stmt->bindParam(':acronym', $acronym);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM partylist
                WHERE partylist_id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}