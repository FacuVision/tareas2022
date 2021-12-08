@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignar materias y secciones a docente <strong>{{$docente->user->perfil->nombre}}{{$docente->user->perfil->apellido}}</strong></h1>
@stop
s
@section('content')
    <div class="card">
        <div class="card-header">
            @if (session('mensaje'))
                <div class="alert alert-success">
                    <strong>{{ session('mensaje') }}</strong>
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

            {!! Form::model($docente, ['route' => ['admin.docentes.update', $docente], 'method' => 'PUT']) !!}

            <div class="form-group">
                <div class="row">

                    <div class="form-group mx-sm-auto">
                        <p><strong>Materias:</strong> </p>
                        @foreach ($materias as $materia)
                        {!! Form::checkbox("materias[]", $materia->id, null, ["class"=>"mr-1", "id"=>"chkmat"]) !!}
                        <label>
                            {{$materia->nombre}}
                        </label>
                        <div class="vr"></div>
                        @endforeach
                    </div>
                    <div class="form-group mx-sm-auto">
                        <p><strong>Secciones:</strong> </p>
                        @foreach ($secciones as $seccion)
                        {!! Form::checkbox("secciones[]", $seccion->id, null, ["class"=>"mr-1"]) !!}
                        <label>
                            {{"Seccion : " . $seccion->nombre. " Año: " . $seccion->grado->grado . " Nivel: " . $seccion->grado->nivel}}
                        </label>
                        <div class="vr"></div>
                        @endforeach
                    </div>
                    {{-- <div class="col">
                        <div class="form-group">
                            {!! Form::label('seccion_id', 'Seccion y grado') !!}
                            <select required name="seccion_id" class="form-control">
                                @foreach ($secciones as $seccion)
                                    <option value={{ $seccion->id }}>{{ $seccion->grado->grado }} DE
                                        {{ $seccion->grado->nivel }} - {{ $seccion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                </div>

                <div class="row">
                    <div class="col">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                        <a href="{{ route('admin.docentes.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>


            </div>
        </div>


    </div>
    {!! Form::close() !!}

    </div>
@stop
