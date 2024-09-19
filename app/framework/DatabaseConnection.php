<?php

namespace app\framework;

use PDO;

class DatabaseConnection
{
    private static $connection = null;

    public static function getConnection(): PDO
    {
        [
            'DB_HOST' => $HOST,
            'DB_NAME' => $DB_NAME,
            'DB_USERNAME' => $USERNAME,
            'DB_PASSWORD' => $PASSWORD
        ] = $_ENV;

        if (empty(self::$connection)) {
            self::$connection = new PDO("mysql:host={$HOST};dbname={$DB_NAME}", $USERNAME, $PASSWORD, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        }

        return self::$connection;
    }
}