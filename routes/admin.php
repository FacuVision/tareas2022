<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SpecialityController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

Route::get('/', [HomeController::class,'index'])->name('admin.index');
