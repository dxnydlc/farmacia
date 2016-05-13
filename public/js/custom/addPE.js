var _rowCount = $('#tblItems tr').length;
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
					_rowHtml += '<td>0</td>';
					_rowHtml += '<td>0</td>';
					_rowHtml += '<td>0</td>';
					_rowHtml += '<td>0</td>';
				_rowHtml += '</tr>';
				$('#tblItems').append( _rowHtml );
				buildTabla();
				focusTable( 'tblItems' , _rowCount -1 );
			});
			/*--------------------------------------*/
			buildTabla();
  			/*--------------------------------------*/
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
				console.log('pressed ENTER!', $el.attr('tdnombre') );
			}
		},
		parentFocusOn: 'mouseover'
	});
}