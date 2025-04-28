<main class="productos">

  <div class="container-fluid">
    <div class="row">

      <!-- Columna de Categorías -->
      <div class="col-12 col-md-2 p-3">
        <button class="btn btn-info w-100 mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#categorias" aria-expanded="true" aria-controls="categorias">
          Categorías
        </button>

        <div class="collapse show" id="categorias">
          <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="#">Procesadores</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Motherboards</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Placas de Video</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Almacenamiento</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Memorias RAM</a></li>
          </ul>
        </div>
      </div>

      <!-- Columna de Productos -->
      <div class="col-12 col-md-10 p-4">
        <div class="row g-4">

          <?php
          $productos = [
            ['nombre' => 'Intel Core i5', 'precio' => 416100, 'imagen' => base_url('assets/img/Procesadores/i5.jpg')],
            ['nombre' => 'Intel Core i7', 'precio' => 451550, 'imagen' => base_url('assets/img/Procesadores/i7.jpg')],
            ['nombre' => 'AMD Ryzen 3', 'precio' => 90000, 'imagen' => base_url('assets/img/Procesadores/ryzen3.jpeg')],
            ['nombre' => 'AsRock B550M', 'precio' => 120000, 'imagen' => base_url('assets/img/mothers/amd/b550m.jpg')],
            ['nombre' => 'Asus Prime A520M', 'precio' => 100000, 'imagen' => base_url('assets/img/mothers/amd/a520m.jpg')],
            ['nombre' => 'RX 7600', 'precio' => 80000, 'imagen' => base_url('assets/img/placasDeVideo/rx7600.jpg')]
          ];
          ?>

          <?php foreach ($productos as $producto): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
              <div class="producto w-100">
                <div class="producto-img-container">
                  <img src="<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>" class="producto-img">
                </div>
                <div class="producto-info">
                  <h5 class="titulo"><?= $producto['nombre'] ?></h5>
                  <p class="precio">$<?= number_format($producto['precio'], 0, ',', '.') ?></p>
                  <p class="descripcion">Descripción breve del producto.</p>
                  <button class="boton-comprar">Comprar</button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
      <script src="assets/js/bootstrap.bundle.min.js"></script>
    </div>
  </div>
</main>
