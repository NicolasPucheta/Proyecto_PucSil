<main class="Regristro bg-dark text-light">

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 100%; max-width: 400px;">
            <div class="card-header text-center">
                <h3>Registrate</h3>
            </div>
            <div class="card-body">
                <?php $validation = \Config\Services::validation(); ?>                
                <form action="<?= base_url('/enviar-form') ?>" method="POST">
                    <?= csrf_field() ?> <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>
                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif ?>

                    <!--Registro de nombre--> 
                    <div class="mb-3">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input type="Nombre" class="form-control" id="Nombre" name="Nombre" placeholder="..." required>
                        <?php if ($validation->getError('Nombre')) : ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('Nombre'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!--Registro de apellido-->
                    <div class="mb-3">
                        <label for="Apellido" class="form-label">Apellido</label>
                        <input type="Apellido" class="form-control" id="Apellido" name="Apellido" placeholder="..." required>

                        <?php if ($validation->getError('Apellido')) : ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('Apellido'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!--Registro de nombre de usuario-->
                    <div class="mb-3">
                        <label for="Usuario" class="form-label">Usuario</label>
                        <input type="Usuario" class="form-control" id="Usuario" name="Usuario" placeholder="..." required>

                        <?php if ($validation->getError('Usuario')) : ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('Usuario'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!--Registro de email-->
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="usuario@correo.com" required>
                        
                        <?php if ($validation->getError('Correo Electronico')) : ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('Correo Electronico'); ?>
                            </div>
                        <?php endif; ?>
                        
                    </div>

                    <!--Registro de contraseña-->
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="pass" class="form-control" id="pass" name="pass" placeholder="••••••••" required>

                          <?php if ($validation->getError('pass')) : ?>
                            <div class='alert alert-danger mt-2'>
                                <?= $error = $validation->getError('pass'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Guardar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</main>