<div id="frmBuscarProds" class="col-md-12 col-sm-12 col-xs-12"  >
    <div class="panel panel-primary">
        <div class="panel-heading">Buscar productos</div>
        <div class="panel-body">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Productos <small>Productos activos</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#frmNuevoProd" ><span class="glyphicon glyphicon-plus" ></span> Agregar nuevo producto</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class=" table table-bordered " id="tblProductos">
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
                            @foreach($data['productos'] as $producto)
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

                </div>
            </div>
        </div>
    </div>
</div>