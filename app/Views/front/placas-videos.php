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
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('placas-videos'); ?>">Placas de Video</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('almacenamiento'); ?>">Almacenamiento</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('memoria-ram'); ?>">Memorias RAM</a></li>
          </ul>
        </div>
      </div>

      <!-- Columna de Productos esta parte  weno arios-->
      <div class="col-12 col-md-10 p-4">
        <div class="row g-4">

          <?php if (!empty($productos)): // Verifica si hay productos para mostrar ?>
            <?php foreach ($productos as $producto): // Cambié $Productos a $producto por convención ?>
              <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                <div class="producto w-100">
                  <div class="producto-img-container">
                    <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" alt="<?= $producto['nombre_prod'] ?>" class="producto-img">
                  </div>
                  <div class="producto-info">
                    <h5 class="titulo"><?= $producto['nombre_prod'] ?></h5>
                    <p class="precio">$<?= number_format($producto['precio_vta'], 0, ',', '.') ?></p>
                    <button class="boton-comprar">Comprar</button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="col-12">
              <p>No hay productos disponibles en este momento.</p>
            </div>
          <?php endif; ?>

        </div>
      </div>
      <script src="assets/js/bootstrap.bundle.min.js"></script>
    </div>
  </div>
</main>
