<main class="bg-dark text-white">
  <div class="container">
    <h1 class="text-center mb-4">Resumen de Ventas</h1>

    <!-- Filtro de fechas -->
    <form id="filtro-fecha" class="row g-3 mb-4" method="GET">
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

    <div class="table-responsive mb-3">
      <table id="tablaVentas" class="table table-dark table-bordered table-hover text-center align-middle">
        <thead>
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
          <!-- JS -->
        </tbody>
      </table>
    </div>

    <div class="text-end">
      <span id="total-vendido" class="badge bg-info text-dark fs-5">Total: $0</span>
    </div>
  </div>

  <!-- DataTables + JS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

  <script>
   function formatearFecha(fechaStr) {
  const fecha = new Date(fechaStr + ' UTC'); // Esto fuerza que lo interprete como UTC
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
          const tabla = $('#tablaVentas').DataTable();
          tabla.clear();
          let totalVendido = 0;

          if (data.length === 0) {
            tabla.row.add([
              '-', 'Sin datos', '-', '-', '-', '-'
            ]).draw();
            document.getElementById('total-vendido').textContent = 'Total: $0';
            return;
          }

          data.forEach((venta, i) => {
            tabla.row.add([
              i + 1,
              formatearFecha(venta.fecha),
              venta.producto,
              venta.cantidad,
              `$${venta.precio}`,
              `$${venta.total}`
            ]).draw(false);

            totalVendido += parseFloat(venta.total);
          });

          document.getElementById('total-vendido').textContent =
            `Total: $${totalVendido.toLocaleString('es-AR', { minimumFractionDigits: 2 })}`;
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
      $('#tablaVentas').DataTable({
        paging: true,
        info: false,
        searching: false,
        ordering: false,
        language: {
          emptyTable: "No hay ventas registradas.",
          paginate: {
            next: "Siguiente",
            previous: "Anterior"
          }
        }
      });

      cargarVentas();

      document.getElementById('filtro-fecha').addEventListener('submit', e => {
        e.preventDefault();
        const inicio = document.getElementById('fecha_inicio').value;
        const fin = document.getElementById('fecha_fin').value;
        cargarVentas(inicio, fin);
      });
    });
  </script>
</main>
