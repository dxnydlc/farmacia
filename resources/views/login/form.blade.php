<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Farmacia | Ingreso</title>

    <!-- Bootstrap core CSS -->
    {!!Html::style('css/bootstrap.min.css')!!}
    
    {!!Html::style('fonts/css/font-awesome.min.css')!!}
    {!!Html::style('css/animate.min.css')!!}

    <!-- Custom styling plus plugins -->
    {!!Html::style('css/custom.css')!!}
    {!!Html::style('css/icheck/flat/green.css')!!}

    {!!Html::script('js/jquery.min.js')!!}

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>
        
        @include('alertas.errors')
        @include('alertas.userRequest')
        
        <div id="wrapper">

        

            <div id="login" class="animate form">
                <section class="login_content">
                    {!!Form::open(['route'=>'login.store','method'=>'POST','autocomplete'=>'off','id'=>'frmLogin'])!!}
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <h1>Login Form</h1>
                        <div>
                            {!!Form::label('email','Correo (*):')!!}
                            {!!Form::text('email',null,['class'=>'form-control','autofocus'=>'true'])!!}
                        </div>
                        <div>
                            {!!Form::label('password','Password:')!!}
                            {!!Form::password('password',['class'=>'form-control'])!!}
                        </div>
                        <div>
                            <input type="submit" class="btn btn-default submit" value="Ingresar" >
                            <a class="reset_pass" href="#">Lost your password?</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">New to site?
                                <a href="#toregister" class="to_register"> Create Account </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                                <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                            </div>
                        </div>
                    {!!Form::close()!!}
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animate form">
                <section class="login_content">
                    <form>
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <a class="btn btn-default submit" href="index.html">Submit</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Gentelella Alela!</h1>

                                <p>©2015 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>