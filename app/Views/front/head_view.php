<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GGHardware</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600&family=Roboto&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/inicio.css') ?>" rel="stylesheet">

</head>

<body>
    <nav class="menu">
        <h2 class="Busqueda"> 
            <form action="/search" method="get" class="d-flex justify-content-center">
                <input type="text" placeholder="¿Qué estás buscando?" name="query form-control m-2" class="search-input">
                <button type="submit" class="search-button">🔍</button>
            </form>                                                 
        </h2>  
        <ul> 
            <li><a href="<?= base_url(); ?>">Inicio</a></li>  <!--  enlace a la página principal -->
            <li><a href="<?= base_url('productos'); ?>">Productos</a></li>
            <li><a href="<?= base_url('comercializacion'); ?>">Comercialización</a></li> 
            <li><a href="<?= base_url('quienesSomos'); ?>">Quiénes Somos</a></li>
            <li><a href="<?= base_url('ayuda'); ?>">Ayuda</a></li>
            <li><a href="<?= base_url('legal'); ?>">Legal</a></li>
        </ul>
        
        <div class="d-flex justify-content-end align-items-center botones-nav">

        <!-- Contenedor para los botones de inicio de sesión y carrito (alineados a la derecha) -->
        <div class="d-flex justify-content-end align-items-start pt-2 pb-0">
            <!-- Botón de Carrito -->
            <a href="<?= base_url('carrito'); ?>" class="btn btn-outline-primary me-2">
                <i class="bi bi-cart-fill"></i> Carrito
            </a>
            <!-- Botón de Iniciar Sesión -->
            <button class="btn btn-outline-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLogin">
                <i class="bi bi-person-fill"></i> Iniciar Sesión
            </button>
        </div>
        </div>
      </nav>

    <!-- Panel de inicio de sesión (Offcanvas) -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasLogin" aria-labelledby="offcanvasLoginLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasLoginLabel">Iniciar Sesión</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
      </div>
      <div class="offcanvas-body">
        <form action="<?= base_url('login'); ?>" method="post">
          <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="usuario@correo.com" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
      </div>
    </div>
</body>

