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
				that = this;

				$('[name="'+target+'"]').keyup(function(){
					innerHtml =  $(this).val();
					$(that).html(innerHtml);
				});
			}
		);
	}
);
$('#nav-tab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
});
;$(document).ready(function(){

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
    });

});

function unnest(string, pointer, substring, matches) {

    if (typeof pointer == 'undefined') pointer = 0;
    if (typeof substring == 'undefined') substring = '';
    if (typeof matches == 'undefined') matches = [];

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

        return unnest(string, pointer, substring, matches);

    } else {

        return matches;
    }

}

function addCheckbox(name) {

    var $checkbox = $('[data-checkbox-name]').first();
    var $parent = $checkbox.parent();

    var data_name = 'category[' + name + ']';

    var $div_clone = $checkbox.clone();

    var $inp_clone = $div_clone.find('input').clone();

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
        };


    }, 'json');
}
;(function($) {

	$.widget("ProfitPress.ajax-form", {

		options: {

			dataRoute : 'data-ajax-post-route',
			dataElement : 'data-ajax-post-element',
		},

		_create: function() {

			this._bind();

		},

		_bind: function() {

			$(document).on('click', this.options.dataRoute, function(eventObject) {

				var route = $(this).data(this.options.dataRoute);
				var data = $(this).data(this.options.dataElement).val();

				var postData = {value: data};

				this.ajaxPost(route, postData);

			});
		},

		ajaxPost: function(route, postData) {

			$.post(route, postData, function (data, textStatus, jqXHR) {

				console.log(data);
				console.log(textStatus);
				console.log(jqXHR);

			}, 'json');
		},


		HTTP200: function() {

		},

		HTTP409: function() {

		},


	});




// Initialization of Attributes




})(jQuery);;// (function($) {

//  $.widget("ProfitPress.ajaxValidator", {

//      options: {

//          dataRoute : 'data-ajax-validator-route',
//          dataModel : 'data-ajax-validator-model',
//      },

//      _create: function() {

//          this._bind();

//      },

//      _bind: function() {

//          $(document).on('input change', this.options.dataRoute, function(eventObject) {

//              var route = $(this).data(this.options.dataRoute);
//              var model = $(this).data(this.options.dataModel);
//              var attr  = $(this).attr('name');
//              var data  = $(this).data(this.options.dataAttr).val();

//              var postData = {
//                  model: model,
//                  attr:  attr
//                  value: data,
//              };

//              this.ajaxPost(route, postData);

//          });
//      },

//      ajaxPost: function(route, postData) {

//          $.post(route, postData, function (data, textStatus, jqXHR) {

//              console.log(data);
//              console.log(textStatus);
//              console.log(jqXHR);

//          }, 'json');
//      }


//      HTTP200: function() {

//      },

//      HTTP409: function() {

//      },


//  });



// $(document).ajaxValidator();
// // Initialization of Attributes




// })(jQuery);
;function sync(sourceElement, targetElement, copy_html)
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

function tinyMCEinit() {

	var $tinyMCE = $('[data-height-target="tiny-mce"]');
	var $source = $('[data-height-source="tiny-mce"]');

	var interval = setInterval(function () {

		if ($source.height() > 200) {
			syncHeight($source,$tinyMCE);
			clearInterval(interval);
		} else {
			return false;
		}
	}, 25);
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
