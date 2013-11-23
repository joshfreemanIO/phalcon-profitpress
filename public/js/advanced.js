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
