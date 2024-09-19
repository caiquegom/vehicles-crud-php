<?php

namespace app\controllers;

use app\framework\Router;
use app\framework\Template;
use app\repositories\ColorRepository;
use app\repositories\VehicleRepository;
use app\services\VehicleService;

class VehicleController
{
    public function index(): void
    {
        try {
            $vehiclesRepository = new VehicleRepository();
            $vehiclesList = $vehiclesRepository->findAllWithColorName();

            $viewData = ["vehicles" => $vehiclesList];
            Template::render("home", $viewData);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function show()
    {
        $id = Router::$params["id"];

        try {
            $vehiclesRepository = new VehicleRepository();
            $vehicle = $vehiclesRepository->find($id);

            $colorsRepository = new ColorRepository();
            $colors = $colorsRepository->getAll();

            $viewData = [
                "id" => $id,
                "vehicle" => $vehicle,
                "colors" => $colors
            ];
            Template::render("editVehicle", $viewData);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function store(): void
    {
        try {
            if (empty($_POST)) {
                throw new \Exception("Nenhum dado foi enviado");
            }

            $vehiclesService= new VehicleService();
            if (!$vehiclesService->verifyUniquePlate($_POST['plate']))
                throw new \Exception("Placa já está cadastrada");

            $data = [
                'ownerName' => $_POST['ownerName'],
                'model' => $_POST['model'],
                'colorId' => $_POST['colorId'],
                'plate' => $_POST['plate']
            ];

            foreach ($data as $key => $value) {
                if (!isset($value)) {
                    throw new \Exception("Faltando dado {$key}");
                }
            }


            $vehiclesRepository = new VehicleRepository();
            $vehiclesRepository->save($data);

            header('Location: http://localhost:8080/');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update(): void
    {
        try {
            if (empty($_POST)) {
                throw new \Exception("Nenhum dado foi enviado");
            }

            $vehiclesService= new VehicleService();
            if (!$vehiclesService->verifyUniquePlate($_POST['plate']))
                throw new \Exception("Placa já está cadastrada");

            $data = [
                'id' => Router::$params["id"],
                'ownerName' => $_POST['ownerName'],
                'model' => $_POST['model'],
                'colorId' => $_POST['colorId'],
                'plate' => $_POST['plate']
            ];

            foreach ($data as $key => $value) {
                if (!isset($value)) {
                    throw new \Exception("Faltando dado {$key}");
                }
            }


            $vehiclesRepository = new VehicleRepository();
            $vehiclesRepository->edit($data);

            header('Location: http://localhost:8080/');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete(): void
    {
        $id = Router::$params["id"];
        echo $id;
        try {
            $vehiclesRepository = new VehicleRepository();
            $vehiclesRepository->remove($id);

            header('Location: http://localhost:8080/');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function newVehicle(): void
    {
        try {
            $colorRepository = new ColorRepository();
            $colorsList = $colorRepository->getAll();

            $viewData = ["colors" => $colorsList];
            Template::render("newVehicle", $viewData);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}