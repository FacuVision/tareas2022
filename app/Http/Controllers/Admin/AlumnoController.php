<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Level;
use App\Models\Seccion;
use App\Models\User;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{

    public function __construct() {
        $this->middleware('can:admin.alumnos.index')->only('index');
        $this->middleware('can:admin.alumnos.edit')->only(['edit','update']);
        $this->middleware('can:admin.alumnos.create')->only(['create','store']);
        $this->middleware('can:admin.alumnos.destroy')->only('destroy');

    }

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
        $users = User::doesntHave('docente')->doesntHave('alumno')->orderBy("name")->get();
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

            //si en caso el usuario posee algun rol en especifico
            foreach ($user->roles as $role) {
                if($role->id == 1 || $role->id == 2){ // si en caso ya posee el rol de admin
                    return redirect()->route('admin.alumnos.index')->with('alerta','El usuario seleccionado tiene rol administrador, no se puede asignar');
                }
            }

            $user->roles()->sync(3);
            Alumno::create($request->all());
            Level::create([
                "user_id" => $request->user_id,
                "level" => 1,
                "exp" => 0,
                "exp_ac" => 0
            ]);
        }
        return redirect()->route('admin.alumnos.index')->with('mensaje','El alumno fue creado correctamente');
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

        $alumno->user->roles()->sync(null);
        $alumno->delete();
        return redirect()->route('admin.alumnos.index')->with('mensaje','El alumno se eliminó correctamente');

    }
}
