
<main class="productos">
  <div class="contenedor-principal d-flex" style="height: 100vh;">

    <!-- NAV VERTICAL -->
    <div class="nav-vertical p-3" style="width: 250px;">
    <h5 class="text-white text-center mb-3">Categorías</h5>
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('procesadores'); ?>">Procesadores</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('motherboard'); ?>">Motherboard</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('placas_video'); ?>">Placas de video</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('ram'); ?>">Memorias Ram</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('almacenamiento'); ?>">Almacenamiento</a></li>
      </ul>
    </div>

    <!-- LISTA DE PRODUCTOS -->
    <div class="productos-contenedor" style="flex: 1; padding-left: 20px; overflow-y: auto;">

       <div class="productos-contenedor">
        <?php
        // Definimos la lista de productos
        $productos = [
            //procesadores 
            ['nombre' => 'Intel core i5', 'precio' => 416100, 'imagen' => base_url('assets/img/Procesadores/i5.jpg')],
            ['nombre' => 'Intel core i7', 'precio' => 451550, 'imagen' => base_url('assets/img/Procesadores/i7.jpg')],
            ['nombre' => 'AMD Ryzen 3', 'precio' => 90000, 'imagen' => base_url('assets/img/Procesadores/ryzen3.jpeg')],
            ['nombre' => 'AMD Ryzen 5', 'precio' => 180000, 'imagen' => base_url('assets/img/Procesadores/ryzen5.jpeg')],
            ['nombre' => 'AMD Ryzen 7', 'precio' => 200000, 'imagen' => base_url('assets/img/Procesadores/ryzen7.jpeg')],
            ['nombre' => 'AMD Ryzen 7 7700X', 'precio' => 300000, 'imagen' => base_url('assets/img/Procesadores/ryzen7_7700x.jpeg')],
            //motherborad
            ['nombre' => 'AsRock B550M', 'precio' => 120000, 'imagen' => base_url('assets/img/mothers/amd/b550m.jpg')],
            ['nombre' => 'Asus prime A520M', 'precio' => 100000, 'imagen' => base_url('assets/img/mothers/amd/a520m.jpg')],
            ['nombre' => 'Gigabyte H510M', 'precio' => 120000, 'imagen' => base_url('assets/img/mothers/intel/H510M.png')],
            ['nombre' => 'AsRock H610M', 'precio' => 100000, 'imagen' => base_url('assets/img/mothers/intel/H610M.png')],
            //almacenamiento
            ['nombre' => 'HDD 1tb', 'precio' => 50000, 'imagen' => base_url('assets/img/discos/HDD1TB.png')],
            ['nombre' => 'M.2 240gb', 'precio' => 70000, 'imagen' => base_url('assets/img/discos/M2_240.png')],
            ['nombre' => 'M.2 1tb', 'precio' => 80000, 'imagen' => base_url('assets/img/discos/M2_1T.png')],
            ['nombre' => 'Ram 16gb', 'precio' => 70000, 'imagen' => base_url('assets/img/rams/RamXpg.png')],
            ['nombre' => 'Ram 32gb', 'precio' => 80000, 'imagen' => base_url('assets/img/rams/ram32.png')],
            //Placa de video
            ['nombre' => 'rx 7600', 'precio' => 80000, 'imagen' => base_url('assets/img/placasDeVideo/rx7600.jpg')],
            ['nombre' => 'rx 7800 xt', 'precio' => 130000, 'imagen' => base_url('assets/img/placasDeVideo/rx7800xt.jpg')],
            ['nombre' => 'rtx 4060', 'precio' => 180000, 'imagen' => base_url('assets/img/placasDeVideo/rtx4060.jpg')],
            ['nombre' => 'rtx 4090', 'precio' => 280000, 'imagen' => base_url('assets/img/placasDeVideo/rtx4090.jpg')],
        ]
        ?>

        <?php foreach ($productos as $producto): ?>
          <div class="col d-flex justify-content-center"> <!-- Centra las tarjetas -->
            <div class="producto">
              <img src="<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>">
              <div class="titulo"><?= $producto['nombre'] ?></div>
              <div class="precio">$<?= number_format($producto['precio'], 0, ',', '.') ?></div>
              <button class="boton-comprar">Comprar</button>
            </div>
          </div>
        <?php endforeach; ?>


      </div>

    </div>
  </div>

</main>

