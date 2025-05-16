<nav class="menu navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <div class="row w-100 align-items-center">

            <div class="col-12 col-md-4 d-flex align-items-center">
                <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand d-none d-lg-block" href="<?php echo base_url() ?>">
                    <img src="assets\img\Logo3.png" alt="Logo" height="80">
                </a>

                <a class="navbar-brand d-block d-lg-none" href="<?php echo base_url() ?>">
                    <img src="assets/img/iconos/favicon.ico" alt="Logo pequeño" height="40">
                </a>
            </div>

            <div class="col-12 col-md-5 d-flex flex-column justify-content-center align-items-center mb-3 mb-lg-0 mt-1">
                <div class="d-flex align-items-center w-100 mb-2">
                    <button type="button" class="search-home-button me-2" onclick="location.href='<?php echo base_url() ?>'">
                        <i class="bi bi-house-door"></i>
                    </button>
                    <form action="/search" method="get" class="d-flex align-items-center w-100">
                        <input type="text" placeholder="¿Qué estás buscando?" name="query" class="form-control search-input me-2">
                        <button type="submit" class="search-button">🔍</button>
                    </form>
                </div>

                <div class="collapse navbar-collapse justify-content-center mt-2" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="<?php echo base_url('productos'); ?>" class="nav-link">Productos</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('comercializacion'); ?>" class="nav-link">Comercialización</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('quienesSomos'); ?>" class="nav-link">Quiénes Somos</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('ayuda'); ?>" class="nav-link">Ayuda</a></li>
                        <li class="nav-item"><a href="<?php echo base_url('legal'); ?>" class="nav-link">Legal</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-3 d-flex justify-content-end align-items-center mb-3 mb-lg-0">
                <a href="<?php echo base_url('carrito'); ?>" class="btn btn-outline-primary me-2">
                    <i class="bi bi-cart-fill"></i> Carrito
                </a>
                <a href="<?php echo base_url('login'); ?>" class="btn btn-outline-success">
                    <i class="bi bi-person-fill"></i> Iniciar Sesión
                </a>
            </div>

        </div>
    </div>
</nav>

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