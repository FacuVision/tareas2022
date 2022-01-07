@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Menu de Usuarios </h1>
@stop

@section('css')
    @include('admin.partials_datatables.cdn_css')
@endsection

@section('content')
<div class="card">
    @if (session('mensaje'))
    <div class="alert alert-success">
        <strong>{{session('mensaje')}}</strong>
    </div>
    @endif
    @can('admin.users.create')

    <div class="card-header">
        <a href="{{route('admin.users.create')}}" class="btn btn-primary"> Crear Usuario</a>
    </div>
    @endcan


    <div class="card-body">
        <table id="tabla" class="table table-striped dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha de Creación</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{date('d/m/Y H:m:s', strtotime($user->created_at))}}</td>
                    <td>
                        {{--Mostrar--}}
                        @can('admin.users.show')
                        <a href="{{route('admin.users.show', $user)}}" class="btn btn-primary">Ver</a>
                        @endcan

                        {{-- Editar --}}
                        @can('admin.users.edit')
                        <a href="{{route('admin.users.edit', $user)}}" class="btn btn-success">Editar</a>

                        @endcan

                        @can('admin.users.destroy')

                        {{-- Eliminar --}}
                        <form style="display: inline" action="{{route('admin.users.destroy', $user)}}" method="post" class="formulario-eliminar">
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
