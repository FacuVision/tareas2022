@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Materias </h1>
@stop

@section('content')
    <div class="card">
        @if (session('mensaje'))
            <div class="alert alert-success">
                <strong>{{ session('mensaje') }}</strong>
            </div>
        @endif
        <div class="card-header">
            <a href="{{ route('admin.materias.create') }}" class="btn btn-primary"> Crear Materia</a>
        </div>


        <div class="card-body">
            <table id="grado" class="table table-sm table-striped " style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th style="width:20px;text-align:center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materias as $materia)
                        <tr>
                            <td>{{$materia->id}}</td>
                            <td>{{$materia->nombre}}</td>
                            <td>{{$materia->descripcion}}</td>
                            <td style="display: flex">

                                {{-- Editar --}}

                                <a href="{{ route('admin.materias.edit', $materia) }}" class="btn btn-success">Editar</a>

                                {{-- Eliminar --}}

                                <form action="{{ route('admin.materias.destroy', $materia) }}" method="post"
                                    class="formulario-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" id="delete" value="Eliminar" class="btn btn-danger"
                                        style="margin: 0px 0px 0px 5px;">
                                </form>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@stop
