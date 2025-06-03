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

    // Método para mostrar el CRUD de usuarios con datos de la base de datos
    public function index()
    {
        $userModel = new Usuarios_model();
        $data['usuarios'] = $userModel->findAll(); // Obtiene todos los usuarios de la base de datos
        $data['Titulo'] = 'CRUD de Usuarios';

        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('front/CRUD_usuario', $data); // Carga la vista CRUD_usuarios.PHP
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
            $formModel->save(  [
                'nombre'     => $this->request->getVar('Nombre'),
                'apellido'   => $this->request->getVar('Apellido'),
                'usuario'    => $this->request->getVar('Usuario'),
                'email'      => $this->request->getVar('email'),
                'pass'       => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
                // password_hash() crea un nuevo hash de contraseña usando un algoritmo de hash de único sentido.
            ]);
            // Flashdata funciona solo en redirigir la función en el controlador en la vista de carga.
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

        return redirect()->to('crudUsuarios'); // Redirige de vuelta a la lista de usuarios
    }

    public function usuarioData()
    {
        // Proteger esta vista: solo si está logueado y es cliente
        if (!session()->get('logged_in') || session()->get('perfil_id') != 2) {
            return redirect()->to('/login');
        }

        $data['main_content'] = view('front/usuarioData'); // Carga la vista principal
        $data['Titulo'] = 'Datos del Cliente'; // Puedes pasar datos adicionales si lo necesitas

        echo view('front/head_view', $data); // Renderiza el header, pasando $data si es necesario
        echo view('front/navbar',$data);
        echo $data['main_content'];                 // Renderiza el contenido principal
        echo view('front/footer_view');         // Renderiza el footer
    }
}