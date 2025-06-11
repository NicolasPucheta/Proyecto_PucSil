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
    
    public function getBuilderVentas_cabecera(){
        // Conecta a la base de datos usando el helper de configuración de CodeIgniter
        $db = \Config\Database::connect();
        // Crea un query builder sobre la tabla ventas_cabecera
        $builder = $db->table('ventas_cabecera');
        $builder->select('*');
        // Se realiza un JOIN con la tabla usuarios
        $builder->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // Esta función devuelve las ventas según se pase o no un $id_usuario
    public function getVentas($id_usuario = null){
        if ($id_usuario == null) {
            // Llama la función getBuilderVentas_cabecera()
            return $this->getBuilderVentas_cabecera();
        } else {
            $db = \Config\Database::connect();
            $builder = $db->table('ventas_cabecera');
            $builder->select('*');
            $builder->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id');
            $builder->where('ventas_cabecera.usuario_id', $id_usuario);
            $query = $builder->get();
            return $query->getResultArray();
        }
    }
}
