@extends('layouts.principal')

@section('titulo')
    Farmacia | Producto Lote
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
			        Producto
			        <small>
			            Producto que contienen un lote asignado
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

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                    <ul class="list-inline">
                        <li>
                            <a href="/ex_prodlote" class="btn btn-success "><span class="glyphicon glyphicon-floppy-save" ></span> Exportar</a>
                        </li>
                    </ul>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- row -->
		

		<div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Producto Lote <small>mostrando todos los registros activos</small></h2>
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
                                    <th>#</th>
	                                <th>Nombre</th>
	                                <th>Lote</th>
	                                <th>Lab.</th>
	                                <th>Vencimiento</th>
	                                <th>Precio</th>
	                                <th>Stock</th>
	                                <th>Tipo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $producto)
	                            <?php
	                            list($anio,$mes,$dia) = explode('-', $producto->vencimiento );
	                            $fecha = $dia.'/'.$mes.'/'.$anio;
	                            ?>
	                            <tr tdnombre="{{$producto->nombre}}" tdid="{{$producto->id_producto}}" tdlab="{{$producto->laboratorio}}" tdfecha="{{$fecha}}" tdprecio="{{$producto->precio}}" tdlote="{{$producto->lote}}" class=" deaPrecio " >
	                                <th scope="row">{{$producto->id_producto}}</th>
	                                <td class="CRUD"  >
	                                    {{$producto->nombre}}
	                                </td>
	                                <td>{{$producto->lote}}</td>
	                                <td>{{$producto->laboratorio}}</td>
	                                <td>{{$fecha}}</td>
	                                <td class="text-right" >{{$producto->precio}}</td>
	                                <td class="text-right" >{{$producto->stock}}</td>
	                                <td>{{$producto->clase}}</td>
	                            </tr>
	                            @endforeach
                            </tbody>
                        </table>
                        {{$data->render()}}

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
