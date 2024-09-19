<?php

namespace app\repositories;

use app\framework\DatabaseConnection;

class ColorRepository
{
    public function getAll(): array
    {
        $connection = DatabaseConnection::getConnection();

        $sql = "SELECT * FROM color";
        return $connection->query($sql)->fetchAll();
    }
}