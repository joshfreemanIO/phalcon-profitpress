function sync(title, permalink)
{
  var n1 = document.getElementById(title);
  var n2 = document.getElementById(permalink);
  n2.value = linkify(n1.value);
}

function linkify(string) {
	var a = string.replace(/([^a-zA-Z0-9])+|[\-\_]+/gi, '-').toLowerCase();
	return a.replace(/^[^a-zA-Z0-9]|[^a-zA-Z0-9]$/gi, '');
}

document.getElementById('title').onkeyup = function() {
	sync('title', 'permalink');
}
