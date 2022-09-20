@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de calificacion de tareas escolares </h1>
    <strong>Recuerda que una vez calificado la nota no podrá cambiarse</strong>
@stop

@section('content')


    <div class="card">

            <div class="card-body">

                {!! Form::open(['method' => 'POST', 'route' => ['admin.revisiones.update', $tarea_id], 'method' => 'PUT']) !!}

                    @php
                        $cont = 1;
                        $contRpta = 0;
                    @endphp

                    {{-- {{$respuestas_alumno}} --}}
                    @foreach ($actividades as $actividad)

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-9">
                                         <strong>{{ $cont }}) {{$actividad->descripcion}}</strong>
                                    </div>
                                    <div class="col-2">
                                        <strong>
                                            Tipo:
                                        @switch($actividad->tipo)
                                            @case(0)
                                                <span class="text-secondary">Pregunta corta</span>
                                                @break
                                            @case(1)
                                                <span class="text-secondary">Pregunta larga</span>
                                                @break
                                            @case(2)
                                                <span class="text-danger">Link de Youtube</span>
                                                @break
                                            @case(3)
                                                <span class="text-primary">Carpeta de Drive</span>
                                                @break
                                        @endswitch

                                    </strong>
                                    </div>
                                    <div class="col-1">
                                        <strong> Ptje. max: {{$actividad->puntaje_max}}</strong>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-10">
                                        @if ($actividad->tipo==1 || $actividad->tipo==2)
                                            <textarea  disabled name="respuesta" class="form-control" cols="30" rows="3">{{$respuestas_alumno[$actividad->id][0]}}</textarea>
                                        @else
                                            <input name="respuesta" type="text" class="form-control" disabled value="{{$respuestas_alumno[$actividad->id][0]}}">
                                        @endif

                                    </div>
                                    <div class="col-2">
                                        <input  required name="puntaje_{{$id_respuestas[$contRpta]}}" placeholder="Puntaje a colocar..." min="0" max="{{$actividad->puntaje_max}}"  step="0.5" type="number" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">

                                @if ($actividad->tipo==3)
                                <strong> Carpeta de Drive:</strong>

                                <a href="{{$actividad->recurso}}" target="_blank" class="text-primary" style="display: inline-block; margin: 10px 20px">
                                    <div class="pb-6 block">
                                        <i class="text-center fab fa-google-drive fa-2x"></i>
                                        Abrir en drive
                                    </div>
                                </a>
                                @endif

                                @if ($actividad->tipo==2)
                                <strong> Link de Youtube:</strong>

                                <a href="{{$actividad->recurso}}" target="_blank" class="text-danger" style="display: inline-block; margin: 10px 20px">
                                    <div class="pb-6 block">
                                        <i class="text-center fab fa-youtube fa-2x"></i>
                                        Abrir en YouTube
                                    </div>
                                </a>
                                @endif

                            </div>
                        </div>
                        @php
                            $cont++;
                            $contRpta++;
                        @endphp


                    @endforeach

                    <input type="hidden" name="id_respuestas" value="@php echo implode("_",$id_respuestas) @endphp">
                    <input type="hidden" name="id_usuario" value="{{$user_id}}">
            </div>

            <div class="card-footer">
                {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
                {!! Form::submit("calificar", ["class"=>"btn btn-success"]) !!}
            </div>

            {!! Form::close() !!}
        </div>


    @stop
