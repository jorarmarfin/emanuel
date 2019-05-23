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
                                        <th>id</th>
                                        <th>Monto</th>
                                        <th>Fecha Deuda</th>
                                        <th>Estado</th>
                                        <th>Fecha operación</th>
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
                                        <th>id</th>
                                        <th>Monto</th>
                                        <th>Fecha Deuda</th>
                                        <th>Estado</th>
                                        <th>Fecha operacion</th>
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
                                        <th>id</th>
                                        <th>Monto</th>
                                        <th>Fecha Deuda</th>
                                        <th>Estado</th>
                                        <th>Fecha operacion</th>
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
                                            <th>id</th>
                                            <th>Monto</th>
                                            <th>Fecha Deuda</th>
                                            <th>Estado</th>
                                            <th>Fecha operacion</th>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Contabilizar deuda</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'deudas.contabilizar', 'method' => 'post']) !!}
            <div class="modal-body">
                    {!! Form::label('Monto') !!}
                    {!! Form::date('fecha',null,['class'=>'form-control']) !!}
                    {!! Form::hidden('iddeuda',null,['id'=>'iddeuda']) !!}
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            {!! Form::close() !!}
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
    
    llenatabla('por pagar',tblxpagar);

    tabporpagar.click(function(){
        llenatabla('por pagar',tblxpagar);
    });
    tabporcobrar.click(function(){
        llenatabla('por cobrar',tblxcobrar);
    });
    tabpagado.click(function(){
        llenatabla('pagado',tblpagado);
    });
    tabcobrado.click(function(){
        llenatabla('cobrado',tblcobrado);
    });


    function llenatabla(name,mytabla){
        var v_url = '/tabla/'+name;
        var v_raiz = "{{ url('/') }}";
        var v_route = v_raiz+v_url;
        mytabla.dataTable({
            language: {
                "emptyTable": "No hay datos disponibles",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ filas",
                "lengthMenu": "_MENU_ registros"
            },
            retrieve: true,
            responsive: true,
            ajax: v_route,
            columnDefs:[
                {
                    targets:10,
                    render: function(data, type, row){
                        if (row.estado=='por pagar') {
                            var clase = 'primary';
                            var nombre = 'Pagar';
                        }else if(row.estado=='por cobrar'){
                            var clase = 'danger';
                            var nombre = 'Cobrar';
                        }else if(row.estado=='cobrado'){
                            var clase = 'success';
                            var nombre = 'Extorno';
                        }else{
                            var clase = 'warning';
                            var nombre = 'Extorno';
                        }
                        var cadena ='';
                        if (nombre=='Extorno') {
                            var url_extorno = "{{ url('/deudas-extornar/') }}"+"/"+data;
                            var cadena = '<a href="'+url_extorno+'" class="btn btn-'+clase+' btn-xs pagar"';
                                cadena += '>'+nombre+'</a>';                            
                        } else {
                            var cadena = '<button type="button" href="#modalForm" class="btn btn-'+clase+' btn-xs pagar"';
                                cadena +='id="pagar"  data-toggle="modal" data-target="#exampleModal"';
                                cadena += ' data-iddeuda="'+data+'"';
                                cadena += '>'+nombre+'</button>';
                        }
                        return cadena;
                    }
                }
            ],
            columns:[
                { "data": "id", "defaultContent":""},
                { "data": "monto", "defaultContent":""},
                { "data": "fecha_deuda", "defaultContent":""},
                { "data": "estado", "defaultContent":""},
                { "data": "fecha", "defaultContent":""},
                { "data": "concepto", "defaultContent":""},
                { "data": "actividad", "defaultContent":""},
                { "data": "miembro", "defaultContent":""},
                { "data": "descripcion", "defaultContent":""},
                { "data": "contabilizar", "defaultContent":""},
                { "data": "id", "defaultContent":""},
            ]
        });
    }
    $(function() {
        $('#exampleModal').on('show.bs.modal', function (event) {
            var boton = $(event.relatedTarget);
            var iddeuda = boton.data('iddeuda');
            var modal = $(this);
            modal.find('.modal-body #iddeuda').val(iddeuda);

        });

    });

</script>
@endsection
@section('titulo-pagina','Deudas Dashboard')