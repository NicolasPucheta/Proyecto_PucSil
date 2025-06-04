<main class="bg-dark text-white">
    <div class="container py-5">
        <h2 class="mb-4 text-center">CRUD de Usuarios</h2>

        <?php if (session()->getFlashdata('success')): ?>
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                setTimeout(function() {
                    var alertElement = document.getElementById('success-alert');
                    if (alertElement) {
                        alertElement.remove();
                    }
                }, 1500); // 1500 milisegundos = 1.5 segundos
            </script>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                setTimeout(function() {
                    var alertElement = document.getElementById('error-alert');
                    if (alertElement) {
                        alertElement.remove();
                    }
                }, 1500); // 1500 milisegundos = 1.5 segundos
            </script>
        <?php endif; ?>

        <table class="table table-bordered table-hover table-dark text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>ROL</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <form method="post" action="<?= base_url('guardar_rol') ?>">
                            <tr>
                                <td><?= $usuario['id'] ?></td>
                                <td><?= $usuario['nombre'] ?></td>
                                <td><?= $usuario['apellido'] ?></td>
                                <td><?= $usuario['usuario'] ?></td>
                                <td><?= $usuario['email'] ?></td>
                                <td>
                                    <input type="hidden" name="user_id" value="<?= $usuario['id'] ?>">
                                    <select class="form-select form-select-sm" name="rol">
                                        <option value="1" <?= ($usuario['perfil_id'] == 1) ? 'selected' : '' ?>>Admin</option>
                                        <option value="2" <?= ($usuario['perfil_id'] == 2) ? 'selected' : '' ?>>Cliente</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-success">Guardar Rol</button>

                                     <a href="<?= base_url('usuarios/eliminar/' . $usuario['id']) ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</a>
                                </td>
                            </tr>
                        </form>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center">No hay usuarios registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editUser(userId) {
            console.log('Editar usuario con ID:', userId);
        }

        function deleteUser(userId) {
            console.log('Solicitud de eliminación para el usuario con ID:', userId);
        }
    </script>
</main>