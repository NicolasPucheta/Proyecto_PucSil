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
        $id = $this->request->getPost('id');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $usuario = $this->request->getPost('usuario');
        $email = $this->request->getPost('email');
        $pass = $this->request->getPost('pass');
    
        $usuarioModel = new Usuarios_model();
    
        $data = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'usuario' => $usuario,
            'email' => $email,
            'pass' => $pass,
        ];
    
        // Solo actualizamos la contraseña si viene no vacía y encriptada (por seguridad)
        if (!empty($pass)) {
            $data['pass'] = password_hash($pass, PASSWORD_DEFAULT);
        }
    
        $usuarioModel->update($id, $data);
    
        // Actualizar la sesión con los datos que se hayan cambiado
        session()->set('nombre', $nombre);
        session()->set('apellido', $apellido);
        session()->set('usuario', $usuario);
        session()->set('email', $email);
        session()->set('pass', $pass);
    
        return redirect()->to('/usuarioData')->with('mensaje', 'Datos actualizados correctamente.');
    }

    public function eliminar($id)
    {
        $usuarioModel = new Usuario_model();

        // Verificamos si el producto existe
        $usuario = $usuarioModel->find($id);
        if (!$usuario) {
            session()->setFlashdata('mensaje', 'Producto no encontrado.');
            session()->setFlashdata('tipo', 'danger');
            return redirect()->to('/');
        }

        // Eliminamos el producto
        $usuarioModel->delete($id);

        session()->setFlashdata('mensaje', 'usuario eliminado correctamente.');
        session()->setFlashdata('tipo', 'success');

        return redirect()->to('crudUsuarios');
    }
}
    