<main class="detalles-compra container my-5">
  <div class="compra-detalles">
    <h2 class="mb-4 text-center text-info">Información para el pago</h2>

    <div class="mt-4 p-4 bg-dark-subtle rounded shadow-sm">
      <p class="text-dark" style="font-size: 1.25rem; font-weight: bold; color: black;">
        <strong>Total a pagar:</strong> $<?= number_format($total_pagar, 0, ',', '.') ?>
      </p>

      <?php if ($metodo_pago === 'transferencia'): ?>
        <h4 class="text-dark">Datos para Transferencia Bancaria</h4>
        <ul class="text-dark">
          <li><strong>CBU:</strong> 0000003100000000000123</li>
          <li><strong>Alias:</strong> micuenta.empresa</li>
          <li><strong>Nombre del titular:</strong> Juan Pérez</li>
          <li><strong>Banco:</strong> Banco Nación</li>
        </ul>
        <p class="text-dark mt-2">Por favor, envíe el comprobante a nuestro WhatsApp una vez realizada la transferencia.</p>

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

    <div class="mt-4 text-center">
      <a href="<?= base_url('principal') ?>" class="btn btn-secondary">Volver</a>
      <button id="btn-descargar" class="btn btn-primary">Descargar Factura</button>
    </div>
  </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
  document.getElementById('btn-descargar').addEventListener('click', () => {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Obtener el contenido que querés pasar a PDF (puede ser el div con la factura)
    let contenido = document.querySelector('.compra-detalles').innerText;

    doc.text(contenido, 10, 10);
    doc.save('factura.pdf');
  });
</script>
