<?php

use App\Controllers\DoctorController;
use App\Controllers\PatientController;
use App\Controllers\PcpsController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [PatientController::class, 'index']);
$routes->get('patients/list', [PatientController::class, 'list']);
$routes->post('patients/create', [PatientController::class, 'create']);
$routes->post('patients/update/(:num)', [PatientController::class, 'update/$1']);
$routes->delete('patients/delete/(:num)', [PatientController::class, 'delete/$1']);

$routes->get('pcps/list', [PcpsController::class, 'list']);

$routes->get('/doctors', [DoctorController::class, 'index']);
