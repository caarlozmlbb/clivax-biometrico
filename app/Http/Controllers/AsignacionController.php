<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AsignacionController extends Controller
{
    protected $id_carrera_sede;
    public function __construct(Request $request)
    {
        $this->id_carrera_sede = '0';
    }

    public function asignar_horarios(Request $request)
    {
        $users = Auth::user();

        // Obtener docentes
        $docentes = DB::table('base_upea.vista_asignacion_control_docente_actua as d')
            ->select(
                'd.asignacion_id',
                'd.ci',
                DB::raw("concat_ws(' ', d.paterno, d.materno, d.persona) as docente"),
                DB::raw("concat_ws(' ', d.sigla_asignatura, d.asignatura) as materia"),
                DB::raw("concat_ws(' ', d.nivel, d.turno, d.paralelo) as nivel"),
                'd.categoria'
            )
            ->where('carsed_id', $this->id_carrera_sede)
            ->orderBy('d.paterno', 'asc')
            ->orderBy('d.materno', 'asc')
            ->orderBy('d.persona', 'asc')
            ->orderBy('d.sigla_asignatura', 'asc')
            ->orderBy('d.nivel', 'asc')
            ->get();

            // dd($docentes);
        // Obtener horarios para cada docente
        foreach ($docentes as $docente) {
            $docente->horarios = DB::table('asignar_horas as as')
                ->select(
                    'as.id',
                    DB::raw("concat_ws(' - ', r.hora_inicio, r.hora_fin) as horas"),
                    'a.ambiente',
                    'd.id as dia_id',
                    'd.dias'
                )
                ->join('horas as r', 'r.id', '=', 'as.id_hora')
                ->join('horarios as h', 'h.id', '=', 'r.id_horario')
                ->join('dias as d', 'd.id', '=', 'h.id_dia')
                ->join('ambientes as a', 'a.id', '=', 'h.id_ambiente')
                ->where('as.id_asignacion', $docente->asignacion_id)
                ->where('as.estado', '1')
                ->orderBy('r.hora_inicio', 'asc')
                ->get();
        }

        return view('asignar.vista_asignar', compact('docentes'));
    }
}
