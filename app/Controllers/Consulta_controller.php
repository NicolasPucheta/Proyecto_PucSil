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


    
    public function verConsultas()
    {
        $consultaModel = new Consulta_model();
        $data['consultas'] = $consultaModel->findAll();
        $data['Titulo'] = 'Consultas recibidas';
    
        echo view('front/head_view', $data);
        echo view('front/navbar');
        echo view('back/Consultas/Consultas_view', $data);
        echo view('front/footer_view');
    }
    
    public function marcarLeido($id)
    {
        if ($this->request->isAJAX()) {
            $consultaModel = new Consulta_model();
    
            $consulta = $consultaModel->find($id);
            if ($consulta) {
                $nuevoEstado = $consulta['leido'] ? 0 : 1;
                $consultaModel->update($id, ['leido' => $nuevoEstado]);
                return $this->response->setJSON(['success' => true]);
            }
        }
    
        return $this->response->setStatusCode(400)->setJSON(['error' => 'Consulta no válida']);
    }
    
}
