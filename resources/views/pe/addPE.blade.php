@extends('layouts.principal')

@section('titulo')
    Farmacia | add Parte Entrada
@stop

@section('losCSS')
    
    {!!Html::style('js/data_table/datatables.min.css')!!}
    {!!Html::style('js/alertify/css/themes/bootstrap.css')!!}

    {!!Html::style('js/sweet-alert/dist/sweetalert.css')!!}

@endsection

@section('content')

	<div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Parte Entrada <small>Agregando un nuevo documento</small></h2>
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
                    <br />
                    @include('alertas.userRequest')
                    
                    {!!Form::open(['route'=>'pe.store','method'=>'post','autocomplete'=>'off', 'class' => 'form-horizontal form-label-left' ,'data-parsley-validate' ])!!}
                    	@include('pe.forms.frmHeader')

                    	<div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <a id="addProds" class="btn btn-default "><i class="fa fa-plus"></i> Agregar Productos</a>
                            </div>
                        </div>
                        <!-- /form-group -->

                        <!-- Buscar producto -->
                        @include('pe.forms.frmGrid')
                        <!-- /Buscar producto -->

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Productos <small>Actualmente en el documento</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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

                                    <table class="table" id="tblItems" >
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
                                            <tr>
                                                <th scope="row">1</th>
                                                <td tdnombre="bla bla bla" >Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>Otto</td>
                                                <td>24</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>Otto</td>
                                                <td>24</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td>Otto</td>
                                                <td>24</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a href="/categoria" class="btn btn-primary">Cancelar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>

                    {!!Form::close()!!}

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

    {!!Html::script('http://nekman.github.io/keynavigator/keynavigator.js')!!}
    {!!Html::script('http://cdnjs.cloudflare.com/ajax/libs/require.js/2.1.5/require.min.js')!!}

    {!!Html::script('js/custom.js')!!}

    {!!Html::script('js/custom/addPE.js')!!}

    {!!Html::script('js/custom/funciones.js')!!}

    

@endsection

@stop
