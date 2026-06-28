<?php 

namespace App\Controllers;

use App\Models\Candidate;
use App\Models\CandidateProgram;
use App\Models\Auth;

class CandidateProgramController {

    public function memberProgramView()
    {
        $candidateModel = new Candidate();
        $programModel = new CandidateProgram();

        $userId = $_SESSION['user']['id'] ?? null;

        if (!$userId) {
            header('Location: /login');
            exit;
        }

        $candidate = $candidateModel->getByUserId($userId);

        if (!$candidate) {
            header('Location: /member/candidate-programs');
            exit;
        }

        $program = $programModel->getByCandidateId($candidate['candidate_id']);

        require __DIR__ . '/../Views/member/candidate-programs.php';
    }

    public function memberProgramStore()
    {
        try {
            $model = new Candidate();
            $programModel = new CandidateProgram();

            $userId = $_SESSION['user']['id'] ?? null;

            if (!$userId) {
                header('Location: /login');
                exit;
            }

            $candidate = $model->getByUserId($userId);
            $candidateId = $candidate['candidate_id'] ?? null;

            if (!$candidateId) {
                die('Candidate record not found');
            }

            $data = [
                'candidate_id' => $candidateId,
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'beneficiary' => $_POST['beneficiary'],
                'status' => $_POST['status'] ?? 'pending'
            ];

            // Check if a program already exists for this candidate
            $existingProgram = $programModel->getByCandidateId($candidateId);

            if ($existingProgram) {
                // Update the existing program
                $programModel->update($existingProgram['program_id'], $data);
            } else {
                // Create a new program
                $programModel->create($data);
            }

            header('Location: /member/candidate-programs');
            exit;

        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}