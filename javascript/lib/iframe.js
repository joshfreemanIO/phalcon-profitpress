$(document).ready(function() {

    var $wrap = $('#wrap');
	var $iframe = $('[data-iframe="full-height"]');

	var elements = $('#wrap > *').not($iframe);

	var height = $("body").height();

	for (var i = elements.length - 1; i >= 0; i--) {
		height -= $(elements[i]).height();
	}

	$iframe.height(height);
});
