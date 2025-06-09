<main class="container my-5 text-dark"> <h2 class="mb-4 text-center text-dark">Información para el pago</h2> <?php
    $metodo_pago = $_POST['metodo_pago'] ?? '';
    $metodo_envio = $_POST['metodo_envio'] ?? '';
    $total_pagar = $_POST['total_pagar'] ?? 0;
  ?>

  <div class="p-4 bg-dark-subtle rounded shadow-sm">
    <p class="text-dark"><strong>Método de pago seleccionado:</strong> <?= esc($metodo_pago) ?></p>
    <p class="text-dark"><strong>Método de envío:</strong> <?= esc($metodo_envio ?: 'No seleccionado') ?></p>
    <p class="text-dark" style="font-size: 1.25rem; font-weight: bold; color: black;">
      <strong>Total a pagar:</strong> $<?= number_format($total_pagar, 0, ',', '.') ?>
    </p>
  </div>

  <div class="mt-4 p-4 bg-dark-subtle rounded shadow-sm">
    <?php if ($metodo_pago === 'tarjeta'): ?>
      <h4 class="text-dark">Pago con tarjeta</h4>
      <p class="text-dark">Ingrese los datos de su tarjeta para completar el pago.</p>
      <form action="<?= base_url('procesarPagoTarjeta') ?>" method="POST">
        <input type="hidden" name="total_pagar" value="<?= esc($total_pagar) ?>">
        <div class="mb-3">
          <label class="form-label text-dark">Número de tarjeta</label>
          <input type="text" class="form-control" name="num_tarjeta" required>
        </div>
        <div class="mb-3">
          <label class="form-label text-dark">Fecha de vencimiento</label>
          <input type="month" class="form-control" name="vencimiento" required>
        </div>
        <div class="mb-3">
          <label class="form-label text-dark">CVV</label>
          <input type="password" class="form-control" name="cvv" required maxlength="4">
        </div>
        <button type="submit" class="btn btn-primary">Pagar</button>
      </form>

    <?php elseif ($metodo_pago === 'paypal'): ?>
      <h4 class="text-dark">Pago con PayPal</h4>
      <p class="text-dark">Para pagar con PayPal, haga clic en el siguiente botón:</p>
      <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=TU_EMAIL_PAYPAL&amount=<?= $total_pagar ?>&currency_code=USD" target="_blank" class="btn btn-primary">
        Pagar con PayPal
      </a>

    <?php elseif ($metodo_pago === 'mercado_pago'): ?>
      <h4 class="text-dark">Pago con Mercado Pago</h4>
      <p class="text-dark">Para pagar con Mercado Pago, haga clic en el siguiente botón:</p>
      <a href="https://www.mercadopago.com.ar/checkout/v1/redirect?pref_id=TU_PREF_ID" target="_blank" class="btn btn-warning">
        Pagar con Mercado Pago
      </a>

    <?php elseif ($metodo_pago === 'efectivo'): ?>
      <h4 class="text-dark">Pago en efectivo</h4>
      <p class="text-dark">Puede realizar el pago en efectivo al momento de la entrega o retiro en tienda.</p>
    <?php else: ?>
      <p class="text-dark">Método de pago no reconocido.</p>
    <?php endif; ?>
  </div>

  <div class="mt-4">
    <a href="<?= base_url('carrito') ?>" class="btn btn-secondary">Volver al carrito</a>
  </div>
</main>