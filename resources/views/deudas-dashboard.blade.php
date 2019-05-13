@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="tabs">
            <ul class="nav nav-tabs">
                <li class="nav-item active">
                    <a class="nav-link" href="#porpagar" data-toggle="tab"><i class="fas fa-star"></i> Por pagar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#porcobrar" data-toggle="tab">Por cobrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pagado" data-toggle="tab">Pagado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#cobrado" data-toggle="tab">Cobrado</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="porpagar" class="tab-pane active">
                    <p>Por pagar</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
                <div id="porcobrar" class="tab-pane">
                    <p>Por cobrar</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
                <div id="pagado" class="tab-pane">
                    <p>PAgado</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
                <div id="cobrado" class="tab-pane">
                    <p>Cobrado</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.</p>
                </div>
            </div>
        </div>
    </div>

</div>
    
@endsection


@section('titulo-pagina','Deudas Dashboard')