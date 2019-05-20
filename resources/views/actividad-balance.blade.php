@extends('layouts.admin')

@section('content')
@if(Session::has('flash_message'))
<span class="mensaje" >{{Session::get('flash_message')}}</span>
@endif
<div class="row">
    <div class="col-md-6">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Ingresos</h2>
            </header>
            <div class="card-body">
                <table class="table table-responsive-md table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Concepto</th>
                            <th class="text-right">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ingresos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->fecha }} - {{ $item->concepto }} <br> <h6> {!! $item->observacion !!} </h6></td>
                            <td class="text-right">S/. {{ number_format($item->monto,2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>TOTAL</th>
                            <th class="text-right">S/. {{ number_format($total_ingresos,2) }}</th>
                        </tr>
                    </tfoot>
                    
                </table>
            </div>
        </section>

    </div>
    <div class="col-md-6">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Egresos</h2>
            </header>
            <div class="card-body">
                <table class="table table-responsive-md table-striped mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Concepto</th>
                            <th class="text-right">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($egresos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->fecha }} - {{ $item->concepto }} <br> <h6> {!! $item->observacion !!} </h6></td>
                            <td class="text-right">S/. {{ number_format($item->monto,2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>TOTAL</th>
                            <th class="text-right">S/. {{ number_format($total_egresos,2) }}</th>
                        </tr>
                    </tfoot>
                    
                </table>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
            <section class="card">
                    <header class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                            <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                        </div>
        
                        <h2 class="card-title">Por Cobrar</h2>
                    </header>
                    <div class="card-body">
                        <table class="table table-responsive-md table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Miembro</th>
                                    <th class="text-right">Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($xcobrar as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->miembro }} <br> <h6> {!! $item->observacion !!} </h6></td>
                                    <td class="text-right">S/. {{ number_format($item->monto,2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>TOTAL</th>
                                    <th class="text-right">S/. {{ number_format($total_xcobrar,2) }}</th>
                                </tr>
                            </tfoot>
                            
                        </table>
                    </div>
                </section>
        
    </div>
    <div class="col-md-6">
        <section class="card">
            <span class=" text-right alert alert-primary">INGRESO S/.{{ $total_ingresos }}</span>
            <span class=" text-right alert alert-danger">EGRESO S/.{{ $total_egresos }}</span>
            <span class=" text-right alert alert-warning">GANACIA S/.{{ $ganancia }}</span>
            <span class=" text-right alert alert-primary">POR COBRAR S/.{{ $total_xcobrar }}</span>
            <span class=" text-right alert alert-dark">GANACIA LIQUIDA S/.{{ $ganancia_liquida }}</span>
        </section>
    </div>
</div>
@if ($actividad->cerrado=='no')    
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => 'actividad.cierre', 'method' => 'post']) !!}
                {!! Form::hidden('idactividad',$actividad->id) !!}
                {!! Form::hidden('ganancia',$ganancia_liquida) !!}
                {!! Form::submit('Cerrar',['class'=>'btn btn-danger col-md-12']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endif
@endsection
@section('titulo-pagina','Actividad económica '.$actividad->nombre.' '.$actividad->fecha)