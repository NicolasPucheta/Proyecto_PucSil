<main class="main-ventas">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card ventas-card">
          <div class="card-header bg-info text-dark">
            <h3 class="mb-0">Resumen de Ventas</h3>
            <span id="total-vendido" class="ms-3 badge bg-dark text-info fs-6">Total: $0</span>
          </div>
          <div class="card-body">
            <!-- Tabla de ventas -->
            <div class="table-responsive">
              <table class="table table-dark table-hover align-middle text-center ventas-table">
                <thead class="ventas-thead">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody id="tabla-ventas">
                  <!-- Se llena con JS -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript para llenar la tabla de ventas -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    fetch('<?= base_url('ventas/data') ?>')
      .then(response => response.json())
      .then(data => {
        const tablaVentas = document.getElementById('tabla-ventas');
        tablaVentas.innerHTML = '';

        if (data.length === 0) {
          tablaVentas.innerHTML = `
            <tr>
              <td colspan="6" style="color: #0dcaf0; font-weight: bold;">No hay ventas registradas.</td>
            </tr>`;
          return;
        }
        let totalVendido = 0;

        data.forEach((venta, i) => {
          const fila = document.createElement('tr');
          fila.innerHTML = `
            <td>${i + 1}</td>
            <td>${venta.fecha}</td>
            <td>${venta.producto}</td>
            <td>${venta.cantidad}</td>
            <td>$${venta.precio}</td>
            <td>$${venta.total}</td>
          `;
         // Convertir "210.000,00" → 210000.00
          const totalLimpio = parseFloat(venta.total.replace(/\./g, '').replace(',', '.'));
          totalVendido += totalLimpio;

          tablaVentas.appendChild(fila);
        });

        // Mostrar total
        document.getElementById('total-vendido').textContent =
          `Total: $${totalVendido.toLocaleString('es-AR', { minimumFractionDigits: 2 })}`;
        })
      .catch(error => console.error('Error al cargar ventas:', error));
  });
</script>

