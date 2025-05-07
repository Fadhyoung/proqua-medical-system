<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Patient::index');
$routes->get('patients/list', 'Patient::list');
$routes->post('patients/create', 'Patient::create');
$routes->post('patients/update/(:num)', 'Patient::update/$1');
$routes->delete('patients/delete/(:num)', 'Patient::delete/$1');

