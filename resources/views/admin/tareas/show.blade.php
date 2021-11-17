@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tarea {{ $tarea->titulo }}</h1>
@stop

@section('content')
    <p>Aqui podras añadir, eliminar y ver las actividades que esten dentro de tu tarea</p>

    {{-- TAREAS DE MI CARPETA --}}


    <div class="card">
        <div class="card-header">

        @if (session('mensaje'))
            <div class="alert alert-success">
                <strong>{{ session('mensaje') }}</strong>
            </div>
        @endif
        @if (session('error'))
        <div class="alert alert-warning">
            <strong>{{ session('error') }}</strong>
        </div>
    @endif

            <a href="{{ route('admin.carpetas.show', $carpeta) }}" class="btn btn-primary">Volver a tu Carpeta</a>
        </div>

        <div class="card-body">



            {{-- MI TAREA - INFORMACION -------------------------------------------------------------------- --}}
            <div class="card" style="width: 18rem; display:inline-block; margin: 0px 10px">

                @if ($tarea->estado == 0)
                    <div class="card-header bg bg-secondary"> <strong>Tu tarea esta en borrador </strong></div>
                @else
                    <div class="card-header bg bg-success"> <strong>Tu tarea esta publicada </strong></div>
                @endif

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Titulo</strong><br>{{ $tarea->titulo }}</li>
                    <li class="list-group-item"><strong>Descripcion</strong><br>{{ $tarea->descripcion }}</li>
                </ul>
            </div>

        </div>

        <div class="card-footer">
            <a href="{{ route('admin.tareas.edit', $tarea) }}" class="btn btn-success">Editar esta tarea</a>

            <form style="display: inline-block;" action="{{ route('admin.tareas.destroy', $tarea) }}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" id="delete" value="Eliminar esta tarea" class="btn btn-danger"
                    style="margin: 0px 0px 0px 5px;">
            </form>

        </div>

    </div>


    @if ($tarea->actividades->isEmpty())
        <div class="card">
            <a href="{{ route('admin.actividades.show', $tarea) }}" class="btn btn-warning"><strong> Ir al menu de creacion
                    de actividades</strong></a>
        </div>
    @endif

    <div class="card">
        <div class="card-header">

            @if (session('mensaje_act'))
                <div class="alert alert-success">
                    <strong>{{ session('mensaje_act') }}</strong>
                </div>
            @endif

            <h3>Tus Actividades</h3>
            <br>
        </div>

        <div class="card-body">

            <table id="actividades" class="table table-sm table-striped " style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Puntaje Max</th>
                        <th>Recurso</th>

                        <th style="width:20px;text-align:center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tarea->actividades as $actividad)
                        <tr>
                            <td>{{ $actividad->id }}</td>
                            <td>{{ $actividad->descripcion }}</td>
                            <td>{{ $actividad->puntaje_max }}</td>


                            @if ($tarea->recurso != ' ')
                                <td><strong class="text text-success">Recurso</strong></td>
                            @else
                                <td><strong class="text text-secondary">Sin recurso</strong></td>
                            @endif

                            <td style="display: flex">

                                {{-- Editar --}}

                                <a href="{{ route('admin.actividades.edit', $actividad) }}"
                                    class="btn btn-success">Editar</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        @if (!$tarea->actividades->isEmpty())
            <div class="card-header">
                <form action="{{ route('admin.actividades.destroy', $tarea) }}" method="post" class="formulario-eliminar">
                    @csrf
                    @method('DELETE')
                    <input type="submit" id="delete" value="Eliminar todas las actividades" class="btn btn-danger" style="margin: 0px 0px 0px 5px;">
                </form>
            </div>

        @endif

    </div>



@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
