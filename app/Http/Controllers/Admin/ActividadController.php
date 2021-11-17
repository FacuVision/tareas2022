<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actividad;
use App\Models\Tarea;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            "hiden_json" => "required",
        ]);


        $tarea = Tarea::findOrFail($request->tarea_id);
        $carpeta = $tarea->carpeta;

        $listaActividades = json_decode($request->hiden_json);

        if ($listaActividades==null) {
            return redirect()->route('admin.actividades.show',$tarea)->with('error', 'Las actividades no pueden estar vacias');
        }

        $array = [];

        foreach ($listaActividades as $actividad => $value) {
            $array[$actividad] = $value;
        }

        $sumatotal = 0;

        foreach ($array as $act) {

            $sumatotal = $sumatotal + $act->puntaje_max;
        }

        if($sumatotal != 20){
            return redirect()->route('admin.actividades.show',$tarea)->with('error', 'La suma de los puntajes deben de ser de 20 pts');
        }


        foreach ($array as $act) {

            Actividad::create([
                "descripcion" => $act->descripcion,
                "puntaje_max" => $act->puntaje_max,
                "tipo" => $act->tipo,
                "tarea_id" => $request->tarea_id,
                "recurso" => $act->recurso
            ]);
        }

        return redirect()->route('admin.tareas.show', compact("tarea","carpeta"))->with('mensaje_act', 'Actividades creadas correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $actividad)
    {
        $tarea = $actividad;
        return view("admin.actividades.create", compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit(Actividad $actividad)
    {

        $tipos = ["0"=>"Respuesta corta", "1"=>"Respuesta larga", "2"=>"Link de Video", "3"=>"Link de carpeta de Drive"];

        return view("admin.actividades.index", compact('actividad','tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividad $actividad)
    {
        $tipos = ["0"=>"Respuesta corta", "1"=>"Respuesta larga", "2"=>"Link de Video", "3"=>"Link de carpeta de Drive"];

        $request->validate([
            "descripcion" => "required",
            "tipo" => "required:in:0,1,2,3",
        ]);

        $actividad->update($request->all());

        $tarea = $actividad->tarea;
        $carpeta = $tarea->carpeta;

        return redirect()->route('admin.tareas.show', compact("tarea","carpeta"))->with('mensaje_act', 'Actividad modificada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarea $actividad)
    {


        $tarea = $actividad;
        $carpeta = $tarea->carpeta;
        $tarea->actividades()->delete();


        return redirect()->route('admin.tareas.show', compact("tarea","carpeta"))->with('mensaje_act', 'Actividades eliminadas correctamente');

    }
}
