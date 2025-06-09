<main class="Regristro bg-dark text-light">
    <div class="container mt-1 mb-1 d-flex justify-content-center">
    <div class="card" style="width:75%;">
        <div class="card-header text-center">
        <h2>Editar Producto</h2>
        </div>

        <?php if (!empty(session()->getFlashdata('fail'))): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif; ?>

        <?php if (!empty(session()->getFlashdata('success'))): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <?php
        $validation = \Config\Services::validation();
        echo form_open_multipart(base_url('admin/actualizarProducto'), ['method' => 'post', 'enctype' => 'multipart/form-data']);
        ?>

        <input type="hidden" name="id" value="<?= esc($producto['id']); ?>">

        <div class="mb-2">
        <label for="nombre_prod" class="form-label">Producto</label>
        <input class="form-control" type="text" name="nombre_prod" id="nombre_prod"
                value="<?= set_value('nombre_prod', $producto['nombre_prod']); ?>" required>
        </div>

        <div class="mb-2">
        <label for="categoria" class="form-label">Categoría</label>
        <select class="form-control" name="categoria" id="categoria">
            <option value="0">Seleccionar Categoría</option>
            <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id']; ?>"
                <?= set_select('categoria', $categoria['id'], $producto['categoria_id'] == $categoria['id']); ?>>
                <?= $categoria['descripcion']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="mb-2">
        <label for="precio" class="form-label">Precio de Costo</label>
        <input class="form-control" type="text" name="precio" id="precio"
                value="<?= set_value('precio', $producto['precio']); ?>" required>
        </div>

        <div class="mb-2">
        <label for="precio_vta" class="form-label">Precio de Venta</label>
        <input class="form-control" type="text" name="precio_vta" id="precio_vta"
                value="<?= set_value('precio_vta', $producto['precio_vta']); ?>" required>
        </div>

        <div class="mb-2">
        <label for="stock" class="form-label">Stock</label>
        <input class="form-control" type="text" name="stock" id="stock"
                value="<?= set_value('stock', $producto['stock']); ?>" required>
        </div>

        <div class="mb-2">
        <label for="stock_min" class="form-label">Stock Mínimo</label>
        <input class="form-control" type="text" name="stock_min" id="stock_min"
                value="<?= set_value('stock_min', $producto['stock_min']); ?>" required>
        </div>

        <div class="mb-2">
        <label for="imagen" class="form-label">Imagen (actual: <?= $producto['imagen']; ?>)</label>
        <input class="form-control" type="file" name="imagen" id="imagen"
                accept="image/png, image/jpg, image/jpeg">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="<?= base_url('admin/productos'); ?>" class="btn btn-secondary">Cancelar</a>
        </div>

        </form>
    </div>
    </div>
</main>
