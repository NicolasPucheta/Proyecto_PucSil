<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuarios_model;

class Login_controller extends BaseController
{
    public function index()
    {
        helper(['form', 'url']);
        
    }

    public function auth()
    {
        $session = session(); //iniciamos el objeto session
        $model = new Usuarios_model(); //instanciamos el modelo

        //traemos los datos del fomrulario
        $email = $this->request->getVar('email'); //correo 
        $password = $this->request->getVar('pass'); //pass

        $data = $model->where('email', $email)->first();

        if ($data) {
            $pass = $data['pass'];
                $ba= $data ['baja'];
                if($ba == 'SI'){
                    $session -> setFlashdata('msg', 'usuario dado de baja');
                    return redirect()->to('/');               }
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_usuario' => $data['id'],
                    'nombre' => $data['nombre'],
                    'apellido' => $data['apellido'],
                    'email' => $data['email'],
                    'usuario' => $data['usuario'],
                    'perfil_id' => $data['perfil_id'],
                    'logged_in' => TRUE
                ];   
                $session->set($ses_data);
                session()->setFlashdata('msg', '¡Bienvenido!');
                return redirect()->to('/principal'); 
            } else {
                session()->setFlashdata('fail', 'Password incorrecto');
                return redirect()->to('/login'); 
            }
        } else {
            session()->setFlashdata('msg', 'No ingresó un email o el mismo es incorrecto');
            return redirect()->to('/login'); 
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login'); 
    }
}