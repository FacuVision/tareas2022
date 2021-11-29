@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de logros para asignar</h1>
@stop

@section('content')
    <p>Se observan todos los logros disponibles</p>

    <div class="card">
        <div class="card-header">
            @isset($mensaje)
                <div class="alert alert-success">
                    <strong>{{ $mensaje }}</strong>
                </div>
            @endisset



            {{-- DATOS DEL ALUMNO --}}
            <div class="card" style="width: 18rem; display:inline-block; margin: 0px 10px">
                <div class="card-header bg bg-info">
                    <strong>Datos del Alumno</strong>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID :</strong> {{ $alumno->user_id }}</li>
                    <li class="list-group-item"><strong>Nombres :</strong> {{ $alumno->user->perfil->nombre }}</li>
                    <li class="list-group-item"><strong>Apellidos :</strong>{{ $alumno->user->perfil->apellido }}</li>
                </ul>

            </div>


        </div>


        <div class="card-body">

            <a  class="btn btn-secondary" href="{{ route('admin.revisiones.edit', $tarea_id)}}"> Volver a Calificaciones</a>
            <br>
            <hr>

            <table id="logro" class="table table-sm table-striped " style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Tipo</th>
                        <th>Imagen</th>
                        <th style="width:20px;text-align:center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logros as $logro)
                        <tr>
                            <td>{{ $logro->id }}</td>
                            <td>{{ $logro->nombre }}</td>
                            <td>{{ $logro->descripcion }}</td>
                            <td>
                                @switch($logro->tipo)
                                    @case(0)
                                        <span class="badge badge-light">
                                            Basico
                                        </span>
                                    @break
                                    @case(1)
                                        <span class="badge badge-secondary">
                                            Regular
                                        </span>
                                    @break
                                    @case(2)
                                        <span class="badge badge-warning">
                                            Normal
                                        </span>
                                    @break
                                    @case(3)
                                        <span class="badge badge-primary">
                                            Bueno
                                        </span>
                                    @break
                                    @case(4)
                                        <span class="badge badge-success">
                                            Muy bueno
                                        </span>
                                    @break
                                    @case(5)
                                        <span class="badge badge-info">
                                            Excelente
                                        </span>
                                    @break
                                @endswitch
                            </td>
                            <td><img src="{{ Storage::url($logro->image->url) }}" class="rounded img-fluid img-size-64">
                            </td>
                            <td style="display: flex">

                                {{-- 0 = basico
                1 = regular
                2 = normal
                3 = bueno
                4 = muy bueno
                5 = excelente --}}



                                {{-- Asignar --}}

                                <form action="{{ route('admin.asignaciones.store') }}" method="post"
                                    class="formulario-eliminar">
                                    @csrf
                                    {!! Form::hidden('alumno_id', $alumno->user_id) !!}
                                    {!! Form::hidden('logro_id', $logro->id) !!}
                                    {!! Form::hidden('tarea_id', $tarea_id) !!}

                                    <input type="submit" value="Asignar" class="btn btn-info"
                                        style="margin: 0px 0px 0px 5px;">
                                </form>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
