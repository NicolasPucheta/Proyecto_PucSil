<main class="container my-5 text-dark">
  <div class="mb-4 p-3 bg-dark-subtle rounded">
    <h5 class="text-dark"><strong>Total Productos:</strong></h5>
    <p class="text-dark"><?= count($cart) ?> productos</p>

    <hr>
    <p class="text-dark"><strong>Método de Pago:</strong>
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
      <p class="text-dark"><strong>Método de Envío:</strong>
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
      <p class="text-dark"><strong>Método de Envío:</strong> No seleccionado</p>
    <?php endif; ?>

    <div class="mt-4 p-3 bg-dark-subtle rounded">
      <h5 class="text-dark">Resumen del Total</h5>
      <p class="text-dark"><strong>Total:</strong> $<?= number_format($total, 0, ',', '.') ?></p>
      <p class="text-dark"><strong>Envío:</strong> <?= isset($envioCosto) ? "$" . number_format($envioCosto, 0, ',', '.') : "$0" ?></p>
      <p class="text-dark" style="font-size: 1.25rem; font-weight: bold; color: black;">
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
