@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Menu de Usuarios </h1>
@stop

@section('content')
<div class="card">
    @if (session('mensaje'))
    <div class="alert alert-success">
        <strong>{{session('mensaje')}}</strong>
    </div>
    @endif
        <div class="card-header">
            <a href="{{route('admin.users.create')}}" class="btn btn-primary"> Crear Usuario</a>
        </div>


    <div class="card-body">
        <table id="usuario" class="table table-sm table-striped " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha de Creación</th>
                    <th style="width:20px;text-align:center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{date('d/m/Y H:m:s', strtotime($user->created_at))}}</td>
                    <td  style="display: flex">
                        {{--Mostrar--}}

                        <a style="margin: 0px 5px" href="{{route('admin.users.show', $user)}}" class="btn btn-primary">Ver</a>

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
                @endforeach

            </tbody>
        </table>
    </div>

</div>
@stop
