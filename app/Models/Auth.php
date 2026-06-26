<?php

namespace App\Models;

use App\Core\Database;

class Auth
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function login($identifier, $password)
    {
        $sql = "SELECT *
                FROM users
                WHERE (email = :identifier OR username = :identifier)
                AND is_active = TRUE
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'identifier' => $identifier
        ]);

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }

        return false;
    }

    // for registering new users, especially candidates
    public function register($username, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password_hash, role, is_active)
                VALUES (:username, :email, :password_hash, 'member', TRUE)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password_hash' => $hashedPassword
        ]);

        return $this->db->lastInsertId();
    }
}