<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use App\Models\Materia;
use App\Models\Seccion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class DocenteController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.docentes.index')->only('index');
        $this->middleware('can:admin.docentes.edit')->only(['edit', 'update']);
        $this->middleware('can:admin.docentes.create')->only(['create', 'store']);
        $this->middleware('can:admin.docentes.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes = Docente::all();
        return view('admin.docentes.index', compact('docentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::doesntHave('alumno')->doesntHave('docente')->orderBy("name")->get();
        $secciones = Seccion::all();
        $materias = Materia::all();
        return view('admin.docentes.create', compact('users', 'secciones', 'materias'));
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
            "user_id" => "required",
            "materias" => "required",
            "secciones" => "required",
        ]);

        $user = User::findOrFail($request->user_id);
        if ($user->alumno) {
            return redirect()
                ->route('admin.docentes.index')
                ->with('alerta', 'El usuario ya fue asignado como alumno');
        } elseif ($user->docente) {
            return redirect()
                ->route('admin.docentes.index')
                ->with('alerta', 'El usuario ya fue asignado como docente');
        } else {


//VERIFICAR SI UN USUARIO SE LE ASIGNA UN ROL POR PRIMERA VEZ
            if (count($user->roles) > 0) {
                //lleno
                foreach ($user->roles as $role) {
                    if ($role->id == 1) { // si estamos hablando de un usuario admin si se puede asignar el rol de docente
                        $user->roles()->sync([1,2]);
                    }
                }
            } else {
                //vacio
                $user->roles()->sync(2);
            }

            //die();
            // foreach ($user->roles as $role) {
            //     if ($role->id == 3) { // si en el usuario es un alumno
            //         return redirect()->route('admin.docentes.index')->with('alerta', 'El usuario seleccionado tiene rol alumno, no se puede asignar');
            //     } elseif ($role->id == 1) { // si estamos hablando de un usuario admin si se puede asignar el rol de docente
            //         $user->roles()->sync([1, 2]);
            //     } else { // en caso no sea ni alumno ni admin, es decir no tiene rol aun
            //         $user->roles()->sync(2);
            //     }
            // }
            //return $user->roles;


            //CREACION DE DATOS EXTERNOS AL USUARIO (DOCENTE, SECCIONES Y MATERIAS)
            $user->docente()->create();

            foreach ($request->secciones as $seccion) {
                DB::table("docente_seccion")->insert([
                    "user_id" => $user->id,
                    "seccion_id" => $seccion
                ]);
            }
            foreach ($request->materias as $materia) {
                DB::table("docente_materia")->insert([
                    "user_id" => $user->id,
                    "materia_id" => $materia
                ]);
            }

            return redirect()->route('admin.docentes.index')->with('mensaje', 'El Docente fue creado correctamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(Docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(Docente $docente)
    {
        $secciones = Seccion::all();
        $materias = Materia::all();
        return view('admin.docentes.edit', compact('docente', 'secciones', 'materias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Docente $docente)
    {

        $docente->materias()->sync($request->materias);
        $docente->secciones()->sync($request->secciones);

        return redirect()->route('admin.docentes.index')->with('mensaje', 'El Docente fue asignado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Docente $docente)
    {

        foreach ($docente->user->roles as $role) {
            // si el docente a eliminar era un administrador
            // mantiene el admin y se borra el docente
            if ($role->id == 1) {
                $docente->user->roles()->sync(1);
                break;
            } else {
                $docente->user->roles()->sync(null);
            }
        }

        $docente->delete();


        return redirect()->route('admin.docentes.index')->with('mensaje', 'El Docente fue eliminado correctamente');
    }
}
