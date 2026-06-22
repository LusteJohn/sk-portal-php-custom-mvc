<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Education {
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

    public function getAll() {
        $sql = "SELECT e.edu_back_id, e.level, e.course, e.school, e.year_start, e.year_end
                FROM education_background e
                INNER JOIN candidate c ON c.candidate_id = e.candidate_id
                ORDER BY e.edu_back_id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     public function getById($id) {
        $sql = "SELECT * FROM education_background
                WHERE edu_back_id = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $sql = "INSERT INTO education_background (
                    candidate_id,
                    level,
                    course,
                    school,
                    year_start,
                    year_end
                ) VALUES (
                    :candidate_id,
                    :level,
                    :course,
                    :school,
                    :year_start,
                    :year_end
                )";

        $stmt = $this->db->prepare($sql);

        $edu_back_id = (int) $data['edu_back_id'];
        $candidate_id = (int) $data['candidate_id'];
        $level = $this->clean($data['level']);
        $course = $this->clean($data['course']);
        $year_start = (int) $data['year_start'];
        $year_end = (int) $data['year_end'];

        $stmt->bindParam(':edu_back_id', $edu_back_id, PDO::PARAM_INT);
        $stmt->bindParam(':candidate_id', $candidate_id, PDO::PARAM_INT);
        $stmt->bindParam(':level', $level, PDO::PARAM_STR);
        $stmt->bindParam(':course', $course, PDO::PARAM_STR);
        $stmt->bindParam(':school', $this->clean($data['school']), PDO::PARAM_STR);
        $stmt->bindParam(':year_start', $year_start, PDO::PARAM_INT);
        $stmt->bindParam(':year_end', $year_end, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function update($id, $data) {
        $sql = "UPDATE education_background SET
                    candidate_id = :candidate_id,
                    level = :level,
                    course = :course,
                    school = :school,
                    year_start = :year_start,
                    year_end = :year_end
                WHERE edu_back_id = :id";
        
        $stmt = $this->db->prepare($sql);

        $candidate_id = (int) $data['candidate_id'];
        $level = $this->clean($data['level']);
        $course = $this->clean($data['course']);
        $school = $this->clean($data['school']);
        $year_start = (int) $data['year_start'];
        $year_end = (int) $data['year_end'];

        $stmt->bindParam(':candidate_id', $candidate_id, PDO::PARAM_INT);
        $stmt->bindParam(':level', $level, PDO::PARAM_STR);
        $stmt->bindParam(':course', $course, PDO::PARAM_STR);
        $stmt->bindParam(':school', $school, PDO::PARAM_STR);
        $stmt->bindParam(':year_start', $year_start, PDO::PARAM_INT);
        $stmt->bindParam(':year_end', $year_end, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM education_background WHERE edu_back_id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

}
