@extends('layouts.principal')

@section('titulo')
    Farmacia | add Venta
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
                    <h2>Ventas <small>Agregando un nuevo documento</small></h2>
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
                    
                    {!!Form::open(['route'=>'ventas.store','method'=>'post','autocomplete'=>'off', 'class' => 'form-horizontal form-label-left' ,'data-parsley-validate', 'id' => 'frmHeader' ])!!}
                    	@include('venta.forms.frmHeader')

                    	<div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <a id="addProds" class="btn btn-default "><i class="fa fa-plus"></i> Agregar Productos</a>
                            </div>
                        </div>
                        <!-- /form-group -->

                        <!-- Buscar producto -->
                        @include('venta.forms.frmGrid')
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

                                    <table class="table table-condensed" id="tblItems" >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th  style="text-align:right" >Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $o = 1; ?>
                                        @foreach($data['items'] as $items)
                                            <tr>
                                                <th scope="row">{{$o}}</th>
                                                <td id="TD{{$o}}" tdnombre="bla bla bla" tdidProd="{{$items->id}}" >{{$items->id}}</td>
                                                <td>{{$items->producto}}</td>
                                                <td>{{$items->precio}}</td>
                                                <td>{{$items->cantidad}}</td>
                                                <td  style="text-align:right"  >{{$items->total}}</td>
                                                <td></td>
                                            </tr>
                                            <?php $o++; ?>
                                        @endforeach
                                            <tr id="newRow" >
                                                <th scope="row">#</th>
                                                <td callback="prod" id="TD{{$o}}" class="" >- Producto -</td>
                                                <th id="nwprecio" callback="lab" >- Precio -</th>
                                                <td id="nwCant" callback="lote" >- Cantidad -</td>
                                                <th id="nwTotal" callback="total" >- Cantidad -</th>
                                                <td callback="ok">
                                                    <a href="#" class="btn btn-success" ><span class="glyphicon glyphicon-ok" ></span></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <table class="table table-condensed" >
                                        <tbody>
                                            <tr>
                                                <th colspan="4" style="text-align:right" >Sub Total</th>
                                                <th style="text-align:right" >80.00</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th colspan="4" style="text-align:right" >IGV</th>
                                                <th style="text-align:right" >18.00</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th colspan="4" style="text-align:right" >Total</th>
                                                <th style="text-align:right" >100.00</th>
                                                <th></th>
                                            </tr>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>

                        @include('venta.forms.frmPago')

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 ">
                                <a href="/pe" class="btn btn-default">Cancelar</a>
                                <?php if( count($data['items']) > 0 ){ ?>
                                <button  type="submit" class="btn btn-success btn-lg ">Guardar</button>
                                <?php } ?>
                            </div>
                        </div>

                    {!!Form::close()!!}

                </div>
            </div>
        </div>
        
    </div>

<div class="hidden">
{!!Form::open(['route'=>'detventa.store','method'=>'post','id'=>'frmPE' ])!!}
    <input type="text" name="producto" id="producto" value="" placeholder="producto" />
    <input type="text" name="id_producto" id="id_producto" value="" placeholder="id_producto" />
    <input type="text" name="cantidad" id="cantidad" value="" placeholder="cantidad" />
    <input type="text" name="precio" id="precio" value="" placeholder="precio" />
    <input type="text" name="total" id="total" value="" placeholder="total" />
    <input type="text" name="descuento" id="descuento" value="" placeholder="descuento" />
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



<!-- Modal -->
<div class="modal fade" id="frmNuevoProd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar producto no existente</h4>
      </div>
      <div class="modal-body">
        {!!Form::open(['route'=>'detventa.store','method'=>'post','id'=>'frmProductoLote' ])!!}
            <input type="hidden" name="tokenPL" id="tokenPL" />
            <div class="col-md-4 col-sm-3 col-xs-12 form-group has-feedback">
                <label for="producto">Producto</label>
                <input type="text" class="form-control" id="producto" name="producto" >
            </div><!-- /form-group -->
            <div class="col-md-4 col-sm-3 col-xs-12 form-group has-feedback">
                <label for="laboratorio">Laboratorio</label>
                <input type="text" class="form-control" id="laboratorio" name="laboratorio" >
            </div><!-- /form-group -->
            <div class="col-md-4 col-sm-3 col-xs-12 form-group has-feedback">
                <label for="lote">Lote</label>
                <input type="text" class="form-control" id="lote" name="lote" >
            </div><!-- /form-group -->
            <div class="col-md-4 col-sm-3 col-xs-12 form-group has-feedback">
                <label for="vencimiento">Vencimiento</label>
                <input type="text" class="form-control" id="vencimiento" name="vencimiento" >
            </div><!-- /form-group -->
            <div class="col-md-4 col-sm-3 col-xs-12 form-group has-feedback">
                <label for="precio">Precio</label>
                <input type="text" class="form-control" id="precio" name="precio" >
            </div><!-- /form-group -->
        {!!Form::close()!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="addProdLote" type="button" class="btn btn-primary">Guardar cambios</button>
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

    {!!Html::script('js/custom/addVenta.js')!!}

    {!!Html::script('js/custom/funciones.js')!!}

    

@endsection

@stop
