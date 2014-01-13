new Dropzone(document.body, { // Make the whole body a dropzone
	url: "/posts/fileupload", // Set the url
	previewsContainer: "#previews", // Define the container to display the previews
	clickable: "#clickable", // Define the element that should be used as click trigger to select files.
    init: function() {
        this.on("error", function(file, message) {
            alert(message);
        });

        this.on("success", function(file, messages) {

            var textarea = document.getElementById("prerendered_content");

            var content = textarea.value;

            for (var i = messages.length - 1; i >= 0; i--) {

                textarea.value += "\n" + messages[i].markdown;

                $(textarea).trigger('change');
            }

        });
    }
});
