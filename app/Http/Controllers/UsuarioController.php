<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function lista_usuarios(){
        $users = User::all();
        $roles = Role::all();
        return view('roles-permissions.users',[
            'users' => $users,
            'roles' => $roles,
        ]);
    }
    public function crear_usuario(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Usuario agregado con exito');
    }

    public function asignar_rol(Request $request, $id){
        $usuario = User::find($id);
        if($usuario){
            $usuario->syncRoles($request->input('roles'));
            return redirect()->back()->with('success', 'Roles asignado correctamente');
        }
        return redirect()->back()->with('Error', 'Rol no asignado');
    }
}
