function submitContactForm(e) {
	$(".js-contact-form").on("submit", function(e) {
		e.preventDefault();

		// Reset errors
		let hasError = false;
		$(".js-contact-form .error").removeClass("error");
		$(".js-contact-form .c-form__messages").removeClass("fail success");

		// Get field values
		const emailRegex = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
		const firstName = $('.js-contact-form input[name="first_name"]').val(),
			lastName = $('.js-contact-form input[name="last_name"]').val(),
			email = $('.js-contact-form input[name="email"]').val(),
			message = $('.js-contact-form textarea[name="message"]').val(),
			enquiryType = $(".js-contact-form .js-selectric").val();

		// Validate fields
		if (firstName == "") {
			$(".js-contact-form #first_name").addClass("error");
			hasError = true;
		}
		if (lastName == "") {
			$(".js-contact-form #last_name").addClass("error");
			hasError = true;
		}
		if (message == "") {
			$(".js-contact-form #message").addClass("error");
			hasError = true;
		}
		if (enquiryType == null) {
			$(".js-contact-form .selectric").addClass("error");
			hasError = true;
		}
		if (!emailRegex.test(email)) {
			console.log("testing");
			$(".js-contact-form #email").addClass("error");
			hasError = true;
		}

		if (hasError) {
			// Show error messages
			$(".js-contact-form .c-form__messages").addClass("fail");
		} else {
			// If fields have valid values, send data to PHP to process...
			$.ajax({
				type: "POST",
				url: scriptVars.ajaxUrl,
				dataType: "html",
				data: {
					first_name: firstName,
					last_name: lastName,
					message: message,
					email: email,
					enquiry_type: enquiryType,
					action: "submit_contact_form"
				},
				beforeSend: function() {
					$(".js-contact-form .c-btn").val("Processing...");
				},
				success: function(response) {
					console.log(response);

					$(".js-contact-form .c-form__actions")
						.removeClass("d-flex")
						.addClass("d-none");
					$(".js-contact-form .c-btn").val("Submit");

					if (response == 'fail') {
						// Display error message
						$(".js-contact-form .c-form__messages").addClass("fail");
					} else {
						// Display success message
						$(".js-contact-form .c-form__messages").addClass("success");
					}
				}
			});
		}
	});

	$(document).on('click', '.js-cf-button', function(e) {
		e.preventDefault();
		
		const enquiryType = $(this).data('enquiry-type');
		$('.js-contact-form #enquiry_type').val(enquiryType).selectric('refresh');
	
		$('.js-cf-button').addClass('c-btn--outline c-btn--outline--red');
		$(this).removeClass('c-btn--outline c-btn--outline--red');
	
		if ($(window).innerWidth() >= 992) {
			scrollToEl('.js-contact-form', -100, 800);
		} else {
			scrollToEl('.js-contact-form', -50, 800);
		}
	})
}

