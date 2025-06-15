<?php

namespace App\Models;

use CodeIgniter\Model;

class Ventas_cabecera_model extends Model
{
    protected $table = 'ventas_cabecera';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'total_venta', 'fecha'];
    protected $returnType = 'array';

    public function getVentas($usuario_id = null, $fecha_inicio = null, $fecha_fin = null)
    {
        $builder = $this->builder();
        $builder->select('ventas_cabecera.*, usuarios.nombre, usuarios.apellido');
        $builder->join('usuarios', 'usuarios.id = ventas_cabecera.usuario_id');

        if ($usuario_id !== null) {
            $builder->where('ventas_cabecera.usuario_id', $usuario_id);
        }

        // Si se proporcionan las fechas de inicio y fin, agregar las condiciones de filtro
        if ($fecha_inicio) {
            $builder->where('ventas_cabecera.fecha >=', $fecha_inicio);
        }

        if ($fecha_fin) {
            $builder->where('ventas_cabecera.fecha <=', $fecha_fin);
        }

        $builder->orderBy('ventas_cabecera.fecha', 'DESC');
        return $builder->get()->getResultArray();
    }

    public function obtenerSumaTotalVentas()
    {
        return $this->selectSum('total_venta')->first()['total_venta'];
    }

    // Método para obtener las ventas con detalles y productos (incluyendo el filtro por fechas)
    public function obtenerVentasConDetalles($fechaInicio = null, $fechaFin = null)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('ventas_cabecera vc')
            ->select('vc.fecha, p.nombre AS producto, vd.cantidad, vd.precio, (vd.cantidad * vd.precio) AS total')
            ->join('ventas_detalle vd', 'vc.id = vd.venta_id')
            ->join('productos p', 'p.id = vd.producto_id');

        // Aplicar filtros de fechas
        if ($fechaInicio) {
            $builder->where('vc.fecha >=', $fechaInicio);
        }

        if ($fechaFin) {
            $builder->where('vc.fecha <=', $fechaFin);
        }

        $builder->orderBy('vc.fecha', 'DESC');
        return $builder->get()->getResultArray();
    }
}
