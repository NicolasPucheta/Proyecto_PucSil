<?php

namespace App\Models;

use CodeIgniter\Model;

class Producto_Model extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'price', 'stock', 'imagen'];

    public function getProducto($id)
    {
        return $this->find($id);
    }

    public function updateStock($id, $new_stock)
    {
        return $this->update($id, ['stock' => $new_stock]);
    }
}
