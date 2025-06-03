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

$routes->get('/usuarioData', 'Usuario_controller::usuarioData');

  /*rutas front productos*/
$routes->get('/productos-catalogo', 'ProductoController::mostrarProductosFront'); 

$routes->get('carrito', 'Home::carrito');


$routes->get('productos', 'ProductoController::productosPorCategoria');
$routes->get('productos/categoria/(:num)', 'ProductoController::productosPorCategoria/$1');


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

/*rutas navbar <Administrador></Administrador>*/
$routes->get('crudProductos', 'ProductoController::index');
$routes->get('crudUsuarios', 'Usuario_Controller::index');
$routes->post('guardar_rol', 'Usuario_controller::guardarRol');

/*cargar un nuevo producto*/
$routes->get('crear', 'ProductoController::crearProducto'); // Muestra el formulario
$routes->post('enviar-prod', 'ProductoController::store'); // Procesa el formulario (guardar producto)
$routes->get('/producto/listar', 'ProductoController::listar');

 /*Consulta*/
 $routes->post('/guardar-consulta', 'Consulta_controller::guardarConsulta');
 // Muestra la lista de consultas
$routes->get('/consultas', 'Consulta_controller::verConsultas');

// Marca como leído/no leído
$routes->post('/consultas/marcarLeido/(:num)', 'Consulta_controller::marcarLeido/$1');

//Rutas editar datos perfil

$routes->post('/actualizarPerfil', 'Usuario_controller::actualizarPerfil');

 
