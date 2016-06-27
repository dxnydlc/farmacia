<div class="form-group">
	{!!Form::label('name','Nombre (*):')!!}
	{!!Form::text('name',null,['class'=>'form-control','autofocus'=>'true'])!!}
	<p class="help-block">Nombres del cliente</p>
</div>

<div class="form-group">
	{!!Form::label('last_name','Apellidos:')!!}
	{!!Form::text('last_name',null,['class'=>'form-control'])!!}
	<p class="help-block">Apellidos del cliente</p>
</div>

<div class="form-group">
	{!!Form::label('user','Usuario (*):')!!}
	{!!Form::text('user',null,['class'=>'form-control'])!!}
	<p class="help-block">Usuario para iniciar session</p>
</div>

<div class="form-group">
	{!!Form::label('dni','DNI (*):')!!}
	{!!Form::text('dni',null,['class'=>'form-control'])!!}
	<p class="help-block">DNI o carnet de extrangería</p>
</div>

<div class="form-group">
	{!!Form::label('email','Correo (*):')!!}
	{!!Form::text('email',null,['class'=>'form-control'])!!}
	<p class="help-block">Correo electrónico</p>
</div>

<div class="form-group">
	{!!Form::label('type','Tipo Usuario:')!!}
	{!!Form::select('type',[ 'normal'=>'Estándar' , 'admin'=>'Administrador' ],null,['placeholder'=>'Seleccione tipo','class'=>'form-control'])!!}
    <p class="help-block">Tipo de habitación</p>
</div>
<!-- form-group -->

<div class="form-group">
	{!!Form::label('password','Password:')!!}
	{!!Form::password('password',['class'=>'form-control'])!!}
	<p class="help-block">Contraseña de ingreso al sistema</p>
</div>