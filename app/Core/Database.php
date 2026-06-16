<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function connect(): PDO
    {
        if (self::$connection === null) {

            $host = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_DATABASE'];
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];

            try {
                self::$connection = new PDO(
                    "pgsql:host=$host;port=$_ENV[DB_PORT];dbname=$dbname",
                    $username,
                    $password
                );

                self::$connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

                self::$connection->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE,
                    PDO::FETCH_ASSOC
                );

            } catch (PDOException $e) {
                die('Database Connection Failed: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }
}