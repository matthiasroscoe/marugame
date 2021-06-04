function setupFormFields() {
	// Animate labels
	$(".c-form__field input, .c-form__field textarea").on("focusin", function() {
		$(this)
			.closest(".c-form__field")
			.addClass("show-label");
	});

	$(".c-form__field input, .c-form__field textarea").on("focusout", function() {
		if ($(this).val() == "") {
			$(this)
				.closest(".c-form__field")
				.removeClass("show-label");
		}
	});

	// Change colour of date input text
	$(".c-form__field input[type=date]").on("change", function() {
		if ($(this).val() == "") {
			$(this).removeClass("has-value");
		} else {
			$(this).addClass("has-value");
		}
	});
}
