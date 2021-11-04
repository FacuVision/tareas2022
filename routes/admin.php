<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\GradoController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;

Route::get('/', [HomeController::class,'index'])->name('admin.index');
Route::resource('grados', GradoController::class)->names('admin.grados');
Route::resource('users', UserController::class)->names('admin.users');
