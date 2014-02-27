function sync(sourceElement, targetElement, copy_html)
{
	var source = $(sourceElement);
	var text = source.val();
	var target = $(targetElement);

	if (target.attr('data-copy-html') === 'true') {
		text = source.html();
		syncScrollPostion(source, target);
	}

	if (target.attr('data-update-scrollbar') === 'true') {
		// target.customScrollbar();
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

function copySourceToTarget(index, target) {
	var id = $(target).attr('data-copy-target');

	var source = '[data-copy-source="'+id+'"]';

	$(source).on('change input',function(e){
		sync(source, target);
		$(target).trigger('change');
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


$(document).ready(function(){

	var hash = window.location.hash.substring(1);

	if (hash) {
		$('[href="'+hash+'"]').trigger('click');
	}

});

function syncHeight(sourceElement, targetElement) {

	var $sourceElement = $(sourceElement);
	var $targetElement = $(targetElement);
	var newHeight = $sourceElement.height();

	$targetElement.animate({height:newHeight});

}

function syncScrollPostion(sourceElement, targetElement) {

	var $sourceElement = $(sourceElement);
	var $targetElement = $(targetElement);

	var sourceHeight = $sourceElement[0].scrollHeight;
	var sourcePosition = $sourceElement.scrollTop();

	var targetHeight = $targetElement[0].scrollHeight;
	var targetPosition = $targetElement.scrollTop();

	var relativePosition = sourcePosition / sourceHeight * targetHeight;

	targetElement.scrollTop(relativePosition);
}

$(document).ready(function(){

	$('[data-copy-input]').each(
		function(index, element) {
			$(element).click(function() {
				var attr = $(this).attr('data-copy-input');
				console.log(attr);
				console.log($('input[name="'+attr+'"]'));

				$('input[name="'+attr+'"]').trigger('change');
			});
		}
	);
	markDownInit();
});

function markDownInit() {


	$('[data-markdown-source]').each(function(index,element) {

		$(element).on('load change input', function() {

			var $sourceElement = $(this);
			var $targetElement = $('[data-markdown-target="'+$sourceElement.attr('data-markdown-source')+'"]');

			markDown($sourceElement,$targetElement);

			$targetElement.trigger('change');

		});

		$(element).trigger('load');

	});

}

function markDown(sourceElement,targetElement) {

	var converter = new Showdown.converter();

	var html = converter.makeHtml(sourceElement.val());


	targetElement.val(html);
	targetElement.html(html);
}
