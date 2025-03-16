<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horas extends Model
{
    protected $table = 'horas';

    protected $fillable = [
        'id_horario',
        'hora_inicio',
        'hora_fin',
        'estado',
    ];
}
