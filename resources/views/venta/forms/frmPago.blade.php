<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
	{!!Form::label('forma_pago','Forma de Pago')!!}
	{!!Form::select('forma_pago',[ 'E'=>'Efectivo' , 'T'=>'Tarjeta' ],$data["forma_pago"],['placeholder'=>'Seleccione','class'=>'form-control','id'=>'forma_pago'])!!}
</div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
    {!!Form::label('pago_efectivo','Efectivo:' , ['class' => 'control-label ' ] )!!}
	{!!Form::text('pago_efectivo',$data["pago_efectivo"],['class'=>'form-control ','id'=>'pago_efectivo'])!!}
	<i class="glyphicon glyphicon-usd form-control-feedback"></i>
</div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
    {!!Form::label('vuelto',' Vuelto:' , ['class' => 'control-label ' ] )!!}
    {!!Form::text('vuelto',$data["vuelto"],['class'=>'form-control ','readonly'=>'readonly','id'=>'vuelto'])!!}
    <i class="glyphicon glyphicon-usd form-control-feedback"></i>
</div>