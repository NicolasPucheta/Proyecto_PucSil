<?php

namespace App\Models;

use CodeIgniter\Model;

class Producto_Model extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre_prod', // Usado en store y actualizarProducto
        'precio',      // Usado en store y actualizarProducto
        'precio_vta',  // Usado en store y actualizarProducto
        'stock',       // Usado en store y actualizarProducto
        'stock_min',   // Usado en store y actualizarProducto
        'imagen',      // Usado en store y actualizarProducto
        'categoria_id', // Usado en store y actualizarProducto
        'eliminado'    // Usado para la restauracion
    ];

    public function getProducto($id)
    {
        return $this->find($id);
    }

    public function updateStock($id, $new_stock)
    {
        return $this->update($id, ['stock' => $new_stock]);
    }

    public function decrementStock(int $productoId, int $cantidad): bool
    {
        // Obtener el producto actual para saber su stock
        $producto = $this->find($productoId);

        if (!$producto) {
            // El producto no existe
            return false;
        }

        $currentStock = $producto['stock'];
        $newStock = $currentStock - $cantidad;
        if ($newStock < 0) {
            $newStock = 0; 
        }

        return $this->update($productoId, ['stock' => $newStock]);
    }
}
