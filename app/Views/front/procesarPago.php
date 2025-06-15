<main class="resumen-compra container my-5">
  <h4 class="text-center mb-4 text-info">Resumen de la Compra</h4>

  <div class="resumen-box mb-4 p-4 rounded shadow-sm">
    <h5><strong>Total Productos:</strong></h5>
    <p><?= count($cart) ?> productos</p>

    <hr>

    <p><strong>Método de Pago:</strong>
      <?php
        switch ($metodo_pago) {
          case 'transferencia':
            echo 'Transferencia Bancaria';
            break;
          case 'mercado_pago':
            echo 'Mercado Pago';
            break;
          case 'efectivo':
            echo 'Efectivo';
            break;
          default:
            echo esc($metodo_pago);
        }
      ?>
    </p>

    <?php if (!empty($metodo_envio)): ?>
      <p><strong>Método de Envío:</strong>
        <?php
          switch ($metodo_envio) {
            case 'retiro':
              echo 'Retiro en tienda';
              break;
            case 'domicilio':
              echo 'Domicilio ($1000)';
              break;
            case 'correo':
              echo 'Correo postal ($1500)';
              break;
            default:
              echo esc($metodo_envio);
          }
        ?>
      </p>
    <?php else: ?>
      <p><strong>Método de Envío:</strong> No seleccionado</p>
    <?php endif; ?>

    <div class="resumen-total mt-4 p-3 rounded">
      <h5>Resumen del Total</h5>
      <p><strong>Total:</strong> $<?= number_format($total, 0, ',', '.') ?></p>
      <p><strong>Envío:</strong> <?= isset($envioCosto) ? "$" . number_format($envioCosto, 0, ',', '.') : "$0" ?></p>
      <p class="total-final">
        <strong>Total a pagar:</strong> $<?= number_format($total + ($envioCosto ?? 0), 0, ',', '.') ?>
      </p>
    </div>

    <?php if ($metodo_pago === 'transferencia'): ?>
      <div class="alert alert-info mt-3">
        Al hacer clic en <strong>“Datos de pago”</strong> se mostrarán los datos bancarios para realizar la transferencia.
      </div>
    <?php endif; ?>
  </div>

  <div class="text-center mt-4">
    <form action="<?= base_url('mostrarDatosPago') ?>" method="POST">
      <input type="hidden" name="metodo_pago" value="<?= esc($metodo_pago) ?>">
      <input type="hidden" name="metodo_envio" value="<?= esc($metodo_envio) ?>">
      <input type="hidden" name="total_pagar" value="<?= $total + ($envioCosto ?? 0) ?>">
      <button type="submit" class="btn btn-success w-100">Datos de pago</button>
    </form>
  </div>
</main>
