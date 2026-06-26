<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            "name" => "John Mark",
            "role" => "Web Developer"
        ];

        $this->view('home', $data);
    }

    public function dashboard()
    {
        $this->view('admin/dashboard');
    }
    public function memberDashboard()
    {
        $this->view('member/dashboard');
    }
    public function viewerDashboard()
    {
        $this->view('viewer/dashboard');
    }
}