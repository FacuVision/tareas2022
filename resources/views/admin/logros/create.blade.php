@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Creación de Logros </h1>
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
                            {!! Form::label('tipo', 'Subir Imagen') !!}
                            <div class="custom-file">
                                {!! Form::file('file', ['class' => 'custom-file-input', 'accept' => 'image/*', 'id' => 'validatedCustomFile', 'required' => true]) !!}
                                {!! Form::label('file', 'Subir Imagen', ['class' => 'custom-file-label']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            <img src="{{asset('img/file.jpeg')}}" id="picture" class="img-thumbnail">
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
