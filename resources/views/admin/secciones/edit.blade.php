@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Editar Sección </h1>
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
        {!! Form::model($seccione, ['route' => ['admin.secciones.update', $seccione], 'method' => 'PUT']) !!}
        <div class="form-group">
            <div class="form-group">
                {!! Form::label('nombre', 'Sección') !!}
                {!! Form::select('nombre', $selectsec, $seccione->nombre, ['placeholder' => 'Elija una seccion...', 'class' => 'form-control']); !!}
            </div>


            <div class="form-group">
                {!! Form::label('grado_id', 'Grado') !!}
                {!! Form::select('grado_id', $selectgr, $seccione->grado->id, ['placeholder' => 'Elija un grado...', 'class' => 'form-control']); !!}
            </div>
        </div>

        <div class="form-group">

        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}

</div>
@stop
