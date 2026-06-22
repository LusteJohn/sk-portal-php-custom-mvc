<?php 

namespace App\Controllers;

use App\Models\Candidate;
use App\Models\Partylist;
use App\Models\SkElection;

class CandidateController {
    public function index() {
        $candidateModel = new Candidate();
        $partylistModel = new Partylist();
        $electionModel = new SkElection();

        $candidates = $candidateModel->getAll();
        $partylists = $partylistModel->getAll();
        $elections = $electionModel->getAll();

        require __DIR__ . '/../Views/admin/candidate.php';
    }

    public function memberProfile()
    {
        $candidateModel = new Candidate();

        $candidateId = $_SESSION['candidate_id'];

        $candidate = $candidateModel->getById($candidateId);

        require __DIR__ . '/../Views/member/profile.php';
    }

    public function memberUpdate()
    {
        try {

            $model = new Candidate();

            $candidateId = $_SESSION['candidate_id'];

            $currentCandidate = $model->getById($candidateId);

            $photoPath = $currentCandidate['photoUrl'];

            if (
                isset($_FILES['photoUrl']) &&
                $_FILES['photoUrl']['error'] === UPLOAD_ERR_OK
            ) {

                $uploadDir = __DIR__ . '/../../public/assets/sk_photo/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileName = uniqid('candidate_') . '.' .
                    pathinfo($_FILES['photoUrl']['name'], PATHINFO_EXTENSION);

                move_uploaded_file(
                    $_FILES['photoUrl']['tmp_name'],
                    $uploadDir . $fileName
                );

                $photoPath = '/assets/sk_photo/' . $fileName;
            }

            $data = [
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'],
                'last_name' => $_POST['last_name'],
                'ext_name' => $_POST['ext_name'],
                'gender' => $_POST['gender'],
                'birthdate' => $_POST['birthdate'],
                'address' => $_POST['address'],
                'photoUrl' => $photoPath
            ];

            $model->updateProfile($candidateId, $data);

            header('Location: /member/profile');
            exit;

        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function store()
    {
        try {

            $model = new Candidate();

            $photoPath = null;
            if (
                isset($_FILES['photoUrl']) &&
                $_FILES['photoUrl']['error'] === UPLOAD_ERR_OK
            ) {

                $uploadDir = __DIR__ . '/../../public/assets/sk_photo/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $extension = pathinfo(
                    $_FILES['photoUrl']['name'],
                    PATHINFO_EXTENSION
                );

                $fileName =
                    uniqid('candidate_') .
                    '.' .
                    strtolower($extension);

                move_uploaded_file(
                    $_FILES['photoUrl']['tmp_name'],
                    $uploadDir . $fileName
                );

                $photoPath =
                    '/assets/sk_photo/' .
                    $fileName;
            }

            $data = [
                'partylist_id' => $_POST['partylist_id'],
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'],
                'last_name' => $_POST['last_name'],
                'ext_name' => $_POST['ext_name'],
                'position' => $_POST['position'],
                'gender' => $_POST['gender'],
                'birthdate' => $_POST['birthdate'],
                'photoUrl' => $photoPath,
                'address' => $_POST['address'],
                'isIncumbent' => $_POST['isIncumbent'] ?? 0,
                'status' => $_POST['status'] ?? 'pending'
            ];

            $model->create($data);

            header('Location: /admin/candidate');
            exit;

        } catch (\Exception $e) {

            die($e->getMessage());

        }
    }

    public function edit() {
        $candidateModel = new Candidate();
        $partylistModel = new Partylist();
        $electionModel = new SkElection();

        $candidates = $candidateModel->getAll();
        $partylists = $partylistModel->getAll();
        $elections = $electionModel->getAll();

        $id = $_GET['id'];

        $editCandidate = $candidateModel->getById($id);

        require __DIR__ . '/../Views/admin/candidate.php';
    }

    public function update() {
        try {
            $model = new Candidate();

            $id = $_POST['candidate_id'];

            $currentCandidate = $model->getById($id);
            $photoPath = $currentCandidate['photoUrl'] ?? '';

            if (
                isset($_FILES['photoUrl']) &&
                $_FILES['photoUrl']['error'] === UPLOAD_ERR_OK
            ) {

                $uploadDir = __DIR__ . '/../../public/assets/sk_photo/';

                $extension = pathinfo(
                    $_FILES['photoUrl']['name'],
                    PATHINFO_EXTENSION
                );

                $fileName =
                    uniqid('candidate_') .
                    '.' .
                    strtolower($extension);

                move_uploaded_file(
                    $_FILES['photoUrl']['tmp_name'],
                    $uploadDir . $fileName
                );

                $photoPath =
                    '/assets/sk_photo/' .
                    $fileName;
            }

            $data = [
                'partylist_id' => $_POST['partylist_id'],
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'],
                'last_name' => $_POST['last_name'],
                'ext_name' => $_POST['ext_name'],
                'position' => $_POST['position'],
                'gender' => $_POST['gender'],
                'birthdate' => $_POST['birthdate'],
                'photoUrl' => $photoPath,
                'address' => $_POST['address'],
                'isIncumbent' => $_POST['isIncumbent'] ?? 0,
                'status' => $_POST['status'] ?? 'pending'
            ];

            $model->update($id, $data);

            header('Location: /admin/candidate');
            exit;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete() {
        try {
            $model = new Candidate();

            $id = $_POST['candidate_id'];

            $model->delete($id);

            header('Location: /admin/candidate');
            exit;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
?>