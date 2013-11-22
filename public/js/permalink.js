function sync(sourceElement, targetElement, linkifyFlag)
{
	var n1 = document.getElementById(sourceElement);
	var n2 = document.getElementById(targetElement);

	if (n2.getAttribute('data-update') == 'false') {
		return false;
	}

	if (typeof(linkifyFlag) !== 'undefined') {
		n2.value = linkify(n1.value);
	} else {
		n2.value = n1.value;
	}
}

function linkify(string) {
	var a = string.replace(/([^a-zA-Z0-9])+|[\-\_]+/gi, '-').toLowerCase();
	return a.replace(/^[^a-zA-Z0-9]|[^a-zA-Z0-9]$/gi, '');
}

document.getElementById('title').onkeyup = function() {
	sync('title', 'permalink', true);
	sync('title', 'head-title');
}

document.getElementById('permalink').onkeydown = function(event) {
	event.target.setAttribute('data-update', false);
}

$(document).ready(
	function(){

		$('[data-role="advanced-options-toggle"]').click(

			function() {
				if($(this).hasClass('btn-default')) {
					$(this).removeClass('btn-default');
					$(this).addClass('btn-warning');
				} else {
					$(this).removeClass('btn-warning');
					$(this).addClass('btn-default');
				}

				$(this).blur();

				$('[data-role="advanced-options"]').toggleClass('hidden', 100);

			});

		$('[data-meta-copy]').each(
			function(){
				target = $(this).attr('data-meta-copy');
				that = this
				console.log($('[name="'+target+'"]'));

				$('[name="'+target+'"]').keyup(function(){
					innerHtml =  $(this).val();
					$(that).html(innerHtml);
				});


			}
		);

	}
);
$('#nav-tab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});

$(document)