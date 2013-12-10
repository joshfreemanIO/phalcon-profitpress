function sync(sourceElement, targetElement, copy_html)
{
	var source = $(sourceElement);
	var text = source.val();
	var target = $(targetElement);

	if (target.attr('data-copy-html') === 'true') {
		text = source.html();
	}

	if (target.attr('data-update') == 'false') {
		return false;
	}

	if (target.attr('data-copy-linkify') === 'true') {
		target.val(linkify(text));
		target.html(linkify(text));
	} else {
		target.val(text);
		target.html(text);
	}
}

function linkify(string) {
	var a = string.replace(/([^a-zA-Z0-9])+|[\-\_]+/gi, '-').toLowerCase();
	return a.replace(/^[^a-zA-Z0-9]|[^a-zA-Z0-9]$/gi, '');
}

function copySourceToTarget(index, element) {
	var id = $(element).attr('data-copy-target');

	var source = '[data-copy-source="'+id+'"]';
	$(source).on('change input',function(e){
		sync(source, element);
		$(element).trigger('change');
	});
}

function copyTargetToSource(index, element) {

	var source = $(element);
	var id = $(source).attr('data-copy-iframe-source');
	var target = $('[data-copy-iframe-target="'+id+'"]');

	$(source).on('DOMSubtreeModified MutationEvent DOMAttrModified',function(e){
		sync(source, target, true);
	});
}

$(document).ready(function(){

	$('[data-copy-target]').each(
		function(index, element) {
			copySourceToTarget(index, element);
		}
	);
});
