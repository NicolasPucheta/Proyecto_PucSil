<main class="iniciSesion bg-dark text-light">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 100%; max-width: 400px;">
            <div class="card-header text-center">
                <h3>Iniciar Sesión</h3>
            </div>
            <div class="card-body">
                <?php $validation = \Config\Services::validation(); ?>
                <form id="loginForm" action="<?= base_url('/enviarlogin') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>
                    
                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif ?>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="usuario@correo.com" required>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="pass" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="••••••••" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                👁️
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">Iniciar Sesión</button>
                    <button type="button" class="btn btn-secondary w-100" onclick="limpiarFormulario()">Limpiar</button>
                </form>
            </div>
            <div style="text-align: center;">
                ¿No tienes cuenta? <a href="<?= base_url('registro') ?>">Regístrate aquí</a>
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
            document.getElementById('loginForm').reset();
            passwordInput.setAttribute('type', 'password'); // Asegura que quede oculto al limpiar
            togglePassword.textContent = '👁️';
        }
    </script>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</main>
