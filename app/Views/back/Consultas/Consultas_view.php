<main class="consultas bg-dark">
  <div class="container py-5">
    <h1 class="mb-4"><?= esc($Titulo) ?></h1>

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <div class="mb-4">
      <input type="text" id="searchInput" class="form-control" placeholder="Buscar por email...">
    </div>

    <ul class="list-group" id="consultaList">
      <?php foreach ($consultas as $consulta): ?>
        <li class="list-group-item d-flex justify-content-between align-items-start <?= $consulta['leido'] ? 'leido' : 'no-leido' ?>" data-email="<?= esc(strtolower($consulta['email'])) ?>" data-id="<?= $consulta['id'] ?>">
          <div class="ms-2 me-auto">
            <div class="fw-bold"><?= esc($consulta['email']) ?></div>
            <?= esc($consulta['mensaje']) ?><br>
            <small class="fecha-consulta">Enviado el <?= date('d/m/Y H:i', strtotime($consulta['created_at'])) ?></small>

          </div>
          <button class="btn btn-sm <?= $consulta['leido'] ? 'btn-secondary' : 'btn-success' ?> btn-toggle-leido">
            <?= $consulta['leido'] ? '<i class="bi bi-check-circle-fill"></i> Leído' : 'Leído' ?>
          </button>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <script>
    const input = document.getElementById("searchInput");

    input.addEventListener("input", () => {
      const filtro = input.value.toLowerCase();
      document.querySelectorAll("#consultaList li").forEach(li => {
        const email = li.dataset.email;
        li.style.display = email.includes(filtro) ? "flex" : "none";
      });
    });

    document.querySelectorAll(".btn-toggle-leido").forEach(btn => {
      btn.addEventListener("click", () => {
        const li = btn.closest("li");
        const id = li.dataset.id;
        fetch(`<?= base_url('consultas/marcarLeido') ?>/${id}`, {
          method: 'POST',
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })

        .then(response => response.json())
        .then(data => {
          if (data.success) {
            li.classList.toggle("leido");
            li.classList.toggle("no-leido");

            const esLeido = btn.classList.contains("btn-secondary");

            btn.className = "btn btn-sm " + (esLeido ? "btn-success" : "btn-secondary") + " btn-toggle-leido";
            btn.innerHTML = esLeido
              ? 'Leído'
              : '<i class="bi bi-check-circle-fill"></i> Leído';
          } else {
            alert("Error al cambiar estado.");
          }
        })
        .catch(() => alert("Error en la conexión"));
      });
    });
  </script>
</main>
