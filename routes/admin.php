<?php

use App\Http\Controllers\Admin\ActividadController;
use App\Http\Controllers\Admin\AlumnoController;
use App\Http\Controllers\Admin\AsignacionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\GradoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CarpetaController;
use App\Http\Controllers\Admin\CrearTareaController;
use App\Http\Controllers\Admin\DocenteController;
use App\Http\Controllers\Admin\MensajeController;
use App\Http\Controllers\Admin\TareaController;
use App\Http\Controllers\Admin\SeccionController;
use App\Http\Controllers\Admin\LogroController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Admin\RevisarTareaController;
use App\Http\Controllers\Admin\RevisionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('admin.index');

//CONTROLADORES DE GESTION DE LA INFORMACION
Route::resource('grados', GradoController::class)->names('admin.grados');
Route::resource('users', UserController::class)->names('admin.users');
Route::resource('carpetas', CarpetaController::class)->names('admin.carpetas');
Route::resource('mensajes', MensajeController::class)->names('admin.mensajes');
Route::resource('secciones', SeccionController::class)->names('admin.secciones');
Route::resource('logros', LogroController::class)->names('admin.logros');
Route::resource('actividades', ActividadController::class)->names('admin.actividades')->parameters(['actividades' => 'actividad']);
Route::resource('alumnos', AlumnoController::class)->names('admin.alumnos');
Route::resource('docentes', DocenteController::class)->names('admin.docentes');
Route::resource('materias', MateriaController::class)->names('admin.materias');


//ASIGNAR LOGROS
Route::resource('asignaciones', AsignacionController::class)->names('admin.asignaciones')->parameters(['asignaciones' => 'asignacion']);

//CREAR TAREAS CONTROLADOR
Route::resource('tareas', TareaController::class)->names('admin.tareas');
Route::get('/crear_tareas/{carpeta}', [CrearTareaController::class,'show'])->name('admin.crear_tareas.show');

//CREAR REVISAR TAREAS CONTROLADOR
Route::resource('revisiones', RevisionController::class)->names('admin.revisiones')->parameters(['revisiones' => 'revision']);
Route::get('/revisar_tareas/{tarea}', [RevisarTareaController::class,'edit'])->name('admin.revisar_tareas.edit');






