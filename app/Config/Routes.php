<?php

use App\Controllers\PatientController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PatientController::index');
$routes->get('patients/list', 'PatientController::list');
$routes->post('patients/create', 'PatientController::create');
$routes->post('patients/update/(:num)', 'PatientController::update/$1');
$routes->delete('patients/delete/(:num)', 'PatientController::delete/$1');

$routes->get('pcps/list', 'PcpsController::list');
