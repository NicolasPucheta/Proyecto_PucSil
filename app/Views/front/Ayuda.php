<main class="ayuda bg-dark text-light">
  <div class="container py-5">
    <!-- Título principal -->
    <div class="text-center mb-4">
      <h2 class="display-4 fw-bold text-info">Centro de Ayuda</h2>
    </div>

    <!-- Sección de contenido -->
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8">
        <p>
          Bienvenido al centro de ayuda de <strong>GGHardware</strong>. Aquí podrás encontrar respuestas a las preguntas más frecuentes sobre nuestros productos y servicios.
        </p>
        <!-- Sección FAQ -->
        <div class="faq-item">
          <h3>¿Cómo realizar un pedido?</h3>
          <p>Para realizar un pedido, solo debes seleccionar tus productos, agregarlos al carrito y seguir el proceso de pago.</p>
        </div>

        <div class="faq-item">
          <h3>¿Qué métodos de pago se aceptan?</h3>
          <p>Aceptamos tarjetas de crédito, débito, transferencias bancarias y pagos a través de plataformas seguras.</p>
        </div>

        <div class="faq-item">
          <h3>¿Realizan envíos a todo el país?</h3>
          <p>Sí, realizamos envíos a todo el país. Los costos y tiempos de entrega dependen de tu ubicación.</p>
        </div>

        <div class="faq-item">
          <h3>¿Cómo puedo contactar con atención al cliente?</h3>
          <p>Puedes contactar con nosotros dirigiéndote al pie de página en la parte de contacto, o en el botón de abajo 👇</p>
        </div>
      </div>
    </div>

    <!-- Botón de contacto -->
    <div class="text-center mt-4">
      <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#contactModal">
        Contáctanos para más información
      </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="contactModalLabel">Dejanos tu consulta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>

          <div class="modal-body">
            <form method="POST" action="<?= base_url('/guardar-consulta') ?>">
              <?= csrf_field() ?>
              <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" required>
              </div>
              <div class="mb-3">
                <label for="mensaje" class="form-label">Tu consulta</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="4" placeholder="Escribí tu mensaje aquí..." required></textarea>
              </div>

              <div class="modal-footer px-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</main>
