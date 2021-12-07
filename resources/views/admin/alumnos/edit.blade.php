@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignar seccion a alumno <strong>{{$alumno->user->perfil->nombre}}{{$alumno->user->perfil->apellido}}</strong></h1>
@stop

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

            {!! Form::model($alumno, ['route' => ['admin.alumnos.update', $alumno], 'method' => 'PUT']) !!}

            <div class="form-group">
                <div class="row">

                    {{-- <div class="form-group">
                        <p><strong>Materias:</strong> </p>
                        @foreach ($materias as $materia)
                        <label>
                            {!! Form::checkbox("materias[]", $materia->id, null, ["class"=>"mr-1"]) !!}
                            {{$materia->nombre}}
                        </label>
                        @endforeach
                    </div> --}}

                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('seccion_id', 'Seccion y grado') !!}
                            <select required name="seccion_id" class="form-control">
                                @foreach ($secciones as $seccion)
                                    <option value={{ $seccion->id }}>{{ $seccion->grado->grado }} DE
                                        {{ $seccion->grado->nivel }} - {{ $seccion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                        <a href="{{ route('admin.alumnos.index') }}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>


            </div>
        </div>


    </div>
    {!! Form::close() !!}

    </div>
@stop
