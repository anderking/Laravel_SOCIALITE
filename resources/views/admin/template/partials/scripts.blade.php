<script src="{{ asset('plugins/js/vendor/jquery.js') }}"></script>
<script src="{{ asset('plugins/js/vendor/bootstrap.js') }}"></script>
<script src="{{ asset('plugins/js/vendor/sweetalert-dev.js') }}"></script>
<script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
<script src="{{ asset('plugins/js/vendor/jquery-confirm.js') }}"></script>
<script src="{{ asset('plugins/js/vendor/fileinput.js') }}"></script>
<script src="{{ asset('plugins/js/vendor/bootstrap-formhelpers.js') }}"></script>
<script src="{{ asset('plugins/trumbowyg/trumbowyg.js') }}"></script>
<script src="{{ asset('plugins/js/main.js') }}"></script>

<script>

	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

	$(".select_tag").chosen({
		max_selected_options: 10,
		no_results_text: "Ningún resultado coincide!",
		placeholder_text_multiple: "Seleccione los tags"
	});

	$(".select_cat").chosen({
		no_results_text: "Ningún resultado coincide!",
	});

	$('.trumbowyg').trumbowyg();

</script>