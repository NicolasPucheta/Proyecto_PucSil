<main class="container my-5 text-light">
  <!-- Resumen de la compra -->
  <div class="mb-4 p-3 bg-dark-subtle rounded">
    <h5><strong>Total Productos:</strong></h5>
    <p><?= count($cart) ?> productos</p>

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
            <td><?= esc($item['name']) ?></td>
            <td><?= esc($item['qty']) ?></td>
            <td>$<?= number_format($subtotal, 0, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <hr>
    <p><strong>Método de Pago:</strong> <?= esc($metodo_pago) ?></p>

    <?php if (!empty($metodo_envio)): ?>
      <p><strong>Método de Envío:</strong> <?= esc($metodo_envio) ?></p>
    <?php else: ?>
      <p><strong>Método de Envío:</strong> No seleccionado</p>
    <?php endif; ?>

    <div class="mt-4 p-3 bg-dark-subtle rounded">
      <h5>Resumen del Total</h5>
      <p><strong>Total productos:</strong> $<?= number_format($total, 0, ',', '.') ?></p>
      <p><strong>Envío:</strong> <?= isset($envioCosto) ? "$" . number_format($envioCosto, 0, ',', '.') : "$0" ?></p>
      <p><strong>Total a pagar:</strong> $<?= number_format($total + ($envioCosto ?? 0), 0, ',', '.') ?></p>
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

