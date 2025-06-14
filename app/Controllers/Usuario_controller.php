<?php

namespace App\Controllers;

use App\Models\Usuarios_model;
use CodeIgniter\Controller;

class Usuario_controller extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function index()
    {
        $userModel = new Usuarios_model();
        $data['usuarios'] = $userModel->findAll();
        $data['Titulo'] = 'CRUD de Usuarios';

        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('front/CRUD_usuario', $data);
        echo view('front/footer_view');
    }

    public function create()
    {
        $data['Titulo'] = 'Registro'; 
        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('back/usuario/registrarse');
        echo view('front/footer_view');
    }

    public function formValidation()
    {
        $input = $this->validate([
            'Nombre'     => 'required|min_length[3]',
            'Apellido'   => 'required|min_length[3]|max_length[25]',
            'Usuario'    => 'required|min_length[3]',
            'email'      => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'pass'       => 'required|min_length[3]|max_length[10]',
        ]);

        $formModel = new Usuarios_model();

        if (!$input) {
            $data['Titulo'] = 'Intento de Registro'; 
            echo view('front/head_view', $data);
            echo view('front/navbar');
            echo view('back/usuario/registrarse', ['validation' => $this->validator]);
            echo view('front/footer_view');
        } else {
            $formModel->save([
                'nombre'     => $this->request->getVar('Nombre'),
                'apellido'   => $this->request->getVar('Apellido'),
                'usuario'    => $this->request->getVar('Usuario'),
                'email'      => $this->request->getVar('email'),
                'pass'       => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
            ]);

            session()->setFlashdata('success', 'Usuario registrado con exito');
            return redirect()->to('/registro');
        }
    }

    public function guardarRol()
    {
        $userId = $this->request->getPost('user_id');
        $nuevoRol = $this->request->getPost('rol');

        $userModel = new Usuarios_model();
        $data = ['perfil_id' => $nuevoRol];
        $updated = $userModel->update($userId, $data);

        if ($updated) {
            session()->setFlashdata('success', 'Rol de usuario actualizado correctamente.');
        } else {
            session()->setFlashdata('error', 'Hubo un error al actualizar el rol del usuario.');
        }

        return redirect()->to('crudUsuarios');
    }

    public function usuarioData()
    {
        if (!session()->get('logged_in') || session()->get('perfil_id') != 2) {
            return redirect()->to('/login');
        }

        $usuario_id = session()->get('id');
        $usuarioModel = new Usuarios_model();
        $usuario = $usuarioModel->find($usuario_id);

        $data['usuario'] = $usuario;
        $data['Titulo'] = 'Datos del Cliente';
        $data['main_content'] = view('front/usuarioData', $data);

        echo view('front/head_view', $data);
        echo view('front/navbar', $data);
        echo $data['main_content'];
        echo view('front/footer_view');
    }
    
    public function actualizarPerfil()
    {
        $session = session();
        $usuarioModel = new Usuarios_model(); 

        $id = $session->get('id');

        // 1. Verificar el ID de la sesión
        if (empty($id)) {
            return redirect()->back()->with('mensaje', 'Error: ID de usuario no encontrado. Inicie sesión de nuevo.');
        }

        // 2. Definir y ejecutar reglas de validación
        $rules = [
            'nombre'   => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'usuario'  => 'required|min_length[3]',
            'email'    => 'required|min_length[4]|max_length[100]|valid_email',
        ];

        $newPassword = $this->request->getPost('pass');
        if (!empty($newPassword)) {
            $rules['pass'] = 'required|min_length[3]|max_length[10]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator)->with('mensaje', 'Error en la validación de los datos. Por favor, revise.');
        }

        // 3. Preparar datos para la actualización
        $data = [
            'nombre'   => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'usuario'  => $this->request->getPost('usuario'),
            'email'    => $this->request->getPost('email'),
        ];

        if (!empty($newPassword)) {
            $data['pass'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        // 4. Manejar la unicidad del email (si ha cambiado)
        $currentUser = $usuarioModel->find($id); // Obtener el usuario actual para comparar el email
        if ($currentUser && $data['email'] !== $currentUser['email']) {
            $existingUserWithNewEmail = $usuarioModel->where('email', $data['email'])->first();
            if ($existingUserWithNewEmail) {
                return redirect()->back()->withInput()->with('mensaje', 'El email ya está registrado por otro usuario.');
            }
        }

        // 5. Ejecutar la actualización en la base de datos
        if ($usuarioModel->update($id, $data)) {
            // 6. Si la actualización fue exitosa, refrescar la sesión
            $usuarioActualizado = $usuarioModel->find($id); // Volver a buscar el usuario para obtener los datos más recientes

                
            if ($usuarioActualizado) {
                $session->set('nombre', $usuarioActualizado['nombre']);
                $session->set('apellido', $usuarioActualizado['apellido']);
                $session->set('usuario', $usuarioActualizado['usuario']);
                $session->set('email', $usuarioActualizado['email']);
                
                // La contraseña no se guarda en sesión por seguridad

                return redirect()->to('/usuarioData')->with('mensaje', 'Datos actualizados correctamente.');
            } else {
                // Esto es una situación rara, pero es bueno tener un fallback
                return redirect()->back()->with('mensaje', 'No se pudo leer el usuario actualizado después de la operación.');
            }
        } else {
            // Si $usuarioModel->update() devuelve false, significa que hubo un error en la BD
            // o que no se realizaron cambios (si los datos eran los mismos).
            return redirect()->back()->with('mensaje', 'Error al actualizar los datos. Puede que no haya cambios o haya un problema en la base de datos.');
        }
    }

    /*
    public function eliminar($id)
    {
        $usuarioModel = new Usuarios_model();

        // Verificamos si el usuario existe
        $usuario = $usuarioModel->find($id);
        if (!$usuario) {
            session()->setFlashdata('mensaje', 'usuario no encontrado.');
             return redirect()->to('crudUsuarios');
        }

        // damos de baja al usuario
       $usuarioModel->update($id, ['baja' => 'SI']);

        session()->setFlashdata('success', 'Usuario dado de baja correctamente.');
        return redirect()->to('crudUsuarios');
    }
    */
    public function darDeBaja($id)
    {
        $model = new Usuarios_model();
        $model->update($id, ['baja' => 'SI']);
        return redirect()->to('crudUsuarios');
    }

    public function reactivar($id)
    {
        $model = new Usuarios_model();
        $model->update($id, ['baja' => 'NO']);
        return redirect()->to('crudUsuarios');
    }

}
    