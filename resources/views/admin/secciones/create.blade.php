@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Menu de Creación de Secciones</h1>
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

        {!! Form::open(['method' => 'POST', 'route' => 'admin.secciones.store']) !!}

        <div class="form-group">
            <div class="form-group">
                {!! Form::label('nombre', 'Sección') !!}
                {!! Form::select('nombre', $selectsec, null, ['placeholder' => 'Elija una sección...', 'class' => 'form-control']); !!}
                {{-- {!! Form::text('grado', null, ['class' => 'form-control']) !!} --}}
            </div>

            <div class="form-group">
                {!! Form::label('grado_id', 'Grado') !!}
                {!! Form::select('grado_id', $selectgr, null, ['placeholder' => 'Elija un grado...', 'class' => 'form-control']); !!}
            </div>
        </div>

        <div class="form-group">

        {!! Form::submit('Crear', ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}

</div>
@stop
