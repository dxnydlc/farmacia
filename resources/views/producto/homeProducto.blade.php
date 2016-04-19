@extends('layouts.principal')

@section('titulo')
    Farmacia | Productos
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
			        productos
			        <small>
			            productos para los productos
			        </small>
			    </h3>
            </div>

    <div class="title_right">
        {!!Form::open(['route'=>['producto.show', 'id' => 1],'method'=>'get','autocomplete'=>'off' ])!!}
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input id="q" name="q" type="text" class="form-control" placeholder="Buscar por...">
                <span class="input-group-btn">
                    <input type="submit" class="btn btn-default" value="Buscar">
                </span>
            </div>
        </div>
        {!!Form::close()!!}
    </div>

        </div>
        <div class="clearfix"></div>
	   
       @include('alertas.success')
        @include('alertas.errors')
		
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
	                <div class="x_content">
	                	<a href="producto/create" class="btn btn-default">Agregar producto</a>
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
                        <h2>productos <small>mostrando todos los registros activos</small></h2>
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

                        <table class="table" ng-table="vm.tableParams" show-filter="true" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Marca</th>
                                    <th>Clase</th>
                                    <th>Laboratorio</th>
                                    <th>Proveedor</th>
                                    <th>Creado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataProductos as $producto)
                                <tr>
                                    <th scope="row">{{$producto->id_producto}}</th>
                                    <td>
                                        {!!link_to_route('producto.edit', $title  = $producto->nombre, $parameters =$producto->id_producto, $attributes = ['class'=>'btn-link '] )!!}
                                    </td>
                                    <td>{{$producto->categoria}}</td>
                                    <td>{{$producto->marca}}</td>
                                    <td>{{$producto->clase}}</td>
                                    <td>{{$producto->laboratorio}}</td>
                                    <td>{{$producto->proveedor}}</td>
                                    <td>{{$producto->created_at}}</td>
                                    <td>
                                        {!!link_to_route('producto.edit', $title  = 'Anular', $parameters =$producto->id_producto, $attributes = ['class'=>'btn-link delCateg ','id'=>$producto->id_producto] )!!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{$dataProductos->render()}}

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

    {!!Html::script('js/custom/producto.js')!!}
    


@endsection

@stop