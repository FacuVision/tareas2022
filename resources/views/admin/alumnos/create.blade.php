@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de creacion de alumno</h1>
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

            {!! Form::open(['method' => 'POST', 'route' => 'admin.alumnos.store']) !!}


            <div class="form-group">

                {{-- Seleccionar Usuario --}}
                {!! Form::label('user_id', 'Seleccione un usuario') !!}<br>
                <div>
                    <select name="user_id" id="user_id" class="form-control" size="10" aria-label="size 3 select example">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->perfil->nombre . ' ' . $user->perfil->apellido . ', DNI:' . $user->perfil->DNI }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!--.container-->
            </div>

            <div class="form-group">
                {!! Form::label('seccion_id', 'Grado y Seccion') !!}
                <select required name="seccion_id" class="form-control">
                    @foreach ($secciones as $seccion)
                        <option value={{ $seccion->id }}>{{ $seccion->grado->grado }} DE
                            {{ $seccion->grado->nivel }} - {{ $seccion->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">

            {!! Form::submit('Crear', ['class' => 'btn btn-success']) !!}
        </div>

        </div>
        {!! Form::close() !!}

    </div>
@stop


@section('js')
@endsection
