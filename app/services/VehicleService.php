<?php

namespace app\services;

use app\repositories\VehicleRepository;

class VehicleService
{
    public function verifyUniquePlate(string $plate): bool
    {
        $vehicleRepository = new VehicleRepository();
        $vehicle = $vehicleRepository->findByPlate($plate);

        return !boolval($vehicle);
    }
}