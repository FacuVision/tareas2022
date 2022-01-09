@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menu de Logros </h1>
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

        @can('admin.logros.create')

        <div class="card-header">
            <a href="{{ route('admin.logros.create') }}" class="btn btn-primary"> Crear Logro</a>
        </div>
        @endcan

        <div class="card-body">
            <table id="tabla" class="table table-striped dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Tipo</th>
                        <th>Imagen</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logros as $logro)
                        <tr>
                            <td>{{ $logro->id }}</td>
                            <td>{{ $logro->nombre }}</td>
                            <td>{{ $logro->descripcion }}</td>
                            <td>
                                @switch($logro->tipo)
                                    @case(0)
                                    <span class="badge badge-light">
                                    Basico
                                    </span>
                                        @break
                                    @case(1)
                                    <span class="badge badge-secondary">
                                    Regular
                                    </span>
                                        @break
                                    @case(2)
                                    <span class="badge badge-warning">
                                    Normal
                                    </span>
                                        @break
                                    @case(3)
                                    <span class="badge badge-primary">
                                    Bueno
                                    </span>
                                        @break
                                    @case(4)
                                    <span class="badge badge-success">
                                    Muy bueno
                                    </span>
                                        @break
                                    @case(5)
                                    <span class="badge badge-info">
                                    Excelente
                                    </span>
                                        @break
                                @endswitch
                            </td>
                            <td><img src="{{Storage::url($logro->image->url)}}" class="rounded img-fluid img-size-64"></td>
                            <td>

                            {{-- 0 = basico
                                1 = regular
                                2 = normal
                                3 = bueno
                                4 = muy bueno
                                5 = excelente --}}

                                @can('admin.logros.edit')

                                    {{-- Editar --}}

                                    <a href="{{ route('admin.logros.edit', $logro) }}" class="btn btn-success">Editar</a>
                                @endcan


                                @can('admin.logros.destroy')

                                {{-- Eliminar --}}

                                <form style="display: inline" action="{{ route('admin.logros.destroy', $logro) }}" method="post"
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
