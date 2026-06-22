<?php

namespace App\Controllers;

use App\Models\Education;
use App\Models\Candidate;

class EducationController {
    public function index() {
        $educationModel = new Education();
        $candidateModel = new Candidate();

        $educations = $educationModel->getAll();
        $candidates = $candidateModel->getAll();

        require __DIR__ . '/../Views/admin/education.php';
    }

    public function store()
    {
        try {

            $model = new Education();

            $data = [
                'candidate_id' => $_POST['candidate_id'] ?? null,
                'level' => $_POST['level'] ?? null,
                'course' => $_POST['course'] ?? null,
                'school' => $_POST['school'] ?? null,
                'year_start' => $_POST['year_start'] ?? null,
                'year_end' => $_POST['year_end'] ?? null
            ];

            $model->create($data);

            header('Location: /admin/education');
            exit;
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function edit()
    {
        $model = new Education();

        $id = $_GET['id'] ?? null;

        if ($id) {
            $editEducation = $model->getById($id);
        }

        header('Location: /admin/education');
        exit;
    }

    public function update()
    {
        try {
            $model = new Education();

            $id = $_POST['edu_back_id'] ?? null;

            if ($id) {
                $data = [
                    'candidate_id' => $_POST['candidate_id'] ?? null,
                    'level' => $_POST['level'] ?? null,
                    'course' => $_POST['course'] ?? null,
                    'school' => $_POST['school'] ?? null,
                    'year_start' => $_POST['year_start'] ?? null,
                    'year_end' => $_POST['year_end'] ?? null
                ];

                $model->update($id, $data);
            }

            header('Location: /admin/education');
            exit;
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function delete()
    {
        try {
            $model = new Education();

            $id = $_POST['edu_back_id'] ?? null;

            if ($id) {
                $model->delete($id);
            }

            header('Location: /admin/education');
            exit;
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>