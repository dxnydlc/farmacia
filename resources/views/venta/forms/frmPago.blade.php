<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
	{!!Form::label('forma_pago','Forma de Pago')!!}
	{!!Form::select('forma_pago',[ 'E'=>'Efectivo' , 'T'=>'Tarjeta' ],null,['placeholder'=>'Seleccione','class'=>'form-control'])!!}
</div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
    {!!Form::label('pago_efectivo','Efectivo:' , ['class' => 'control-label ' ] )!!}
	{!!Form::text('pago_efectivo',$data["efectivo"],['class'=>'form-control '])!!}
	<i class="glyphicon glyphicon-usd form-control-feedback"></i>
</div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
    {!!Form::label('vuelto','Correlativo (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::text('vuelto',$data["vuelto"],['class'=>'form-control '])!!}
    <i class="glyphicon glyphicon-usd form-control-feedback"></i>
</div>