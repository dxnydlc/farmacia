var _rowCount = $('#tblItems tr').length;
/*--------------------------------------*/
var _rowItems = $('table#tblItems > tbody tr td').keynavigator({
	activeClass: 'alert-success',
	keys:{
		13:function($el, cellIndex, e){
			console.log('pressed ENTER!', $el.attr('tdnombre') );
		}
	},
	parentFocusOn: 'mouseover'
});
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
					_rowHtml += '<td id="TD'+_rowCount+'" >- producto -</td>';
					_rowHtml += '<td></td>';
					_rowHtml += '<td></td>';
					_rowHtml += '<td></td>';
					_rowHtml += '<td></td>';
					_rowHtml += '<td></td>';
					_rowHtml += '<td></td>';
				_rowHtml += '</tr>';
				_rowItems.parent().append( _rowHtml );
				_rowItems.keynavigator.reBuild();
				//$(this).fadeOut();
			});
			/*--------------------------------------*/
			//Rebuild
  			//$rows.keynavigator.reBuild();
  			/*--------------------------------------*/
  			/*--------------------------------------*/
  			/*--------------------------------------*/
  			/*--------------------------------------*/
  			/*--------------------------------------*/
		});

})(jQuery);

