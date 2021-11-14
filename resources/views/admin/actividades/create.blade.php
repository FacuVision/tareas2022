@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema Web de Gestion de tareas Escolares</h1>
@stop

@section('content')
    <p>¡Bienvenido al panel de administracion!</p>

    <div class="card" id="principal">
        Hola
    </div>

    <div class="card" id="espacio">

    </div>

    <input type="button" value="Crear" id="crear" class="btn btn-success">

    <label>Descripcion</label>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

    // var div = document.createElement("div");
    //     div.style.width = "100px";
    //     div.style.height = "100px";
    //     div.style.background = "red";
    //     div.style.color = "white";
    //     div.innerHTML = "Hello";

    // document.getElementById("main").appendChild(div);

    $(document).ready(function(){

        var boton = document.getElementById('crear');
        boton.addEventListener("click",ejecucion,false);

    });

    function ejecucion() {

            $('#espacio').append("<div class='card'><a href='borrar'>Borrar</a> </div>");
        }

    </script>
@stop
