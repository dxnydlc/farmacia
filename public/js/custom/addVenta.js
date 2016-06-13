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

(function($){

	$(document).ready(function()
		{
			/*--------------------------------------*/
			_servicio = _url+'/detpe';
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
  			$('.delItem').click(function(event) {
  				e.preventDefault();
  				var _id = $(this).attr('id');
  				console.log( _id );
  				$.ajax({
  					url: _url+'/pe/to/file',
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
  				});
  				
  			});
  			/*--------------------------------------*/
  			$(document).keyup(function(event) {
  				if( event.keyCode == 27 )
  				{
  					hideBucarProducto();
  					_frmProdsOpen = false;
  				}
  			});
  			/*--------------------------------------*/
  			/*--------------------------------------*/
		});

})(jQuery);
/* ---------------------------------------------------------- */
function savePE(){
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
		var _data = $('#frmPE').serialize();
		$.post( _servicio , _data , function(data, textStatus, xhr) {
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
						savePE();
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
		case 'lote':
			_titulo 		= 'Lote';
			_caption 		= 'Ingrese un Lote';
			_placeHolder 	= 'Ingrese un Lote';
			_obj 			= 'nwLote';
			_txtObj 		= 'lote';
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
