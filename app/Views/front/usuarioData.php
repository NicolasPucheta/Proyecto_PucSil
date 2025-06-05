<main class="usuarioData">
    <div class="info-Usuario">
        <h1>Datos del Cliente</h1>

        <?php if (session()->getFlashdata('mensaje')): ?>
            <div class="alert alert-info">
                <?= session()->getFlashdata('mensaje') ?>
            </div>
        <?php endif; ?>

        <?php $validation = session()->getFlashdata('validation'); ?>
        <?php if ($validation): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($validation->getErrors() as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/actualizarPerfil') ?>" method="post" class="form-perfil">
            <input type="hidden" name="id" value="<?= session()->get('id') ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?= old('nombre', session()->get('nombre')) ?>" required>
            <?php if ($validation && $validation->hasError('nombre')): ?>
                <span class="text-danger"><?= $validation->getError('nombre') ?></span>
            <?php endif; ?>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" value="<?= old('apellido', session()->get('apellido')) ?>" required>
            <?php if ($validation && $validation->hasError('apellido')): ?>
                <span class="text-danger"><?= $validation->getError('apellido') ?></span>
            <?php endif; ?>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= old('email', session()->get('email')) ?>" required>
            <?php if ($validation && $validation->hasError('email')): ?>
                <span class="text-danger"><?= $validation->getError('email') ?></span>
            <?php endif; ?>

            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?= old('usuario', session()->get('usuario')) ?>" required>
            <?php if ($validation && $validation->hasError('usuario')): ?>
                <span class="text-danger"><?= $validation->getError('usuario') ?></span>
            <?php endif; ?>

            <label for="pass">Contraseña:</label>
            <input type="password" name="pass" id="pass" placeholder="Dejar vacío si no cambia la contraseña">
            <?php if ($validation && $validation->hasError('pass')): ?>
                <span class="text-danger"><?= $validation->getError('pass') ?></span>
            <?php endif; ?>

            <button type="submit">Guardar cambios</button>
        </form>

        <a href="<?= base_url('/principal') ?>">← Volver</a>
    </div>
</main>