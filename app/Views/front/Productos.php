<main class="procesadores">

  <div class="container-fluid">
    <div class="row">

      <!-- Columna de Categorías -->
      <div class="col-12 col-md-2 p-3">
        <button class="btn btn-info w-100 mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#categorias" aria-expanded="true" aria-controls="categorias">
          Categorías
        </button>

        <div class="collapse show" id="categorias">
          <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Procesadores'); ?>">Procesadores</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('motherboard'); ?>">Motherboards</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('placa-videos'); ?>">Placas de Video</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('almacenamiento'); ?>">Almacenamiento</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('memoria-ram'); ?>">Memorias RAM</a></li>
          </ul>
        </div>
      </div>

      <!-- Columna de Productos esta parte -->
      <div class="col-12 col-md-10 p-4">
        <div class="row g-4">

          <?php
          $productos = [
            ['nombre' => 'Intel Core i5', 'precio' => 416100, 'imagen' => base_url('assets/img/Procesadores/i5.jpg')],
            ['nombre' => 'Intel Core i7', 'precio' => 451550, 'imagen' => base_url('assets/img/Procesadores/i7.jpg')],
            ['nombre' => 'AMD Ryzen 3', 'precio' => 90000, 'imagen' => base_url('assets/img/Procesadores/ryzen3.jpeg')],
            ['nombre' => 'AsRock B550M', 'precio' => 120000, 'imagen' => base_url('assets/img/mothers/amd/b550m.jpg')],
            ['nombre' => 'Asus Prime A520M', 'precio' => 100000, 'imagen' => base_url('assets/img/mothers/amd/a520m.jpg')],
            ['nombre' => 'RX 7600', 'precio' => 80000, 'imagen' => base_url('assets/img/placasDeVideo/rx7600.jpg')],
            ['nombre' => 'SSD m.2 1TB', 'precio' => 80000, 'imagen' => base_url('assets/img/discos/M2_1T.png')],
            ['nombre' => 'SSD 240GB', 'precio' => 20000, 'imagen' => base_url('assets/img/discos/M2_240.png')],
             ['nombre' => 'Memoria Ram 16gb XPG', 'precio' => 25000, 'imagen' => base_url('assets/img/rams/RamXpg.png')],
            ['nombre' => 'Memoria Ram 32gb RGB', 'precio' => 80000, 'imagen' => base_url('assets/img/rams/ram32.png')]
          ];
          ?>

          <?php foreach ($productos as $Productos): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
              <div class="producto w-100">
                <div class="producto-img-container">
                  <img src="<?= $Productos['imagen'] ?>" alt="<?= $Productos['nombre'] ?>" class="producto-img">
                </div>
                <div class="producto-info">
                  <h5 class="titulo"><?= $Productos['nombre'] ?></h5>
                  <p class="precio">$<?= number_format($Productos['precio'], 0, ',', '.') ?></p>
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
