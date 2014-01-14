yepnope({
  test : Modernizr.inputtypes && Modernizr.inputtypes.date,
  nope : [
  'javascript/vendor/date-timepicker/jquery.datetimepicker.css',
    'javascript/vendor/date-timepicker/jquery.datetimepicker.js'
  ]
});