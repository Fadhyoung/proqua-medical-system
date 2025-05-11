<?php

use App\Controllers\AuthController;
use App\Controllers\DoctorController;
use App\Controllers\PatientController;
use App\Controllers\PcpsController;
use App\Controllers\RegisterController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('register', [RegisterController::class, 'registerView']);
$routes->post('register', [RegisterController::class, 'registerAction']);
service('auth')->routes($routes, ['except' => ['register']]);

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', [PatientController::class, 'index']);
    $routes->get('doctors', [DoctorController::class, 'index']);
    $routes->get('logout', [AuthController::class, 'logout']);
    $routes->delete('user', [AuthController::class, 'deleteUser']);
});

$routes->group('api/v1', ['filter' => 'auth'], static function ($routes) {
    $routes->get('patients', [PatientController::class, 'list']);
    $routes->post('patients', [PatientController::class, 'create']);
    $routes->put('patients/(:num)', [PatientController::class, 'update/$1']);
    $routes->delete('patients/(:num)', [PatientController::class, 'delete/$1']);

    $routes->get('pcps', [PcpsController::class, 'list']);
});
