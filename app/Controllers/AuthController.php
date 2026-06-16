<?php

namespace App\Controllers;

use App\Models\Auth;

class AuthController
{
    public function showLogin()
    {
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function login()
    {
        session_start(); // ensure session is active

        $auth = new Auth();

        $identifier = $_POST['email']; // can be email or username
        $password = $_POST['password'];

        $user = $auth->login($identifier, $password);

        if ($user) {

            // Store session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: /admin");
            } else {
                header("Location: /dashboard");
            }

            exit;
        }

        echo "Invalid credentials";
    }

    public function logout()
    {
        session_start();
        session_destroy();

        header("Location: /login");
        exit;
    }
}