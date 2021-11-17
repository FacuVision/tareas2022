@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de creacion de Tareas </h1>
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

        </div>
        <div class="card-body">

            {!! Form::open(['method' => 'POST', 'route' => 'admin.tareas.store']) !!}

            <div class="form-group">

                <div class="form-group">
                    {!! Form::label('titulo', 'Titulo') !!}
                    {!! Form::text('titulo', null, ['required' => true, 'placeholder' => 'Ingrese un titulo...', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('descripcion', 'Descripcion') !!}
                    {!! Form::textarea('descripcion', null, ['rows' => 5, 'required' => true, 'placeholder' => 'Ingrese una descripcion...', 'class' => 'form-control']) !!}
                </div>

                {{-- <div class="form-group">
                    {!! Form::label('estado', 'Estado') !!}
                    {!! Form::select('estado', $estados, $estados[0], ['required' => true,  'class' => 'form-control']) !!}
                </div> --}}

                {!! Form::hidden("carpeta_id", $carpeta->id) !!}

                <div class="form-group">
                    {!! Form::submit('Crear', ['class' => 'btn btn-success']) !!}
                </div>

                {!! Form::close() !!}

            </div>
        @stop

        @section('css')

            <link rel="stylesheet" href="/css/admin_custom.css">

        @stop

        @section('js')
        @stop
