<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Seccion;
use App\Models\User;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumno::all();
        return view("admin.alumnos.index", compact("alumnos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::select()->orderBy("name")->get();
        $secciones = Seccion::all();
        return view("admin.alumnos.create", compact("secciones","users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "user_id" => "required"
        ]);

        $user = User::findOrFail($request->user_id);

        if ($user->alumno) {
            return redirect()->route('admin.alumnos.index')->with('alerta','El usuario ya fue asignado como alumno');
        } elseif($user->docente) {
            return redirect()->route('admin.alumnos.index')->with('alerta','El usuario ya fue asignado como docente');
        } else{
            Alumno::create($request->all());
            return redirect()->route('admin.alumnos.index')->with('mensaje','El alumno fue creado correctamente');

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        $secciones = Seccion::all();

        return view("admin.alumnos.edit",compact("alumno","secciones"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
        $alumno->update($request->all());

        return redirect()->route('admin.alumnos.index')->with('mensaje','El alumno se asigno a su seccion correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        //
    }
}
