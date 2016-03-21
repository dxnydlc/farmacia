var _servicio = 'http://localhost:8000/categoria/';
(function($){
	$(document).ready(function()
		{
			$('.delCateg').click(function(event) {
				event.preventDefault();
				var _token = $('#token').val();
				var _DataSend = {'_method':'DELETE','_token': _token };
				var _id = $(this).attr('id');
				$.post(_servicio+_id, _DataSend , function(data, textStatus, xhr) {
					console.log( data );
				});
			});
		});

})(jQuery);
