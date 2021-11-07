@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar un Mensaje</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        @if (session('mensaje'))
            <div class="alert alert-success">
                <strong>{{session('mensaje')}}</strong>
            </div>
        @endif
        @if (count($errors) > 0)
        <div class="text-danger">

                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach

        </div>
        @endif

    </div>
    <div class="card-body">

        {!! Form::model($mensaje, ['route' => ['admin.mensajes.update', $mensaje], 'method' => 'PUT']) !!}
        <div class="form-group">
            <div class="form-group">
                {!! Form::label('mensaje', 'Mensaje') !!}
                {!! Form::text('mensaje', $mensaje->mensaje, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('color', 'Color') !!}
                <br><input type="color" name="color" value="{{$mensaje->color}}">
            </div>
        </div>


        <a href="{{ route('admin.mensajes.index')}}" class ="btn btn-secondary">Volver</a>

        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
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
