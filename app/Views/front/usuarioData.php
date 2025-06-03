<main class="usuarioData">
    <div class="info-Usuario">
        <h1>Datos del Cliente</h1>
        
        <form action="<?= base_url('/actualizarPerfil') ?>" method="post" class="form-perfil">
            <input type="hidden" name="id" value="<?= session()->get('id') ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?= session()->get('nombre') ?>" required>

            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" value="<?= session()->get('apellido') ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= session()->get('email') ?>" required>

            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?= session()->get('usuario') ?>" required>

            <label for="pass">Contraseña:</label>
            <input type="password" name="pass" id="pass" placeholder="Dejar vacío si no cambia la contraseña">

            <button type="submit">Guardar cambios</button>
        </form>

        <a href="<?= base_url('/principal') ?>">← Volver</a>
    </div>
</main>
