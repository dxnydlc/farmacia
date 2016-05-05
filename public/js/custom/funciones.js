
(function($){
	$(document).ready(function()
		{
			$('#tblProductos').removeClass('dataTable').removeClass('no-footer');
			/*--------------------------------------*/
			$('#frmBuscarProds').fadeOut();
			/*--------------------------------------*/
			$('#addProds').click(function(event) {
				event.preventDefault();
				$('#frmBuscarProds').fadeIn();
				$('#tblProductos tbody tr').focus();
			});
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
		});

})(jQuery);
