<main>
 
  <!-- Carousel de imágenes -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/carrusel principal/publi1.jpg" class="d-block w-100 img-fluid" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/img/carrusel principal/publi3.png" class="d-block w-100 img-fluid" alt="...">
    </div>
    <div class="carousel-item">
      <img src="assets/img/carrusel principal/publi4.png" class="d-block w-100 img-fluid" alt="...">
    </div>
  </div>

  <!-- Botones de navegación -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


<section class="caja-carrusel">
  <h2 class="titulo-caja">¡Lo más vendido!</h2>
  <div class="carrusel-infinito">
    <div class="carousel-track">

      <!-- Item 1 -->
      <div class="item-producto">
        <img src="assets/img/Procesadores/i5.jpg" alt="i5">
      
      </div>

      <!-- Item 2 -->
      <div class="item-producto">
        <img src="assets/img/Procesadores/i7.jpg" alt="i7">

      </div>

      <!-- Item 3 -->
      <div class="item-producto">
        <img src="assets/img/placasDeVideo/rtx4090.jpg" alt="4090">
     
      
      </div>

      <!-- Item 4 -->
      <div class="item-producto">
        <img src="assets/img/placasDeVideo/rtx4060.jpg" alt="4060">
  
       
      </div>

      <!-- Item 5 -->
      <div class="item-producto">
        <img src="assets/img/placasDeVideo/rx7600.jpg" alt="rx7600">
  
      </div>

      <!-- Item 6 -->
      <div class="item-producto">
        <img src="assets/img/Procesadores/ryzen7_7700x.jpeg" alt="Ryzen 7">

      </div>

      <!-- Item 7 -->
      <div class="item-producto">
        <img src="assets/img/rams/ram1.png" alt="Ram">
     
      </div>

      <!-- Duplicados para loop (para hacer el carrusel infinito) -->
      <div class="item-producto">
        <img src="assets/img/Procesadores/i5.jpg" alt="i5">

      </div>

      <div class="item-producto">
        <img src="assets/img/Procesadores/i7.jpg" alt="i7">

      </div>

      <div class="item-producto">
        <img src="assets/img/placasDeVideo/rtx4090.jpg" alt="1">
   

      </div>

      <div class="item-producto">
        <img src="assets/img/placasDeVideo/rtx4060.jpg" alt="1">
      </div>

      <div class="item-producto">
        <img src="assets/img/placasDeVideo/rx7600.jpg" alt="1">
     
      </div>

      <div class="item-producto">
        <img src="assets/img/Procesadores/ryzen7_7700x.jpeg" alt="1">

      </div>

      <div class="item-producto">
        <img src="assets/img/rams/ram1.png" alt="1">

      </div>
    </div>
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
        </a>

        <a href="<?= base_url('ayuda'); ?>" style = "text-decoration: none;" >    
        <div class="info-card" tabindex="-1">
          <img src="assets\img\iconos\pagos.png" alt="pagos">
          <a href="<?= base_url('ayuda'); ?>" style = "text-decoration: none;" >   
          <h2>Todos los medios de pagos</h2>
        </div>
        </a>
        <a href="<?= base_url('comercializacion'); ?>" style = "text-decoration: none;" >    
        <div class="info-card" tabindex="-1">
          <img src="assets\img\iconos\paquete2.png" alt="camion">
          <h2>%100 Confiables</h2>
        </div>
        </a>
      </div>
    </section>
    <?php if (session()->get('logged_in') && session()->get('perfil_id') == 2): ?>
        <a href="<?= base_url('/usuarioData') ?>" class="boton-flotante">
            🧑 Mi Perfil
        </a>
    <?php endif; ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</main>

