<?php

namespace App\Models;

use CodeIgniter\Model;

class Ventas_detalle_model extends Model
{
    protected $table = 'ventas_detalle'; // nombre de la tabla en tu BD
    protected $primaryKey = 'id';        // clave primaria

    protected $allowedFields = ['venta_id', 'producto_id', 'cantidad', 'precio'];

    protected $returnType = 'array';

    public function getDetalles($venta_id)
    {
        return $this->where('venta_id', $venta_id)->findAll();
    }
}
