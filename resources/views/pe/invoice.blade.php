@extends('layouts.principal')

@section('titulo')
    Farmacia | invoice Parte Entrada
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
                    <h2>Parte Entrada <small>Invoice</small></h2>
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
                <h2>Invoice Parte Entrada #{{ $data['pe']->id }}</h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-3 col-lg-3 pull-left">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Proveedor</div>
                        <div class="panel-body">
                            {{ $data['pe']->proveedor }}
                        </div>
                    </div>
                    
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Fecha</div>
                        <div class="panel-body">
                            {{ $data['pe']->fecha }}
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Creado por</div>
                        <div class="panel-body">
                            <strong>{{ $data['pe']->user }}</strong><br>
                            {{ $data['pe']->created_at }}
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 pull-right">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Cerrado por</div>
                        <div class="panel-body">
                            <strong>{{ $data['pe']->user }}</strong><br>
                            {{ $data['pe']->updated_at }}
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
                                    <th>Laboratorio</th>
                                    <th>Lote</th>
                                    <th>Vencimiento</th>
                                    <th>Cantidad</th>
                                    <th>Compra</th>
                                    <th>Venta</th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $o = 1; ?>
                                @foreach($data['items'] as $items)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td id="TD{{$o}}" tdnombre="bla bla bla" tdidProd="{{$items->id_producto}}" >{{$items->producto}}</td>
                                        <td>{{$items->laboratorio}}</td>
                                        <td>{{$items->lote}}</td>
                                        <td>{{$items->vencimiento}}</td>
                                        <td>{{$items->cantidad}}</td>
                                        <td>{{$items->compra}}</td>
                                        <td>{{$items->venta}}</td>
                                        <td>{{$items->utilidad.'%'}}</td>
                                        <td></td>
                                    </tr>
                                    <?php $o++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
