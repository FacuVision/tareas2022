<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogroController extends Controller
{

    public $tipoL = [
        0 => 'Basico',
        1 => 'Regular',
        2 => 'Normal',
        3 => 'Bueno',
        4 => 'Muy bueno',
        5 => 'Excelente',
    ];

    public function __construct() {
        $this->middleware('can:admin.logros.index')->only('index');
        $this->middleware('can:admin.logros.edit')->only(['edit','update']);
        $this->middleware('can:admin.logros.create')->only(['create','store']);
        $this->middleware('can:admin.logros.destroy')->only('destroy');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logros = Logro::all();

        return view('admin.logros.index', compact('logros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tipo = $this->tipoL;
        return view('admin.logros.create', compact('tipo'));
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
            'descripcion' => 'required|string',
            'tipo' => 'required|string',
            'file' => 'required|image',
        ]);

        $logro = Logro::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
        ]);


        if ($request->file('file')) {
            $url = Storage::disk('public')->put('_logros', $request->file('file'));
            $logro->image()->create([
                'url' => $url
            ]);
        }

        return redirect()->route('admin.logros.index')->with('mensaje', 'El logro ha sido creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logro  $logro
     * @return \Illuminate\Http\Response
     */
    public function show(Logro $logro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logro  $logro
     * @return \Illuminate\Http\Response
     */
    public function edit(Logro $logro)
    {
        $tipo = $this->tipoL;
        return view('admin.logros.edit', compact('tipo', 'logro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logro  $logro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logro $logro)
    {

        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'tipo' => 'required|string',
        ]);

        $logro->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo
        ]);

        if ($request->file('file')) {
            $urlnueva = Storage::disk('public')->put('_logros', $request->file('file'));

            if ($logro->image) {
                Storage::delete($logro->image->url);
                $logro->image()->update([
                    'url' => $urlnueva
                ]);
            } else {
                $logro->image()->create([
                    'url' => $urlnueva
                ]);
            }
        }
        return redirect()->route('admin.logros.edit', $logro)->with('mensaje','El logro ha sido modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logro  $logro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logro $logro)
    {
        Storage::disk('public')->delete($logro->image->url);
        $logro->delete();

        return redirect()->route('admin.logros.index')->with('mensaje', 'Logro eliminado correctamente');
    }
}
