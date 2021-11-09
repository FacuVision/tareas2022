<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\GradoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CarpetaController;
use App\Http\Controllers\Admin\MensajeController;
use App\Http\Controllers\Admin\TareaController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class,'index'])->name('admin.index');
Route::resource('grados', GradoController::class)->names('admin.grados');
Route::resource('users', UserController::class)->names('admin.users');
Route::resource('carpetas', CarpetaController::class)->names('admin.carpetas');
Route::resource('mensajes', MensajeController::class)->names('admin.mensajes');
Route::resource('tareas', TareaController::class)->names('admin.tareas');


