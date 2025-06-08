<main class="detalles-compra container my-5">


  <div id="detallesCompra" class="compra-detalles">
    <h2 class="text-center mb-4 text-info">Detalles de la Compra</h2>

    <!-- Tabla de productos en la compra -->
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Total por Producto</th>
        </tr>
      </thead>
        <tbody>
    <?php $totalProductos = 0; ?>
    <?php foreach ($carrito as $item): ?>
      <tr>
        <td>
          <img src="<?= base_url('assets/uploads/' . $item['imagen']) ?>" alt="<?= $item['name'] ?>" class="img-fluid" style="width: 60px;">
          <?= esc($item['name']) ?>
        </td>
        <td><?= esc($item['qty']) ?></td>
        <td>$<?= number_format($item['price'], 0, ',', '.') ?></td>
        <td>$<?= number_format($item['subtotal'], 0, ',', '.') ?></td>
      </tr>
      <?php $totalProductos += $item['qty']; ?>
    <?php endforeach; ?>
  </tbody>

    </table>

    <!-- Resumen de la compra -->
    <p><strong>Total de productos:</strong> <?= $totalProductos ?></p>
          <!-- Métodos de pago -->
        <div class="metodo-pago mt-5 p-4 bg-dark-subtle rounded shadow-sm">
          <h4 class="text-light">Método de Pago</h4>
          <form action="<?= base_url('procesarPago') ?>" method="POST">
      <div class="form-group">
        <label class="text-light">Seleccione un método de pago</label>
        <select name="metodo_pago" class="form-select">
          <option value="tarjeta">Tarjeta</option>
          <option value="paypal">PayPal</option>
          <option value="efectivo">Efectivo</option>
        </select>
      </div>

      <!-- Método de envío -->
      <div class="form-group mt-3">
        <label class="text-light">Seleccione un método de envío</label>
        <select name="metodo_envio" class="form-select">
          <option value="retiro">Retiro en tienda</option>
          <option value="domicilio">Domicilio ($1000)</option>
          <option value="correo">Correo postal ($1500)</option>
        </select>
      </div>

      <div class="mt-4 text-center">
        <button type="submit" class="btn btn-success w-100">Proceder con el Pago</button>
      </div>
    </form>



    </div>
  </div>
</main>

