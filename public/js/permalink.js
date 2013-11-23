function sync(sourceElement, targetElement)
{
	var source = $(sourceElement);
	var text = source.val();
	var target = $(targetElement);

	console.log(target);
	if (target.attr('data-update') == 'false') {
		return false;
	}
		console.log('text:'+text);

	if (target.attr('data-copy-linkify') === 'true') {
		target.val(linkify(text));
		target.html(linkify(text));
		console.log('linkify:'+source.attr('id')+'-->'+target.attr('id')+' '+'('+text+')');
	} else {
		target.val(text);
		target.html(text);
		console.log('no-linkify:'+source.attr('id')+'-->'+target.attr('id')+' '+'('+text+')');
	}
}

function linkify(string) {
	var a = string.replace(/([^a-zA-Z0-9])+|[\-\_]+/gi, '-').toLowerCase();
	return a.replace(/^[^a-zA-Z0-9]|[^a-zA-Z0-9]$/gi, '');
}

$(document).ready(function(){

	$('[data-copy-target]').each(
		function(index, element) {

			var id = $(element).attr('data-copy-target');

			var source = '[data-copy-source="'+id+'"]';

			$(source).on('change input',function(e){
				sync(source, element);
				$(element).trigger('change');
			});
		}
	);
});