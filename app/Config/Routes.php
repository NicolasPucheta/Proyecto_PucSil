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

$routes->get('Procesadores', 'Home::Procesadores');

$routes->get('motherboard', 'Home::Motherboard');

$routes->get('placas-videos', 'Home::Placas_video');

$routes->get('almacenamiento', 'Home::Almacenamiento');

$routes->get('memoria-ram', 'Home::memorias_ram');


$routes->get('detalleCompra', 'Home::finalizarCompra');


/*rutas para el login*/
$routes->get('/login', 'Home::login');
$routes->post('/enviarlogin', 'Login_controller::auth');
$routes->post('/panel', 'Panel_controller::index',['filter' => 'auth']);
$routes->get('/logout', 'Login_controller::logout');


$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);


$routes->get('/principal', 'Home::principal');

/*rutas del registro de Usuario*/
$routes->get('/registro', 'Home::registro');
$routes->post('/enviar-form','Usuario_controller::formValidation');