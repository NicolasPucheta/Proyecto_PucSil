<?php

namespace App\Models;

use CodeIgniter\Model;

class Ventas_cabecera_model extends Model
{
    protected $table = 'ventas_cabecera'; // Nombre de la tabla en tu BD
    protected $primaryKey = 'id';         // Clave primaria
    protected $allowedFields = ['usuario_id', 'total_venta', 'fecha']; // Campos que se pueden insertar/actualizar
    protected $returnType = 'array';      // Para que el modelo devuelva arrays en lugar de objetos

    /**
     * Obtiene ventas de cabecera, incluyendo nombre y apellido del usuario.
     * Si se proporciona un usuario_id, filtra por ese usuario.
     * Si no, trae todas las ventas (útil para el administrador).
     *
     * @param int|null $usuario_id ID del usuario para filtrar, o null para todas las ventas.
     * @return array Array de objetos/arrays de ventas de cabecera.
     */
    public function getVentas($usuario_id = null)
    {
        // El builder se inicia con la tabla principal del modelo
        $builder = $this->builder();

        // Seleccionamos todos los campos de ventas_cabecera y los campos nombre y apellido de la tabla usuarios
        // Es importante seleccionar solo los campos necesarios para evitar traer datos sensibles como la contraseña
        $builder->select('ventas_cabecera.*, usuarios.nombre, usuarios.apellido');

        // Realizamos un JOIN con la tabla de usuarios.
        // Se usa 'usuarios.id' porque el modelo Usuarios_model define 'id' como su clave primaria.
        $builder->join('usuarios', 'usuarios.id = ventas_cabecera.usuario_id');

        // Si se proporciona un ID de usuario, filtramos las ventas por ese usuario
        if ($usuario_id !== null) {
            $builder->where('ventas_cabecera.usuario_id', $usuario_id);
        }

        // Ordenamos las ventas por fecha en orden descendente (las más recientes primero)
        $builder->orderBy('ventas_cabecera.fecha', 'DESC');

        // Ejecutamos la consulta y devolvemos los resultados como un array de arrays
        return $builder->get()->getResultArray();
    }
    public function obtenerSumaTotalVentas()
    {
        return $this->selectSum('total')->first()['total'];
    }

}
