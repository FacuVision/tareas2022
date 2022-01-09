@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Materias </h1>
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

        @can('admin.materias.create')

            <div class="card-header">
                <a href="{{ route('admin.materias.create') }}" class="btn btn-primary"> Crear Materia</a>
            </div>
        @endcan


        <div class="card-body">
            <table id="tabla" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materias as $materia)
                        <tr>
                            <td>{{ $materia->id }}</td>
                            <td>{{ $materia->nombre }}</td>
                            <td>{{ $materia->descripcion }}</td>
                            <td>

                                @can('admin.materias.edit')

                                    {{-- Editar --}}

                                    <a href="{{ route('admin.materias.edit', $materia) }}" class="btn btn-success">Editar</a>
                                @endcan

                                @can('admin.materias.create')

                                    {{-- Eliminar --}}

                                    <form style="display: inline" action="{{ route('admin.materias.destroy', $materia) }}"
                                        method="post" class="formulario-eliminar">
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
