<?php

namespace App\Models;

class Validator
{
    public static function validateRegister($username, $email, $password)
    {
        $errors = [];

        // 🔹 Username validation
        if (empty($username)) {
            $errors[] = "Username is required.";
        } elseif (strlen($username) < 3 || strlen($username) > 20) {
            $errors[] = "Username must be 3–20 characters.";
        } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
            $errors[] = "Username can only contain letters, numbers, and underscores.";
        }

        // 🔹 Email validation
        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        // 🔹 Password validation
        if (empty($password)) {
            $errors[] = "Password is required.";
        } elseif (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters.";
        } elseif (!preg_match("/[A-Z]/", $password)) {
            $errors[] = "Password must contain at least 1 uppercase letter.";
        } elseif (!preg_match("/[0-9]/", $password)) {
            $errors[] = "Password must contain at least 1 number.";
        }

        return [
            'status' => empty($errors), // true if no errors
            'errors' => $errors
        ];
    }
}