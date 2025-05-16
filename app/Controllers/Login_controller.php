<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios_model;

class Login_controller extends BaseController
{
    public function index()
    {
        helper(['form', 'url']);
        $data['Titulo'] = 'Login';
        echo view('front/head_view', $data);
        echo view('front/navbar',$data);
        echo view('front/inicio_sesion', $data); // Cambiado la ruta de la vista
        echo view('front/footer_view',$data );
    }

    public function auth()
    {
        $session = session();
        $model = new Usuarios_model();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password'); // Cambiado 'pass' a 'password'

        $data = $model->where('email', $email)->first();

        if ($data) {
            $pass = $data['pass'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_usuario' => $data['id_usuario'],
                    'nombre' => $data['nombre'],
                    'apellido' => $data['apellido'],
                    'email' => $data['email'],
                    'usuario' => $data['usuario'],
                    'perfil_id' => $data['perfil_id'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                session()->setFlashdata('msg', '¡Bienvenido!');
                return redirect()->to('/principal'); // Asegúrate de que esta ruta exista
            } else {
                session()->setFlashdata('msg', 'Password incorrecto');
                return redirect()->to('/login'); // Asumo que tienes una ruta '/login' para mostrar el formulario
            }
        } else {
            session()->setFlashdata('msg', 'No ingresó un email o el mismo es incorrecto');
            return redirect()->to('/login'); // Asumo que tienes una ruta '/login' para mostrar el formulario
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login'); // Asumo que tienes una ruta '/login'
    }
}