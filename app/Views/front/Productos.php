<main class="procesadores">
  <div class="container-fluid">
    <div class="row">

      <div class="col-12 col-md-2 p-3">
        <button class="btn btn-info w-100 mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#categorias" aria-expanded="true" aria-controls="categorias">
          Categorías
        </button>
        <div class="collapse show" id="categorias">
          <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="<?= base_url('productos/categoria/1') ?>">Procesadores</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('productos/categoria/2') ?>">Motherboards</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('productos/categoria/3') ?>">Memoria RAM</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('productos/categoria/4') ?>">Placas de Video</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('productos/categoria/5') ?>">Almacenamiento</a></li>
          </ul>
        </div>
      </div>

      <div class="col-12 col-md-10 p-4">
        <div class="row g-4">

          <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
              <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                <div class="producto w-100">
                  <div class="producto-img-container">
                    <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" alt="<?= $producto['nombre_prod'] ?>" class="producto-img">
                  </div>
                  <div class="producto-info">
                    <h5 class="titulo"><?= $producto['nombre_prod'] ?></h5>
                    <p class="precio">$<?= number_format($producto['precio_vta'], 0, ',', '.') ?></p>

                    <?php if ($producto['stock'] > 0): ?>
                      <?= form_open('carrito/add') ?>
                        <?= form_hidden('id', $producto['id']) ?>
                        <?= form_hidden('precio_vta', $producto['precio_vta']) ?>
                        <?= form_hidden('nombre_prod', $producto['nombre_prod']) ?>
                        <?php
                          $btn = array(
                            'class' => 'btn btn-secondary fuenteBotones',
                            'value' => 'Agregar al Carrito',
                            'name'  => 'action'
                          );
                          echo form_submit($btn);
                          echo form_close();
                        ?>
                    <?php else: ?>
                      <p class="text-danger">Sin stock</p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="col-12">
              <h2 class="text-center tit">No hay productos disponibles</h2>
            </div>
          <?php endif; ?>

        </div>
      </div>

    </div>
  </div>


  <?php if (session()->getFlashdata('success')): ?>
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
    <div id="toastCarrito" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <?= session()->getFlashdata('success') ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
      </div>
    </div>
  </div>
<?php endif; ?>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    const toastEl = document.getElementById('toastCarrito');
    if (toastEl) {
      const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
      toast.show();
    }
  });
</script>


<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

