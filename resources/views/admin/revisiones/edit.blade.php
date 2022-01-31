@extends('adminlte::page')

@section('title', 'Revision de Tareas')

@section('content_header')
    <h1>Revision de Tareas de {{ $seccion->grado->grado }}  {{ $seccion->grado->nivel }} - {{ $seccion->nombre}}</h1>
@stop

@section('css')
    @include('admin.partials_datatables.cdn_css_impresion')
@endsection


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

            @can('admin.revisiones.show')

            <a class="btn btn-secondary" style="margin-bottom: 20px" href="{{ route('admin.revisiones.show', $tarea->carpeta->id) }}"> Volver a Tareas </a>
            @endcan

            <table id="tabla" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre Alumno</th>
                        <th>Apellido Alumno</th>
                        <th>DNI N°</th>
                        <th>Correo</th>
                        <th>Nota</th>
                        <th>Estado</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tareas_alumnos as $tarea_alumno)
                        <tr>
                            <td>{{ $tarea_alumno->user_id }}</td>
                            <td>{{ $tarea_alumno->user->perfil->nombre }}</td>
                            <td>{{ $tarea_alumno->user->perfil->apellido }}</td>
                            <td>{{ $tarea_alumno->user->perfil->DNI }}</td>
                            <td>{{ $tarea_alumno->user->email}}</td>

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
                            @can('admin.revisar_tareas.edit')

                                @switch($tarea_alumno->pivot->estado)

                                    @case(1)
                                        <a href="{{ route('admin.revisar_tareas.edit', $tarea_alumno->pivot->tarea_id ."-".$tarea_alumno->pivot->user_id)}}" class="btn btn-primary">Calificar</a>
                                @endswitch
                            @endcan

                            @can('admin.asignaciones.show')
                            <a href="{{ route('admin.asignaciones.show', $tarea_alumno->user_id."-".$tarea_alumno->pivot->tarea_id) }}" class="btn btn-success">Asignar Logro</a>

                            @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop




@section('js')
    @include('admin.partials_datatables.cdn_js_impresion')
@endsection
