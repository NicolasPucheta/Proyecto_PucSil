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
      <i class="bi bi-trash"></i> ELIMINAR
    </button>
  </div>


    <!-- Tabla -->
    <div class="table-responsive">
      <table class="table table-dark table-bordered table-hover text-center align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Precio_Vta</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="tablaProductos"></tbody>
      </table>
    </div>
  </div>

  <script>
    const form = document.getElementById('formProducto');
    const tabla = document.getElementById('tablaProductos');

    function cargarProductos() {
      fetch('/producto/listar')
        .then(res => res.json())
        .then(data => {
          tabla.innerHTML = '';
          data.forEach(p => {
            tabla.innerHTML += `
              <tr>
                <td>${p.id}</td>
                <td>${p.nombre}</td>
                <td>$${p.precio}</td>
                <td>$${p.precio_vta ?? '-'}</td>
                <td>
                  <button class="btn btn-warning btn-sm me-2" onclick="editar(${p.id}, '${p.nombre}', ${p.precio})">Editar</button>
                  <button class="btn btn-danger btn-sm" onclick="eliminar(${p.id})">Eliminar</button>
                </td>
              </tr>
            `;
          });
        });
    }

    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const id = document.getElementById('idProducto').value;
      const nombre = document.getElementById('nombre').value;
      const precio = document.getElementById('precio').value;

      const datos = new FormData();
      datos.append('nombre', nombre);
      datos.append('precio', precio);

      const url = id ? `/producto/editar/${id}` : '/producto/crear';

      fetch(url, {
        method: 'POST',
        body: datos
      }).then(res => res.json())
        .then(() => {
          form.reset();
          document.getElementById('idProducto').value = '';
          cargarProductos();
        });
    });

    function editar(id, nombre, precio) {
      document.getElementById('idProducto').value = id;
      document.getElementById('nombre').value = nombre;
      document.getElementById('precio').value = precio;
    }

    function eliminar(id) {
      if (confirm('¿Eliminar este producto?')) {
        fetch(`/producto/eliminar/${id}`, { method: 'DELETE' })
          .then(res => res.json())
          .then(() => cargarProductos());
      }
    }

    cargarProductos();
  </script>
</main>
