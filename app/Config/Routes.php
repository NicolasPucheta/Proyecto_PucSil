<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('legal', 'Legal::index');
$routes->get('home/legal', 'Home::legal');
