<div class="form-group">
	{!!Form::label('nombre','Nombre (*):' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
    	{!!Form::text('nombre',null,['class'=>'form-control col-md-7 col-xs-12','autofocus'=>'true'])!!}
    </div>
</div>
<div class="form-group">
	{!!Form::label('ruc','RUC (*):' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
    	{!!Form::text('ruc',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
    </div>
</div>

<div class="form-group">
	{!!Form::label('direccion','Dirección (*):' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
    	{!!Form::text('direccion',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
    </div>
</div>

<div class="form-group">
	{!!Form::label('telefono','Teléfono (*):' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
    	{!!Form::text('telefono',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
    </div>
</div>

<div class="form-group">
	{!!Form::label('contacto','Contacto :' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
    	{!!Form::text('contacto',null,['class'=>'form-control col-md-7 col-xs-12'])!!}
    </div>
</div>
