@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xl-6">
        <section class="card">
            <header class="card-header card-header-transparent">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Movimientos del mes</h2>
            </header>
            <div class="card-body">
                <table class="table table-responsive-md table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Concepto</th>
                            <th>Monto</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimientos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->fecha }} - {{ $item->concepto }}</td>
                            <td><span class="badge badge-success">S/. {{ number_format($item->monto,2) }}</span></td>
                            <td>
                                @if ($item->tipo == 'Entrada')
                                    <span class="badge badge-warning">{{ $item->tipo }}</span>
                                    @else
                                    <span class="badge badge-danger">{{ $item->tipo }}</span>
                                
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
@endsection