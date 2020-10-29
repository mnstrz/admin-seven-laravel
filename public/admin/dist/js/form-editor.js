$(function () {
	// Summernote
	$('.summernote').summernote()

	// CodeMirror
	CodeMirror.fromTextArea(document.getElementById(".code-miror"), {
	  mode: "htmlmixed",
	  theme: "monokai"
	});
})