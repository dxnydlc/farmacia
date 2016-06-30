@extends('layouts.principal')

@section('titulo')
    Farmacia | Inicio
@stop

<?php
if( count($data['header_vta']) > 0 )
{
    $arreglo = array();
    foreach ($data['header_vta'] as $key => $rs) {
        $o = array();
        $o['x'] = $rs->date;
        $o['y'] = $rs->total;
        array_push( $arreglo , $o );
    }
    unset($rs);
}
?>

@section('jsHeader')
<script>
    var _dataGrafico = <?php echo json_encode( $arreglo ) ?>;
</script>
@endsection

@section('content')

<!-- top tiles -->
<!-- /top tiles -->


<br />

@include('alertas.success')
@include('alertas.errors')

<div class="row">
    <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Ventas <small>Semanal</small></h2>
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
                <div class="dashboard-widget-content">
                    <table class="table" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <?php $o = 1 ?>
                        <tbody>
                            @foreach($data['header_vta'] as $rs)
                            <tr>
                                <td>{{$o++}}</td>
                                <td>
                                    <a href="/ventas_fecha/{{$rs->date}}">{{$rs->fecha}}</a>
                                </td>
                                <td class="text-right">{{$rs->total}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="x_panel">
                    <div id="graph"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /col -->
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Actividad Reciente <small>Registro</small></h2>
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
                <div class="dashboard-widget-content">

                    <ul class="list-unstyled timeline widget">
                    <?php 
                    if( count($data['logs']) > 0 ){ 
                        foreach ($data['logs'] as $key => $rs) {
                    ?>
                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a href="{{$rs['link_to']}}" >{{$rs['evento']}}</a>
                                        </h2>
                                        <div class="byline">
                                            <span>Hace {{$rs['tiempo']}} </span> por <a>{{$rs['usuario']}}</a>
                                        </div>
                                        <p class="excerpt">{{$rs['contenido']}}</p>
                                    </div>
                                </div>
                            </li>
                    <?php
                        }
                    }
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    

</div>

<!-- footer content -->
@include('layouts.footer')
<!-- /footer content -->

@section('scripts')

    <!-- gauge js -->
    {!!Html::script('js/gauge/gauge.min.js')!!}
    {!!Html::script('js/gauge/gauge_demo.js')!!}

    <!-- chart js -->
    {!!Html::script('js/moris/morris.js')!!}
    {!!Html::script('js/moris/raphael-min.js')!!}

    <!-- bootstrap progress js -->
    {!!Html::script('js/progressbar/bootstrap-progressbar.min.js')!!}
    {!!Html::script('js/nicescroll/jquery.nicescroll.min.js')!!}

    <!-- icheck -->
    {!!Html::script('js/icheck/icheck.min.js')!!}

    <!-- daterangepicker -->
    {!!Html::script('js/moment.min.js')!!}
    {!!Html::script('js/datepicker/daterangepicker.js')!!}
    
    {!!Html::script('js/custom.js')!!}

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    {!!Html::script('js/flot/jquery.flot.js')!!}
    {!!Html::script('js/flot/jquery.flot.pie.js')!!}
    {!!Html::script('js/flot/jquery.flot.orderBars.js')!!}
    {!!Html::script('js/flot/jquery.flot.time.min.js')!!}
    {!!Html::script('js/flot/date.js')!!}
    {!!Html::script('js/flot/jquery.flot.spline.js')!!}
    {!!Html::script('js/flot/jquery.flot.stack.js')!!}
    {!!Html::script('js/flot/curvedLines.js')!!}
    {!!Html::script('js/flot/jquery.flot.resize.js')!!}

    <script>
        $(document).ready(function () {
            // Use Morris.Area instead of Morris.Line
            Morris.Area({
              element: 'graph',
              data: _dataGrafico,
              xkey: 'x',
              ykeys: 'y',
              labels: 'y'
            }).on('click', function(i, row){
              console.log(i, row);
            });
        });
    </script>

    <!-- worldmap -->
    {!!Html::script('js/maps/jquery-jvectormap-2.0.1.min.js')!!}
    {!!Html::script('js/maps/gdp-data.js')!!}
    {!!Html::script('js/maps/jquery-jvectormap-world-mill-en.js')!!}
    {!!Html::script('js/maps/jquery-jvectormap-us-aea-en.js')!!}
    <!-- pace -->
    {!!Html::script('js/pace/pace.min.js')!!}


    <!-- skycons -->
    {!!Html::script('js/skycons/skycons.js')!!}

    <!-- dashbord linegraph -->
    <!-- /dashbord linegraph -->
    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {
            //
        });
    </script>
    <script>
        NProgress.done();
    </script>
    <!-- /datepicker -->
    <!-- /footer content -->
@endsection


@stop