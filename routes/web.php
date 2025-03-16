<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\PlanificacionController;

// Ruta de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas de Breeze (login, register, etc.)
require __DIR__.'/auth.php';

// Dashboard protegido
Route::get('/dashboard', [HomeController::class, 'root'])->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas con autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/lista-usuarios',[UsuarioController::class, 'lista_usuarios'])->name('lista_usuarios');
Route::post('/crear_usuario', [UsuarioController::class, 'crear_usuario'])->name('crear_usuario');
Route::post('/usuario-rol/{id}', [UsuarioController::class, 'asignar_rol'])->name('asignar_rol');


Route::controller(AmbienteController::class)->middleware('auth')->group(function() {
    Route::get('/ambientes', 'vista_ambientes')->name('vista_ambientes');
    Route::post('/guardar_ambiente', 'guardar_ambiente')->name('guardar_ambiente');
    Route::delete('/ambientes/{id}',  'eliminar_ambiente')->name('eliminar_ambiente');
    Route::post('/ambientes/{id}/actualizar', 'actualizar_ambiente')->name('actualizar_ambiente');
});


Route::controller(PlanificacionController::class)->middleware('auth')->group(function() {
    Route::get('/planificar', 'vista_planificar')->name('vista_planificar');
    Route::post('/seleccioname_ambiente', 'seleccioname_ambiente')->name('seleccioname_ambiente');
    Route::post('/guardar_horas','guardar_horas')->name('guardar_horas');
    Route::post('/obtener_horas_por_ambiente', 'obtener_horas_por_ambiente')->name('obtener_horas_por_ambiente');
});
Route::controller(AsignacionController::class)->middleware('auth')->group(function(){
    Route::get('asignar_horarios', 'asignar_horarios')->name('asignar_horarios');
});

Route::resource('/roles', RolesController::class)->names('roles');

// Esta ruta debe ir **al final** para no interferir con las rutas de Breeze
Route::get('{any}', [HomeController::class, 'index'])->where('any', '.*')->name('index');
