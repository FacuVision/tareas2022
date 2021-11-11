@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de creacion de carpetas </h1>
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

            {!! Form::open(['method' => 'POST', 'route' => 'admin.carpetas.store']) !!}

            <div class="form-group">

                <div class="form-group">
                    {!! Form::label('titulo', 'Titulo') !!}
                    {!! Form::text('titulo', null, ['required' => true, 'placeholder' => 'Ingrese un titulo...', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('descripcion', 'Descripcion') !!}
                    {!! Form::textarea('descripcion', null, ['rows' => 5, 'required' => true, 'placeholder' => 'Ingrese una descripcion...', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('sesion', 'Sesion') !!}
                    {!! Form::number('sesion', null, ['required' => true, 'class' => 'form-control', 'min' => 1, 'max' => 70]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fecha_inicio', 'Fecha Inicio - Fecha Final') !!}
                    <div class="input-group">

                        {!! Form::date('fecha_inicio', $fecha, ['required' => true, 'class' => 'form-control']) !!}
                        {!! Form::date('fecha_final', null, ['required' => true, 'class' => 'form-control ml-5']) !!}
                        {{-- {!! Form::label('fecha_final', 'Fecha Final') !!} --}}
                        {{-- {!! Form::date('fecha_final', null, ['required' => true, 'class' => 'form-control']) !!} --}}
                    </div>


                    {{-- </div> --}}

                    {{-- <div class="form-group"> --}}
                    {{-- {!! Form::label('fecha_final', 'Fecha Final') !!} --}}
                    {{-- {!! Form::date('fecha_final', null, ['required' => true, 'class' => 'form-control']) !!} --}}
                </div>

                <div class="form-group">
                    {!! Form::label('materia', 'Materia') !!}

                    <select name="materia_id" class="form-control" placeholder="Elija una materia">
                        @foreach ($materias as $materia)
                            <option value={{ $materia->id }}>{{ $materia->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    {!! Form::label('seccion', 'Seccion') !!}

                    <select required name="seccion_id" class="form-control" placeholder="Elija una seccion y grado">
                        @foreach ($secciones as $seccion)
                            <option value={{ $seccion->id }}>{{ $seccion->grado->grado }} DE
                                {{ $seccion->grado->nivel }} - {{ $seccion->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {!! Form::hidden('user_id', $docente->user_id) !!}
                {!! Form::hidden('estado', 0) !!}



                <div class="form-group">

                    {!! Form::submit('Crear', ['class' => 'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}

            </div>
        @stop

        {{-- id: 10,
         titulo: "alias",
         sesion: 3,
         descripcion: "Non et voluptates quo ad praesentium. Numquam aut id odit dolore est reiciendis minus suscipit.",
         fecha_inicio: "2021-11-06",
         fecha_final: "2021-11-08",
         estado: "1",
         materia_id: 8,
         user_id: 2,
         seccion_id: 1,
         created_at: "2021-11-06 23:15:29",
         updated_at: "2021-11-06 23:15:29", --}}


        @section('css')

            <link rel="stylesheet" href="/css/admin_custom.css">

        @stop

        @section('js')
            <script>
                console.log('Hi!');
            </script>
        @stop
