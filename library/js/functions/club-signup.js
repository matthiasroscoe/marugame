function clubSignUpForm() {
	// Open signup form on button click
	$(".js-show-club-signup-form").on("click", function(e) {
		e.preventDefault();

		$(".club-signup__buttons").fadeOut("300");
		setTimeout(() => {
			$(".club-signup__form")
				.css("display", "flex")
				.hide()
				.fadeIn("300");
		}, 350);
	});

	// When submitting signup form first step
	// create new contact in Atreemo
	$(".js-club-signup-step-1").on("submit", e => {
		e.preventDefault();

		// Reset errors
		let hasError = false;
		$(".js-club-signup-step-1 .error").removeClass("error");
		$(".js-club-signup-step-1 .c-form__messages").removeClass(
			"fail success invalid user-exists"
		);

		// Get user's details from form
		const emailRegex = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
		const email = $(".js-club-signup-step-1 #email").val(),
			firstName = $(".js-club-signup-step-1 #first_name").val(),
			terms = $(".js-club-signup-step-1 #terms").is(":checked"),
			lastName = $(".js-club-signup-step-1 #last_name").val(),
			supinfoStatus = $(".js-club-signup-step-1 #supinfo_status").val(),
			sourceID = $(".js-club-signup-step-1 #source_id").val();

		if (!emailRegex.test(email)) {
			$(".js-club-signup-step-1 #email").addClass("error");
			hasError = true;
		}

		let localBusiness = false,
			localBusinessCode = false;
		if (sourceID == "Local Business Website Signup Form") {
			localBusiness = $(".js-club-signup-step-1 #local_business").val();
			localBusinessCode = $(".js-club-signup-step-1 #local_business_code").val();
		}

		if (!terms) {
			$(".js-club-signup-step-1 #terms").addClass("error");
			hasError = true;
		}

		if (hasError) {
			$(".js-club-signup-step-1 .c-form__messages").addClass("invalid");
		} else {
			const data = {
				action: "acteol_add_contact",
				email: email,
				first_name: firstName,
				last_name: lastName,
				supinfo_status: supinfoStatus,
				source_id: sourceID
			};

			if (localBusiness) {
				data.local_business = localBusiness;
			}
			if (localBusinessCode) {
				data.local_business_code = localBusinessCode;
			}

			console.log(data);

			$.ajax({
				type: "POST",
				url: scriptVars.ajaxUrl,
				dataType: "html",
				data: data,
				beforeSend: function() {
					$(".js-club-signup-step-1 .c-btn").val("Processing...");
				},
				success: function(response) {
					console.log(response);
					const parsedResponse = JSON.parse(response);
					console.log(parsedResponse);

					if (parsedResponse.error) {
						console.error(parsedResponse.message);
						$(".js-club-signup-step-1 .c-form__messages").addClass("fail");
					} else {
						// Pre-fill signup form step 2 with step 1 values
						$(".js-club-signup-step-2 #email").val(email);
						$(".js-club-signup-step-2 #first_name").val(firstName);
						$(".js-club-signup-step-2 #last_name").val(lastName);
						$(".js-club-signup-step-2 #supinfo_status").val(supinfoStatus);
						$(".js-club-signup-step-2 #source_id").val(sourceID);
						$(".js-club-signup-step-2 #local_business").val(localBusiness);
						$(".js-club-signup-step-2 #local_business_code").val(localBusinessCode);

						// If user is already subscribed,
						// try and prefill their ctcID, postcode, dob, and mobile if available.
						if (parsedResponse.user_data) {
							console.log("User is already signed up.");

							const existingMobile = parsedResponse.user_data[0].MobilPhone,
								existingBirthDate = parsedResponse.user_data[0].BirthDate,
								existingPostCode = parsedResponse.user_data[0].Company.PostCode;

							if (existingMobile) {
								$(".js-club-signup-step-2 #mobile").val(existingMobile);
							}
							if (existingBirthDate) {
								$(".js-club-signup-step-2 #signup_dob").val(existingBirthDate);
							}
							if (existingPostCode) {
								$(".js-club-signup-step-2 #postcode").val(existingPostCode);
							}
							$(".js-club-signup-step-2 #ctc_id").val(
								parsedResponse.user_data[0].CtcID
							);

							const heading = $(".js-club-signup-step-2-heading").data(
									"signed-up-heading"
								),
								text = $(".js-club-signup-step-2-text").data("signed-up-text");
							$(".js-club-signup-step-2-heading").text(heading);
							$(".js-club-signup-step-2-text").text(text);
						} else {
							$(".js-club-signup-step-2 #ctc_id").val(parsedResponse.CtcID);

							const heading = $(".js-club-signup-step-2-heading").data(
									"thanks-heading"
								),
								text = $(".js-club-signup-step-2-text").data("thanks-text");
							$(".js-club-signup-step-2-heading").text(heading);
							$(".js-club-signup-step-2-text").text(text);
						}

						// Trigger popup
						$(".c-overlay[data-overlay=club-signup]").addClass("is-active is-animated");
						$("body").addClass("no-scroll");
						$(".js-club-signup-step-1 .c-btn").val("Sign Up");
					}
				},
				error: function(response) {
					console.log(response);
					$(".js-club-signup-step-1 .c-form__actions")
						.removeClass("d-flex")
						.addClass("d-none");

					// Display API error
					$(".js-club-signup-step-1 .c-form__messages").addClass("fail");
					$(".js-club-signup-step-1 .c-btn").val("Sign Up");
				}
			});
		}
	});

	// When submitting signup form second step, update the contacts details in acteol.
	$(".js-club-signup-step-2").on("submit", e => {
		e.preventDefault();
		// Reset errors
		let hasError = false;
		$(".js-contact-form .error").removeClass("error");
		$(".js-club-signup-step-2 .c-form__messages").removeClass(
			"fail success invalid user-exists"
		);

		const firstName = $(".js-club-signup-step-2 #first_name").val(),
			lastName = $(".js-club-signup-step-2 #last_name").val(),
			email = $(".js-club-signup-step-2 #email").val(),
			smsOptin = $(".js-club-signup-step-2 #sms_optin").is(":checked"),
			mobile = $(".js-club-signup-step-2 #mobile").val(),
			ctcID = $(".js-club-signup-step-2 #ctc_id").val(),
			dob = $(".js-club-signup-step-2 #signup_dob").val(),
			postcode = $(".js-club-signup-step-2 #postcode").val(),
			supinfoStatus = $(".js-club-signup-step-2 #supinfo_status").val(),
			sourceID = $(".js-club-signup-step-2 #source_id").val(),
			localBusiness = $(".js-club-signup-step-2 #local_business").val(),
			localBusinessCode = $(".js-club-signup-step-2 #local_business_code").val();

		if (hasError) {
			$(".js-club-signup-step-2 .c-form__messages").addClass("invalid");
		} else {
			const data = {
				action: "acteol_update_contact",
				first_name: firstName,
				last_name: lastName,
				email: email,
				mobile: mobile,
				dob: dob,
				postcode: postcode,
				smsOptin: smsOptin,
				ctcID: ctcID,
				source_id: sourceID,
				supinfo_status: supinfoStatus
			};

			console.log(data);

			if (localBusiness && localBusiness != "false") {
				data.local_business = localBusiness;
			}
			if (localBusinessCode && localBusinessCode != "false") {
				data.local_business_code = localBusinessCode;
			}

			console.log(data);

			$.ajax({
				type: "POST",
				url: scriptVars.ajaxUrl,
				dataType: "html",
				data: data,
				beforeSend: function() {
					$(".js-club-signup-step-2 .c-btn").val("Processing...");
				},
				success: function(response) {
					console.log(response);
					const parsedResponse = JSON.parse(response);

					if (parsedResponse.error) {
						console.error(parsedResponse.message);
						$(".js-club-signup-step-2 .c-form__messages").addClass("fail");
					} else {
						// Display API error
						$(".js-club-signup-step-2 .c-form__messages").addClass("success");
						$(".js-club-signup-step-2 .c-btn").val("Submit");
					}
				},
				error: function(response) {
					console.error(response);

					$(".js-club-signup-step-2 .c-form__messages").addClass("fail");
					$(".js-club-signup-step-2 .c-btn").val("Sign Up");
				}
			});
		}
	});
}
