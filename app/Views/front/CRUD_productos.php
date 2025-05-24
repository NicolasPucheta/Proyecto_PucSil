
<main class="bg-dark text-white">
  <div class="container">
    <h1 class="text-center mb-4">CRUD de Productos</h1>

    <!-- Formulario -->
    <form id="formProducto" class="row g-3 mb-4">
      <input type="hidden" id="idProducto">
      <div class="col-md-5">
        <input type="text" id="nombre" class="form-control" placeholder="Nombre del producto" required>
      </div>
      <div class="col-md-5">
        <input type="number" id="precio" class="form-control" placeholder="Precio" required>
      </div>
      <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>

    <!-- Tabla -->
    <div class="table-responsive">
      <table class="table table-dark table-bordered table-hover">
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
