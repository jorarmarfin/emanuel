@extends('layouts.simplepage')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route'=>'deudas.save','method'=>'POST']) !!}
                <div class="form-group">
                    <label for="monto"><strong>Monto</strong></label>
                    {!! Form::number('monto',null,['class'=>'form-control','step'=>'any']) !!}
                </div>
                <div class="form-group">
                    <label for="fecha"><strong>Fecha de la deuda</strong></label>
                    {!! Form::date('fecha_deuda',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="concepto"><strong>concepto</strong></label>
                    {!! Form::select('idconcepto',$conceptos,null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="idactividad"><strong>Actividades</strong></label>
                    {!! Form::select('idactividad',$actividades,null,['class'=>'form-control','placeholder'=>'Seleccionar']) !!}
                </div>
                <div class="form-group">
                    <label for="estado"><strong>Estado</strong></label>
                    {!! Form::select('estado',$estados,null,['class'=>'form-control','placeholder'=>'Seleccionar']) !!}
                </div>
                <div class="form-group">
                    <label for="estado"><strong>Hermano</strong></label>
                    {!! Form::select('idmiembro',$hermanos,null,['class'=>'form-control','placeholder'=>'Seleccionar']) !!}
                </div>
                <div class="form-group">
                    <label for="Tipo"><strong>Contabilizar</strong></label>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="contabilizar" value="si" id="si">
                        <label class="form-check-label" for="si">Si</label>
                    </div>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="contabilizar" value="no" id="no">
                        <label class="form-check-label" for="no">No</label>
                    </div>    
                </div>
                
                <div class="form-group">
                    <label for="descripcion"><strong>Descripcion</strong></label>
                    {!! Form::textarea('descripcion',null,['class'=>'form-control','rows'=>'3']) !!}
                </div>            
                <button type="submit" class="btn btn-primary">Submit</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection