var _rowCount = $('#tblItems tbody tr').length;
var _objProdTabla 	= '';
var _idOtro 		= _rowCount;
var _objProdhtml 	= 'TD'+_idOtro;
var _objProdBD 		= 'producto';
var _objProdidBD	= 'id_producto';
var _frmProdsOpen 	= false;
/*--------------------------------------*/
//console.log(_rowCount);
/*var _rowItems = $('table#tblItems > tbody tr td').keynavigator({
	activeClass: 'alert-success',
	keys:{
		13:function($el, cellIndex, e){
			console.log('pressed ENTER!', $el.attr('tdnombre') );
		}
	},
	parentFocusOn: 'mouseover'
});+/
/*--------------------------------------*/
/*--------------------------------------*/
var $rows = $('table#tblProductos > tbody tr ').keynavigator({
	activeClass: 'alert-success',
	parentFocusOn: 'mouseover',
	keys:{
		13:function($el, cellIndex, e){
			swal({
			  title: "Agregar Producto",
			  text: $el.attr('tdnombre'),
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonClass: "btn-success",
			  confirmButtonText: "Si, agregar!",
			  closeOnConfirm: false
			},
			function(){
				var _texto = $el.attr('tdnombre'), _deaID = $el.attr('tdid');
				if( $el.hasClass('deaPrecio') )
				{
					var _htmlProd = _texto+'<br><small>Lote: '+$el.attr('tdlote')+', Vence: '+$el.attr('tdfecha')+'</small>';
					var _precio = $el.attr('tdprecio');
					var _cantidad = $('#nwCant').html(), _total = 0;
					$('#nwprecio').html( _precio );
					$('#precio').val( _precio );
					$('#laboratorio').val( $el.attr('tdlab') );
					$('#lote').val( $el.attr('tdlote') );
					$('#vencimiento').val( $el.attr('tdfecha') );
					if(! isNaN(_cantidad) )
					{
						_total = _cantidad * _precio;
						$('#nwTotal').html( _total );
					}
				}
				$('#'+_objProdhtml).html( _htmlProd );//objeto html de la tabla
				$('#'+_objProdidBD).val( _deaID );
				$('#'+_objProdBD).val( _texto );
				hideBucarProducto();
				focusTable( 'tblItems' , _rowCount );
			  swal("Agregado!", "El producto fue agregado a la lista", "success");
			});
			//console.log('pressed ENTER!', $el.attr('tdnombre') +' > '+_objProdBD);
		},
	}
});
/*--------------------------------------*/
(function($){

	$(document).ready(function()
		{
			/*--------------------------------------*/
			_servicio = _url+'/detventa';
			/*--------------------------------------*/
			setTimeout(function(){ 
				//focusTable( 'tblItems' );
			}, 1000);
			/*--------------------------------------*/
			$(document).keydown(function(tecla){
			    if (tecla.keyCode == 113 ) { 
			    	//F2
			        focusTable( 'tblItems' , _rowCount );
			    }
			});
			/*--------------------------------------*/
			$('#addProds').click(function(event) {
				event.preventDefault();
				//Agregar una celda vacia a la tabla actual, la que esta oculta
				$('#newRow').fadeIn();
				focusTable( 'tblItems' , _rowCount );
			});
			/*--------------------------------------*/
			buildTabla();
  			/*--------------------------------------*/
  			$('#token').val( _token );
  			/*--------------------------------------*/
  			$('#tokenDoc').val( _token );
  			/*--------------------------------------*/
  			$('#tokenPL').val( _token );
  			/*--------------------------------------*/
  			/*--------------------------------------*/
  			$(document).keyup(function(event) {
  				if( event.keyCode == 27 )
  				{
  					hideBucarProducto();
  					_frmProdsOpen = false;
  				}
  			});
  			/*--------------------------------------*/
  			$('#lt_vencimiento').datepicker({
			    startView: 1,
			    autoclose: true,
			    language: "es",
			    todayHighlight: true
			});
  			/*--------------------------------------*/
  			$('#addProdLote').click(function(event) {
  				event.preventDefault();
  				var _data = $('#frmProductoLote').serializeArray();
  				$.ajax({
  					url 	: _url+'/addProLot',
  					type 	: 'POST',
  					dataType: 'json',
  					data 	: _data
  				})
  				.done(function() {
  					console.log("success");
  					$('#frmProductoLote')[0].reset();
  					swal("Agregado!", "Producto añadido, espere a que se cargue la pagina", "success");
  					document.location.reload();
  				})
  				.fail(function() {
  					console.log("error");
  				})
  				.always(function() {
  					console.log("complete");
  				});
  				
  			});
  			/*--------------------------------------*/
  			$('#delProd').click(function(event) {
  				event.preventDefault();
  				removeItem( $(this).attr('tdidProd') , $(this).attr('tdnombre') );
  			});
  			/*--------------------------------------*/
  			$('#tipo_doc').click(function(event) {
  				if( $(this).val() == 'F' )
  				{
  					$('#frameFactura').removeClass('hidden');
  				}
  				else
  				{
  					$('#frameFactura').addClass('hidden');
  				}
  			});
  			/*--------------------------------------*/
  			$('#pago_efectivo').keyup(function(event) {
  				var _valor = $(this).val();
  				var _vuelto = 0;
  				if(! isNaN(_valor) )
  				{
  					if( _valor < _totalDoc )
  					{
  						_vuelto = 'Error';
  					}
  					else
  					{
  						_vuelto = _valor - _totalDoc;
  						_vuelto = _vuelto.toFixed(2)
  					}
  				}
  				else
  				{
  					_vuelto = 'Ingrese número';
  				}
  				$('#vuelto').val( _vuelto );
  			});
  			/*--------------------------------------*/
  			$('#btnCerrarDoc').click(function(event) {
  				event.preventDefault();
  				var _efectivo = $('#pago_efectivo').val();
  				if( _totalDoc > _efectivo && $('#forma_pago').val() == 'E' )
  				{
  					swal("Pago Efectivo", "El monto de pago es menor al total", "error");
  					return true;
  				}
				swal({
				  title: "Confirme Cerrar Documento?",
				  text: "Esto moverá stock",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonClass: "btn-success",
				  confirmButtonText: "Si, Cerrar Documento",
				  cancelButtonText: "No, Cancelar!",
				  closeOnConfirm: false,
				  closeOnCancel: false
				},
				function(isConfirm) {
				  if (isConfirm) {
				    swal("Cerrado!", "Se cerró el documento y se movió stock.", "success");
				    $('#frmHeader').submit();
				  } else {
				    //swal("Cancelled", "Your imaginary file is safe :)", "error");
				  }
				});
  				
  			});
  			/*--------------------------------------*/
  			/*--------------------------------------*/
  			/*--------------------------------------*/
  			/*--------------------------------------*/
  			/*--------------------------------------*/
  			/*--------------------------------------*/
  			/*--------------------------------------*/
  			/*--------------------------------------*/
			$('#tblProductos').DataTable({
				"language": {
		            "lengthMenu": "Mostrando _MENU_ filas por página",
		            "zeroRecords": "Nothing found - sorry",
		            "info": "Mostrando página _PAGE_ de _PAGES_",
		            "infoEmpty": "No records available",
		            "infoFiltered": "(filtered from _MAX_ total records)",
		            "search":"Buscar"
		        },
		        'order':[[1,'asc']]
			});
			/*--------------------------------------*/
			$('#tblProductos_filter input[type="search"]').keydown(function(event) {
				$rows.keynavigator.reBuild();
				if( event.keyCode == 40 )
				{
					$('#tblProductos tbody').focus();
				}
			});
			/*--------------------------------------*/
			$('#tblProductos').removeClass('dataTable').removeClass('no-footer');
			/*--------------------------------------*/
			$('#frmBuscarProds').fadeOut();
			/*--------------------------------------*/
			$('#tblProductos_length label').addClass('control-label');
			/*--------------------------------------*/
			$('#tblProductos_filter input[type="search"]').addClass('form-control');
			/*--------------------------------------*/
			$('#datePicker').datepicker({
			    startView: 1,
			    language: "es",
			    todayHighlight: true
			}).on('changeDate', function(e){
				$('#vencimientoFecha').val(e.format('yyyy-mm-dd'));
			});
			/*--------------------------------------*/
			$('#addFecha').click(function(event) {
				event.preventDefault();
				var _fecha = $('#vencimientoFecha').val();
				$('#vencimiento').val( _fecha );
				$('#nwVcto').html( formatoFeha( _fecha ) );
				$('#myModal').modal('hide');
				//focusTable( 'tblItems' , _rowCount -1 );
			});
			/*--------------------------------------*/
			$('#id_cliente').click(function(event) {
				var _valor = $('#id_cliente option:selected').text();
				$('#cliente').val( _valor );
			});
			/*--------------------------------------*/
		});

})(jQuery);
/* ---------------------------------------------------------- */
function removeItem($id,$nombre)
{
	swal({
		title: "Eliminar Item",
		text: "Confirme eliminar "+$nombre+" de la lista ",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Si, eliminar!",
		closeOnConfirm: false
	},
	function(){
		$.ajax({
			url: _url+'/detventa/'+$id,
			type: 'DELETE',
			dataType: 'json',
			headers: {'X-CSRF-TOKEN':_csrf_token},
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
			$('#TR'+$id).fadeOut();
		});
		swal("Eliminado!", "Se quitó al producto de la lista.", "success");
	});
		

}
/* ---------------------------------------------------------- */
function saveDetalle(){
	swal({
	  title: "Confirme guardar detalle",
	  text: "Se agregará el registro a la base de datos",
	  type: "success",
	  showCancelButton: true,
	  confirmButtonClass: "btn-success",
	  confirmButtonText: "Si, Agregarlo",
	  closeOnConfirm: false,
	  showLoaderOnConfirm: true
	},
	function(){
		/**/
		var _data = $('#frmDetalle').serialize();
		$.post( _servicio , _data , function(data, textStatus, xhr) {
			$('#frmDetalle')[0].reset();
			swal("Agregado!", "Espere a que la página se cargue", "success");
			document.location.reload();
		},'json');
		/**/
	});
		
}
/* ---------------------------------------------------------- */
function buildTabla()
{
	$('table#tblItems > tbody tr td').keynavigator({
		activeClass: 'alert-success',
		keys:{
			13:function($el, cellIndex, e){
				var _callback = $el.attr('callback');
				switch( _callback )
				{
					case 'prod':
						frameBuscarProducto();
						_frmProdsOpen = true;
					break;
					case 'vcto':
						$('#myModal').modal('show');
					break;
					case 'ok':
						//Agregar el registro a la base de datos
						saveDetalle();
					break;
					case 'del':
						//Elimina el registro a la base de datos
						removeItem( $el.attr('tdidProd') , $el.attr('tdnombre') );
					break;
					default:
						callPromt( _callback );
					break;
				}
			}
		},
		parentFocusOn: 'mouseover'
	});
}
/* ---------------------------------------------------------- */
function callPromt( _callback )
{
	var _titulo = '', _caption = '', _placeHolder = '', _obj = '', _txtObj = '';
	switch( _callback )
	{
		case 'prod':
			//otro
		break;
		case 'lab':
			_titulo 		= 'Laboratorio';
			_caption 		= 'Ingrese un Laboratorio';
			_placeHolder 	= 'Ingrese un Laboratorio';
			_obj 			= 'nwlaboratorio';
			_txtObj 		= 'laboratorio';
		break;
		case 'cantidad':
			_titulo 		= 'Cantidad';
			_caption 		= 'Ingrese una can|tidad';
			_placeHolder 	= 'Ingrese una cantidad';
			_obj 			= 'nwCant';
			_txtObj 		= 'cantidad';
		break;
		case 'vcto':
			//otro
		break;
		case 'cant':
			_titulo 		= 'Cantidad';
			_caption 		= 'Cantidad de producto';
			_placeHolder 	= 'Cantidad de producto';
			_obj 			= 'nwCant';
			_txtObj 		= 'cantidad';
		break;
		case 'comp':
			_titulo 		= 'Compra';
			_caption 		= 'Precio de compra';
			_placeHolder 	= 'Precio de compra';
			_obj 			= 'nwCompra';
			_txtObj 		= 'compra';
		break;
		case 'vta':
			_titulo 		= 'Venta';
			_caption 		= 'Precio de Venta';
			_placeHolder 	= 'Precio de Venta';
			_obj 			= 'nwVenta';
			_txtObj 		= 'venta';
		break;
		case '%':
			//calculado
		break;
		case 'ok':
			//Agregar el registro a la base de datos
		break;
	}
	/* =============================== */
	swal({
	  title: _titulo,
	  text: _caption,
	  type: "input",
	  showCancelButton: true,
	  closeOnConfirm: false,
	  inputPlaceholder: _placeHolder
	}, function (inputValue) {
	  if (inputValue === false) return false;
	  if (inputValue === "") {
	    swal.showInputError("Debes escribir un valor");
	    return false
	  }
	  $('#'+_obj).html( inputValue );//objeto td de la tabla
	  $('#'+_txtObj).val( inputValue );//objeto input del formulario que se guardará
	  //Calcular total
	  if( _callback == 'cantidad' )
	  {
	  	var _total = get_valor( 'nwprecio', 'html' );
	  	var _cant = get_valor( inputValue , '' )
	  	set_total( _cant * _total );
	  }
	  focusTableTD( 'tblItems' ,  _obj );
	  calcularUT();//calcular la utilidad
	  swal("Nice!", "You wrote: " + inputValue, "success");
	});
}
/* ---------------------------------------------------------- */
function calcularUT(){
	var _elpc = $('#compra').val();
	var _elpv = $('#venta').val();
	if( !isNaN( _elpv ) && !isNaN( _elpc ) ){
		var _lauti = (( _elpc / _elpv ) - 1 ) * 100;
		_lauti = _lauti * -1;
		if( !isNaN(_lauti) ){
			_lauti = parseInt(_lauti), _out = 0;
		}
		$('#utilidad').val( _lauti+'%' );
		$('#nwUtil').html( _lauti+'%' );
	}
}
/* ---------------------------------------------------------- */
function get_valor( $obj , $tipo )
{
	var _valor = 0;
	switch($tipo)
	{
		case 'html':
			_valor = $('#'+$obj).html();
		break;
		case 'input':
			_valor = $('#'+$obj).val();
		break;
		default:
			_valor = $obj;
		break;
	}
	//
	if( !isNaN(_valor) )
	{
		return _valor;
	}
	else
	{
		return 0;
	}
}
/* ---------------------------------------------------------- */
function set_total( $valor )
{
	$('#total').val( $valor );
	$('#nwTotal').html( $valor );
}
/* ---------------------------------------------------------- */
function formatoFeha( _fechaMySQL )
{
	//devuelve un formato de fecha latina dd/mm/yyyy
	var _arFecha = _fechaMySQL.split('-');
	return _arFecha[2]+'/'+_arFecha[1]+'/'+_arFecha[0];
}

function focusTable( _tabla , _indice )
{
	$('#'+_tabla+' tbody tr td#TD'+_indice).trigger('mouseover');
	$('#'+_tabla+' tbody tr td#TD'+_indice).trigger('click');
}

function focusTableTD( _tabla , _obj )
{
	$('#'+_tabla+' tbody tr td#'+_obj).trigger('mouseover');
	$('#'+_tabla+' tbody tr td#'+_obj).trigger('click');
}

function frameBuscarProducto()
{
	//vamos a mostrar el frame de buscar producto y hacer focus en la cajita de texto
	$('#frmBuscarProds').fadeIn();
	$('#tblProductos_filter input[type="search"]').focus();
}
function hideBucarProducto()
{
	$('#frmBuscarProds').fadeOut();
}
