(function($) {

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




})(jQuery);