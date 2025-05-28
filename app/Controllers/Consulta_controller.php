<?php

namespace App\Controllers;

use App\Models\Consulta_model;
use CodeIgniter\Controller;

class Consulta_controller extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function guardarConsulta()
    {
        // Validación
        $rules = [
            'email'   => 'required|valid_email|max_length[100]',
            'mensaje' => 'required|min_length[5]'
        ];

        if (!$this->validate($rules)) {
            // Si no pasa validación, redirigí con errores
            return redirect()->back()->withInput()->with('fail', 'Completa los campos correctamente');
        }

        // Guardar en la base de datos
        $consultaModel = new Consulta_model();

        $consultaModel->save([
            'email'   => $this->request->getPost('email'),
            'mensaje' => $this->request->getPost('mensaje')
        ]);

        // Flash y redirección
        return redirect()->to('/ayuda')->with('success', 'Consulta enviada correctamente. Gracias por escribirnos.');
    }
}
