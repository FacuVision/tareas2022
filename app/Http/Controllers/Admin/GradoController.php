<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grado;
class GradoController extends Controller
{

    public $gr = ['PRIMERO' => 'PRIMERO','SEGUNDO' =>'SEGUNDO','TERCERO' => 'TERCERO','CUARTO' => 'CUARTO','QUINTO'=> 'QUINTO', 'SEXTO'=> 'SEXTO'];
    public $niv = ['PRIMARIA'=> 'PRIMARIA','SECUNDARIA'=> 'SECUNDARIA'];

    public function __construct() {
        $this->middleware('can:admin.grados.index')->only('index');
        $this->middleware('can:admin.grados.edit')->only(['edit','update']);
        $this->middleware('can:admin.grados.create')->only(['store','create']);
        $this->middleware('can:admin.grados.destroy')->only('destroy');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grados = Grado::all();
        return view('admin.grados.index', compact('grados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gr = $this->gr;
        $niv =$this->niv;
        return view('admin.grados.create', compact('gr','niv'));
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
            'grado' =>'required|string',
            'nivel' =>'required|string'
        ]);

        // echo '<pre>' , var_export($request->all(),true) , '</pre>';
        // die();

        Grado::create($request->all());
        return redirect()->route('admin.grados.index')->with('mensaje','Grado creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Grado $grado)
    {
        $gr = $this->gr;
        $niv =$this->niv;
        return view('admin.grados.edit', compact('grado', 'gr', 'niv'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grado $grado)
    {
        $request->validate([
            "grado" =>'required|string',
            "nivel" => 'required|string'
        ]);
        $grado->update($request->all());
        return redirect()->route('admin.grados.index')->with('mensaje','El grado se modifico correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grado $grado)
    {
        $grado->delete();
        return redirect()->route('admin.grados.index')->with('mensaje','Grado eliminado correctamente');
    }
}
