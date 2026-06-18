<?php

namespace App\Controllers;

use App\Models\Partylist;
use App\Models\SkElection;

class PartylistController
{
    public function index()
    {
        $partylistModel = new Partylist();
        $electionModel = new SkElection();

        $partylists = $partylistModel->getAll();
        $elections = $electionModel->getAll();

        $editPartylist = null;

        require __DIR__ . '/../Views/admin/partylist.php';
    }

    public function store()
    {
        try {

            $model = new Partylist();

            $data = [
                'election_id' => $_POST['election_id'],
                'partylist_name' => $_POST['partylist_name'],
                'acronym' => $_POST['acronym'],
                'status' => $_POST['status'] ?? 'pending'
            ];

            $model->create($data);

            header('Location: /admin/partylist');
            exit;

        } catch (\Exception $e) {

            die($e->getMessage());

        }
    }

    public function edit()
    {
        $partylistModel = new Partylist();
        $electionModel = new SkElection();

        $partylists = $partylistModel->getAll();
        $elections = $electionModel->getAll();

        $id = $_GET['id'];

        $editPartylist = $partylistModel->getById($id);

        require __DIR__ . '/../Views/admin/partylist.php';
    }

    public function update()
    {
        try {

            $model = new Partylist();

            $id = $_POST['partylist_id'];

            $data = [
                'election_id' => $_POST['election_id'],
                'partylist_name' => $_POST['partylist_name'],
                'acronym' => $_POST['acronym'],
                'status' => $_POST['status']
            ];

            $model->update($id, $data);

            header('Location: /admin/partylist');
            exit;

        } catch (\Exception $e) {

            die($e->getMessage());

        }
    }

    public function delete()
    {
        try {

            $model = new Partylist();

            $model->delete($_POST['partylist_id']);

            header('Location: /admin/partylist');
            exit;

        } catch (\Exception $e) {

            die($e->getMessage());

        }
    }
}