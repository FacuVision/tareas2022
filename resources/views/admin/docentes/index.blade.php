@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Docentes </h1>
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


        @can('admin.docentes.create')
        <div class="card-header">
            <a href="{{ route('admin.docentes.create') }}" class="btn btn-primary"> Crear un Docente</a>
        </div>

        @endcan

        <div class="card-body">
            <table id="tabla" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Correo</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docentes as $docente)
                        <tr>

                            <td>{{$docente->user_id}}</td>
                            <td>{{$docente->user->perfil->nombre}}</td>
                            <td>{{$docente->user->perfil->apellido}}</td>
                            <td>{{$docente->user->perfil->DNI}}</td>
                            <td>{{$docente->user->email}}</td>
                            <td>

                                {{-- Ver --}}
                                @can('admin.users.show')
                                <a href="{{ route('admin.users.show', $docente->user) }}" class="btn btn-primary">Ver</a>
                                @endcan

                                @can('admin.docentes.edit')
                                {{-- Editar --}}

                                <a href="{{ route('admin.docentes.edit', $docente) }}" class="btn btn-success">Asignar</a>

                                @endcan

                                @can('admin.docentes.destroy')

                                {{-- Eliminar --}}
                                <form style="display: inline" action="{{ route('admin.docentes.destroy', $docente) }}" method="post"
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
