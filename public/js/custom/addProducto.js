
(function($){
	$(document).ready(function()
		{
			$('.combito').click(function(event) {
				var _thisID = $(this).attr('name');
				var _valor = $('#'+_thisID+' option:selected').text();
				var _obj = $(this).attr('rel');
				$('#'+_obj).val(_valor);
			});
		});

})(jQuery);
