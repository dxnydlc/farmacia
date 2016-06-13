@extends('layouts.principal')

@section('titulo')
    Farmacia | Kardex
@stop

@section('losCSS')
    {!!Html::style('js/alertify/css/alertify.css')!!}
    {!!Html::style('js/alertify/css/themes/bootstrap.css')!!}
@endsection

@section('content')

<input type="hidden" id="token" value="{{ csrf_token() }}" >
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>
			        Kardex
			        <small>
			            Movimiento de productos del almacen
			        </small>
			    </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar por...">
                        <span class="input-group-btn">
                <button class="btn btn-default" type="button">Buscar</button>
            </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
	   
        @include('alertas.success')
        @include('alertas.errors')
		

		<div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Kardex <small>mostrando todos los registros activos</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Opción 1</a>
                                    </li>
                                    <li><a href="#">Opción 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="5" class="text-primary text-center" >Detalle</th>
                                    <th colspan="3" class="text-success text-center" >Entrada</th>
                                    <th colspan="3" class="text-muted text-center" >Salida</th>
                                    <th colspan="3" class="text-info text-center" >Saldos</th>
                                </tr>
                                <tr>
                                    <th class="text-primary" >#</th>
                                    <th class="text-primary" >M</th>
                                    <th class="text-primary" >Fecha</th>
                                    <th class="text-primary" >Producto</th>
                                    <th class="text-primary" >Documento</th>
                                    <th class="text-success" >Cantidad</th>
                                    <th class="text-success" >Precio</th>
                                    <th class="text-success" >Total</th>
                                    <th class="text-muted" >Cantidad</th>
                                    <th class="text-muted" >Precio</th>
                                    <th class="text-muted" >Total</th>
                                    <th class="text-info" >Cantidad</th>
                                    <th class="text-info" >Precio</th>
                                    <th class="text-info" >Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataKarex as $kdx)
                                <tr id="fila_{{$kdx->id}}" >
                                    <th class="text-primary"  scope="row">{{$kdx->id}}</th>
                                    <td class="text-primary" >{{$kdx->movimiento}}</td>
                                    <td class="text-primary" >{{$kdx->fecha}}</td>
                                    <td class="text-primary" >{{$kdx->producto}}</td>
                                    <td class="text-primary" >{{$kdx->documento.' '.$kdx->numero_doc}}</td>
                                    <td class="text-success" >{{$kdx->cantidad_e}}</td>
                                    <td class="text-success" >{{$kdx->precio_e}}</td>
                                    <td class="text-success" >{{$kdx->valor_e}}</td>
                                    <td class="text-muted" >{{$kdx->cantidad_s}}</td>
                                    <td class="text-muted" >{{$kdx->precio_s}}</td>
                                    <td class="text-muted" >{{$kdx->valor_s}}</td>
                                    <td class="text-info" >{{$kdx->cantidad_f}}</td>
                                    <td class="text-info" >{{$kdx->precio_f}}</td>
                                    <td class="text-info" >{{$kdx->valor_f}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- row -->

    </div>

    <!-- footer content -->
    @include('layouts.footer')
    <!-- /footer content -->


@section('scripts')

    <!-- Aletify -->
    {!!Html::script('js/alertify/alertify.js')!!}

	<!-- icheck -->
    {!!Html::script('js/icheck/icheck.min.js')!!}

    <!-- bootstrap progress js -->
    {!!Html::script('js/progressbar/bootstrap-progressbar.min.js')!!}
    {!!Html::script('js/nicescroll/jquery.nicescroll.min.js')!!}

    {!!Html::script('js/custom.js')!!}

    {!!Html::script('js/custom/pe.js')!!}

@endsection

@stop