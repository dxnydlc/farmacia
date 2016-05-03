<div id="frmBuscarProds" class="col-md-12 col-sm-12 col-xs-12"  >
    <div class="x_panel">
        <div class="x_title">
            <h2>Basic Tables <small>basic table subtitle</small></h2>
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

            <table class=" table table-bordered " id="tblProductos">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>Clase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['productos'] as $producto)
                    <tr>
                        <th scope="row">{{$producto->id_producto}}</th>
                        <td class="CRUD" tdnombre="{{$producto->nombre}}" tdid="{{$producto->id_producto}}" >
                            {{$producto->nombre}}
                        </td>
                        <td>{{$producto->categoria}}</td>
                        <td>{{$producto->marca}}</td>
                        <td>{{$producto->clase}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>