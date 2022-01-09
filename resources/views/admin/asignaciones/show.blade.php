@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignacion de logros</h1>
@stop

@section('content')
    <p>Se observan todos los logros del alumno</p>

    <div class="card">
        <div class="card-header">

            @isset($mensaje)
                <div class="alert alert-danger">
                    <strong>{{ $mensaje }}</strong>
                </div>
            @endisset

            @can('admin.revisiones.edit')
                <a class="btn btn-secondary" href="{{ route('admin.revisiones.edit', $tarea_id) }}"> Volver a Calificaciones</a>
            @endcan
        </div>

        <div class="card-body">

            @if ($logros->isEmpty())
                <div class="alert alert-light">
                    <strong>El alumno no tiene ningun logro asignado ... </strong>
                </div>

            @else


                <div class="container">
                    <div class="row">


                        @foreach ($logros as $logro)
                            <div class="col-md-4 col-sm-6">

                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{ Storage::url($logro->image->url) }}"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $logro->nombre }}</h5>
                                        <p class="card-text">{{ $logro->descripcion }}</p>

                                        @can('admin.asignaciones.destroy')

                                        <form class="text-center"
                                            action="{{ route('admin.asignaciones.destroy', $alumno->user_id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            {!! Form::hidden('logro_id', $logro->id) !!}
                                            {!! Form::hidden('tarea_id', $tarea_id) !!}
                                            <input type="submit" id="delete" value="Eliminar" class="btn btn-danger"
                                                style="margin: 0px 0px 0px 5px;">
                                        </form>

                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif


        </div>

        @can('admin.asignaciones.edit')
        <div class="card-footer">
            <a class="btn btn-success" href="{{ route('admin.asignaciones.edit', $alumno->user_id . '-' . $tarea_id) }}">
                Asignar un nuevo Logro</a>
        </div>

        @endcan

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
