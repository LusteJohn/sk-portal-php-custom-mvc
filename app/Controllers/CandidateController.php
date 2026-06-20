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

    public function store()
    {
        try {

            $model = new Candidate();

            $photoPath = null;

            if (
                isset($_FILES['photo']) &&
                $_FILES['photo']['error'] === UPLOAD_ERR_OK
            ) {

                $uploadDir = __DIR__ . '/../assets/sk_photo/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $extension = pathinfo(
                    $_FILES['photo']['name'],
                    PATHINFO_EXTENSION
                );

                $fileName =
                    uniqid('candidate_') .
                    '.' .
                    strtolower($extension);

                move_uploaded_file(
                    $_FILES['photo']['tmp_name'],
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

            $photoPath = $currentCandidate['photoUrl'];

            if (
                isset($_FILES['photo']) &&
                $_FILES['photo']['error'] === UPLOAD_ERR_OK
            ) {

                $uploadDir = __DIR__ . '/../assets/sk_photo/';

                $extension = pathinfo(
                    $_FILES['photo']['name'],
                    PATHINFO_EXTENSION
                );

                $fileName =
                    uniqid('candidate_') .
                    '.' .
                    strtolower($extension);

                move_uploaded_file(
                    $_FILES['photo']['tmp_name'],
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
                'status' => $_POST['status']
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