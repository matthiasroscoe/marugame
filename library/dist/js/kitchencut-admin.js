jQuery(document).ready(function($) {
	$('form[name="kitchencut_sync"]').on("submit", function(e) {
		e.preventDefault();

		$.ajax({
			type: "POST",
			dataType: "html",
			url: "/wp-admin/admin-ajax.php",
			data: {
				action: "sync_kitchencut_with_woocommerce"
			},
			beforeSend: function() {
				$(".kc-admin-page .js-loading").fadeIn(400);
			},
			success: function(response) {
				console.log(response);
				setTimeout(() => {
					$(".kc-admin-page .js-loading").fadeOut(400);
				}, 3000);
			}
		});
	});
});
