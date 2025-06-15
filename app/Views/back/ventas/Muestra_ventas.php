<main class="main-ventas">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card ventas-card">
          <div class="card-header bg-info text-dark d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Resumen de Ventas</h3>
            <span id="total-vendido" class="badge bg-dark text-info fs-6">Total: $0</span>
          </div>

          <div class="card-body">
         <!-- Filtro de fechas -->
        <form id="filtro-fecha" class="row g-3 mb-4" method="GET" action="<?= base_url('ventas/data') ?>">
          <div class="col-md-5">
            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
          </div>
          <div class="col-md-5">
            <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
          </div>
          <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-info text-dark">Filtrar</button>
          </div>
        </form>

            <!-- Tabla de ventas -->
            <div class="table-responsive">
              <table class="table table-dark table-hover text-center ventas-table">
                <thead class="ventas-thead">
                  <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
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

<script>
function formatearFecha(fechaStr) {
  const fecha = new Date(fechaStr);
  if (isNaN(fecha)) return 'Fecha inválida';
  const dia = String(fecha.getDate()).padStart(2, '0');
  const mes = String(fecha.getMonth() + 1).padStart(2, '0');
  const anio = fecha.getFullYear();
  const horas = String(fecha.getHours()).padStart(2, '0');
  const minutos = String(fecha.getMinutes()).padStart(2, '0');
  return `${dia}/${mes}/${anio} ${horas}:${minutos}`;
}

function cargarVentas(fecha_inicio = '', fecha_fin = '') {
  const params = new URLSearchParams();
  if (fecha_inicio) params.append('fecha_inicio', fecha_inicio);
  if (fecha_fin) params.append('fecha_fin', fecha_fin);

  fetch(`<?= base_url('ventas/data') ?>?${params.toString()}`)
    .then(response => response.json())
    .then(data => {
      const tablaVentas = document.getElementById('tabla-ventas');
      tablaVentas.innerHTML = '';
      let totalVendido = 0;

      if (data.length === 0) {
        tablaVentas.innerHTML = `
          <tr><td colspan="6" style="color: #0dcaf0; font-weight: bold;">No hay ventas registradas.</td></tr>`;
        document.getElementById('total-vendido').textContent = 'Total: $0';
        return;
      }

      data.forEach((venta, i) => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
          <td>${i + 1}</td>
          <td>${formatearFecha(venta.fecha)}</td>
          <td>${venta.producto}</td>
          <td>${venta.cantidad}</td>
          <td>$${venta.precio}</td>
          <td>$${venta.total}</td>`;
        totalVendido += parseFloat(venta.total);
        tablaVentas.appendChild(fila);
      });

      document.getElementById('total-vendido').textContent =
        `Total: $${totalVendido.toLocaleString('es-AR', { minimumFractionDigits: 2 })}`;
    });
}

document.addEventListener('DOMContentLoaded', () => {
  cargarVentas();

  document.getElementById('filtro-fecha').addEventListener('submit', e => {
    e.preventDefault();
    const inicio = document.getElementById('fecha_inicio').value;
    const fin = document.getElementById('fecha_fin').value;
    cargarVentas(inicio, fin);
  });
});
</script>
