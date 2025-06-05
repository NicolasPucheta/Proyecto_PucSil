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

$routes->get('detalleCompra', 'carrito_controller::finalizarCompra');


/*rutas para el login*/
$routes->get('/login', 'Home::login');
$routes->post('/enviarlogin', 'Login_controller::auth');
$routes->post('/panel', 'Panel_controller::index',['filter' => 'auth']);
$routes->get('/logout', 'Login_controller::logout');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/principal', 'Home::principal');

//RUTAS PARA USUARIOS 
/*rutas del registro de Usuario*/
$routes->get('/registro', 'Home::registro');
$routes->post('/enviar-form','Usuario_controller::formValidation');
/*Eliminar usuarios*/
$routes->get('usuarios/eliminar/(:num)', 'Usuario_Controller::eliminar/$1');
//Rutas editar datos perfil
$routes->post('/actualizarPerfil', 'Usuario_controller::actualizarPerfil');

/*rutas navbar <Administrador></Administrador>*/
$routes->get('crudProductos', 'ProductoController::index');
$routes->get('crudUsuarios', 'Usuario_Controller::index');
$routes->post('guardar_rol', 'Usuario_controller::guardarRol');

//RUTAS PARA PRODUCTOS
/*cargar un nuevo producto*/
$routes->get('crear', 'ProductoController::crearProducto'); // Muestra el formulario
$routes->post('enviar-prod', 'ProductoController::store'); // Procesa el formulario (guardar producto)
$routes->get('/producto/listar', 'ProductoController::listar');
/*Eliminar producto*/
$routes->get('producto/eliminar/(:num)', 'ProductoController::eliminar/$1');

$routes->get('productos', 'ProductoController::productosPorCategoria');
$routes->get('productos/categoria/(:num)', 'ProductoController::productosPorCategoria/$1');

//RUTAS PARA CONSULTAS
 /*Consulta*/
 $routes->post('/guardar-consulta', 'Consulta_controller::guardarConsulta');
 // Muestra la lista de consultas
$routes->get('/consultas', 'Consulta_controller::verConsultas');
// Marca como leído/no leído
$routes->post('/consultas/marcarLeido/(:num)', 'Consulta_controller::marcarLeido/$1');
//muestra ventas admin
$routes->get('muestra-ventas', 'ProductoController::mostrarVentas');

// Rutas para el carrito*/
// muestra todos los productos del catalogo
$routes->get('/productos-catalogo', 'ProductoController::mostrarProductosFront', ['filter' => 'auth']);

// carga la vista carrito_parte_view
$routes->get('carrito', 'carrito_controller::Carrito', ['filter' => 'auth']);

// actualiza los datos del carrito
$routes->get('/carrito_actualiza', 'carrito_controller::actualiza_carrito', ['filter' => 'auth']);

// agregar los items seleccionados
$routes->post('carrito/add', 'carrito_controller::add', ['filter' => 'auth']);

// elimina un item del carrito
$routes->get('carrito_elimina/(:any)', 'carrito_controller::remove/$1', ['filter' => 'auth']);

// eliminar todo el carrito
$routes->get('/borrar', 'carrito_controller::borrar_carrito', ['filter' => 'auth']);

// Registrar la venta en las tablas
$routes->get('/carrito-comprar', 'Ventascontroller::registrar_venta', ['filter' => 'auth']);

// botones de sumar y restar en la vista del carrito
$routes->get('carrito_suma/(:any)', 'carrito_controller::suma/$1');
$routes->get('carrito_resta/(:any)', 'carrito_controller::resta/$1');



 
