@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Menu Usuarios: Editar Usuario </h1>
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

        {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'PUT']) !!}
        <div class="form-group">
            <div class="form-group">
                {!! Form::label('email', 'Correo Electronico') !!}
                {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Contraseña') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('nombre', 'Nombres') !!}
                {!! Form::text('nombre', $user->name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('apellido', 'Apellidos') !!}
                {!! Form::text('apellido', $user->perfil->apellido, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('fecha', 'Fecha de Nacimiento') !!}
                {!! Form::date('fecha', $user->perfil->fecha_nac, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('dni', 'DNI') !!}
                {!! Form::text('dni', $user->perfil->DNI, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('edad', 'Edad') !!}
                {!! Form::text('edad', $user->perfil->edad, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('sexo', 'Sexo') !!}
                {!! Form::select('sexo', $sexo, $user->perfil->sexo, ['placeholder' => 'Elija sexo...', 'class' => 'form-control']); !!}
            </div>
            <div class="form-group">
                {!! Form::label('direccion', 'Direccion') !!}
                {!! Form::text('direccion', $user->perfil->direccion, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('distrito', 'Distrito') !!}
                {!! Form::select('distrito', $dist, $user->perfil->distrito, ['placeholder' => 'Elija un distrito...', 'class' => 'form-control']); !!}
            </div>
        </div>

        <div class="form-group">

        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}

</div>
@stop

