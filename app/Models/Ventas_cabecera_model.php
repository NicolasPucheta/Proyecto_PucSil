<?php

namespace App\Models;

use CodeIgniter\Model;

class Ventas_cabecera_model extends Model
{
    protected $table = 'ventas_cabecera'; // nombre de la tabla en tu BD
    protected $primaryKey = 'id';         // clave primaria

    protected $allowedFields = ['usuario_id', 'total_venta', 'fecha']; // campos que se pueden insertar/actualizar

    // Si querés que el modelo devuelva arrays en lugar de objetos
    protected $returnType = 'array';

    public function getVentas($id_usuario)
    {
        return $this->where('usuario_id', $id_usuario)->findAll();
    }
}
