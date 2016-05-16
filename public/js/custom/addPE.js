var _rowCount = $('#tblItems tr').length;
var _objProdTabla 	= '';
var _idOtro 		= _rowCount - 1;
var _objProdBD 		= 'TD'+_idOtro;
var _objProdidBD	= '';
/*--------------------------------------*/
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
			        focusTable( 'tblItems' , _rowCount -1 );
			    }
			});
			/*--------------------------------------*/
			$('#addProds').click(function(event) {
				event.preventDefault();
				//Agregar una celda vacia a la tabla actual
				var _rowHtml = '';
				_rowHtml += '<tr>';
					_rowHtml += '<th scope="row">#</th>';
					_rowHtml += '<td id="TD'+_rowCount+'" >- Producto -</td>';
					_rowHtml += '<td>- Laboratorio -</td>';
					_rowHtml += '<td>- Lote -</td>';
					_rowHtml += '<td>- Vencimiento -</td>';
					_rowHtml += '<td>- Cantidad -</td>';
					_rowHtml += '<td>- Compra -</td>';
					_rowHtml += '<td>- Venta -</td>';
					_rowHtml += '<td>- % -</td>';
				_rowHtml += '</tr>';
				//$('#tblItems').append( _rowHtml );
				//buildTabla();
				$('#newRow').fadeIn();
				focusTable( 'tblItems' , _rowCount-1 );
			});
			/*--------------------------------------*/
			buildTabla();
  			/*--------------------------------------*/
  			$('#token').val( _token );
  			/*--------------------------------------*/
  			/*--------------------------------------*/
  			/*--------------------------------------*/
  			/*--------------------------------------*/
		});

})(jQuery);

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
					break;
					case 'vcto':
						$('#myModal').modal('show');
					break;
					case 'ok':
						//Agregar el registro a la base de datos
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
