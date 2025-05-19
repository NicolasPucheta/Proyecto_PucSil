<main class="detalles-compra container my-5">
  <!-- Si la compra fue exitosa, se muestra un mensaje de éxito -->
  <div class="alert alert-success text-center mb-4" id="compraExitosa">
    <h2 class="text-info">¡Compra realizada con éxito!</h2>
    <p class="lead">Gracias por tu compra. Un correo de confirmación será enviado a tu dirección de correo electrónico.</p>
    <a href="#" class="btn btn-primary mt-3">Volver al inicio</a>
  </div>

  <!-- Si la compra no fue exitosa, mostramos los detalles de la compra -->
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
        <!-- Producto 1 -->
        <tr>
          <td>
            <img src="assets/img/producto1.jpg" alt="Producto 1" class="img-fluid" style="width: 60px;">
            Producto 1
          </td>
          <td>2</td>
          <td>$1500</td>
          <td>$3000</td>
        </tr>
        <!-- Producto 2 -->
        <tr>
          <td>
            <img src="assets/img/producto2.jpg" alt="Producto 2" class="img-fluid" style="width: 60px;">
            Producto 2
          </td>
          <td>1</td>
          <td>$500</td>
          <td>$500</td>
        </tr>
        <!-- Producto 3 -->
        <tr>
          <td>
            <img src="assets/img/producto3.jpg" alt="Producto 3" class="img-fluid" style="width: 60px;">
            Producto 3
          </td>
          <td>1</td>
          <td>$2000</td>
          <td>$2000</td>
        </tr>
      </tbody>
    </table>

    <!-- Resumen de la compra -->
    <div class="compra-resumen mt-4 p-4 bg-dark-subtle rounded shadow-sm">
      <h4 class="text-light">Resumen de la Compra</h4>
      <p><strong>Total de productos:</strong> 4</p>
      <p><strong>Total a pagar:</strong> <span id="totalCompra">$5500</span></p>
    </div>

    <!-- Métodos de pago -->
    <div class="metodo-pago mt-5 p-4 bg-dark-subtle rounded shadow-sm">
      <h4 class="text-light">Método de Pago</h4>
      <form action="#" method="POST">
        <div class="form-group">
          <label for="metodo_pago" class="text-light">Seleccione un método de pago</label>
          <select id="metodo_pago" name="metodo_pago" class="form-select">
            <option value="tarjeta">Tarjeta de Crédito</option>
            <option value="paypal">PayPal</option>
            <option value="efectivo">Efectivo</option>
          </select>
        </div>
        <div class="mt-3 text-center">
          <button type="submit" class="btn btn-success w-100">Proceder con el Pago</button>
        </div>
        
      </form>
    </div>
  </div>
</main>

<!-- JavaScript para mostrar el estado de la compra -->
<script>
  // Cambia la visibilidad de la vista según si la compra fue exitosa o no
  const compraExitosa = false;  // Puedes cambiar esto manualmente para probar
  if (compraExitosa) {
    document.getElementById('compraExitosa').style.display = 'block';
    document.getElementById('detallesCompra').style.display = 'none';
  } else {
    document.getElementById('compraExitosa').style.display = 'none';
    document.getElementById('detallesCompra').style.display = 'block';
  }
</script>
