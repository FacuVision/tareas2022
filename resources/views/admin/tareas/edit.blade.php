@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de edicion de carpetas </h1>
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
                <div class="alert alert-warning">
                    <strong>{{ session('mensaje') }}</strong>
                </div>
            @endif

        </div>
        <div class="card-body">

            {!! Form::model($tarea, ['route' => ['admin.tareas.update', $tarea], 'method' => 'PUT']) !!}

            <div class="form-group">

                <div class="form-group">
                    {!! Form::label('titulo', 'Titulo') !!}
                    {!! Form::text('titulo', null, ['required' => true, 'placeholder' => 'Ingrese un titulo...', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('descripcion', 'Descripcion') !!}
                    {!! Form::textarea('descripcion', null, ['rows' => 5, 'required' => true, 'placeholder' => 'Ingrese una descripcion...', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('estado', 'Estado') !!}
                    {!! Form::select('estado', $estados, $tarea->estado, ['required' => true,  'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    <a  class="btn btn-secondary" href="{{ route('admin.tareas.show', $tarea) }}"> Volver </a>
                    {!! Form::submit('Actualizar', ['class' => 'btn btn-success']) !!}
                </div>

                {!! Form::close() !!}

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
