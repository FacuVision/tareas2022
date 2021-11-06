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

        {!! Form::open(['method' => 'POST', 'route' => 'admin.grados.store']) !!}

        <div class="form-group">
            <div class="form-group">
                {!! Form::label('grado', 'Grado') !!}
                {!! Form::select('grado', $gr, null, ['placeholder' => 'Elija un grado...', 'class' => 'form-control']); !!}

                {{-- {!! Form::text('grado', null, ['class' => 'form-control']) !!} --}}
            </div>


            <div class="form-group">
                {!! Form::label('nivel', 'Nivel') !!}
                {!! Form::select('nivel', $niv, null, ['placeholder' => 'Elija un nivel...', 'class' => 'form-control']); !!}
            </div>
        </div>

        <div class="form-group">

        {!! Form::submit('Crear', ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}

</div>
@stop
