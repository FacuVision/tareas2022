@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Secciones </h1>
@stop

@section('content')
    <div class="card">
        @if (session('mensaje'))
            <div class="alert alert-success">
                <strong>{{ session('mensaje') }}</strong>
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">
                <strong>{{ session('warning') }}</strong>
            </div>
        @endif
        <div class="card-header">
            <a href="{{ route('admin.secciones.create') }}" class="btn btn-primary"> Crear Sección</a>
        </div>


        <div class="card-body">
            <table id="seccion" class="table table-sm table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Sección</th>
                        <th>Grado</th>
                        <th style="width:20px;text-align:center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $secciones as $seccion)
                        <tr>

                            <td>{{$seccion->id}}</td>
                            <td>{{$seccion->nombre}}</td>
                            <td>{{$seccion->grado->grado. " DE ". $seccion->grado->nivel}}</td>
                            <td style="display: flex">

                                {{-- Editar --}}

                                <a href="{{ route('admin.secciones.edit', $seccion) }}" class="btn btn-success">Editar</a>

                                {{-- Eliminar --}}

                                <form action="{{ route('admin.secciones.destroy', $seccion) }}" method="post"
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
