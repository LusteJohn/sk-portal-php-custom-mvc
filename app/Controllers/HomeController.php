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
}