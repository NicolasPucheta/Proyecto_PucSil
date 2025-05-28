<main class="bg-dark text-white">
  <div class="container">
    <h1 class="text-center mb-4">CRUD de Productos</h1>

    <div class="d-flex justify-content-center mb-4 gap-4">
      <button onclick="window.location.href='<?= base_url('crear'); ?>'"
              class="btn btn-success px-4 py-2 shadow rounded-pill">
        <i class="bi bi-cloud-upload"></i> CARGAR
      </button>

      <button class="btn btn-warning text-dark px-4 py-2 shadow rounded-pill">
        <i class="bi bi-pencil-square"></i> EDITAR
      </button>
      <button class="btn btn-danger px-4 py-2 shadow rounded-pill">
        <i class="bi bi-trash"></i> ELIMINADOS
      </button>
    </div>

    <!-- Tabla -->
    <div class="table-responsive">
      <table id="tablaProductos" class="table table-dark table-bordered table-hover text-center align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Precio_Vta</th>
            <th>ROL</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
         <!--falta recorrer con el forech-->


        </tbody>
      </table>
    </div>
  </div>


  <!-- Scripts necesarios para DataTable -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
  let tabla;

  function cargarProductos() {
    fetch('<?= base_url('producto/listar') ?>')
      .then(res => res.json())
      .then(data => {
        tabla.clear();
        data.forEach(p => {
          tabla.row.add([
            p.id,
            p.nombre,
            `$${p.precio}`,
            `$${p.precio_vta ?? '-'}`,
            `
            <button class="btn btn-warning btn-sm me-2" onclick="editar(${p.id}, '${p.nombre}', ${p.precio})">Editar</button>
            <button class="btn btn-danger btn-sm" onclick="eliminar(${p.id})">Eliminar</button>
            `
          ]);
        });
        tabla.draw();
      })
      .catch(error => {
        console.error('Error al cargar productos:', error);
      });
  }

  $(document).ready(function () {
    tabla = $('#tablaProductos').DataTable();
    cargarProductos();
  });
</script>

</main>
