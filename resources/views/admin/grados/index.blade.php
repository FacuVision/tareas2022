@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Menu de Grados </h1>
@stop

@section('content')
<div class="card">
    @if (session('mensaje'))
    <div class="alert alert-success">
        <strong>{{session('mensaje')}}</strong>
    </div>
    @endif
        <div class="card-header">
            <a href="{{ route('admin.grados.create')}}" class="btn btn-primary"> Crear Grado</a>
        </div>


    <div class="card-body">
        <table id="grado" class="table table-sm table-striped " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Grado</th>
                    <th>Nivel</th>
                    <th style="width:20px;text-align:center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grados as $grado)
                <tr>
                    <td>{{$grado->id}}</td>
                    <td>{{$grado->grado}}</td>
                    <td>{{$grado->nivel}}</td>
                    <td  style="display: flex">

                          {{-- Editar --}}

                            <a href="{{route('admin.grados.edit', $grado)}}" class="btn btn-success">Editar</a>

                        {{-- Eliminar --}}

                          <form action="{{route('admin.grados.destroy', $grado)}}" method="post" class="formulario-eliminar">
                            @csrf
                            @method('DELETE')
                            <input type="submit" id="delete" value="Eliminar" class="btn btn-danger" style="margin: 0px 0px 0px 5px;">
                        </form>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
@stop
