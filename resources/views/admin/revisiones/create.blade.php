@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Seleccion de carpetas para la revision </h1>
@stop

@section('content')



<div class="card border-dark mb-3">
    <div class="card-header"><strong> Recuerda !!!</strong></div>
    <div class="card-body text-secondary">
      <p class="card-text">Aqui se muestran tus carpetas que han sido activadas previamente, recuerda que no es recomendable desactivar las carpetas cuando esta en proceso de evaluacion</p>
    </div>
  </div>

    <div class="card">
        @can('admin.revisiones.index')

        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('admin.revisiones.index') }}"> Volver</a>
        </div>
        @endcan

        <div class="card-body">


            <table id="carpetas" class="table table-sm table-striped " style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Materia</th>
                        {{-- <th>Sesion</th> --}}
                        <th>grado</th>
                        <th>seccion</th>
                        <th>fecha_inicio</th>
                        <th>fecha_final</th>
                        <th>Estado</th>
                        <th style="width:20px;text-align:center"> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carpetas as $carpeta)
                    <tr>
                        <td>{{$carpeta->id}}</td>
                        <td>{{$carpeta->titulo}}</td>
                        <td>{{$carpeta->materia->nombre}}</td>
                        {{-- <td>{{$carpeta->sesion}}</td> --}}
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

                            @can('admin.revisiones.show')

                            {{-- Ver --}}

                            <a style="margin: 0px 5px" href="{{route('admin.revisiones.show', $carpeta->id)}}" class="btn btn-primary">Ver</a>
                            @endcan

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>



    </div>
@stop
