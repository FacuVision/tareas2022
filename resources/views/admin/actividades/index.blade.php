@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Actividad</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">

            @if (count($errors) > 0)
                <div class="text-danger">

                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach

                </div>
            @endif

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

        </div>
        <div class="card-body">

            {!! Form::model($actividad, ['route' => ['admin.actividades.update', $actividad], 'method' => 'PUT']) !!}

            <div class="form-group">

                <div class="form-group">
                    {!! Form::label('descripcion', 'Descripcion') !!}
                    {!! Form::text('descripcion', $actividad->descripcion, ['required' => true, 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('recurso', 'Recurso (opcional)') !!}
                    {!! Form::text('recurso', $actividad->recurso, ['class' => 'form-control']) !!}
                </div>


                <div class="form-group">
                    {!! Form::label('tipo', 'Tipo') !!}
                    {!! Form::select('tipo', $tipos, $actividad->tipo, ['required' => true,  'class' => 'form-control']) !!}
                </div>


                <div class="form-group">
                    <a class="btn btn-secondary" href="{{ route('admin.tareas.show', $actividad->tarea) }}">Volver</a>
                    {!! Form::submit('Actualizar', ['class' => 'btn btn-success']) !!}
                </div>

                {!! Form::close() !!}

            </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
