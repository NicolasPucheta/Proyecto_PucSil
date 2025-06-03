<main class="usuarioData">
    <div class="info-Usuario">
        <h1>Datos del Cliente</h1>
        <p><strong>Nombre:</strong> <?= session()->get('nombre') ?> <?= session()->get('apellido') ?></p>
        <p><strong>Email:</strong> <?= session()->get('email') ?></p>
        <p><strong>Usuario:</strong> <?= session()->get('usuario') ?></p>
        <p><strong>Contraseña:</strong> <?= session()->get('pass') ?></p>
         <a href="<?= base_url('/principal') ?>">← Volver</a>
    </div>
</main>