@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Menu de Usuarios: Crear Usuario </h1>
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

        <div class="col"></div>

        {!! Form::open(['method' => 'POST', 'route' => 'admin.users.store']) !!}
        <div class="form-group">

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        {!! Form::label('email', 'Correo Electronico') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('password', 'Contraseña') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                  </div>
            </div>




            <div class="form-group">
                <div class="row">
                    <div class="col">
                        {!! Form::label('nombre', 'Nombres') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('apellido', 'Apellidos') !!}
                        {!! Form::text('apellido', null, ['class' => 'form-control']) !!}                    </div>
                  </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col">
                        {!! Form::label('fecha', 'Fecha de Nacimiento') !!}
                        {!! Form::date('fecha', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('dni', 'DNI') !!}
                        {!! Form::text('dni', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('edad', 'Edad') !!}
                        {!! Form::text('edad', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('sexo', 'Sexo') !!}
                        {!! Form::select('sexo', $sexo, null, ['placeholder' => 'Elija sexo...', 'class' => 'form-control']); !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('direccion', 'Direccion') !!}
                {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('distrito', 'Distrito') !!}
                {!! Form::select('distrito', $dist, null, ['placeholder' => 'Elija un distrito...', 'class' => 'form-control']); !!}
            </div>
            <div class="form-group">
                {!! Form::label('rol', 'Rol: (opcional)') !!} <br>
                <label>
                    {!! Form::checkbox('rol_id', 1 , null, ['class' => 'mr-1']) !!} Admin
                </label>
            </div>
        </div>

        <div class="form-group">
            {!! Form::submit('Crear', ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}

</div>
@stop
