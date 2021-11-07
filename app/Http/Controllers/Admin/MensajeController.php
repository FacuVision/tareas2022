<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mensaje;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mensajes = Mensaje::orderBy('id', 'DESC')->get();
        return view("admin.mensajes.index",compact('mensajes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("admin.mensajes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validaciones = [
            "mensaje" =>"required|string|unique:mensajes|max:100",
            "color" =>"required",
            ];


        $request->validate($validaciones);
        $mensaje = Mensaje::create($request->all());

        return redirect()->route('admin.mensajes.edit',$mensaje)->with('mensaje','El mensaje ha sido creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function show(Mensaje $mensaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensaje $mensaje)
    {
        return view('admin.mensajes.edit', compact('mensaje'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mensaje $mensaje)
    {

        $validaciones = [
            "mensaje" =>"required|string|unique:mensajes|max:100",
            "color" =>"required",
            ];

        $validacionesColor = [
                "mensaje" =>"required|string|max:100",
                "color" =>"required",
        ];

        if ($mensaje->mensaje == $request->mensaje) {
            $request->validate($validacionesColor);

        } else{
            $request->validate($validaciones);
        }

        $mensaje->update($request->all());

        return redirect()->route('admin.mensajes.edit',$mensaje)->with('mensaje','El mensaje ha sido modificado correctamente');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensaje $mensaje)
    {
        return redirect()->route('admin.mensajes.index')->with('mensaje','El mensaje ha sido eliminado correctamente');

    }
}
