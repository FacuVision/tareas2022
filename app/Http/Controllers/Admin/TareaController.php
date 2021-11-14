<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carpeta;
use App\Models\Docente;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
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
            "titulo" => "required|string|max:200",
            "descripcion"=> "required",
            "estado"=> "required|in:0,1",
            "carpeta_id"=> "required"
        ]);


        $tarea = Tarea::create($request->all());
        $carpeta = Carpeta::findOrFail($request->carpeta_id);

        return view("admin.tareas.show", compact('tarea','carpeta'))->with('mensaje','tarea creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        $carpeta = $tarea->carpeta;
        return view("admin.tareas.show",compact('tarea','carpeta'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarea $tarea)
    {
        $estados = ["0" => "borrador", "1"=>"publicado"];
        // $carpetas_disponibles =  Auth::user()->docente->carpetas->pluck('titulo','id');

        return view("admin.tareas.edit",compact('tarea','estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {

        $tarea->update($request->all());
        $carpeta = $tarea->carpeta;
        return view("admin.tareas.show",compact('tarea','carpeta'))->with('mensaje', 'Tarea modificada correctamente');
        // return redirect()->route('admin.carpetas.index')->with('mensaje', 'Tarea modificada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        $docente = Docente::findOrFail(auth()->user()->id);

        return redirect()->route('admin.carpetas.index', $docente)->with('mensaje', 'Tarea eliminada correctamente');

    }
}
