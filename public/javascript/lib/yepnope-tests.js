yepnope({
  test : Modernizr.inputtypes && Modernizr.inputtypes.date,
  nope : [
	'scripts/datepicker.js'
  ]
});