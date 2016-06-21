@extends('layouts.principal')

@section('titulo')
    Farmacia | invoice Ventas
@stop

@section('losCSS')
    
    {!!Html::style('js/data_table/datatables.min.css')!!}
    {!!Html::style('js/alertify/css/themes/bootstrap.css')!!}

    {!!Html::style('js/sweet-alert/dist/sweetalert.css')!!}

    {!!Html::style('js/datepicker/css/bootstrap-datepicker.css')!!}

@endsection

@section('content')

    <div class="row">
        
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Venta <small>Invoice</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    
    <div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <i class="fa fa-search-plus pull-left icon"></i>
                <?php switch ($data['venta']->tipo_doc) {
                    case 'B':
                        $tipo_doc = 'Boleta';
                        $cols = 4;
                    break;
                    case 'F':
                        $tipo_doc = 'Factura';
                        $cols = 3;
                    break;
                } ?>
                <h2>Invoice {{$tipo_doc}} #{{ $data['venta']->serie.' - '.$data['venta']->correlativo }}</h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-{{$cols}} col-lg-{{$cols}} pull-left">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Cliente</div>
                        <div class="panel-body">
                            {{ $data['venta']->cliente }}
                            <br/>
                            <?php list($anio,$mes,$dia) = explode('-', $data['venta']->fecha ); $fecha = $dia.'/'.$mes.'/'.$anio; ?>
                            {{ $fecha }}
                        </div>
                    </div>
                    
                </div>
                <?php if( $data['venta']->tipo_doc == 'F' ){ ?>
                <div class="col-xs-12 col-md-{{$cols}} col-lg-{{$cols}}">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Empresa</div>
                        <div class="panel-body">
                            {{ $data['venta']->razon_social }}
                            <br/>
                            {{ $data['venta']->ruc }}
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="col-xs-12 col-md-{{$cols}} col-lg-{{$cols}}">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Creado por</div>
                        <div class="panel-body">
                            <strong>{{ $data['venta']->user_creado }}</strong><br>
                            {{ $data['venta']->created_at }}
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-{{$cols}} col-lg-{{$cols}} pull-right">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Cerrado por</div>
                        <div class="panel-body">
                            <strong>{{ $data['venta']->user }}</strong><br>
                            {{ $data['venta']->updated_at }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title"><h3 class="text-center"><strong>Detalle Productos</strong></h3></div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th class="fuente-r" >Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $o = 1; $totalDoc = 0; ?>
                                @foreach($data['items'] as $items)
                                <?php
                                list($anio,$mes,$dia) = explode('-', $items->vencimiento );
                                $fecha = $dia.'/'.$mes.'/'.$anio;
                                ?>
                                    <tr >
                                        <th scope="row">{{$o}}</th>
                                        <th class="fuente-l tdTabla" id="TD{{$o}}" tdnombre="{{$items->producto}}" tdidProd="{{$items->id}}" >{{$items->producto}}<br><small>Lote:{{$items->lote}}, Vence: {{$fecha}}</small></th>
                                        <th class="fuente-r tdTabla" >{{$items->precio}}</th>
                                        <th class="fuente-r tdTabla" >{{$items->cantidad}}</th>
                                        <th class="fuente-r tdTabla" >{{$items->total}}</th>
                                    </tr>
                                    <?php $o++; $totalDoc = $totalDoc + $items->total;?>
                                @endforeach
                                    <?php 
                                    #Calculando montos
                                    $totalDoc = number_format($totalDoc,2); $igv = ($totalDoc * 18) / 100;
                                    $subtotal = $totalDoc - $igv; 
                                    ?>
                                    <tr>
                                        <th colspan="4" class="fuente-r" >Sub Total</th>
                                        <th class="fuente-r" >{{$subtotal}}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="fuente-r" >IGV</th>
                                        <th class="fuente-r" >{{$igv}}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="fuente-r" >Total</th>
                                        <th class="fuente-r" >{{$totalDoc}}</th>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php
switch ($data['venta']->forma_pago) {
    case 'E':
        $forma_pago = 'Efectivo';
    break;
}
?>
    <div class="row">
        <div class="col-xs-12 col-md-4 col-lg-4 pull-left">
            <div class="panel panel-default height">
                <div class="panel-heading">Forma de Pago</div>
                <div class="panel-body">
                    {{ $forma_pago }}
                    <br/>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4 pull-left">
            <div class="panel panel-default height">
                <div class="panel-heading">Pago</div>
                <div class="panel-body">
                    {{ $data['venta']->pago_efectivo }}
                    <br/>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4 col-lg-4 pull-left">
            <div class="panel panel-default height">
                <div class="panel-heading">Vuelto</div>
                <div class="panel-body">
                    {{ $data['venta']->vuelto }}
                    <br/>
                </div>
            </div>
        </div>
    </div>

<!-- Seccion de log del documento -->
<div class="row">
    <div class=" col-lg-12 col-md-10 col-sm-10 col-xs-10 ">
    
    <div class="x_panel">
        <div class="x_title"><p>Registro de eventos</p></div>
        <div class="x_content">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Contenido</th>
                        <th>Resultado</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['logs'] as $items)
                    <tr>
                        <td>{{$items->evento}}</td>
                        <td>{{$items->contenido}}</td>
                        <td>{{$items->resultado}}</td>
                        <td>{{$items->fecha}}</td>
                        <td>{{$items->usuario}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    

            
    </div>
</div>

<div class="row">
    <div class="col-lg-2 col-lg-offset-1 " >
        <a href="/pe" class="btn btn-default btn-lg btn-block" >Regresar</a>
    </div>
    <!--<div class="col-lg-2 col-lg-offset-1 " >
        <a href="#" class="btn btn-primary btn-lg btn-block" >Imprimir</a>
    </div>-->
</div>

                </div>

            </div>
        </div>
        
    </div>






@section('scripts')

    <!-- Aletify -->
    {!!Html::script('js/alertify/alertify.js')!!}

    <!-- icheck -->
    {!!Html::script('js/icheck/icheck.min.js')!!}

    <!-- bootstrap progress js -->
    {!!Html::script('js/progressbar/bootstrap-progressbar.min.js')!!}
    {!!Html::script('js/nicescroll/jquery.nicescroll.min.js')!!}

    {!!Html::script('js/data_table/datatables.js')!!}
    {!!Html::script('js/sweet-alert/dist/sweetalert.js')!!}

    {!!Html::script('js/keynaigator/keynavigator.js')!!}
    <!--{!!Html::script('js/keynaigator/require.min.js')!!}-->

    {!!Html::script('js/datepicker/js/bootstrap-datepicker.js')!!}
    {!!Html::script('js/datepicker/locales/bootstrap-datepicker.es.min.js')!!}

    {!!Html::script('js/custom.js')!!}

    {!!Html::script('js/custom/addPE.js')!!}

    {!!Html::script('js/custom/funciones.js')!!}

    

@endsection

@stop
