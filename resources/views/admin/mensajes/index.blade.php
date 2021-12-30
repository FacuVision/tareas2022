@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mensajes motivadores del dia</h1>
@stop

@section('css')
    @include('admin.partials_datatables.cdn_css')
@stop

@section('content')
    <p>Aqui podras administrar los mensajes que se visualizan en el dashboard del sistema</p>

    <div class="card">
        @if (session('mensaje'))
        <div class="alert alert-danger">
            <strong>{{session('mensaje')}}</strong>
        </div>
        @endif
            <div class="card-header">
                <a href="{{route('admin.mensajes.create')}}" class="btn btn-primary"> Crear un nuevo mensaje</a>
            </div>


        <div class="card-body">
            <table id="tabla" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Mensaje</th>
                        <th>Color</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mensajes as $men)
                    <tr>
                        <td>{{$men->id}}</td>
                        <td>{{$men->mensaje}}</td>
                        <td>
                            <label style="background:{{$men->color}}; padding:10px; width:50%;"></label>
                        </td>
                        <td>

                            {{-- Editar --}}
                            <a href="{{route('admin.mensajes.edit', $men)}}" class="btn btn-success">Editar</a>

                            {{-- Eliminar --}}
                            <form style="display: inline" action="{{route('admin.mensajes.destroy', $men)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" id="delete" value="Eliminar" class="btn btn-danger">
                            </form>
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

