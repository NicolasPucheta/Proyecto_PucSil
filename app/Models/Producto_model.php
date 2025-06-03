<?php

namespace App\Models;

use CodeIgniter\Model;

class Producto_model extends Model
{
    protected $table            = 'productos';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nombre_prod',
        'imagen',
        'categoria_id',
        'precio',
        'precio_vta',
        'stock',
        'stock_min',
        'eliminado'
    ];
    public function getProductoAll()
    {
        return $this->findAll(); // devuelve todos los productos
    }
    public function getVentas() {
        // Utilizamos el modelo de ventas para acceder a la tabla 'ventas'
        $db = \Config\Database::connect();
        $builder = $db->table('ventas');
        
        // Devolver todas las ventas
        return $builder->get()->getResult(); 
    }
}