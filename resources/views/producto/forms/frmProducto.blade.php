<div class="form-group">
	{!!Form::label('nombre','Nombre (*):' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
    	{!!Form::text('nombre',null,['class'=>'form-control col-md-7 col-xs-12','autofocus'=>'true'])!!}
    </div>
</div>

<div class="form-group">
	{!!Form::label('descripcion','Descripción (*):' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
    	{!!Form::textarea('descripcion',null,['class'=>'form-control col-md-7 col-xs-12','size'=>'1x1'])!!}
    </div>
</div>

<div class="form-group">
	{!!Form::label('categoria','Categoría (*):' , ['class' => 'control-label col-md-3 col-sm-3 col-xs-12' ] )!!}
    <div class="col-md-6 col-sm-6 col-xs-12">
    	{!!Form::select('categoria', $categorias ,null,['placeholder'=>'Seleccione','class'=>'form-control'])!!}
    	{!!Form::hidden('id_categoria')!!}
    </div>
</div>