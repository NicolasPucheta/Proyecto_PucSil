<?php

namespace App\Models;

use CodeIgniter\Model;

class Ventas_detalle_model extends Model
{
    protected $table = 'ventas_detalle'; // nombre de la tabla en tu BD
    protected $primaryKey = 'id';        // clave primaria

    protected $allowedFields = ['venta_id', 'producto_id', 'cantidad', 'precio'];

    protected $returnType = 'array';

    public function getDetallePorVenta($venta_id = null) {
        $db = \Config\Database::connect();
        $builder = $db->table('venta_detalle');
        $builder->select('*');
        $builder->join('ventas_cabecera','ventas_cabecera.id = ventas_detalle.venta_id');
        $builder->join('productos','productos.id = ventas_detalle.producto_id');
        $builder->join('usuarios','usuarios.id_usuario = ventas_cabecera.usuario.id');
        if($venta_id != null){
            $builder->where('venta_cabecera_id', $venta_id);
        }
        $query = $builder->get();
        return $query->getResultArray();
    }
}