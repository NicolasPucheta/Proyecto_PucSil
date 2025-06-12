<div class="container-eliminados mt-5">
    <h2><?= $Titulo ?></h2>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td>
                        <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" width="80" alt="Sin imagen">
                    </td>
                    <td><?= esc($producto['nombre_prod']) ?></td>
                    <td>$<?= number_format($producto['precio'], 2) ?></td>
                    <td><?= esc($producto['stock']) ?></td>
                    <td>
                        <a href="<?= site_url('restaurarProducto/' . $producto['id']) ?>" class="btn btn-success btn-sm">Restaurar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
