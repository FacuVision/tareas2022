<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carpeta;
use App\Models\Docente;
use App\Models\Materia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CarpetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //OBTENEMOS LA INFORMACION DEL DOCENTE LOGUEADO HASTA EL MOMENTO
        $docente = Docente::findOrFail(auth()->user()->id);

        return view("admin.carpetas.index",compact('docente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fecha = Carbon::now();
        $docente = Docente::findOrFail(auth()->user()->id);

        $materias = $docente->materias;
        $secciones = $docente->secciones;

        return view("admin.carpetas.create", compact('fecha', 'materias','secciones', 'docente'));
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
            "sesion"=> "required|integer|min:1|max:70",
            "descripcion" => "required|string|max:200",
            "fecha_inicio"=> "required|date",
            "fecha_final"=> "required|date|after:fecha_inicio",
            "user_id"=> "required",
            "materia_id"=> "required",
            "estado"=> "required|in:0,1",
            "seccion_id"=> "required"
        ]);


        Carpeta::create($request->all());

        return redirect()->route('admin.carpetas.index')->with('mensaje','Carpeta creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carpeta  $carpeta
     * @return \Illuminate\Http\Response
     */
    public function show(Carpeta $carpeta)
    {
        return view("admin.carpetas.show", compact('carpeta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carpeta  $carpeta
     * @return \Illuminate\Http\Response
     */
    public function edit(Carpeta $carpeta)
    {
        $docente = Docente::findOrFail(auth()->user()->id);
        //Array de materias
        $materias = $docente->materias;
        //Array vacio
        $selectmat = [];
        //Recorrido del modelo guardandolo en el array vacio
        foreach($materias as $materia){
            $selectmat[$materia->id] = $materia->nombre;
        }
        //------------------------------------------------------------//
        //Array de secciones
        $secciones = $docente->secciones;
        //Array vacio
        $selectsec = [];
        //Recorrido del modelo guardandolo en el array vacio
        foreach($secciones as $seccion){
            $selectsec[$seccion->id] = $seccion->grado->grado . " DE ". $seccion->grado->nivel . " - " . $seccion->nombre;
        }
        // return view("admin.carpetas.edit", compact('carpeta', 'materias','secciones'));
        return view("admin.carpetas.edit", compact('carpeta', 'selectmat','selectsec'));
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
        $request->validate([
            "titulo" => "required|string|max:200",
            "sesion"=> "required|integer|min:1|max:70",
            "descripcion" => "required|string|max:200",
            "fecha_inicio"=> "required|date",
            "fecha_final"=> "required|date|after:fecha_inicio",
            "user_id"=> "required",
            "materia_id"=> "required",
            "estado"=> "required|in:0,1",
            "seccion_id"=> "required"
        ]);

        // if($request->fecha_final)
        // return $request->fecha_final;

        if ($request->estado == 1) {
            if ($request->fecha_final < Carbon::now()) {
                return redirect()->route('admin.carpetas.edit',$carpeta)->with('mensaje','No puedes activar una carpeta antigua. Verifique las fechas');
            }
        }

        $carpeta->update($request->all());
        return redirect()->route('admin.carpetas.show',$carpeta)->with('mensaje','Carpeta modificada correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carpeta  $carpeta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carpeta $carpeta)
    {
        $carpeta->delete();
        return redirect()->route('admin.carpetas.index',$carpeta)->with('mensaje','Carpeta elminada correctamente');

    }


}
