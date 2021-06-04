<div class="c-overlay js-signup-overlay | bg-red" data-overlay="club-signup">
    <div class="c-overlay__inner u-fluid d-flex justify-content-start align-item-start align-items-lg-center">
        <div class="c-overlay__close js-close-overlay u-pointer">
            <img class="d-block u-pointer u-fluid" src="<?php echo get_icon('nav-close-desktop.svg'); ?>" alt="Close Modal">
        </div>
        <div class="container-lg">
            <div class="row justify-content-center pb-5 pb-lg-0 mb-5 mb-lg-0">
                <div class="col-lg-4 pr-lg-5 pt-5 pt-lg-0 mb-4 mb-lg-0">
                    <h1 class="js-club-signup-step-2-heading t-heading t-white pr-5 mr-5 pr-lg-0 mr-lg-0" data-thanks-heading="<?php echo get_field('signup_modal_heading', 'option'); ?>" data-signed-up-heading="<?php echo get_field('signup_modal_heading_signed_up', 'option'); ?>"><?php echo get_field('signup_modal_heading','option'); ?></h1>
                    <p class="js-club-signup-step-2-text t-white" data-thanks-text="<?php echo get_field('signup_modal_text', 'option'); ?>" data-signed-up-text="<?php echo get_field('signup_modal_text_signed_up', 'option'); ?>"><?php echo get_field('signup_modal_text','option'); ?></p>
                </div>
                <div class="col-lg-7 mb-5 mb-lg-0 pb-5 pb-lg-0">
                    <form class="c-form c-form--white js-club-signup-step-2" action="#">
                        <div class="c-form__field">
                            <input id="email" name="email" type="email" placeholder="Email Address" readonly>
                            <label class="c-form__label" for="email">Email</label>
                        </div>
                        <div class="c-form__field c-form__field--halfwidth">
                            <input id="first_name" name="first_name" type="text" placeholder="First Name">
                            <label class="c-form__label" for="first_name">First Name</label>
                        </div>
                        <div class="c-form__field c-form__field--halfwidth">
                            <input id="last_name" name="last_name" type="text" placeholder="Last Name">
                            <label class="c-form__label" for="last_name">Last Name</label>
                        </div>
                        <div class="c-form__field c-form__field--halfwidth">
                            <input type="date" id="signup_dob" placeholder="Date of Birth">
                            <label class="c-form__label is-for-date" for="signup_dob">Date of Birth</label>
                        </div>
                        <div class="c-form__field c-form__field--halfwidth">
                            <input id="postcode" name="postcode" type="text" placeholder="Postcode">
                            <label class="c-form__label" for="postcode">Postcode</label>
                        </div>
                        <div class="c-form__field">
                            <input id="mobile" name="mobile" type="tel" placeholder="Mobile Number">
                            <label class="c-form__label" for="mobile">Mobile Number</label>
                        </div>
                        <div class="c-form__actions | d-flex align-items-start justify-content-between">
                            <div class="c-form__checkboxes">
                                <label class="c-form__checkbox" for="sms_optin">
                                    <input id="sms_optin" name="sms_optin" type="checkbox">
                                    <span class="t-brown">I agree to receive messages via SMS.</a></span>
                                </label>
                            </div>
                            <input type="hidden" id="ctc_id" value="">
                            <input type="hidden" id="supinfo_status" value="">
                            <input type="hidden" id="source_id" value="">
                            <input type="hidden" id="local_business" value="">
                            <input type="hidden" id="local_business_code" value="">
                            <input id="acteol-signup-step-2" class="c-btn c-btn--large c-btn--white" type="submit" value="Submit">
                        </div>
                        <div class="c-form__messages | u-w100">
                            <p class="success">Your details have been updated.</p>
                            <p class="fail">There has been an error processing your details. Please try again later.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <img src="<?php echo get_icon('club-signup-stars.svg'); ?>" alt="Stars" class="c-overlay__stars d-none d-lg-block">
    <img src="<?php echo get_icon('club-signup-rings.svg'); ?>" alt="Rings" class="c-overlay__rings d-none d-lg-block">
</div>