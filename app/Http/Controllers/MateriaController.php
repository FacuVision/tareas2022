<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Alumno;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumno = Alumno::findOrFail(auth()->user()->id);

        //$datos = $alumno->seccion->carpetas;
        //$datos = $alumno->seccion->carpetas()->get()->groupBy('materia_id');
        $datos = $alumno->seccion->carpetas->pluck('materia_id')->toArray();

        $array = array_unique($datos);
        $materias = [];
        foreach ($array as $key) {
            $materias[$key] = Materia::findOrFail($key);
        }

        //return $materias;
        return view('alumno.materias.index', compact('materias'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show(Materia $materia)
    {
        $alumno = Alumno::findOrFail(auth()->user()->id);
        $datos = $alumno->seccion->carpetas;
        return view('alumno.materias.show', compact('materia','datos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function edit(Materia $materia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materia $materia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materia $materia)
    {
        //
    }
}
