// (function($) {

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
