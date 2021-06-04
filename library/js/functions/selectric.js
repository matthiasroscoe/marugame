function initSelectric() {
	$(".js-selectric").selectric({
		nativeOnMobile: true,
		onChange: function(el) {
			$(el).closest('.c-form__field').addClass('show-label')
		}
	});
}
