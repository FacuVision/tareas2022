@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Creacion de tareas escolares</h1>
@stop

@section('content')
<p>Es primordial conocer las materia, grado y seccion a la cual va a pertenecer tu carpeta de tareas</p>

<div class="card">
    <div class="card-body">

        {{-- MATERIAS DEL DOCENTE --}}
        <div class="card" style="width: 18rem; display:inline-block; margin: 0px 10px">
            <div class="card-header bg bg-info">
                <strong>Tus Materias</strong>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($docente->materias as $materias)
                <li class="list-group-item">{{$materias->nombre}}</li>
                @endforeach
            </ul>
        </div>

        {{-- SECCIONES DEL DOCENTE --}}
        <div class="card" style="width: 18rem; display:inline-block">
            <div class="card-header bg bg-primary">
                <strong>Tus grados y secciones</strong>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($docente->secciones as $secciones)
                    <li class="list-group-item">{{$secciones->grado->grado}} DE {{$secciones->grado->nivel}} - {{$secciones->nombre}}</li>
                @endforeach
            </ul>
        </div>

    </div>
</div>



            {{-- CARPETAS DEL DOCENTE --}}
            <div class="card">
                    <div class="card-header">

                        @if (session('mensaje'))
                            <div class="alert alert-success">
                                <strong>{{session('mensaje')}}</strong>
                            </div>
                        @endif

                        <h3>Tus Carpetas</h3>
                        <br>
                        <a href="{{ route('admin.carpetas.create')}}" class="btn btn-warning"> Crear una nueva carpeta</a>

                    </div>


                <div class="card-body">

                    <table id="carpetas" class="table table-sm table-striped " style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Titulo</th>
                                <th>Materia</th>
                                <th>Sesion</th>
                                <th>grado</th>
                                <th>seccion</th>
                                <th>fecha_inicio</th>
                                <th>fecha_final</th>
                                <th>Estado</th>
                                <th style="width:20px;text-align:center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($docente->carpetas as $carpeta)
                            <tr>
                                <td>{{$carpeta->id}}</td>
                                <td>{{$carpeta->titulo}}</td>
                                <td>{{$carpeta->materia->nombre}}</td>
                                <td>{{$carpeta->sesion}}</td>
                                <td>{{$carpeta->seccion->grado->grado}} DE {{$carpeta->seccion->grado->nivel}}</td>
                                <td>{{$carpeta->seccion->nombre}}</td>
                                <td>{{$carpeta->fecha_inicio}}</td>
                                <td>{{$carpeta->fecha_final}}</td>
                                @if ($carpeta->estado == 1)
                                    <td><strong class="text text-success">Activo</strong></td>
                                @else
                                    <td><strong class="text text-secondary">Inactivo</strong></td>
                                @endif

                                <td  style="display: flex">

                                    {{-- Ver --}}

                                    <a style="margin: 0px 5px" href="{{route('admin.carpetas.show', $carpeta)}}" class="btn btn-primary">Ver</a>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
@stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')
<script> console.log('Hi!');</script>
@stop
