<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use App\Models\Dia;
use App\Models\Horario;
use App\Models\Horas;
use App\Models\planificar_horarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PlanificacionController extends Controller
{
    public function vista_planificar(Request $request)
    {
        $users = Auth::user();
        $id_carrera_sede = '21'; //////////////////////////////Dinamicos para que no existan fallos

        $planificar = planificar_horarios::all();
        if ($planificar->isEmpty()) {
            $obj = new planificar_horarios();
            $obj->tipo = 'docente'; ////////////Dinamico
            $obj->ciclo = 'semana'; ///////////Dinamico
            $obj->id_carrera_sede  = $id_carrera_sede;
            //$obj->id_usuario  = $users->id;
            $obj->save();
            $id_planificar = $obj->id;
        } else {
            $planificar = planificar_horarios::first();
            //lO TRAEMOS PARA AGREGAR A LA TABLA HORARIOS
            $id_planificar = $planificar->id;
        }
        $ambient = Ambientes::where('id_carrera_sede', $id_carrera_sede)->orderBy('ambiente')->get();
        $dias = Dia::all();

        // dd($id_planificar);
        //insercion para horario por defacult
        // Obtener todos los ID de los ambientes
        $id_ambientes = Ambientes::pluck('id');

        if ($id_planificar != 0) {
            foreach ($id_ambientes as $id_ambiente) { // Iteramos sobre cada ambiente
                foreach ($dias as $d) {
                    // Validar si ya existe un horario para ese día y ese ambiente
                    $valida = Horario::where('id_dia', $d->id)
                        ->where('id_ambiente', $id_ambiente)
                        ->exists(); // Solo verificamos si existe

                    if (!$valida) { // Si no existe, lo creamos
                        $horario = new Horario();
                        $horario->id_dia  = $d->id;
                        $horario->id_ambiente  = $id_ambiente;
                        $horario->id_planificar_horario = $id_planificar;
                        $horario->save();
                    }
                }
            }
        }

        $horario = DB::table('horarios as h')
            ->select('h.*', 'a.*', 'd.*')
            ->join('dias as d', 'h.id_dia', '=', 'd.id')
            ->join('ambientes as a', 'h.id_ambiente', '=', 'a.id')
            ->where('id_planificar_horario', $id_planificar)
            ->orderBy('d.id', 'asc')
            ->get();

        return view('planificar.vista_planificar', compact('ambient', 'horario', 'dias', 'id_planificar'));
    }

    public function seleccioname_ambiente(Request $request)
    {
        if ($request->isMethod('post')) {
            $ambiente = Ambientes::find($request->input('id'));


            if ($ambiente) {
                return response()->json([
                    'success' => true,
                    'id_ambiente' => $ambiente->id,
                    'ambiente' => $ambiente->ambiente
                ]);
            }

            return response()->json(['success' => false, 'message' => 'Ambiente no encontrado'], 404);
        }
    }


    public function obtener_horas_por_ambiente(Request $request)
    {
        if ($request->isMethod('post')) {
            $id_ambiente = $request->input('id_ambiente');
            $id_planificar = session('id_planificar_horario'); // Asegúrate de tener esta sesión disponible

            // Obtener todos los días
            $dias = Dia::all();

            $horas_por_dia = [];

            foreach ($dias as $dia) {
                $horas = DB::table('horarios as h')
                    ->select('r.*')
                    ->join('dias as d', 'h.id_dia', '=', 'd.id')
                    ->join('ambientes as a', 'h.id_ambiente', '=', 'a.id')
                    ->join('horas as r', 'h.id', '=', 'r.id_horario')
                    ->where('id_planificar_horario', 2)//el dos volverlo dinamico para que sea escalable
                    ->where('id_dia', $dia->id)
                    ->where('id_ambiente', $id_ambiente)
                    ->orderBy('r.hora_inicio', 'ASC')
                    ->get();

                $horas_por_dia[$dia->id] = $horas;
            }

            return response()->json([
                'success' => true,
                'horas_por_dia' => $horas_por_dia
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Método no permitido'], 405);
    }

    public function guardar_horas(Request $request)
    {
        try {
            // Obtener el primer horario que coincida con los criterios
            $horario = Horario::where('id_dia', $request->id_dia)
                ->where('id_ambiente', $request->id_ambiente)
                ->first(); // Esto obtiene solo el primer resultado

            // Verificar que se encontró un horario
            if (!$horario) {
                return redirect()->back()->with('error', 'No se encontró el horario correspondiente');
            }

            // Ahora creamos horas agregando el id_horario
            $obj = new Horas();
            $obj->id_horario = $horario->id; // Usar directamente el id del horario encontrado
            $obj->hora_inicio = $request->hora_inicio;
            $obj->hora_fin = $request->hora_fin;
            $obj->estado = '1';
            $obj->save();

            return redirect()->back()->with('success', 'Horario agregado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear horario: ' . $e->getMessage());
        }
    }
}
