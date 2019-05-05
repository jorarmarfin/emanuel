@extends('layouts.simplepage')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route'=>'movimientos','method'=>'POST']) !!}
                <div class="form-group">
                    <label for="monto"><strong>Monto</strong></label>
                    {!! Form::number('monto',null,['class'=>'form-control','step'=>'any']) !!}
                </div>
                <div class="form-group">
                    <label for="fecha"><strong>Fecha</strong></label>
                    {!! Form::date('fecha',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="concepto"><strong>concepto</strong></label>
                    {!! Form::select('idconcepto',$conceptos,null,['class'=>'form-control']) !!}
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="radio" name="tipo" value="Entrada" id="Entrada">
                    <label class="form-check-label" for="Entrada">Entrada</label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="radio" name="tipo" value="Salida" id="Salida">
                    <label class="form-check-label" for="Salida">Salida</label>
                </div>                
                <button type="submit" class="btn btn-primary">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection