<?php

namespace App\Controllers;

use App\Models\SkElection;

class SkElectionController
{
    public function index()
    {
        $model = new SkElection();
        $elections = $model->getAll();

        require __DIR__ . '/../Views/admin/election-setting.php';
    }

    public function store()
    {
        $model = new SkElection();

        $data = [
            'election_year'   => $_POST['election_year'],
            'barangay'        => $_POST['barangay'],
            'municipality'    => $_POST['municipality'],
            'province'        => $_POST['province'],
            'region'          => $_POST['region'],
            'status'          => $_POST['status'] ?? 'pending',
            'chairman_seat'   => $_POST['chairman_seat'],
            'councilor_seat'  => $_POST['councilor_seat'],
            'voter_age_min'   => $_POST['voter_age_min'],
            'voter_age_max'   => $_POST['voter_age_max'],
        ];

        $model->create($data);

        header("Location: /admin/election-setting");
        exit;
    }

    public function delete()
    {
        $model = new SkElection();

        $id = $_POST['election_id'];

        $model->delete($id);

        header("Location: /admin/election-setting");
        exit;
    }
}