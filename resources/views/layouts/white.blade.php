<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('titulo')</title>

    <!-- Bootstrap core CSS -->
    <link href="" rel="stylesheet">
    {!!Html::style('css/bootstrap.min.css')!!}

    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('fonts/css/font-awesome.min.css')!!}
    {!!Html::style('css/animate.min.css')!!}

    <!-- Custom styling plus plugins -->
    {!!Html::style('css/custom.css')!!}
    {!!Html::style('css/maps/jquery-jvectormap-2.0.1.css')!!}
    {!!Html::style('css/icheck/flat/green.css')!!}
    {!!Html::style('css/floatexamples.css')!!}

    {!!Html::script('js/jquery.min.js')!!}
    {!!Html::script('js/nprogress.js')!!}
    
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,900' rel='stylesheet' type='text/css'>

@section('losCSS')
@show

<script>
    var _token = '<?php if( isset($data['token']) ){ echo $data['token']; } ?>';
    var _url = '{{ 'http://'.$_SERVER['HTTP_HOST'] }}';
    var _servicio = '';
    var _csrf_token = '{{ csrf_token() }}';
</script>

@section('jsHeader')
@show

</head>


<body class="nav-md-pdf">

    <div class="container body">


        <div class="main_container">



            <!-- top navigation -->

            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
    
    {!!Html::script('js/bootstrap.min.js')!!}

    

@section('scripts')
@show

    
</body>

</html>

