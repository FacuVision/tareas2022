@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Editar Grado </h1>
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


        {!! Form::model($grado, ['route' => ['admin.grados.update', $grado], 'method' => 'PUT']) !!}
        <div class="form-group">
            <div class="form-group">
                {!! Form::label('grado', 'Grado') !!}
                {!! Form::select('grado', $gr, $grado->grado, ['placeholder' => 'Elija un grado...', 'class' => 'form-control']); !!}
            </div>


            <div class="form-group">
                {!! Form::label('nivel', 'Nivel') !!}
                {!! Form::select('nivel', $niv, $grado->nivel, ['placeholder' => 'Elija un nivel...', 'class' => 'form-control']); !!}
            </div>
        </div>

        <div class="form-group">

        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}

</div>
@stop
