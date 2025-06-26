<main class="carrito container my-5">
  <h2 class="text-center mb-4 text-info">Mis Compras</h2>
   <?php
    
    if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert" style="margin-bottom: 15px;">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
       
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="margin-bottom: 15px;">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>
  <div class="table-responsive-carrito">
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Stock Disponible</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="carrito-items">
        <?php foreach ($cart as $item): ?>
          <tr id="producto-<?= esc($item['id']) ?>">
            <td>
              <img src="<?= base_url('assets/uploads/' . ($item['imagen'] ?? 'default.jpg')) ?>" alt="Imagen" class="img-fluid producto-img">
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
              <span class="stock"><?= esc($item['stock_disponible']) ?></span>
            </td>
            <td>
              <a href="<?= base_url('carrito_elimina/' . $item['rowid']) ?>" class="btn btn-danger btn-sm">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="carrito-total mt-5 p-4 text-center bg-dark-subtle rounded shadow-sm">
    <?php if (!empty($cart)): ?>
      <h4 class="text-dark">
        Total: $<?= number_format(array_reduce($cart, fn($acum, $prod) => $acum + $prod['subtotal'], 0), 2) ?>
      </h4>
      <a href="<?= base_url('detalleCompra') ?>" class="btn btn-success">Finalizar Compra</a>
    <?php else: ?>
      <h4 class="text-dark">Tu carrito está vacío</h4>
      <a href="<?= base_url('productos/categoria') ?>" class="btn btn-outline-info">Seguir comprando</a>
    <?php endif; ?>
  </div>
</main>
