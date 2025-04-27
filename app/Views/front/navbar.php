<nav class="menu navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <div class="row w-100">
            <div class="col-12 col-md-4">
            </div>

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
            </div>

            <div class="col-12 col-md-3   d-flex justify-content-lg-end justify-content-center align-items-center mb-3 mb-lg-0">
                <a href="<?php echo base_url('carrito'); ?>" class="btn btn-outline-primary me-2">
                    <i class="bi bi-cart-fill"></i> Carrito
                </a>
                <button class="btn btn-outline-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLogin">
                    <i class="bi bi-person-fill"></i> Iniciar Sesión
                </button>
            </div>

            <div class="col-12 d-flex justify-content-center"> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="col-12 navbar-collapse justify-content-center mt-3    mt-2 mb-3" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="<?php echo base_url('productos'); ?>" class="nav-link">Productos</a></li>
                    <li class="nav-item"><a href="<?php echo base_url('comercializacion'); ?>" class="nav-link">Comercialización</a></li>
                    <li class="nav-item"><a href="<?php echo base_url('quienesSomos'); ?>" class="nav-link">Quiénes Somos</a></li>
                    <li class="nav-item"><a href="<?php echo base_url('ayuda'); ?>" class="nav-link">Ayuda</a></li>
                    <li class="nav-item"><a href="<?php echo base_url('legal'); ?>" class="nav-link">Legal</a></li>
                </ul>
                <a href="<?php echo base_url('carrito'); ?>" class="btn btn-outline-primary me-2 d-block d-lg-none mt-3">
                    <i class="bi bi-cart-fill"></i> Carrito
                </a>
                <button class="btn btn-outline-success d-block d-lg-none mt-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLogin">
                    <i class="bi bi-person-fill"></i> Iniciar Sesión
                </button>
            </div>
        </div>
    </div>
</nav>