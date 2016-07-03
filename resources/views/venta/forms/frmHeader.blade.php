<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
	{!!Form::label('tipo_doc','Tipo Documento')!!}
	{!!Form::select('tipo_doc',[ 'Boleta'=>'Boleta' , 'Factura'=>'Factura' ],null,['placeholder'=>'Seleccione tipo','class'=>'form-control','id'=>'tipo_doc'])!!}
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

<div class="hidden" id="frameFactura">
    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
        {!!Form::label('ruc','RUC:' , ['class' => 'control-label ' ] )!!}
        {!!Form::text('ruc',$data["ruc"],['class'=>'form-control '])!!}
        <i class="glyphicon glyphicon-console form-control-feedback"></i>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback">
        {!!Form::label('razon_social','Razón social:' , ['class' => 'control-label ' ] )!!}
        {!!Form::text('razon_social',$data["razon_social"],['class'=>'form-control '])!!}
        <i class="glyphicon glyphicon-user form-control-feedback"></i>
    </div>
</div>