<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use App\Models\Edificio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmbienteController extends Controller
{
    public function vista_ambientes(Request $request)
    {
        $users = Auth::user();
        //$ambiente = ambientes::all();
        $edificio = Edificio::all();
        $ambientes = DB::table('ambientes as a')
            ->select('e.edificio', 'a.*')
            ->join('edificios as e', 'a.id_edificio', '=', 'e.id')
            ->orderBy('a.ambiente', 'asc')
            ->get();
        return view('ambiente.vista_ambiente', compact('ambientes', 'edificio'));
    }

    public function guardar_ambiente(Request $request)
    {
        try {
            $obj = new Ambientes();
            $obj->id_carrera_sede  = '21'; ///////////////////////////////////////////VOLVER DINAMICO
            $obj->ambiente = $request->post('ambiente');
            $obj->id_edificio  = $request->post('edificio');
            $obj->piso = $request->post('piso');
            $obj->tipo_ambiente = $request->post('tipo');
            $obj->estado = '1';
            $obj->capacidad_ambiente = $request->post('capacidad');
            $obj->save();
            return redirect()->back()->with('status', 'Ambiente creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear ambiente.');
        }
    }


    public function eliminar_ambiente($id)
    {
        try {
            $ambiente = Ambientes::findOrFail($id);

            $ambiente->delete();

            return redirect()->back()->with('status', 'Ambiente eliminado correctamente.');
        } catch (\Exception $e) {
            // Redirigir con un mensaje de error si algo falla
            return redirect()->back()->with('error', 'Error al eliminar ambiente.' . $e->getMessage());
        }
    }

    public function actualizar_ambiente(Request $request, $id)
    {
        try {
            $ambiente = Ambientes::findOrFail($id);
            $ambiente->ambiente = $request->post('ambiente');
            $ambiente->id_edificio = $request->post('edificio');
            $ambiente->piso = $request->post('piso');
            $ambiente->tipo_ambiente = $request->post('tipo');
            $ambiente->capacidad_ambiente = $request->post('capacidad');
            $ambiente->estado = $request->post('estado');
            $ambiente->save();

            return redirect()->back()->with('status', 'Ambiente actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar ambiente.');
        }
    }
}
