<?php

namespace App\Http\Controllers;

use App\Models\Carpeta;
use App\Models\Alumno;
use App\Models\Respuesta;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CarpetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     *
     */
    public function __construct()
    {
        // $this->middleware('can:alumno.carpeta.show')->only(['edit','storage']);
        $this->middleware('can:alumno.carpeta.show')->only(['edit']);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VISTO POR EL ALUMNO
        $alumno = Alumno::find(Auth()->user()->id);
        $tarea = $alumno->tareas->find($request->id);
        $pivot = $tarea->pivot;

        if($pivot->hora_inicio == null){
            $alumno->tareas()->updateExistingPivot($request->id,['hora_inicio' => Carbon::now('America/Lima')]);
            return response()->json(['Si salio']);
        }else{
           return response()->json(['No salio']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carpeta  $carpeta
     * @return \Illuminate\Http\Response
     */
    public function show(Carpeta $carpeta)
    {
        /* --METODO DE AUTORIZACION DE TAREAS SEGUN ALUMNO */
        $this->authorize("metodo_autorizador_carpetas_alumno", $carpeta);

        $alumno = Alumno::findOrFail(auth()->user()->id);
        $datos = $alumno->tareas;
        return view('alumno.carpetas.show', compact('carpeta', 'datos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carpeta  $carpeta
     * @return \Illuminate\Http\Response
     */
    public function edit(Carpeta $carpeta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carpeta  $carpeta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carpeta $carpeta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carpeta  $carpeta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carpeta $carpeta)
    {
        //
    }
}
