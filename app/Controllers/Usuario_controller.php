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
}