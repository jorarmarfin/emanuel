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
    <div class="col-xl-6">
        <section class="card">
            <header class="card-header card-header-transparent">
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
                    <tfooter>
                        <tr>
                            <th>#</th>
                            <th>TOTAL</th>
                            <th>S/. {{ number_format($total_ingresos,2) }}</th>
                        </tr>
                    </tfooter>
                    
                </table>
            </div>
        </section>
    </div>
    <div class="col-xl-6">
        <section class="card">
            <header class="card-header card-header-transparent">
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
                </table>
            </div>
        </section>
    </div>
</div>
@endsection
@section('titulo-pagina','Balance mensual')