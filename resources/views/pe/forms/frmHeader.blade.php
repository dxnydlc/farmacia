
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    {!!Form::label('proveedor','Proveedor (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::select('id_proveedor', $data['proveedor'] ,null,[ 'id' => 'id_proveedor', 'rel' => 'proveedor', 'placeholder'=>'Seleccione','class'=>'form-control combito'])!!}
    {!!Form::hidden('proveedor',null,['id' => 'proveedor'])!!}
</div>


<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    {!!Form::label('nombre','Fecha (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::text('nombre',$data["fecha"],['class'=>'form-control '])!!}
</div>

