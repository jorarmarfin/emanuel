@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="tabs">
            <ul class="nav nav-tabs">
                <li class="nav-item active">
                    <a class="nav-link porpagar" href="#porpagar" data-toggle="tab"><i class="fas fa-star"></i> Por pagar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link porcobrar" href="#porcobrar" data-toggle="tab">Por cobrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pagado" href="#pagado" data-toggle="tab">Pagado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link cobrado" href="#cobrado" data-toggle="tab">Cobrado</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="porpagar" class="tab-pane active ">
                    <div class="row">
                        <div class="col-md-12 table-responsive-md">
                            <table class="table table-bordered table-striped mb-0" id="tbl-xpagar">
                                <thead>
                                    <tr>
                                        <th>Monto</th>
                                        <th>Fecha Deuda</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Concepto</th>
                                        <th>Actividad</th>
                                        <th>Miembro</th>
                                        <th>Descripcion</th>
                                        <th>Contabilizar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="porcobrar" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12 table-responsive-md">
                            <table class="table table-bordered table-striped mb-0" id="tbl-xcobrar">
                                <thead>
                                    <tr>
                                        <th>Monto</th>
                                        <th>Fecha Deuda</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Concepto</th>
                                        <th>Actividad</th>
                                        <th>Miembro</th>
                                        <th>Descripcion</th>
                                        <th>Contabilizar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="pagado" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12 table-responsive-md">
                            <table class="table table-bordered table-striped mb-0" id="tbl-pagado">
                                <thead>
                                    <tr>
                                        <th>Monto</th>
                                        <th>Fecha Deuda</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Concepto</th>
                                        <th>Actividad</th>
                                        <th>Miembro</th>
                                        <th>Descripcion</th>
                                        <th>Contabilizar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="cobrado" class="tab-pane">
                    <div class="row">
                            <div class="col-md-12 table-responsive-md">
                                <table class="table table-bordered table-striped mb-0" id="tbl-cobrado">
                                    <thead>
                                        <tr>
                                            <th>Monto</th>
                                            <th>Fecha Deuda</th>
                                            <th>Estado</th>
                                            <th>Fecha</th>
                                            <th>Concepto</th>
                                            <th>Actividad</th>
                                            <th>Miembro</th>
                                            <th>Descripcion</th>
                                            <th>Contabilizar</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    
@endsection

@section('scripts')
<script>
    var tblxpagar = $("#tbl-xpagar");
    var tblxcobrar = $("#tbl-xcobrar");
    var tblpagado = $("#tbl-pagado");
    var tblcobrado = $("#tbl-cobrado");

    var tabporpagar = $(".porpagar");
    var tabporcobrar = $(".porcobrar");
    var tabpagado = $(".pagado");
    var tabcobrado = $(".cobrado");

    tabporpagar.click(function(){
        tblxpagar.dataTable({
            language: {
                "emptyTable": "No hay datos disponibles",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
                "lengthMenu": "_MENU_ registros"
            },
            retrieve: true,
            responsive: true,
            ajax: "{{ url('/tabla/por pagar') }}",
            columns:[
                { "data": "monto", "defaultContent":""},
                { "data": "fecha_deuda", "defaultContent":""},
                { "data": "estado", "defaultContent":""},
                { "data": "fecha", "defaultContent":""},
                { "data": "idconcepto", "defaultContent":""},
                { "data": "idactividad", "defaultContent":""},
                { "data": "idmiembro", "defaultContent":""},
                { "data": "descripcion", "defaultContent":""},
                { "data": "contabilizar", "defaultContent":""},
                { "data": "id", "defaultContent":""},
            ]
        });
    });


</script>
@endsection
@section('titulo-pagina','Deudas Dashboard')