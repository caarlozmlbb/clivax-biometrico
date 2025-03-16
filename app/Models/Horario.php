<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';

    protected $fillable = [
        'id_dia',
        'id_ambiente',
        'id_planificar_horario'
    ];
}
