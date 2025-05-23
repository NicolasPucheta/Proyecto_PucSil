<main class="iniciSesion bg-dark text-light">

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 100%; max-width: 400px;">
            <div class="card-header text-center">
                <h3>Iniciar Sesión</h3>
            </div>
            <div class="card-body">
                  <?php $validation = \Config\Services::validation(); ?>                
                    <form action="<?= base_url('/enviarlogin') ?>" method="post">
                    <?= csrf_field() ?> <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>
                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif ?>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="usuario@correo.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="pass" class="form-control" id="pass" name="pass" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                </form>
            </div>
                <div style="text-align: center;">
                    ¿No tienes cuenta? <a href="<?= base_url('registro') ?>">Regístrate aquí</a>
                </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</main>
