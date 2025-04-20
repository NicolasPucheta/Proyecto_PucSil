<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos | GGHardware</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <link href="<?= base_url('assets/css/productos.css') ?>" rel="stylesheet">
</head><body class="productos">
  <div class="contenedor-principal d-flex">
    
    <!-- NAV VERTICAL -->
    <div class="nav-vertical p-3">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('procesadores'); ?>">Procesadores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('motherboard'); ?>">Motherboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('placas_video'); ?>">Placas de video</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('ram'); ?>">Memorias Ram</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('almacenamiento'); ?>">Almacenamiento</a>
        </li>
    </ul>

    </div>

    <!-- LISTA DE PRODUCTOS (PROCESADORES) -->
    <div class="productos-lista d-flex flex-wrap gap-4 p-3">
      <div class="producto">
        <img src="<?= base_url('assets/img/Procesadores/i5.jpg') ?>" alt="Intel core i5">
        <div class="titulo">Intel core i5</div>
        <div class="precio">$416.100</div>
        <button class="boton-comprar">Comprar</button>
      </div>

      <div class="producto">
        <img src="<?= base_url('assets/img/Procesadores/i7.jpg') ?>" alt="Intel core i7">
        <div class="titulo">Intel core i7</div>
        <div class="precio">$451.550</div>
        <button class="boton-comprar">Comprar</button>
      </div>

      <div class="producto">
        <img src="<?= base_url('assets/img/Procesadores/ryzen3.jpeg') ?>" alt="AMD Ryzen 3">
        <div class="titulo">AMD Ryzen 3</div>
        <div class="precio">$90.000</div>
        <button class="boton-comprar">Comprar</button>
      </div>

      <div class="producto">
        <img src="<?= base_url('assets/img/Procesadores/ryzen5.jpeg') ?>" alt="AMD Ryzen 5">
        <div class="titulo">AMD Ryzen 5</div>
        <div class="precio">$180.000</div>
        <button class="boton-comprar">Comprar</button>
      </div>

      <div class="producto">
        <img src="<?= base_url('assets/img/Procesadores/ryzen7.jpeg') ?>" alt="AMD Ryzen 7">
        <div class="titulo">AMD Ryzen 7</div>
        <div class="precio">$200.000</div>
        <button class="boton-comprar">Comprar</button>
      </div>

      <div class="producto">
        <img src="<?= base_url('assets/img/Procesadores/ryzen7_7700x.jpeg') ?>" alt="AMD Ryzen 7 7700X">
        <div class="titulo">AMD Ryzen 7 7700X</div>
        <div class="precio">$300.000</div>
        <button class="boton-comprar">Comprar</button>
      </div>
    </div>
  </div>

   
</body>
</html>
