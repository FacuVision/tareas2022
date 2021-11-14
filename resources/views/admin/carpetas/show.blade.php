@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Carpeta {{ $carpeta->titulo }}</h1>
@stop

@section('content')
    <p>Aqui podras añadir, eliminar y ver las tareas que esten dentro de tu carpeta</p>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.carpetas.index') }}" class="btn btn-primary">Volver a tus Carpetas</a>
        </div>

        <div class="card-body">



            {{-- MI CARPETA - INFORMACION ----------------------------------------------------------------------}}
            <div class="card" style="width: 18rem; display:inline-block; margin: 0px 10px">

                @if ($carpeta->estado == 0)
                    <div class="card-header bg bg-secondary"> <strong>Tu Carpeta esta Inactiva </strong></div>
                @else
                    <div class="card-header bg bg-success"> <strong>Tu Carpeta esta Activa </strong></div>
                @endif

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Titulo</strong><br>{{ $carpeta->titulo }}</li>
                    <li class="list-group-item"><strong>Descripcion</strong><br>{{ $carpeta->descripcion }}</li>
                    <li class="list-group-item"><strong>N° Sesion</strong><br>{{ $carpeta->sesion }}</li>
                    <li class="list-group-item"><strong>Materia</strong><br>{{ $carpeta->materia->nombre }}</li>
                </ul>
            </div>

            <div class="card" style="width: 18rem; display:inline-block; margin: 0px 10px">

                @if ($carpeta->estado == 0)
                    <div class="card-header bg bg-secondary"><br></div>
                @else
                    <div class="card-header bg bg-success"><br></div>
                @endif

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Fecha Inicio</strong><br>{{ $carpeta->fecha_inicio }}</li>
                    <li class="list-group-item"><strong>Fecha Fin</strong><br>{{ $carpeta->fecha_final }}</li>
                    <li class="list-group-item"><strong>Grado</strong><br>{{ $carpeta->seccion->grado->grado }} DE
                        {{ $carpeta->seccion->grado->nivel }}</li>
                    <li class="list-group-item"><strong>Seccion</strong><br>{{ $carpeta->seccion->nombre }}</li>
                </ul>
            </div>
        </div>

        <div class="card-footer">

            <a href="{{ route('admin.carpetas.edit', $carpeta) }}" class="btn btn-success">Editar esta carpeta</a>

            <form style="display: inline-block;" action="{{ route('admin.carpetas.destroy', $carpeta)}}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" id="delete" value="Eliminar esta carpeta" class="btn btn-danger" style="margin: 0px 0px 0px 5px;">
            </form>

        </div>
    </div>
    {{-- MI CARPETA - INFORMACION ----------------------------------------------------------------------}}







    {{-- TAREAS DE MI CARPETA --}}

    <div class="card">
        <div class="card-header">

            @if (session('mensaje'))
                <div class="alert alert-success">
                    <strong>{{ session('mensaje') }}</strong>
                </div>
            @endif

            <h3>Tus Tareas</h3>
            <br>
            <a href="{{ route('admin.crear_tareas.show', $carpeta) }}" class="btn btn-warning"> Añadir una nueva tarea</a>
        </div>


        <div class="card-body">

            <table id="carpetas" class="table table-sm table-striped " style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Estado</th>
                        <th style="width:20px;text-align:center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carpeta->tareas as $tarea)
                        <tr>
                            <td>{{ $tarea->id }}</td>
                            <td>{{ $tarea->titulo }}</td>
                            @if ($tarea->estado == 1)
                                <td><strong class="text text-success">Publicado</strong></td>
                            @else
                                <td><strong class="text text-secondary">Borrador</strong></td>
                            @endif

                            <td style="display: flex">

                                {{-- Ver --}}

                                <a style="margin: 0px 5px" href="{{ route('admin.tareas.show', $tarea) }}"
                                    class="btn btn-primary">Ver</a>
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
    <script>
        console.log('Hi!');
    </script>
@stop
