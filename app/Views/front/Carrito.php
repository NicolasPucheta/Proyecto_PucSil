<main class="carrito container my-5">
  <h2 class="text-center mb-4 text-info">Mis Compras</h2>

  <!-- Tabla de productos en el carrito -->
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
      <!-- Ejemplo de producto en el carrito -->
      <tr id="producto-1">
        <td>
          <img src="assets/img/producto1.jpg" alt="no disponible" class="img-fluid" style="width: 60px;">
        </td>
        <td class="precio" data-precio="1500">$1500</td>
        <td>
          <div class="cantidad-controles">
            <button class="btn btn-sm btn-outline-info me-1" onclick="restarProducto(1)">−</button>
            <span class="cantidad" id="cantidad-1">1</span>
            <button class="btn btn-sm btn-outline-info ms-1" onclick="sumarProducto(1)">+</button>
          </div>
        </td>
        <td>
          <button class="btn btn-danger btn-sm" onclick="eliminarProducto(1)">Eliminar</button>
        </td>
      </tr>
      <!-- Fin ejemplo -->
    </tbody>
  </table>
  <div class="carrito-total mt-5 p-4 text-center bg-dark-subtle rounded shadow-sm">
    <h4 class="text-light">Total: <span id="totalCarrito">$1500</span></h4>
    <button class="btn btn-success mt-3 w-100" onclick="window.location.href='<?php echo base_url('detalleCompra'); ?>'">
        Finalizar Compra
    </button>
</div>

  <script>
  let cantidades = { 1: 1 }; // Clave: ID del producto
  let precios = { 1: 1500 }; // Clave: ID del producto, valor: precio por unidad

  // Actualizar el total del carrito
  function actualizarTotal() {
    let total = 0;
    for (let id in cantidades) {
      total += cantidades[id] * precios[id];
    }
    document.getElementById('totalCarrito').textContent = `$${total}`;
  }

  // Sumar cantidad de un producto
  function sumarProducto(id) {
    cantidades[id]++;
    document.getElementById('cantidad-' + id).textContent = cantidades[id];
    actualizarTotal();
  }

  // Restar cantidad de un producto
  function restarProducto(id) {
    if (cantidades[id] > 1) {
      cantidades[id]--;
      document.getElementById('cantidad-' + id).textContent = cantidades[id];
      actualizarTotal();
    }
  }

  // Eliminar un producto del carrito
  function eliminarProducto(id) {
    const producto = document.getElementById('producto-' + id);
    producto.remove();
    delete cantidades[id]; // Eliminar producto de la lista
    actualizarTotal();
  }
</script>

</main>