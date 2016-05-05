
(function($){
	$(document).ready(function()
		{
			/*--------------------------------------*/
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
			/*--------------------------------------*/
			$('#tblProductos_filter input[type="search"]').addClass('form-control');
			/*--------------------------------------*/
			$('#tblProductos_length label').addClass('control-label');
			/*--------------------------------------*/
			$('table#tblProductos > tbody tr ').keynavigator({
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
						  swal("Agregado!", "El producto fue agregado a la lista", "success");
						});
						console.log('pressed ENTER!', $el.attr('tdnombre') );
					},
				}
			});
			/*--------------------------------------*/
			$('table#tblItems > tbody tr ').keynavigator({
				activeClass: 'alert-success',
				keys:{
					13:function($el, cellIndex, e){
						console.log('pressed ENTER!', $el.attr('tdnombre') );
					},
				}
			});
			/*--------------------------------------*/
			//Rebuild
  			//$rows.keynavigator.reBuild();
  			/*--------------------------------------*/
		});

})(jQuery);
