<main class="carrito container my-5">
  <h2 class="text-center mb-4 text-info">Mis Compras</h2>

  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>Producto</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="carrito-items">
      <?php foreach ($cart as $item): ?>
        <tr id="producto-<?= esc($item['id']) ?>">
          <td>
            <img src="<?= base_url('assets/img/' . ($item['imagen'] ?? 'default.jpg')) ?>" alt="Imagen" class="img-fluid" style="width: 60px;">
            <?= esc($item['name']) ?>
          </td>
          <td class="precio" data-precio="<?= esc($item['price']) ?>">$<?= esc($item['price']) ?></td>
          <td>
            <div class="cantidad-controles">
              <a href="<?= base_url('carrito_resta/' . $item['rowid']) ?>" class="btn btn-sm btn-outline-info me-1">−</a>
              <span class="cantidad"><?= esc($item['qty']) ?></span>
              <a href="<?= base_url('carrito_suma/' . $item['rowid']) ?>" class="btn btn-sm btn-outline-info ms-1">+</a>
            </div>
          </td>
          <td>
            <a href="<?= base_url('carrito_elimina/' . $item['rowid']) ?>" class="btn btn-danger btn-sm">Eliminar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="carrito-total mt-5 p-4 text-center bg-dark-subtle rounded shadow-sm">
    <h4 class="text-light">
      Total: $
      <?= number_format(array_reduce($cart, fn($acum, $prod) => $acum + $prod['subtotal'], 0), 2) ?>
    </h4>
    <!-- Botón en carrito para ir a finalizar compra -->
<a href="<?= base_url('detalleCompra') ?>" class="btn btn-success">Finalizar Compra</a>

  </div>
</main>
