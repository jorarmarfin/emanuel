@extends('layouts.admin')

@section('content')
 
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'deudas.contabilizar', 'method' => 'post']) !!}
                    {!! Form::text('monto',null,['placeholder'=>'monto','size'=>'40','aria-required'=>'true','class'=>'form-control','id'=>'monto']) !!}
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
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
<!-- Modal Form -->
<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Registration Form</h2>
        </header>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6 mb-3 mb-lg-0">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Zip</label>
                        <input type="text" class="form-control" id="inputZip">
                    </div>
                </div>
            </form>
        </div>
        <footer class="card-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary modal-confirm">Submit</button>
                    <button class="btn btn-default modal-dismiss">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
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
        llenatabla('pagador',tblpagado);
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
                    targets:9,
                    render: function(data, type, row){
                        if (row.estado=='por pagar') {
                            var cadena = '<button type="button" href="#modalForm" class="btn btn-primary btn-xs pagar"';
                                cadena +='id="pagar"  data-toggle="modal" data-target="#exampleModal"';
                                cadena += ' data-monto="'+row.monto+'">Pagar</button>';
                            return cadena;
                        }else if(row.estado=='por cobrar'){
                            return '<a href="#" class="btn btn-danger btn-xs ">Cobrar</a>';
                        }
                    }
                }
            ],
            columns:[
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
            var monto = boton.data('monto');
            var modal = $(this);
            modal.find('.modal-body #monto').val(monto);

        });


    });

</script>
@endsection
@section('titulo-pagina','Deudas Dashboard')