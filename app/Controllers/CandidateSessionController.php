<?php

namespace App\Controllers;

use App\Models\Candidate;
use App\Models\CandidateSession;
use App\Models\Auth;

class CandidateSessionController {
    
    public function memberSessionView()
    {
        $candidateModel = new Candidate();
        $sessionModel = new CandidateSession();

        $userId = $_SESSION['user']['id'] ?? null;

        if (!$userId) {
            header('Location: /login');
            exit;
        }

        $candidate = $candidateModel->getByUserId($userId);

        if (!$candidate) {
            header('Location: /member/candidate-sessions');
            exit;
        }

        $session = $sessionModel->getByCandidateId($candidate['candidate_id']);

        require __DIR__ . '/../Views/member/candidate-sessions.php';
    }

    public function memberSessionStore()
    {
        try {
            $model = new Candidate();
            $sessionModel = new CandidateSession();

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
                'total_session' => $_POST['total_session'],
                'total_attended' => $_POST['total_attended'],
                'attended_rate' => $_POST['attended_rate']
            ];

            $existingSession = $sessionModel->getByCandidateId($candidateId);

            if ($existingSession) {
                $sessionModel->update($existingSession['session_id'], $data);
            } else {
                $sessionModel->create($data);
            }

            header('Location: /member/candidate-sessions');
            exit;
        } catch (\Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}

?>