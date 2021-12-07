<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public $dist = ["Villa Maria del Triunfo"=>"Villa Maria del Triunfo",
                    "Villa el Salvador"=>"Villa el Salvador",
                    "Lurin"=>"Lurin",
                    "San Juan de Miraflores"=>"San Juan de Miraflores",
                    "Pachacamac"=>"Pachacamac"];

    public $sexo =["m" => "Masculino","f"=>"Femenino"];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','DESC')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dist = $this->dist;
        $sexo = $this->sexo;
        return view('admin.users.create', compact('dist','sexo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // echo '<pre>' , var_export($request->all(),true) , '</pre>';
        // die();
        $request->validate([
            "email" =>"required|string|email|max:100|unique:users",
            "password" =>"required|string",
            "nombre" =>"required|string",
            "apellido" =>"required|string",
            "fecha" =>"required",
            "dni" =>"required|string|max:8",
            "edad" =>"required|string|max:2",
            "sexo" =>"required|string",
            "direccion" =>"required|max:100",
            "distrito" => "required|string",
        ]);

        $admin = User::create([
            "name" => $request->nombre,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        $admin->perfil()->create(
            [
                "nombre" => $request->nombre,
                "apellido" => $request->apellido,
                "DNI" => $request->dni,
                "fecha_nac" => $request->fecha,
                "edad" => $request->edad,
                "sexo" => $request->sexo,
                "direccion" => $request->direccion,
                "distrito" => $request->distrito
            ]
        );
        return redirect()->route('admin.users.index')->with('mensaje','Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $dist = $this->dist;
        $sexo = $this->sexo;
        return view('admin.users.edit', compact('user','dist','sexo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $sin = [
                "email" =>"required|string|email|max:100",
                "nombre" =>"required|string",
                "apellido" =>"required|string",
                "fecha" =>"required",
                "dni" =>"required|string|max:8",
                "edad" =>"required|string|max:2",
                "sexo" =>"required|string",
                "direccion" =>"required|max:100",
                "distrito" => "required|string"
                ];
        $con = [
                "email" =>"required|string|email|max:100",
                "password" =>"required|string",
                "nombre" =>"required|string",
                "apellido" =>"required|string",
                "fecha" =>"required",
                "dni" =>"required|string|max:8",
                "edad" =>"required|string|max:2",
                "sexo" =>"required|string",
                "direccion" =>"required|max:100",
                "distrito" => "required|string",
                ];

                $con_correo = [
                    "email" =>"required|string|email|max:100|unique:users",
                    "nombre" =>"required|string",
                    "apellido" =>"required|string",
                    "fecha" =>"required",
                    "dni" =>"required|string|max:8",
                    "edad" =>"required|string|max:2",
                    "sexo" =>"required|string",
                    "direccion" =>"required|max:100",
                    "distrito" => "required|string",
                    ];


            if ($user->email == $request->email) {
                if($request->password == "")
                {
                    //validacion sin password, ya que no se presentaron cambios en la contraseña
                    $request->validate($sin);
                    //actualiza solo modelo user
                    $user->update(['name'=>$request->nombre,'email'=>$request->email]);
                }else
                {
                    //validacion con cambios realizados en la contraseña
                    $request->validate($con);
                    //Actualiza solo modelo user
                    $user->update(['name'=>$request->nombre,'email'=>$request->email,'password' => bcrypt($request->password)]);
                }
            } else{
                $request->validate($con_correo);
            }


            //actualiza solo el modelo profile
            $user->perfil->update($request->only("nombre","apellido","DNI","fecha_nac","edad","sexo","direccion","distrito"));

            return redirect()->route('admin.users.edit',$user)->with('mensaje','El usuario ha sido modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('mensaje', 'Usuario eliminado correctamente');
    }
}
