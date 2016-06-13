var _servicio = 'http://localhost:8000/pe/';
var _objeto = 'Parte entrada';

//override defaults
alertify.defaults.transition = "slide";
alertify.defaults.theme.ok = "btn btn-primary";
alertify.defaults.theme.cancel = "btn btn-danger";
alertify.defaults.theme.input = "form-control";

(function($){
	$(document).ready(function()
		{
			$('.delItem').click(function(event) {
				event.preventDefault();
				var _token = $('#token').val();
				var _DataSend = {'_method':'DELETE','_token': _token };
				var _id = $(this).attr('id');
				//
				$('#fila_'+_id).removeClass().addClass('danger');
				alertify.confirm("Confirme anular "+_objeto,
					function()
					{
						//Ok
						$.post(_servicio+_id, _DataSend , function(data, textStatus, xhr) {
							console.log('correcto');
							document.location.reload();
						},'json');
					},
					function()
					{
						//Cancel
						$('#fila_'+_id).removeClass();
					});
			});
		});

})(jQuery);
