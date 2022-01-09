<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seccion;
use App\Models\Grado;
use Illuminate\Http\Request;

class SeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $listasec = ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E', 'F' => 'F', 'G' => 'G', 'H' => 'H', 'I' => 'I', 'J' => 'J', 'K' => 'K', 'L' => 'L'];

    public function index()
    {
        $secciones = Seccion::all();
        return view('admin.secciones.index', compact('secciones'));
    }

    public function __construct() {
        $this->middleware('can:admin.secciones.index')->only('index');
        $this->middleware('can:admin.secciones.edit')->only(['edit','update']);
        $this->middleware('can:admin.secciones.create')->only(['create','store']);
        $this->middleware('can:admin.secciones.destroy')->only('destroy');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectsec = $this->listasec;
        $grado = Grado::all();
        $selectgr = [];
        foreach ($grado as $gr) {
            $selectgr[$gr['id']] = $gr['grado'] . " DE " . $gr['nivel'];
        }
        return view('admin.secciones.create', compact('selectsec', 'selectgr'));
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
            'nombre' => 'required|string',
            'grado_id' => 'required|string'
        ]);

        $lista = Seccion::where('nombre', $request->nombre)->pluck('nombre', 'grado_id')->all();

        //Corroboramos que la lista contenga datos
        if (!empty($lista)) {
            //se hace un recorrido a la lista entera
            foreach ($lista as $grid => $nomsec) {
                //se comprueba que no contenga secciones repetidas mediante un IF
                if (($request->nombre == $nomsec) and ($request->grado_id == $grid)) {
                    return redirect()->route('admin.secciones.index')->with('warning', 'Sección ya existente');
                }
            }
        }

        Seccion::create($request->all());
        return redirect()->route('admin.secciones.index')->with('mensaje', 'Sección creada correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function show(Seccion $seccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Seccion $seccione)
    {

        $grado = Grado::all();
        //Select seccion
        $selectsec = $this->listasec;
        //Select grado
        $selectgr = [];
        foreach ($grado as $gr) {
            $selectgr[$gr['id']] = $gr['grado'] . " DE " . $gr['nivel'];
        }
        return view('admin.secciones.edit', compact('seccione', 'selectsec', 'selectgr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seccion $seccione)
    {

        $request->validate([
            'nombre' => 'required|string',
            'grado_id' => 'required|string'
        ]);

        $seccione->update($request->all());
        return redirect()->route('admin.secciones.index')->with('mensaje', 'La sección se modifico correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seccion  $seccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seccion $seccione)
    {
        $seccione->delete();
        return redirect()->route('admin.secciones.index')->with('mensaje', 'Sección eliminado correctamente');
    }
}
