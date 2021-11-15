@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Creacion de Actividades</h1>
@stop

@section('content')
    <p>Recuerda que los puntajes sumen un valor de 20pts</p>

    <div class="card">


        <div style="display: block" class="card-header">

            @if (count($errors) > 0)
            <div class="text-danger">

                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach

            </div>

            @if (session('error'))
                <div  class="alert alert-warning">
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif

            <a class="button is-info" href="{{ route('admin.tareas.show', $tarea) }}"> Volver a tu Tarea</a>


        </div>

        <div class="card-body">

            <div id="jsonDiv">

            </div>

            {!! Form::open(['method' => 'POST', 'route' => 'admin.actividades.store', 'id' => 'FormFinal']) !!}
                {!! Form::hidden('hiden_json', '', ['id' => 'hiden_json']) !!}
                {!! Form::hidden('tarea_id', $tarea->id) !!}
            {!! Form::close() !!}


            <form action="" id="frmActividad" class="m-3">
                <label class="label">Crear Actividad</label>

                <div class="columns">
                    <div class="column">
                        {!! Form::text('descripcion', null, ['placeholder' => 'Ingrese la descripcion', 'autocomplete' => 'off', 'class' => 'form-control']) !!}
                    </div>

                </div>
                <div class="columns">

                    <div class="column">
                        <input class="form-control" required class="input" name="recurso" type="text"
                            placeholder="Recurso (opcional)" autocomplete="off">
                    </div>


                </div>

                    <div class="columns">
                        <div class="column">
                            <input class="form-control" required class="input" name="puntaje_max" type="text"
                                placeholder="Puntaje maximo (1 al 10)" autocomplete="off">
                        </div>
                        <div class="column">
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
