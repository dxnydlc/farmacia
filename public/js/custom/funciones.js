
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
				$('#'+_objProdhtml).html( _texto );//objeto html de la tabla
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
			$('#id_proveedor').click(function(event) {
				var _valor = $('#id_proveedor option:selected').text();
				$('#proveedor').val( _valor );
			});
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
		});

})(jQuery);

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
