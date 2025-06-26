<main class="procesadores">
    <div class="container-fluid">
        <div class="row">

            <!-- Columna de Categorías - SIN COLAPSE -->
            <div class="col-12 col-md-2 p-3">
                <!-- Se eliminó el botón de colapse y las clases de colapse -->
                <h5 class="mb-3">Categorías</h5> <!-- Título simple para las categorías -->
                <div id="categorias"> <!-- Se mantiene el ID pero sin las clases de colapse -->
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('productos/categoria/1') ?>">Procesadores</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('productos/categoria/2') ?>">Motherboards</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('productos/categoria/3') ?>">Memoria RAM</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('productos/categoria/4') ?>">Placas de Video</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('productos/categoria/5') ?>">Almacenamiento</a></li>
                    </ul>
                </div>
            </div>

            <!-- Columna Principal de Productos -->
            <div class="col-12 col-md-10 p-4">
                <!-- Título dinámico para búsqueda o categoría/general -->
                <?php if (isset($search_query) && !empty($search_query)): ?>
                    <h2 class="text-center tit mb-4">Resultados de búsqueda para: "<?= esc($search_query) ?>"</h2>
                    <?php if (empty($productos)): ?>
                        <p class="text-center">No se encontraron productos que coincidan con su búsqueda.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <h2 class="text-center tit mb-4"><?= esc($Titulo ?? 'Nuestros Productos') ?></h2>
                <?php endif; ?>

                <div class="row g-4">
                    <?php if (!empty($productos)): ?>
                        <?php foreach ($productos as $producto): ?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                                <div class="producto w-100">
                                    <div class="producto-img-container">
                                        <!-- Usar assets/uploads/ y añadir fallback de imagen -->
                                        <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" 
                                             alt="<?= esc($producto['nombre_prod']) ?>" 
                                             class="producto-img"
                                             onerror="this.onerror=null;this.src='https://placehold.co/400x300/E0E0E0/333333?text=Imagen+no+disponible';">
                                    </div>
                                    <div class="producto-info">
                                        <h5 class="titulo"><?= esc($producto['nombre_prod']) ?></h5>
                                        <p class="precio">$<?= number_format($producto['precio_vta'], 0, ',', '.') ?></p>

                                        <?php if ($producto['stock'] > 0): ?>
                                            <?= form_open('carrito/add') ?>
                                                <?= form_hidden('id', $producto['id']) ?>
                                                <?= form_hidden('precio_vta', $producto['precio_vta']) ?>
                                                <?= form_hidden('nombre_prod', $producto['nombre_prod']) ?>
                                                <?= form_hidden('imagen', $producto['imagen']) ?>
                                                <?php
                                                $btn = array(
                                                    'class' => 'btn btn-secondary fuenteBotones btn-custom',
                                                    'value' => 'Agregar al Carrito',
                                                    'name'  => 'action'
                                                );
                                                echo form_submit($btn);
                                                echo form_close();
                                                ?>
                                        <?php else: ?>
                                            <p class="text-danger">Sin stock</p>
                                        <?php endif; ?>
                                        <!-- Se eliminó el botón "Ver Detalle" -->
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Mensaje adicional si no hay productos disponibles en general, o después de una búsqueda -->
                        <?php if (!isset($search_query) || empty($search_query)): ?>
                            <div class="col-12">
                                <h2 class="text-center tit">Actualmente no hay productos disponibles.</h2>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <!-- Toast de Notificación -->
    <?php if (session()->getFlashdata('success')): ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
        <div id="toastCarrito" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= session()->getFlashdata('success') ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toastEl = document.getElementById('toastCarrito');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                toast.show();
            }
        });
    </script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</main>

<!-- Se eliminó la inclusión de Tailwind CSS CDN y el bloque de estilos personalizados de Tailwind -->
