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

					addCheckbox(msg.name);
				  });
		});
	})

});


function getRegex(a) {

	var string = a;

	var regex = /.*(\[.*\])/g,
		qualities = [],
		matches;

	while (matches = regex.exec(string)) {
    qualities.push(decodeURIComponent(matches[1]));   
}
}

function unnest(string, pointer, substring, matches) {

	var pointer = typeof pointer !== 'undefined' ? pointer : 0;
	var substring = typeof substring !== 'undefined' ? substring : '';
	var matches = typeof matches !== 'undefined' ? matches : new Array();

	var current_car = string[pointer];


	if ( string[pointer] === '[' || string[pointer] === ']' ) {
		
		if (substring.length > 0) {

			matches.push(substring);

		}

		substring = '';

	} else {

		substring += string[pointer];

	}


	if ( typeof string[pointer] !== 'undefined' ) {
		
		pointer++;

		return unnest(string, pointer, substriCategory Errorsng, matches);

	} else {

		return matches;
	}

}

function addCheckbox(name) {

	var $checkbox = $('[data-checkbox-name]').first();
	var $parent = $checkbox.parent();

	var data_name = 'category[' + name + ']';

	var $div_clone = $checkbox.clone();

	var	$inp_clone = $div_clone.find('input').clone();

	$div_clone.attr('data-checkbox-name', data_name);
	$inp_clone.attr('name', data_name).prop('checked', true);

	$inp_clone.appendTo($div_clone.find('label').empty());
	$div_clone.find('label').append(name);

	$div_clone.appendTo($checkbox.parent());

}

function addNewMeta() {

	var $meta = $('[head-description]').first();

	$meta.clone().html('');

	$meta.appendTo($meta.parent());

}

function ajaxPost(uri, data) {

	$.post(uri, data, function (data) {

		var functions = {

			200 : function(data) {
				
			},

			409 : function(data) {

			},
		}


	}, 'json');
}

function 
// data-ajax-post-route="uri"
// data-ajax-post-element="#css selector"

