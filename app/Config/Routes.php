<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('legal', 'Home::legal');

$routes->get('quienesSomos', 'Home::quienesSomos');

$routes->get('ayuda', 'Home::ayuda');




