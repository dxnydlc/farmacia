var _servicio = 'http://localhost:8000/ventas/';
var _servDel = 'http://localhost:8000/delventa/';
var _objeto = 'Doc. Ventas';

(function($){
	$(document).ready(function()
		{
			$('.delItem').click(function(event) {
				event.preventDefault();
				var _token = $('#token').val();
				var _DataSend = {'_method':'POST','_token': _token };
				var _id = $(this).attr('id');
				//
				$('#fila_'+_id).removeClass().addClass('danger');

				swal({
					title: "Anular Doc. Ventas",
					text: "Escriba un motivo para anular:",
					type: "input",
					showCancelButton: true,
					closeOnConfirm: false,
					inputPlaceholder: "Motivo"
				}, function (inputValue) {
					if (inputValue === false) return false;
					if (inputValue === "") {
					swal.showInputError("Escriba un motivo de anular");
						return false
					}
					//Ok
					$('#id').val( _id );
					$('#motivo_anular').val( inputValue );
					var _DataSend = $('#frmDel').serializeArray();
					$('#frmDel').submit();
					/*$.post(_servicio, _DataSend , function(data, textStatus, xhr) {
						document.location.reload();
					},'json');*/
				});

			});
		});

})(jQuery);
