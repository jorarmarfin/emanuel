@extends('layouts.simplepage')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post">
                <div class="form-group">
                    <label for="monto"><strong>Monto</strong></label>
                    <input type="number" name="monto" id="monto" class="form-control">
                    {!! Form::text('monto2',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="fecha"><strong>Fecha</strong></label>
                    <input type="date" name="fecha" id="fecha" class="form-control">
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
            </form>
        </div>
    </div>
</div>
@endsection