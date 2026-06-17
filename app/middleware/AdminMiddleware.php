<?php

namespace App\Middleware;

class AdminMiddleware
{
    public static function handle()
    {

        // ❌ Not logged in
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        // ❌ Not admin
        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo "403 Forbidden - Admins only";
            exit;
        }

        // ✅ Allowed
        return true;
    }
}