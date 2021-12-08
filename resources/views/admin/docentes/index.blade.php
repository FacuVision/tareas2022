@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Docentes </h1>
@stop

@section('content')
    <div class="card">

        @if (session('mensaje'))
            <div class="alert alert-success">
                <strong>{{ session('mensaje') }}</strong>
            </div>
        @endif
        @if (session('alerta'))
            <div class="alert alert-warning">
                <strong>{{ session('alerta') }}</strong>
            </div>
        @endif

        <div class="card-header">
            <a href="{{ route('admin.docentes.create') }}" class="btn btn-primary"> Crear un Docente</a>
        </div>

        <div class="card-body">
            <table id="seccion" class="table table-sm table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Correo</th>
                        {{-- <th>Grado</th>
                        <th>Seccion</th> --}}
                        <th style="width:20px;text-align:center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docentes as $docente)
                        <tr>

                            <td>{{$docente->user_id}}</td>
                            <td>{{$docente->user->perfil->nombre}}</td>
                            <td>{{$docente->user->perfil->apellido}}</td>
                            <td>{{$docente->user->perfil->DNI}}</td>
                            <td>{{$docente->user->email}}</td>
                            {{-- <td></td>
                            <td></td> --}}
                            <td style="display: flex">

                                {{-- Ver --}}

                                <a href="{{ route('admin.users.show', $docente->user) }}" style="margin: 0px 5px;"class="btn btn-primary">Ver</a>

                                {{-- Editar --}}

                                <a href="{{ route('admin.docentes.edit', $docente) }}" class="btn btn-success">Asignar</a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@stop
