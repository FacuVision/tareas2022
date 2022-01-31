@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Revision de Tareas Escolares </h1>
    <br>
    <p>Aqui podras revisar las tareas de los alumnos, es necesario especificar a que materia, grado y seccion pertenece tu
        carpeta donde estan tus tareas</p>
@stop

@section('content')
    <div class="card">
        @if (session('mensaje'))
            <div class="alert alert-success">
                <strong>{{ session('mensaje') }}</strong>
            </div>
        @endif

        <div class="card-header">
            {{-- MATERIAS DEL DOCENTE --}}
            <div class="card" style="width: 18rem; display:inline-block; margin: 0px 10px">
                <div class="card-header bg bg-info">
                    <strong>Tus Materias</strong>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($docente->materias as $materias)
                        <li class="list-group-item">{{ $materias->nombre }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- SECCIONES DEL DOCENTE --}}
            <div class="card" style="width: 18rem; display:inline-block">
                <div class="card-header bg bg-primary">
                    <strong>Tus grados y secciones</strong>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($docente->secciones as $secciones)
                        <li class="list-group-item">{{ $secciones->grado->grado }} DE {{ $secciones->grado->nivel }} -
                            {{ $secciones->nombre }}</li>
                    @endforeach
                </ul>
            </div>
        </div>


        <div class="card-body">


            {!! Form::open(['method' => 'POST', 'route' => 'admin.revisiones.store']) !!}

            <div class="row">

                <div class="col">

                    <div class="form-group">
                        {!! Form::label('materia', 'Materia') !!}
                        {!! Form::select('materia_id', $materia, null, ['required'=>true, 'placeholder' => 'Elija una materia...', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        {!! Form::label('seccion', 'Seccion y grado') !!}
                        <select required name="seccion_id" class="form-control">
                            <option selected="selected" value="">Elija una seccion y grado...</option>
                            @foreach ($docente->secciones as $seccion)
                                <option value={{ $seccion->id }}>{{ $seccion->grado->grado }} DE
                                    {{ $seccion->grado->nivel }} - {{ $seccion->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        {!! Form::label('Periodo', 'Periodo') !!}
                        <input type="month" name="periodo" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        {!! Form::label('estado', 'Estado') !!}
                        <select required name="estado" class="form-control">
                            <option selected="selected" value="1">Activo</option>
                                <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>


            {!! Form::submit('Buscar carpetas', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>

    </div>
@stop
