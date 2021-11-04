@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Menu de Usuarios </h1>
@stop

@section('content')
<div class="card">

    <div class="card-header">
        @if (session('mensaje'))
        <div class="alert alert-danger">
            <strong>{{session('mensaje')}}</strong>
        </div>
        @endif
    </div>

    <div class="card-body">
        <table id="usuario" class="table table-sm table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha_Nac</th>
                    <th>DNI</th>
                    <th>Sexo</th>
                    <th>Dirección</th>
                    <th>Distrito</th>
                    <th style="width:20px;text-align:center">Acciones</th>
                </tr>
            </thead>
            <tbody>


                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->perfil->nombre}}</td>
                    <td>{{$user->perfil->apellido}}</td>
                    <td>{{date('d/m/Y ', strtotime($user->perfil->fecha_nac))}}</td>
                    <td>{{$user->perfil->DNI}}</td>
                    <td>
                        @if ($user->perfil->sexo == 'm')
                        Masculino
                        @else
                        Femenino
                        @endif
                    </td>
                    <td>{{$user->perfil->direccion}}</td>
                    <td>{{$user->perfil->distrito}}</td>
                    <td style="display: flex">
                        {{-- Editar --}}

                        <a href="{{route('admin.users.edit', $user)}}" class="btn btn-success">Editar</a>

                        {{-- Eliminar --}}

                        <form action="{{route('admin.users.destroy', $user)}}" method="post" class="formulario-eliminar">
                            @csrf
                            @method('DELETE')
                            <input type="submit" id="delete" value="Eliminar" class="btn btn-danger" style="margin: 0px 0px 0px 5px;">
                        </form>
</td>
                </tr>


            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.users.index') }}" class="btn btn-warning"> Volver </a>
    </div>

</div>
@stop
