<?php 

namespace App\Controllers;

use App\Models\Candidate;
use App\Models\Auth;
use App\Models\CandidateProfile;

class CandidateProfileController {
    public function memberProfileView()
    {
        $candidateModel = new Candidate();
        $profileModel = new CandidateProfile();

        $userId = $_SESSION['user']['id'] ?? null;

        if (!$userId) {
            header('Location: /login');
            exit;
        }

        $candidate = $candidateModel->getByUserId($userId);

        if (!$candidate) {
            header('Location: /member/profile');
            exit;
        }

        $profile = $profileModel->getByCandidateId($candidate['candidate_id']);

        require __DIR__ . '/../Views/member/candidate-profile.php';
    }

    public function memberProfileStore()
    {
        try {
            $model = new Candidate();
            $profileModel = new CandidateProfile();

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
                'platform_summary' => $_POST['platform_summary'],
                'key_advocacies' => $_POST['key_advocacies'],
                'priority_issues' => $_POST['priority_issues'],
                'slogan' => $_POST['slogan']
            ];

            $existing = $profileModel->getByCandidateId($candidateId);

            if ($existing) {
                $profileModel->update($candidateId, $data);
            } else {
                $profileModel->create($data);
            }

            header('Location: /member/candidate-profile');
            exit;

        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}

?>