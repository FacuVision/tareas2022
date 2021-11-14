@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Sistema Web de Gestion de tareas Escolares</h1>
@stop

@section('content')
    <p>¡Bienvenido al panel de administracion!</p>

    <div class="card">
        Hola
    </div>

    <input type="button" value="Crear" id="crear" class="btn btn-success">

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

    var div = document.createElement("div");
        div.style.width = "100px";
        div.style.height = "100px";
        div.style.background = "red";
        div.style.color = "white";
        div.innerHTML = "Hello";

    document.getElementById("main").appendChild(div);

    </script>
@stop
