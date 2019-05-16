@extends('layouts.admin')

@section('content')
<section class="card mb-4">
    <header class="card-header">
        <div class="card-actions">
            <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
            <a href="#" class="card-action card-action-dismiss" data-card-dismiss=""></a>
        </div>

        <h2 class="card-title">Lista de Actividades</h2>
    </header>
    <div class="card-body table-responsive-md">
        <table class="table table-bordered table-striped mb-0">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Precio Unitario</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actividades as $item)
                    <tr>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->fecha }}</td>
                        <td>{{ $item->ini }}</td>
                        <td>{{ $item->fin }}</td>
                        <td>{{ $item->pu }}</td>
                        <td>{{ $item->activo }}</td>
                        <td><a href="{{ route('actividad.balance',$item->id) }}" class="btn btn-primary">Ver</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</section>
@endsection