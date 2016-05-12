
/*--------------------------------------*/
var $rows = $('table#tblProductos > tbody tr ').keynavigator({
	activeClass: 'alert-success',
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
				$.post( _servicio , {param1: 'value1'}, function(data, textStatus, xhr) {
					console.log(data);
				},'json');
			  swal("Agregado!", "El producto fue agregado a la lista", "success");
			});
			console.log('pressed ENTER!', $el.attr('tdnombre') );
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
		        }
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
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
		});

})(jQuery);

function focusTable( _tabla , _indice )
{
	//$('#'+_tabla+' tbody tr td').focus();
	$('#'+_tabla+' tbody tr td#TD'+_indice).trigger('mouseover');
	$('#'+_tabla+' tbody tr td#TD'+_indice).trigger('click');
}

function frameBuscarProducto()
{
	//vamos a mostrar el frame de buscar producto y hacer focus en la cajita de texto
	$('#frmBuscarProds').fadeIn();
	$('#tblProductos_filter input[type="search"]').focus();
}
