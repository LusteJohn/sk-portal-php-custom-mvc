<?php

namespace App\Controllers;

use App\Models\Auth;
use App\Core\Database;

class AuthController
{
    public function showLogin()
    {
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function showRegister()
    {
        require __DIR__ . '/../Views/auth/register.php';
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

    public function register()
    {
        $db = Database::connect();

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password_hash)
                VALUES (:username, :email, :password)";

        $stmt = $db->prepare($sql);

        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        header("Location: /login");
        exit;
    }

    public function logout()
    {
        session_start();
        session_destroy();

        header("Location: /login");
        exit;
    }
}