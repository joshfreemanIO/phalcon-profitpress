$(document).ready(function(){

	$('[data-ajax-route]').each(function() {

		console.log($(this));

		$(this).on('click', function(){

			var name = $(this).attr('data-ajax-input');

			var val = $('[name="'+name+'"]').val();

			$.ajax({
					type: "POST",
					url: $(this).attr('data-ajax-route'),
					data: { 
						value: val
					}
				})
				.done(function( msg ) {
				  	res = msg;
				    console.log( msg );
				  });
		});
	})

});