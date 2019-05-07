@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle=""></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss=""></a>
                </div>

                <h2 class="card-title">Seleccione mes y año para consultar</h2>
            </header>
            <div class="card-body">
                {!! Form::open(['route' => 'balance.consultar', 'method' => 'post','class'=>'row']) !!}
                    <div class="form-group col-md-6">
                        <label for="mes"><strong>Mes:  </strong></label>
                        {!! Form::select('mes',$meses,$mes,['class'=>'form-control',]) !!}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="year"><strong>Año:  </strong></label>
                        {!! Form::select('year',$years,$year,['class'=>'form-control',]) !!}
                    </div>
                    {!! Form::submit('Enviar',['class'=>'btn btn-primary col-md-12']) !!}
                {!! Form::close() !!}
            </div>
        </section>
    </div>
</div>
@if ($sw!=0)    
<div class="row">
    <div class="col-xl-6">   
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Ingresos</h2>
            </header>
            <div class="card-body">
                <div class="text-right text-uppercase"><strong>Saldo del mes anterior S/. {{ $resumen->saldo_inicial }}</strong></div>
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
    <div class="col-xl-6">
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
                            <td>{{ $item->fecha }} - {{ $item->concepto }} <br> <h6> {!! $item->observacion !!} </h6> </td>
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
    <div class="col-xl-6">   
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Otros Ingresos</h2>
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
                        @foreach ($oingresos as $item)
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
                            <th class="text-right">S/. {{ number_format($total_oingresos,2) }}</th>
                        </tr>
                    </tfoot>
                    
                </table>
            </div>
        </section>
    </div>
    <div class="col-xl-6">   
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                </div>

                <h2 class="card-title">Porcentajes RCC</h2>
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
                        <tr>
                            <td>10%</td>
                            <td>Zona</td>
                            <td class="text-right">S/. xxx</td>
                        </tr>
                        <tr>
                            <td>20%</td>
                            <td>Diocesis</td>
                            <td class="text-right">S/. xxx</td>
                        </tr>
                        <tr>
                            <td>10%</td>
                            <td>Sacerdotes</td>
                            <td class="text-right">S/. xxx</td>
                        </tr>
                        <tr>
                            <td>3 S</td>
                            <td>Nacional</td>
                            <td class="text-right">S/. xxx</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>TOTAL</th>
                            <th class="text-right">S/. xxx</th>
                        </tr>
                    </tfoot>
                    
                </table>
            </div>
        </section>
    </div>
        
</div>
<div class="row">
    <div class="col-xl-6">   
        <section class="card">
            <div class="text-right alert alert-primary">
                <span class="text-uppercase"> Ingreso total del mes S/. {{ number_format($total_oingresos+$total_ingresos,2) }} </span>
            </div>
            <div class="text-right alert alert-warning">
                <span class="text-uppercase"> total S/. {{ number_format($total_oingresos+$total_ingresos+$resumen->saldo_inicial,2) }} </span>
            </div>
            <div class="text-right alert alert-default">
                {!! Form::submit('Cerrar caja del mes',['class'=>'btn btn-warning']) !!}
            </div>
        </section>
    </div>
    <div class="col-xl-6">   
        <section class="card">
            <div class=" text-right alert alert-danger">
                <span class="text-uppercase"> Egreso total del mes S/. {{ number_format($total_oingresos+$total_ingresos,2) }} </span>
            </div>
            <div class="text-right alert alert-danger">
                <span class="text-uppercase"> Saldo para el mes siguiente S/. {{ number_format($total_oingresos+$total_ingresos+$resumen->saldo_inicial,2) }} </span>
            </div>
            <div class="text-right alert alert-warning">
                <span class="text-uppercase"> total S/. {{ number_format($total_oingresos+$total_ingresos+$resumen->saldo_inicial,2) }} </span>
            </div>
        </section>
    </div>
</div>
@endif
@endsection
@section('titulo-pagina','Balance mensual de '.$mes." del ".$year)