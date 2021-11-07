@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Menu de Grados </h1>
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

        {!! Form::open(['method' => 'POST', 'route' => 'admin.mensajes.store']) !!}

        <div class="form-group">
            <div class="form-group">
                {!! Form::label('mensaje', 'Mensaje') !!}
                {!! Form::text('mensaje', null, ["class"=>"form-control", "placeholder" => "Ingrese un nuevo mensaje"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('color', 'Color') !!}
                <br><input type="color" name="color">
            </div>
        </div>


        {!! Form::submit('Crear', ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

