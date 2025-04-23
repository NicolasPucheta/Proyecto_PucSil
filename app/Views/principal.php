<?= view('front/head_view'); ?>
    <!-- Carousel de imagenes -->
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
          <div class="carousel-item active">
              <img src="assets\img\carrusel principal\publi1.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
              <img src="assets\img\carrusel principal\publi3.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
              <img src="assets\img\carrusel principal\publi4.png" class="d-block w-100" alt="...">
          </div>

      </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>[]
      </div>

    <!-- Carrusel de productos infinito en caja -->
    <section class="caja-carrusel">
      <h2 style= color:white class="titulo-caja">¡Lo más vendido!</h2>
    <div class="carrusel-infinito">
       <div class="carousel-track">

        <div class="item-producto">
          <img src="assets\img\Procesadores\i5.jpg" alt="i5">
          <p class="precio">Precio Lista: $125.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>

        <div class="item-producto">
          <img src="assets\img\Procesadores\i7.jpg" alt="i7">
          <p class="precio">Precio Lista: $90.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>

        <div class="item-producto">
          <img src="assets\img\placasDeVideo\rtx4090.jpg" alt="4090">
          <p class="precio">Precio Lista: $90.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>

        <div class="item-producto">
          <img src="assets\img\placasDeVideo\rtx4060.jpg" alt="4060">
          <p class="precio">Precio Lista: $90.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>

        <div class="item-producto">
          <img src="assets\img\placasDeVideo\rx7600.jpg" alt="rx760'">
          <p class="precio">Precio Lista: $90.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>

        <div class="item-producto">
          <img src="assets\img\Procesadores\ryzen7_7700x.jpeg" alt="Ryzen 7">
          <p class="precio">Precio Lista: $90.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>

        <div class="item-producto">
          <img src="assets\img\rams\ram1.png" alt="Ram">
          <p class="precio">Precio Lista: $90.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>
            <!-- Duplicados para loop -->
            <div class="item-producto">
          <img src="assets\img\Procesadores\i5.jpg" alt="i5">
          <p class="precio">Precio Lista: $125.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>

        <div class="item-producto">
          <img src="assets\img\Procesadores\i7.jpg" alt="i7">
          <p class="precio">Precio Lista: $90.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>

        <div class="item-producto">
          <img src="assets\img\placasDeVideo\rtx4090.jpg" alt="1">
          <p class="precio">Precio Lista: $90.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>

        <div class="item-producto">
          <img src="assets\img\placasDeVideo\rtx4060.jpg" alt="1">
          <p class="precio">Precio Lista: $90.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>

        <div class="item-producto">
          <img src="assets\img\placasDeVideo\rx7600.jpg" alt="1">
          <p class="precio">Precio Lista: $90.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>

        <div class="item-producto">
          <img src="assets\img\Procesadores\ryzen7_7700x.jpeg" alt="1">
          <p class="precio">Precio Lista: $90.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>

        <div class="item-producto">
          <img src="assets\img\rams\ram1.png" alt="1">
          <p class="precio">Precio Lista: $90.000</p>
          <img class="carrito-icono" src="assets/img/carrito.png" alt="Agregar al carrito">
        </div>
</section>
    
       <!-- Info Envios -->
    <a href="<?= base_url('comercializacion'); ?>" style = "text-decoration: none;" >    
    <section class="info-section">
      <div class="info-container">
    
        <div class="info-card" tabindex="-1">
          <img src="assets\img\iconos\camion.png" alt="camion">
          <h2>Envios a todo el Pais</h2>
        </div>
        <div class="info-card" tabindex="-1">
          <img src="assets\img\iconos\pagos.png" alt="pagos">
          <h2>Aceptamos Tarjetas debito/credito</h2>
        </div>
        <div class="info-card" tabindex="-1">
          <img src="assets\img\iconos\paquete2.png" alt="camion">
          <h2>%100 Confiables</h2>
        </div>
      </div>
    </section>
  </a>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
    <?= view('front/footer_view'); ?>