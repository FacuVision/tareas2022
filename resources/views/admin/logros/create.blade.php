@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Creación de Logros </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <p class="text-sm text-dark">Puedes usar las siguientes herramientas online para mejorar la calidad de tus logros</p>
            <p class="text-sm text-secondary">Remueve el fondo en blanco: <a class="text-sm text-info" target="_blank" href="https://www.remove.bg/es">Remove BG</a></p>
            <p class="text-sm text-secondary">Consigue iconos con licencia gratuita para tus logros: <a class="text-sm text-info" target="_blank" href="https://www.flaticon.es/">Flaticon </a></p>
            @if (count($errors) > 0)
                <div class="text-danger">

                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach

                </div>
            @endif

        </div>
        <div class="card-body">

            {!! Form::open(['method' => 'POST', 'route' => 'admin.logros.store', 'files' => 'true']) !!}

            <div class="form-group">

                <div class="row">

                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('descripcion', 'Descripcion') !!}
                            {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tipo', 'Tipo') !!}
                            {!! Form::select('tipo', $tipo, null, ['placeholder' => 'Elija un tipo...', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('exp_req', 'Puntos Necesarios') !!}
                            {!! Form::number('exp_req', null, ['required' => true, 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tipo', 'Subir Imagen') !!}
                            <div class="custom-file">
                                {!! Form::file('file', [
                                    'class' => 'custom-file-input',
                                    'accept' => 'image/*',
                                    'id' => 'validatedCustomFile',
                                    'required' => true,
                                ]) !!}
                                {!! Form::label('file', 'Subir Imagen', ['class' => 'custom-file-label']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            <img src="{{ asset('img/file.jpeg') }}" id="picture" class="img-thumbnail">
                        </div>
                    </div>

                </div>
            </div>

            <div class="form-group">

                {!! Form::submit('Crear', ['class' => 'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}

        </div>

    @stop
    @section('js')
        <script>
            document.getElementById("validatedCustomFile").addEventListener('change', cambiarImagen);

            function cambiarImagen(event) {
                var file = event.target.files[0];

                var reader = new FileReader();
                reader.onload = (event) => {
                    document.getElementById("picture").setAttribute('src', event.target.result);
                };

                reader.readAsDataURL(file);
            }
        </script>
    @stop
