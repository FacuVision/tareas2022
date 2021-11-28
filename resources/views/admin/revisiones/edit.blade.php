@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Revision de Tareas de {{ $seccion->grado->grado }}  {{ $seccion->grado->nivel }} - {{ $seccion->nombre}}</h1>
@stop

@section('content')
    <div class="card">


        <div class="card-header">


             {{-- TAREA DEL DOCENTE --}}
             <div class="card" style="width:auto; display:inline-block; margin: 0px 10px">
                <div class="card-header bg bg-info">
                    <strong>Titulo : {{ $tarea->titulo }}</strong>
                </div>
                <ul class="list-group list-group-flush">
                        <li class="list-group-item"> <strong> Descripcion : </strong> {{ $tarea->descripcion }}</li>
                </ul>
            </div>
        </div>


        <div class="card-body">

            <a class="btn btn-secondary" href="{{ route('admin.revisiones.show', $tarea->carpeta->id) }}"> Volver a Tareas </a>

            <table id="respuestas" class="table table-sm table-striped" style="margin: 20px 0px" style="width:100%" >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre Alumno</th>
                        <th>Apellido Alumno</th>
                        <th>DNI N°</th>
                        <th>Nota</th>
                        <th>Estado</th>
                        <th style="width:15%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tareas_alumnos as $tarea_alumno)
                        <tr>
                            <td>{{ $tarea_alumno->user_id }}</td>
                            <td>{{ $tarea_alumno->user->perfil->nombre }}</td>
                            <td>{{ $tarea_alumno->user->perfil->apellido }}</td>
                            <td>{{ $tarea_alumno->user->perfil->DNI }}</td>

                            <td>
                            @if ($tarea_alumno->pivot->nota_final == null)
                                <span class="badge badge-secondary">Sin Nota</span>
                            @else
                                <span class="badge badge-light">{{ $tarea_alumno->pivot->nota_final }}</span>
                            @endif
                            </td>
                            <td>
                            @switch($tarea_alumno->pivot->estado)
                                @case(0)
                                    <span class="badge badge-danger">Sin Responder</span>
                                @break

                                @case(1)
                                    <span class="badge badge-success">Respondido</span>
                                @break

                                @case(2)
                                    <span class="badge badge-primary">Calificado</span>
                                @break
                            @endswitch
                            </td>


                            <td>

                            @switch($tarea_alumno->pivot->estado)

                                @case(1)
                                    <a href="{{ route('admin.revisar_tareas.edit', $tarea_alumno->pivot->tarea_id ."-".$tarea_alumno->pivot->user_id)}}" class="btn btn-primary">Calificar</a>
                                @break

                            @endswitch

                                <a href="" class="btn btn-success">Asignar Logro</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop


