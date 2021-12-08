<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use App\Models\Materia;
use App\Models\Seccion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes = Docente::all();
        return view('admin.docentes.index', compact('docentes'));
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
        $materias = Materia::all();
        return view('admin.docentes.create', compact('users','secciones','materias'));
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
            "user_id" => "required",
            "materias" => "required",
            "secciones" => "required",
        ]);
        //return $request;
        $user = User::findOrFail($request->user_id);
        if ($user->alumno) {
            return redirect()->route('admin.docentes.index')->with('alerta','El usuario ya fue asignado como alumno');
        } elseif($user->docente) {
            return redirect()->route('admin.docentes.index')->with('alerta','El usuario ya fue asignado como docente');
        } else{
            //$docente = Docente::create(["user_id" => $request->user_id]); NO FUNKA
            //$docente = Docente::create($request->only(["user_id"]));X2
            $user->docente()->create();
            foreach($request->secciones as $seccion)
            {
                DB::table("docente_seccion")->insert([
                   "user_id" => $user->id,
                   "seccion_id" => $seccion
                ]);
            }

            foreach($request->materias as $materia)
            {
                DB::table("docente_materia")->insert([
                   "user_id" => $user->id,
                   "materia_id" => $materia
                ]);
            }
            //return $docente->secciones;

            //$docente->secciones()->attach($request->secciones);X3
            //$docente->materias()->attach($request->materias);X4

            return redirect()->route('admin.docentes.index')->with('mensaje','El Docente fue creado correctamente');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente $docente)
    {
        $secciones = Seccion::all();
        $materias = Materia::all();
        return view('admin.docentes.edit', compact('docente','secciones','materias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Docente $docente)
    {

        $docente->materias()->sync($request->materias);
        $docente->secciones()->sync($request->secciones);

        return redirect()->route('admin.docentes.index')->with('mensaje','El Docente fue asignado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {
        //
    }
}
