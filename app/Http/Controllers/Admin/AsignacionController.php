<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Logro;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AsignacionController extends Controller
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
        $alumno = Alumno::findOrFail($request->alumno_id);
        $logros = Logro::all();

        $tarea_id = $request->tarea_id;


        $alumno->logros()->detach($request->logro_id);
        $alumno->logros()->attach($request->logro_id);
        $mensaje = "El logro ha sido asignado correctamente";

        // foreach ($alumno->logros as $logro) {
        //     if ($request->logro_id == $logro->pivot->logro_id) {
        //         $mensaje = "El logro ya ha sido asignado, elegir otro";
        //     } else{
        //     }
        // }

        return view("admin.asignaciones.edit",compact("logros","alumno","mensaje","tarea_id"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id) // alumno_id
    {
        $array_nuevo = explode("-", $user_id);

        $user_id = $array_nuevo[0];
        $tarea_id = $array_nuevo[1];

        $this->authorize("update", Tarea::findOrfail($tarea_id)); //metodo autorizador

        $logros = Alumno::findOrFail($user_id)->logros;
        $alumno = Alumno::findOrFail($user_id);

        return view("admin.asignaciones.show", compact("logros", "alumno", "tarea_id"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_tarea) // alumno_id
    {

        $array_nuevo = explode("-", $user_tarea);

        $user_id = $array_nuevo[0];
        $tarea_id = $array_nuevo[1];

        $this->authorize("update", Tarea::findOrfail($tarea_id));

        $logros = Logro::all();
        $alumno = Alumno::findOrFail($user_id);


        return view("admin.asignaciones.edit",compact("logros","alumno","tarea_id"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) //id_alumno
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->logros()->detach($request->logro_id);

        $logros = $alumno->logros;
        $tarea_id = $request->tarea_id;

        $mensaje = "Logro eliminado del alumno correctamente";

        return view("admin.asignaciones.show", compact("logros", "alumno", "mensaje","tarea_id"));
    }
}
