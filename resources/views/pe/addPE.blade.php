@extends('layouts.principal')

@section('titulo')
    Farmacia | add Parte Entrada
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
                    
                    {!!Form::open(['route'=>'pe.store','method'=>'post','autocomplete'=>'off', 'class' => 'form-horizontal form-label-left' ,'data-parsley-validate', 'id' => 'frmHeader' ])!!}
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
                                    <h2>Productos <small id="todoTren">Actualmente en el documento</small></h2>
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
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $o = 1; ?>
                                        @foreach($data['items'] as $items)
                                            <tr>
                                                <th scope="row">{{$o}}</th>
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
                                            <tr id="newRow" >
                                                <th scope="row">#</th>
                                                <td callback="prod" id="TD{{$o}}" class="" >- Producto -</td>
                                                <td id="nwlaboratorio" callback="lab" >- Laboratorio -</td>
                                                <td id="nwLote" callback="lote" >- Lote -</td>
                                                <td id="nwVcto" callback="vcto" >- Vencimiento -</td>
                                                <td id="nwCant" callback="cant" >- Cantidad -</td>
                                                <td id="nwCompra" callback="comp" >- Compra -</td>
                                                <td id="nwVenta" callback="vta" >- Venta -</td>
                                                <th id="nwUtil" callback="%" >0</th>
                                                <td callback="ok">
                                                    <a href="#" class="btn btn-success" ><span class="glyphicon glyphicon-ok" ></span></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                <a href="/pe" class="btn btn-default">Cancelar</a>
                                <?php if( count($data['items']) > 0 ){ ?>
                                <button id="saveFormEEEEEE" type="submit" class="btn btn-success btn-lg ">Guardar</button>
                                <?php } ?>
                            </div>
                        </div>

                    {!!Form::close()!!}

                </div>
            </div>
        </div>
        
    </div>

<div class="hidden">
{!!Form::open(['route'=>'detpe.store','method'=>'post','id'=>'frmPE' ])!!}
    <input type="text" name="producto" id="producto" value="" placeholder="producto" />
    <input type="text" name="id_producto" id="id_producto" value="" placeholder="id_producto" />
    <input type="text" name="laboratorio" id="laboratorio" value="" placeholder="laboratorio" />
    <input type="text" name="vencimiento" id="vencimiento" value="" placeholder="vencimiento" />
    <input type="text" name="lote" id="lote" value="" placeholder="lote" />
    <input type="text" name="cantidad" id="cantidad" value="" placeholder="cantidad" />
    <input type="text" name="compra" id="compra" value="" placeholder="compra" />
    <input type="text" name="venta" id="venta" value="" placeholder="venta" />
    <input type="text" name="utilidad" id="utilidad" value="0" placeholder="utilidad" />
    <input type="text" name="fraccion" id="fraccion" value="1" placeholder="fraccion" />
    <input type="text" name="token" id="token" value="" placeholder="token" />
{!!Form::close()!!}
</div>

<!-- Datepicker -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Seleccione Fecha</h4>
      </div>
      <div class="modal-body">
        <div id="datePicker" ></div>
        <input type="hidden" id="vencimientoFecha" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="addFecha" type="button" class="btn btn-primary">Agregar</button>
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
