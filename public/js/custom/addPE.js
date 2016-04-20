
(function($){
	$(document).ready(function()
		{
			$('#tblProductos').DataTable(
				{
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
				console.log(event.keyCode);
			});
			$('#tblProductos_filter input[type="search"]').addClass('form-control');
			$('#tblProductos_length label').addClass('control-label');
		});

})(jQuery);
