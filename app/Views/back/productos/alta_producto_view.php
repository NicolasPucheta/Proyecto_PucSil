<main class="Regristro bg-dark text-light">
    <div class="container mt-1 mb-1 d-flex justify-content-center">
    <div class="card" style="width:75%;">
        <div class="card-header text-center">
        <h2>Alta de Productos</h2>
        </div>

        <!-- Validación -->
        <?php if (!empty(session()->getFlashdata('fail'))): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif; ?>

        <?php if (!empty(session()->getFlashdata('success'))): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <?php
        $validation = \Config\Services::validation();
        echo form_open_multipart(base_url('enviar-prod'), ['method' => 'post', 'enctype' => 'multipart/form-data']);
        ?>

        <div class="mb-2">
        <label for="nombre_prod" class="form-label">Producto</label>
        <input class="form-control" type="text" name="nombre_prod" id="nombre_prod"
                value="<?= set_value('nombre_prod'); ?>" placeholder="Nombre del producto" autofocus>

        <?php if ($validation->getError('nombre_prod')): ?>
            <div class="alert alert-danger mt-2"><?= $validation->getError('nombre_prod'); ?></div>
        <?php endif; ?>
        </div>

        <div class="mb-2">
        <label for="categoria" class="form-label">Categoría</label>
        <select class="form-control" name="categoria" id="categoria">
            <option value="0">Seleccionar Categoría</option>
            <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id']; ?>" <?= set_select('categoria', $categoria['id']); ?>>
                <?= $categoria['descripcion']; ?>
            </option>
            <?php endforeach; ?>
        </select>

        <?php if ($validation->getError('categoria')): ?>
            <div class="alert alert-danger mt-2"><?= $validation->getError('categoria'); ?></div>
        <?php endif; ?>
        </div>

        <div class="mb-2">
        <label for="precio" class="form-label">Precio de Costo</label>
        <input class="form-control" type="text" name="precio" id="precio"
                value="<?= set_value('precio'); ?>">

        <?php if ($validation->getError('precio')): ?>
            <div class="alert alert-danger mt-2"><?= $validation->getError('precio'); ?></div>
        <?php endif; ?>
        </div>

        <div class="mb-2">
        <label for="precio_vta" class="form-label">Precio de Venta</label>
        <input class="form-control" type="text" name="precio_vta" id="precio_vta"
                value="<?= set_value('precio_vta'); ?>">

        <?php if ($validation->getError('precio_vta')): ?>
            <div class="alert alert-danger mt-2"><?= $validation->getError('precio_vta'); ?></div>
        <?php endif; ?>
        </div>

        <div class="mb-2">
        <label for="stock" class="form-label">Stock</label>
        <input class="form-control" type="text" name="stock" id="stock"
                value="<?= set_value('stock'); ?>">

        <?php if ($validation->getError('stock')): ?>
            <div class="alert alert-danger mt-2"><?= $validation->getError('stock'); ?></div>
        <?php endif; ?>
        </div>

        <div class="mb-2">
        <label for="stock_min" class="form-label">Stock Mínimo</label>
        <input class="form-control" type="text" name="stock_min" id="stock_min"
                value="<?= set_value('stock_min'); ?>">

        <?php if ($validation->getError('stock_min')): ?>
            <div class="alert alert-danger mt-2"><?= $validation->getError('stock_min'); ?></div>
        <?php endif; ?>
        </div>

        <div class="mb-2">
        <label for="imagen" class="form-label">Imagen</label>
        <input class="form-control" type="file" name="imagen" id="imagen"
                accept="image/png, image/jpg, image/jpeg">

        <?php if ($validation->getError('imagen')): ?>
            <div class="alert alert-danger mt-2"><?= $validation->getError('imagen'); ?></div>
        <?php endif; ?>
        </div>

        <!-- Botones -->
        <div class="form-group">
            <button type="submit" id="send_form" class="btn btn-success">Enviar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
            <a href="<?= base_url('crear'); ?>" class="btn btn-secondary">Volver</a>
        </div>

        </form>
    </div>
    </div>


    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</main>