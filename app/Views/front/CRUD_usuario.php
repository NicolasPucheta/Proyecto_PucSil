
  <main class="bg-light">
    <div class="container py-5">
      <h2 class="mb-4 text-center">CRUD de Usuarios</h2>

      <form id="userForm" class="mb-4">
        <div class="row g-2">
          <div class="col-md-4">
            <input type="text" id="name" class="form-control" placeholder="Nombre" required>
          </div>
          <div class="col-md-4">
            <input type="email" id="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="col-md-4 d-grid">
            <button type="submit" class="btn btn-primary" id="submitBtn">Agregar Usuario</button>
          </div>
        </div>
      </form>

      <table class="table table-bordered table-hover">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="userTableBody"></tbody>
      </table>
    </div>

    <script>
      let users = [];
      let editIndex = null;

      const userForm = document.getElementById('userForm');
      const userTableBody = document.getElementById('userTableBody');
      const nameInput = document.getElementById('name');
      const emailInput = document.getElementById('email');
      const submitBtn = document.getElementById('submitBtn');

      userForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const name = nameInput.value.trim();
        const email = emailInput.value.trim();

        if (editIndex === null) {
          users.push({ name, email });
        } else {
          users[editIndex] = { name, email };
          editIndex = null;
          submitBtn.textContent = 'Agregar Usuario';
        }

        userForm.reset();
        renderTable();
      });

      function renderTable() {
        userTableBody.innerHTML = '';
        users.forEach((user, index) => {
          userTableBody.innerHTML += `
            <tr>
              <td>${index + 1}</td>
              <td>${user.name}</td>
              <td>${user.email}</td>
              <td>
                <button class="btn btn-sm btn-warning me-1" onclick="editUser(${index})">Editar</button>
                <button class="btn btn-sm btn-danger" onclick="deleteUser(${index})">Eliminar</button>
              </td>
            </tr>
          `;
        });
      }

      function editUser(index) {
        const user = users[index];
        nameInput.value = user.name;
        emailInput.value = user.email;
        editIndex = index;
        submitBtn.textContent = 'Actualizar Usuario';
      }

      function deleteUser(index) {
        if (confirm('¿Seguro que deseas eliminar este usuario?')) {
          users.splice(index, 1);
          renderTable();
        }
      }
    </script>
  </main>
