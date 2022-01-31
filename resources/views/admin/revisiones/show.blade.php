@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de calificacion de tareas escolares </h1>
@stop

@section('content')

<div class="card border-dark mb-3">
    <div class="card-header"><strong> Recuerda !!!</strong></div>
    <div class="card-body text-secondary">
        <p class="card-text">Aqui se muestran tus tareas que han sido publicadas previamente, recuerda que no es recomendable desactivar las tareas cuando esta en proceso de evaluacion</p>
    </div>
  </div>

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


            <div class="container">
                <div class="row">
                    @foreach ($tareas as $tarea)
                  <div class="col-md-4 col-sm-6">

                    <div class="card" style="width: 18rem;">
                        <div class="card-header" style="text-align:center" >
                            <i style="padding: 30px; color: royalblue" class="fas fa-book fa-5x"></i>
                        </div>

                        <div class="card-body">
                            <h5 class="text-center"><strong>{{$tarea->titulo}}</strong></h5>
                        </div>

                        <ul class="list-group list-group-flush">

                            @if ($tarea->estado==1)
                                <li class="list-group-item text-center"><strong class="text text-success">Activo</strong></li>
                            @else
                                <li class="list-group-item text-center"><strong class="text text-secondary">Inactivo</strong></li>
                            @endif


                            <li class="list-group-item text-justify font-weight-light text-sm">{{$tarea->descripcion}}</li>
                            <li class="list-group-item text-center">
                                @can('admin.revisiones.edit')

                                <a style="margin: 0px 5px" href="{{ route('admin.revisiones.edit', $tarea->id) }}"
                                class="btn btn-warning">Ver</a>
                                @endcan
                            </li>
                        </ul>
                      </div>


                  </div>
                  @endforeach
                </div>
            </div>

        </div>
    @stop
