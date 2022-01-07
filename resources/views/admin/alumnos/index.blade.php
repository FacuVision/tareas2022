@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Alumnos </h1>
@stop

@section('css')
    @include('admin.partials_datatables.cdn_css')
@endsection



@section('content')
    <div class="card">

        @if (session('mensaje'))
            <div class="alert alert-success">
                <strong>{{ session('mensaje') }}</strong>
            </div>
        @endif
        @if (session('alerta'))
            <div class="alert alert-warning">
                <strong>{{ session('alerta') }}</strong>
            </div>
        @endif
    @can('admin.alumnos.create')
    <div class="card-header">
        <a href="{{ route('admin.alumnos.create') }}" class="btn btn-primary"> Crear un Alumno</a>
    </div>
    @endcan

        <div class="card-body">
            <table id="tabla" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        @can('admin.users.show')<th>DNI</th>@endcan
                        <th>Correo</th>
                        <th>Grado</th>
                        <th>Seccion</th>
                        <th style="width:20px;text-align:center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnos as $alumno)
                        <tr>

                            <td>{{$alumno->user_id}}</td>
                            <td>{{$alumno->user->perfil->nombre}}</td>
                            <td>{{$alumno->user->perfil->apellido}}</td>
                            @can('admin.users.show')
                            <td>{{$alumno->user->perfil->DNI}}</td>
                            @endcan

                            <td>{{$alumno->user->email}}</td>
                            <td>{{$alumno->seccion->grado->grado}} - {{$alumno->seccion->grado->nivel}}</td>
                            <td>{{$alumno->seccion->nombre}}</td>
                            <td style="display: flex">

                                {{-- Ver --}}

                                @can('admin.users.show')

                                <a href="{{ route('admin.users.show', $alumno->user) }}" style="margin: 0px 5px;"class="btn btn-primary">Ver</a>

                                @endcan


                                {{-- Editar --}}
                                @can('admin.alumnos.edit')

                                <a href="{{ route('admin.alumnos.edit', $alumno) }}" class="btn btn-success">Asignar</a>
                                @endcan

                                @can('admin.docentes.destroy')
                                {{-- Borrar --}}
                                <form style="display: inline" action="{{ route('admin.alumnos.destroy', $alumno) }}" method="post"
                                    class="formulario-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" id="delete" value="Eliminar" class="btn btn-danger">
                                </form>

                                @endcan


                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@stop

@section('js')
    @include('admin.partials_datatables.cdn_js')
@endsection
