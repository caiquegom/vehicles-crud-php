<?php

return [
    'GET' => [
        '/' => 'VehicleController@index',
        '/newVehicle' => 'VehicleController@newVehicle',
        '/vehicles/{id}/edit' => 'VehicleController@show',
    ],
    'POST' => [
        '/vehicles' => 'VehicleController@store',
        '/vehicles/{id}/edit' => 'VehicleController@update',
        '/vehicles/{id}/delete' => 'VehicleController@delete'
    ],
];