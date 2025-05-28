<main class="Regristro bg-dark text-light">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 100%; max-width: 400px;">
            <div class="card-header text-center">
                <h3>Regístrate</h3>
            </div>
            <div class="card-body">
                <?php $validation = \Config\Services::validation(); ?>
                <form id="registroForm" action="<?= base_url('/enviar-form') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>
                    
                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif ?>

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="..." required>
                        <?php if ($validation->getError('Nombre')) : ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $validation->getError('Nombre'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Apellido -->
                    <div class="mb-3">
                        <label for="Apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="Apellido" name="Apellido" placeholder="..." required>
                        <?php if ($validation->getError('Apellido')) : ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $validation->getError('Apellido'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Usuario -->
                    <div class="mb-3">
                        <label for="Usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="Usuario" name="Usuario" placeholder="..." required>
                        <?php if ($validation->getError('Usuario')) : ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $validation->getError('Usuario'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="usuario@correo.com" required>
                        <?php if ($validation->getError('Correo Electronico')) : ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $validation->getError('Correo Electronico'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Contraseña con mostrar/ocultar -->
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="••••••••" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                👁️
                            </button>
                        </div>
                        <?php if ($validation->getError('pass')) : ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $validation->getError('pass'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">Guardar</button>
                    <button type="button" class="btn btn-secondary w-100" onclick="limpiarFormulario()">Limpiar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mostrar/Ocultar contraseña
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('pass');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });

        // Limpiar formulario
        function limpiarFormulario() {
            document.getElementById('registroForm').reset();
            passwordInput.setAttribute('type', 'password');
            togglePassword.textContent = '👁️';
        }
    </script>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</main>
