<?php

namespace App\Middleware;

class MemberMiddleware
{
    public static function handle()
    {

        // ❌ Not logged in
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        // ❌ Not a member
        if ($_SESSION['user']['role'] !== 'member') {
            http_response_code(403);
            echo "403 Forbidden - Members only";
            exit;
        }

        // ✅ Allowed
        return true;
    }
}