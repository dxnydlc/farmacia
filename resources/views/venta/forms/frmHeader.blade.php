<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
	{!!Form::label('tipo_doc','Tipo Documento')!!}
	{!!Form::select('tipo_doc',[ 'B'=>'Boleta' , 'F'=>'Factura' ],null,['placeholder'=>'Seleccione tipo','class'=>'form-control'])!!}
</div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
    {!!Form::label('serie','Serie (*):' , ['class' => 'control-label ' ] )!!}
	{!!Form::text('serie',$data["serie"],['class'=>'form-control '])!!}
	<i class="glyphicon glyphicon-edit form-control-feedback"></i>
</div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
    {!!Form::label('correlativo','Correlativo (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::text('correlativo',$data["correlativo"],['class'=>'form-control '])!!}
    <i class="glyphicon glyphicon-edit form-control-feedback"></i>
</div>

<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
    {!!Form::label('cliente','Cliente (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::select('id_cliente', $data['clientes'] ,null,[ 'id' => 'id_cliente', 'rel' => 'cliente', 'placeholder'=>'Seleccione','class'=>'form-control combito'])!!}
    {!!Form::hidden('cliente',null,['id' => 'cliente'])!!}
    {!!Form::hidden('tokenDoc',null,['id' => 'tokenDoc'])!!}
</div>


<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
    {!!Form::label('fecha','Fecha (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::text('fecha',$data["fecha"],['class'=>'form-control '])!!}
    <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
</div>