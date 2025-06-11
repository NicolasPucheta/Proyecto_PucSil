<?php

namespace App\Models;

use CodeIgniter\Model;

class Ventas_detalle_model extends Model
{
    protected $table = 'ventas_detalle'; // Nombre de la tabla en tu BD
    protected $primaryKey = 'id';         // Clave primaria
    protected $allowedFields = ['venta_id', 'producto_id', 'cantidad', 'precio'];
    protected $returnType = 'array';      // Para que los resultados se devuelvan como arrays

    /**
     * Obtiene los detalles de una venta específica, incluyendo el nombre del producto.
     * Este método está diseñado para ser llamado con un venta_id.
     *
     * @param int $venta_id ID de la venta cuyos detalles se desean obtener.
     * @return array Array de objetos/arrays de detalles de venta.
     */
    public function getDetallePorVenta($venta_id)
    {
        // El builder se inicia con la tabla principal del modelo
        $builder = $this->builder();

        // Seleccionamos todos los campos de ventas_detalle y el nombre del producto de la tabla productos
        // Se le asigna un alias 'producto' al nombre del producto para evitar conflictos y facilitar el acceso en la vista
        $builder->select('ventas_detalle.*, productos.nombre_prod as producto'); // Usar nombre_prod si es el nombre real del campo
        
        // Realizamos un JOIN con la tabla de productos para obtener el nombre del producto
        $builder->join('productos', 'productos.id = ventas_detalle.producto_id');
        
        // Filtramos por el ID de la venta
        $builder->where('ventas_detalle.venta_id', $venta_id);

        // Ejecutamos la consulta y devolvemos los resultados como un array de arrays
        return $builder->get()->getResultArray();
    }
}
