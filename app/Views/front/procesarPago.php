<main class="container my-5 text-dark">
  <div class="mb-4 p-3 bg-dark-subtle rounded">
    <h5 class="text-dark"><strong>Total Productos:</strong></h5>
    <p class="text-dark"><?= count($cart) ?> productos</p>

    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        foreach ($cart as $item):
          $subtotal = $item['price'] * $item['qty'];
          $total += $subtotal;
        ?>
          <tr>
            <td class="text-dark"><?= esc($item['name']) ?></td>
            <td class="text-dark"><?= esc($item['qty']) ?></td>
            <td class="text-dark">$<?= number_format($subtotal, 0, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <hr>
    <p class="text-dark"><strong>Método de Pago:</strong> <?= esc($metodo_pago) ?></p>

    <?php if (!empty($metodo_envio)): ?>
      <p class="text-dark"><strong>Método de Envío:</strong> <?= esc($metodo_envio) ?></p>
    <?php else: ?>
      <p class="text-dark"><strong>Método de Envío:</strong> No seleccionado</p>
    <?php endif; ?>

    <div class="mt-4 p-3 bg-dark-subtle rounded">
      <h5 class="text-dark">Resumen del Total</h5>
      <p class="text-dark"><strong>Total productos:</strong> $<?= number_format($total, 0, ',', '.') ?></p>
      <p class="text-dark"><strong>Envío:</strong> <?= isset($envioCosto) ? "$" . number_format($envioCosto, 0, ',', '.') : "$0" ?></p>
      <p class="text-dark" style="font-size: 1.25rem; font-weight: bold; color: black;">
        <strong>Total a pagar:</strong> $<?= number_format($total + ($envioCosto ?? 0), 0, ',', '.') ?>
      </p>
    </div>
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