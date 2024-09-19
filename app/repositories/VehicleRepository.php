<?php

namespace app\repositories;

use app\framework\DatabaseConnection;

class VehicleRepository
{
    public function find(int $id): object
    {
        $connection = DatabaseConnection::getConnection();
        $sql = "SELECT * FROM vehicles WHERE id = {$id}";

        return $connection->query($sql)->fetchObject();
    }

    public function findAllWithColorName(): array
    {
        $connection = DatabaseConnection::getConnection();
        $sql = "SELECT 
                    vehicles.id,
                    vehicles.owner_name,
                    vehicles.model,
                    vehicles.plate,
                    color.name AS color_name
                FROM 
                    vehicles
                JOIN 
                    color ON vehicles.color_id = color.id";

        return $connection->query($sql)->fetchAll();
    }

    public function findByPlate(string $plate)
    {
        $connection = DatabaseConnection::getConnection();
        $sql = "SELECT * FROM vehicles WHERE plate = '{$plate}'";

        return $connection->query($sql)->fetch();
    }

    public function save(array $data): void
    {
        $connection = DatabaseConnection::getConnection();
        $sql = "INSERT INTO vehicles (owner_name, color_id, model, plate) VALUES (:ownerName, :colorId, :model, :plate)";

        $connection->prepare($sql)->execute($data);
    }

    public function edit(array $data): void
    {
        $connection = DatabaseConnection::getConnection();
        $sql = "UPDATE vehicles " .
                "SET owner_name = :ownerName, color_id = :colorId, model = :model, plate = :plate " .
                "WHERE id = :id";

        $connection->prepare($sql)->execute($data);
    }

    public function remove(string $id): void
    {
        $connection = DatabaseConnection::getConnection();
        $sql = "DELETE FROM vehicles WHERE id={$id}";

        $connection->prepare($sql)->execute();
    }

}