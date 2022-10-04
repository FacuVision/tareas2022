<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actividad;
use App\Models\Carpeta;
use App\Models\Docente;
use App\Models\Level;
use App\Models\Respuesta;
use App\Models\Tarea;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevisionController extends Controller
{

    public function __construct() {
        $this->middleware('can:admin.revisiones.index')->only('index');
        $this->middleware('can:admin.revisiones.edit')->only(['edit','update','store']);
        $this->middleware('can:admin.revisiones.show')->only('show');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $docente = Docente::findOrFail(Auth::user()->id);
        $materia = $docente->materias->pluck('nombre','id');

        return view("admin.revisiones.index", compact('materia', 'docente'));
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
        $carpetas = Carpeta::where("materia_id",$request->materia_id)
                            ->where("seccion_id",$request->seccion_id)
                            ->where("user_id",Auth::user()->id)
                            ->where("estado","$request->estado")
                            ->where("fecha_inicio","like","%$request->periodo%")
                            ->get();

        //return $carpetas;

        return view("admin.revisiones.create", compact("carpetas"));

        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carpeta = Carpeta::FindOrfail($id);
        //MUESTRA LAS TAREAS RELACIONADAS CON EL ID DE LA CARPETA Y ADEMAS QUE ESTEN ACTIVAS (IMPORTANTE)
        $this->authorize("metodo_autorizador_carpetas", $carpeta);

        $tareas = Tarea::where("carpeta_id",$id)->get();
        return view("admin.revisiones.show", compact("tareas"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // id de la tarea
    {
        //REVISION DE LAS TAREAS DE LOS ESTUDIANTES POR PARTE DEL PROFESOR

        $tarea = Tarea::findOrFail($id);
        $this->authorize("update", $tarea); // METODO AUTORIZADOR DE VISUALIZACION DE LAS TAREAS RESPONDIDAS POR LOS ALUMNOS

        $tareas_alumnos = $tarea->alumnos;
        $seccion = $tarea->carpeta->seccion;

        return view("admin.revisiones.edit",compact("tareas_alumnos","seccion","tarea"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tarea_id)
    {
        $tipo = Tarea::findOrFail($tarea_id);

        $inputs_final = explode("_", $request->id_respuestas);


        $notal_final=0;

        foreach ($inputs_final as $input) {

            $puntaje_en_orden = $request->input("puntaje_".$input); //puntaje_100 = 10 ,puntaje_20 = 5

            $respuesta = Respuesta::FindOrFail($input);

            $respuesta->update([
                "puntaje"=> $puntaje_en_orden
            ]);

            $notal_final = $notal_final + $puntaje_en_orden;
        }

        $tarea_exp = $notal_final;
        if($tipo->tipo == 1){
            $tarea_exp = $tarea_exp * 5;
        }
        $est = $tipo->alumnos->where('user_id',$request->id_usuario)->first();

          if ($est->pivot->estado != 2) {

            $userlvl = Level::where('user_id',$request->id_usuario)->first();
            $exp_ac= $userlvl->exp_ac+$tarea_exp;
            $limite = ( $userlvl->level * 100 );
            if($limite > ($userlvl->exp + $tarea_exp)){
                $exp = $userlvl->exp + $tarea_exp;
                $lvl = $userlvl->level;
            }elseif($limite == ($userlvl->exp + $tarea_exp)){
                $lvl = $userlvl->level +1;
                $exp = 0;
            }else{
                $sobra = ($userlvl->exp + $tarea_exp) - $limite;
                $lvl = $userlvl->level +1;
                $exp = $sobra;
            }
            $userlvl->update([
                'level' => $lvl,
                'exp' => $exp,
                'exp_ac' => $exp_ac,
            ]);

            $respuesta->alumno->tareas()->updateExistingPivot($tarea_id,["nota_final"=>$notal_final,"estado"=>"2"]);
          }

        $tarea = Tarea::findOrFail($tarea_id);
        $tareas_alumnos = Tarea::findOrFail($tarea_id)->alumnos;
        $seccion = Tarea::findOrFail($tarea_id)->carpeta->seccion;

        return view("admin.revisiones.edit",compact("tareas_alumnos","seccion","tarea"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
