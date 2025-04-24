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
<nav class="menu navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    
    <div class="row w-100">
      <div class="col-12 col-md-4">
      </div>
      
      <!-- Sección búsqueda y botón de inicio -->
      <div class="col-12 col-md-5 d-flex flex-column justify-content-center align-items-center mb-3 mb-lg-0 mt-1">
          <div class="d-flex">
            <button type="button" class="search-home-button me-2" onclick="location.href='<?php echo base_url() ?>'">
              <i class="bi bi-house-door"></i>
            </button>
            <form action="/search" method="get" class="d-flex align-items-center w-100">
              <input type="text" placeholder="¿Qué estás buscando?" name="query" class="form-control search-input me-2">
              <button type="submit" class="search-button">🔍</button>
            </form>
          </div>

            <!-- Links de navegación -->
       <div class="col-12 collapse navbar-collapse justify-content-center mt-3   mt-2 mb-3" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="<?php echo base_url('productos'); ?>" class="nav-link">Productos</a></li>
          <li class="nav-item"><a href="<?php echo base_url('comercializacion'); ?>" class="nav-link">Comercialización</a></li>
          <li class="nav-item"><a href="<?php echo base_url('quienesSomos'); ?>" class="nav-link">Quiénes Somos</a></li>
          <li class="nav-item"><a href="<?php echo base_url('ayuda'); ?>" class="nav-link">Ayuda</a></li>
          <li class="nav-item"><a href="<?php echo base_url('legal'); ?>" class="nav-link">Legal</a></li>
        </ul>
      </div>

      </div>

      <!-- Carrito e Iniciar Sesión -->
      <div class="col-12 col-md-3  d-flex justify-content-lg-end justify-content-center align-items-center mb-3 mb-lg-0">
        <a href="<?php echo base_url('carrito'); ?>" class="btn btn-outline-primary me-2">
          <i class="bi bi-cart-fill"></i> Carrito
        </a>
        <button class="btn btn-outline-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLogin">
          <i class="bi bi-person-fill"></i> Iniciar Sesión
        </button>
      </div>

      <!-- Toggle nav (pantallas pequeñas) -->
      <div class="col-12 d-flex justify-content-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>


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

