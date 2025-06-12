<main class="bg-dark text-white">
    <div class="container">
        <h1 class="text-center mb-4">CRUD de Productos</h1>

        <div class="d-flex justify-content-center mb-4 gap-4">
            <button onclick="window.location.href='<?= base_url('crear'); ?>'"
                    class="btn btn-success px-4 py-2 shadow rounded-pill">
                <i class="bi bi-cloud-upload"></i> CARGAR
            </button>
            <button onclick="window.location.href='<?= base_url('productosEliminados'); ?>'" 
                 class="btn btn-danger px-4 py-2 shadow rounded-pill">
                <i class="bi bi-trash"></i> ELIMINADOS
            </button>
        </div>

        <div class="table-responsive">
            <table id="tablaProductos" class="table table-dark table-bordered table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Precio_Vta</th>
                        <th>Stock</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($productos)): ?>
                        <?php foreach ($productos as $producto): ?>
                        <tr style="min-height: 80px;">
                            <td><?= $producto['id'] ?></td>
                            <td><?= $producto['nombre_prod'] ?></td>
                            <td>$<?= number_format($producto['precio'], 2, ',', '.') ?></td>
                            <td>$<?= number_format($producto['precio_vta'], 0, ',', '.') ?></td>
                            <td><?= $producto['stock'] ?></td>
                            <td style="width: 60px; height: 60px; overflow: hidden; vertical-align: middle;">
                                <?php if (!empty($producto['imagen'])): ?>
                                   <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" alt="<?= $producto['nombre_prod'] ?>" 
                                   class="tabla-imagen" style="display: block; width: 100%; height: 100%; object-fit: contain;">
                                    <?php else: ?>
                                    Sin imagen
                                <?php endif; ?>
                            </td>
                            <td>
                            <a href="<?= base_url('producto/editar/' . $producto['id']) ?>" class="btn btn-warning btn-sm me-2">Editar</a>
                            <a href="<?= base_url('producto/eliminar/' . $producto['id']) ?>" class="btn btn-danger btn-sm"
                             onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7">No hay productos disponibles.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablaProductos').DataTable();
        });

        function editar(id, nombre, precio) {
            console.log('Editar producto con ID:', id, nombre, precio);
        }

        function eliminar(id) {
            console.log('Eliminar producto con ID:', id);
        }
    </script>
</main>