<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('legal', 'Home::legal');

$routes->get('quienesSomos', 'Home::quienesSomos');

$routes->get('ayuda', 'Home::ayuda');

$routes->get('comercializacion', 'Home::comercializacion');

$routes->get('productos', 'Home::Productos');

$routes->get('carrito', 'Home::carrito');

$routes->get('almacenamiento', 'Home::Almacenamiento');


$routes->get('motherboard', 'Home::Motherboard');