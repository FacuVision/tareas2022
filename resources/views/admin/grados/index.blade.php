@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Grados </h1>
@stop

@section('css')
    @include('admin.partials_datatables.cdn_css')
@endsection

@section('content')
    <div class="card">
        @if (session('mensaje'))
            <div class="alert alert-success">
                <strong>{{ session('mensaje') }}</strong>
            </div>
        @endif

        @can('admin.grados.create')

        <div class="card-header">
            <a href="{{ route('admin.grados.create') }}" class="btn btn-primary"> Crear Grado</a>
        </div>
        @endcan

        <div class="card-body">
            <table id="tabla" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Grado</th>
                        <th>Nivel</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grados as $grado)
                        <tr>
                            <td>{{ $grado->id }}</td>
                            <td>{{ $grado->grado }}</td>
                            <td>{{ $grado->nivel }}</td>
                            <td>

                                {{-- Editar --}}
                                @can('admin.grados.edit')

                                <a href="{{ route('admin.grados.edit', $grado) }}" class="btn btn-success">Editar</a>
                                @endcan

                                @can('admin.grados.destroy')

                                {{-- Eliminar --}}

                                <form style="display: inline" action="{{ route('admin.grados.destroy', $grado) }}" method="post"
                                    class="formulario-eliminar">
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
