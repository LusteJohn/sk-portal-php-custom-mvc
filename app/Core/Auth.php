<?php

namespace App\Core;

class Auth
{
    public static function check()
    {
        return isset($_SESSION['user']);
    }

    public static function role($role)
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === $role;
    }
}