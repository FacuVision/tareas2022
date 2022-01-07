@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Añadir actividades a tu tarea</h1>
@stop

@section('content')
    <p>Este es el menu de creacion de actividades para las tareas (Recuerda que la suma de los puntos debe de ser equivalente a 20)</p>

    <div class="card">


        <div style="display: block" class="card-header">


            @if (session('error'))
                <div  class="alert alert-warning">
                    <strong>{{ session('error') }}</strong>
                </div>

            @endif

            @can('admin.tareas.show')

            <a class="button is-info" href="{{ route('admin.tareas.show', $tarea) }}"> Volver a tu Tarea</a>
            @endcan


        </div>

        <div class="card-body">



            <div id="jsonDiv">

            </div>

            {!! Form::open(['method' => 'POST', 'route' => 'admin.actividades.store', 'id' => 'FormFinal']) !!}
            {!! Form::hidden('hiden_json', '', ['id' => 'hiden_json']) !!}
            {!! Form::hidden('tarea_id', $tarea->id) !!}
            {!! Form::close() !!}


            <form action="" id="frmActividad" class="m-3">
                <label class="label">Descripcion:</label>

                <div class="columns">
                    <div class="column">
                        {!! Form::text('descripcion', null, ['placeholder' => 'Ingrese la descripcion', 'autocomplete' => 'off', 'class' => 'form-control']) !!}
                    </div>

                </div>
                <div class="columns">

                    <div class="column">
                        <label class="label">Recurso (opcional):</label>
                        <input class="form-control" required class="input" name="recurso" type="text"
                            placeholder="Recurso (opcional)" autocomplete="off">
                    </div>


                </div>

                    <div class="columns">
                        <div class="column">
                            <label class="label">Puntaje Maximo:</label>

                            <input class="form-control" required class="input" name="puntaje_max" type="text"
                                placeholder="Puntaje maximo (1 al 10)" autocomplete="off">
                        </div>
                        <div class="column">
                            <label class="label">Tipo de pregunta:</label>

                            <div class="select">
                            <select name="tipo" id="tipo">
                                <option value="0">Pregunta Corta</option>
                                <option value="1">Pregunta Larga</option>
                                <option value="2">Video</option>
                                <option value="3">Subir a carpeta de drive</option>
                            </select>
                        </div>

                        </div>
                        <div class="column">
                            <label class="label">Añadir:</label>

                            <button id="btnAdd" type="button" class="btn btn-success">
                                <span class="icon">
                                    <i class="fas fa-plus"></i>
                                </span>
                            </button>
                        </div>
                        <div class="column">
                            <button id="btnSave" type="button" class="btn btn-warning">
                                Enviar todas las actividades
                            </button>
                        </div>

                    </div>

            </form>
            <hr>

            <div id="divElements">

            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
@stop

@section('js')
    <script src="{{ asset('js/actividad.js') }}"></script>

@stop
