<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Alumno;
use App\Models\Level;
use App\Models\Logro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('can:alumno.materias.index')->only('index');
        $this->middleware('can:alumno.materias.create')->only('index');
        $this->middleware('can:alumno.materias.show')->only('show');
    }

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
        $alumno = Alumno::findOrFail(Auth::user()->id);
        $unlocks = $alumno->logros;
        $array = [];
        foreach ($unlocks as $u) {
            array_push($array,$u->pivot["logro_id"]);
        }
        //WHERE NOT IN FUNCIONA PARA HACER UNA CONSULTA MASIVA DE DATOS HACIENDO USO DE UN ARRAY UNIDIMENSIONAL
        $logros = Logro::whereNotIn('id',$array)->get();
        //$logros = Logro::doesntHave('alumnos')->get();
        return view('alumno.logros.index', compact('logros','unlocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $alumno = Alumno::findOrFail(Auth::user()->id);
        $logro = Logro::findOrFail($request->logro_id);

        if($alumno->level->exp_ac >= $logro->exp_req){
            $alumno->logros()->detach($request->logro_id);
            $alumno->logros()->attach($request->logro_id);
        }else{
            return redirect()->route('alumno.materias.create')->with('alerta','No cuenta con puntos suficientes para asignar este logro');
        }

        return redirect()->route('alumno.materias.create')->with('mensaje','Logro desbloqueado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show(Materia $materia)
    {
        /*--METODO AUTORIZADOR DE MATERIAS POR ALUMNO-- */
        $this->authorize("metodo_autorizador_materias_alumno", $materia);
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
