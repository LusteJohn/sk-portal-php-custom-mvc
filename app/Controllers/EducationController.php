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

    public function memberEducation()
    {
        $educationModel = new Education();

        $candidateId = $_SESSION['candidate_id'];

        $educations = $educationModel->getByCandidateId($candidateId);

        require __DIR__ . '/../Views/member/education.php';
    }

    public function memberStore()
    {
        try {

            $model = new Education();

            $candidateId = $_SESSION['candidate_id'];

            $data = [
                'candidate_id' => $candidateId,
                'level' => $_POST['level'],
                'course' => $_POST['course'],
                'school' => $_POST['school'],
                'year_start' => $_POST['year_start'],
                'year_end' => $_POST['year_end']
            ];

            $model->create($data);

            header('Location: /member/education');
            exit;

        } catch (\Exception $e) {

            die($e->getMessage());

        }
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

    public function memberEdit()
    {
        $model = new Education();

        $id = $_GET['id'];

        $education = $model->getById($id);

        if (
            !$education ||
            $education['candidate_id'] != $_SESSION['candidate_id']
        ) {
            die('Unauthorized Access');
        }

        require __DIR__ . '/../Views/member/edit_education.php';
    }

    public function memberUpdate()
    {
        try {

            $model = new Education();

            $id = $_POST['edu_back_id'];

            $education = $model->getById($id);

            if (
                !$education ||
                $education['candidate_id'] != $_SESSION['candidate_id']
            ) {
                die('Unauthorized Access');
            }

            $data = [
                'candidate_id' => $_SESSION['candidate_id'],
                'level' => $_POST['level'],
                'course' => $_POST['course'],
                'school' => $_POST['school'],
                'year_start' => $_POST['year_start'],
                'year_end' => $_POST['year_end']
            ];

            $model->update($id, $data);

            header('Location: /member/education');
            exit;

        } catch (\Exception $e) {

            die($e->getMessage());

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