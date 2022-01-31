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

            {!! Form::model($carpeta, ['route' => ['admin.carpetas.update', $carpeta], 'method' => 'PUT']) !!}

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
                    {!! Form::label('sesion', 'Sesion') !!}
                    {!! Form::number('sesion', null, ['required' => true, 'class' => 'form-control', 'min' => 1, 'max' => 70]) !!}
                </div> --}}

                <div class="form-group">
                    {!! Form::label('fecha_inicio', 'Fecha Inicio') !!}
                    {!! Form::date('fecha_inicio', $carpeta->fecha_inicio, ['required' => true, 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fecha_final', 'Fecha Final') !!}
                    {!! Form::date('fecha_final', $carpeta->fecha_final, ['required' => true, 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('materia', 'Materia') !!}
                    {!! Form::select('materia_id', $selectmat, $carpeta->materia->materia_id, ['required' => true, 'placeholder' => 'Elija una materia...', 'class' => 'form-control']) !!}

                </div>


                <div class="form-group">
                    {!! Form::label('seccion', 'Seccion') !!}
                    {!! Form::select('seccion_id', $selectsec, $carpeta->seccion->id, ['required' => true, 'placeholder' => 'Elija una seccion...', 'class' => 'form-control']) !!}
                </div>



                <div class="form-group">
                    {!! Form::label('estado', 'Estado') !!}
                    {!! Form::select('estado', ['0' => 'inactivo', '1' => 'activo'], $carpeta->estado, ['class' => 'form-control']) !!}
                </div>

                {!! Form::hidden('user_id', Auth::user()->id) !!}

                <a  class="btn btn-secondary" href="{{ route('admin.carpetas.show', $carpeta) }}"> Volver </a>
                {!! Form::submit('Actualizar', ['class' => 'btn btn-success']) !!}

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
