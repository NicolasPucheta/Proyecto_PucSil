<?php

namespace App\Models;
use CodeIgniter\Model;

class Consulta_model extends Model
{
    protected $table = 'consultas';
    protected $primaryKey = 'id';

    // Campos que se pueden guardar
    protected $allowedFields = ['email', 'mensaje'];

    // Si querés guardar fecha de creación y actualización automáticamente
    protected $useTimestamps = true;
}
