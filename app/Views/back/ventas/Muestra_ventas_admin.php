<main class="main-ventas container my-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card ventas-card shadow-sm">
                <div class="card-header bg-info text-dark">
                    <h3 class="mb-0">Listado Completo de Ventas (Administrador)</h3>
                </div>
                <div class="card-body">
                    <?php if (empty($ventas)): ?>
                        <div class="alert alert-info text-center" role="alert">
                            No hay ventas registradas en el sistema.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-dark table-hover align-middle text-center ventas-table">
                                <thead class="ventas-thead">
                                    <tr>
                                        <th scope="col">ID Venta</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Total Venta</th>
                                        <th scope="col">Detalles Productos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ventas as $venta): ?>
                                        <tr>
                                            <td><?= esc($venta['id']) ?></td>
                                            <td><?= esc($venta['fecha']) ?></td>
                                            <td><?= esc($venta['nombre_cliente']) ?></td>
                                            <td>$<?= esc(number_format($venta['total_venta'], 2)) ?></td>
                                            <td>
                                                <?php if (!empty($venta['detalles'])): ?>
                                                    <table class="table table-sm table-borderless table-dark my-2">
                                                        <thead>
                                                            <tr>
                                                                <th>Producto</th>
                                                                <th>Cant.</th>
                                                                <th>Precio Unit.</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($venta['detalles'] as $detalle): ?>
                                                                <tr>
                                                                    <td><?= esc($detalle['producto']) ?></td>
                                                                    <td><?= esc($detalle['cantidad']) ?></td>
                                                                    <td>$<?= esc(number_format($detalle['precio'], 2)) ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                <?php else: ?>
                                                    <span class="text-muted">Sin detalles de productos</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>