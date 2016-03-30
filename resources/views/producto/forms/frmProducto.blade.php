
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    {!!Form::label('nombre','Nombre (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::text('nombre',null,['class'=>'form-control ','autofocus'=>'true'])!!}
</div>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    {!!Form::label('descripcion','Descripción (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::textarea('descripcion',null,['class'=>'form-control ','size'=>'1x1'])!!}
</div>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    {!!Form::label('id_categoria','Categoría (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::select('id_categoria', $data['categoria'] ,null,[ 'id' => 'id_categoria', 'rel' => 'categoria', 'placeholder'=>'Seleccione','class'=>'form-control combito'])!!}
    {!!Form::hidden('categoria',null,['id' => 'categoria'])!!}
</div>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    {!!Form::label('marca','Marca (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::select('id_marca', $data['marca'] ,null,[ 'id' => 'id_marca', 'rel' => 'marca', 'placeholder'=>'Seleccione','class'=>'form-control combito'])!!}
    {!!Form::hidden('marca',null,['id' => 'marca'])!!}
</div>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    {!!Form::label('id_clase','Clase (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::select('id_clase', $data['clase'] ,null,[ 'id' => 'id_clase', 'rel' => 'clase', 'placeholder'=>'Seleccione','class'=>'form-control combito'])!!}
    {!!Form::hidden('clase',null,['id' => 'clase'])!!}
</div>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    {!!Form::label('proveedor','Proveedor (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::select('id_proveedor', $data['proveedor'] ,null,[ 'id' => 'id_proveedor', 'rel' => 'proveedor', 'placeholder'=>'Seleccione','class'=>'form-control combito'])!!}
    {!!Form::hidden('proveedor',null,['id' => 'proveedor'])!!}
</div>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    {!!Form::label('laboratorio','Laboratorio (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::text('laboratorio',null,['class'=>'form-control '])!!}
</div>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    {!!Form::label('destacado','Destacado (*):' , ['class' => 'control-label ' ] )!!}
    {!!Form::select('destacado', ['Si','No'] ,null,['placeholder'=>'Seleccione','class'=>'form-control'])!!}
</div>
