<div class="c-overlay js-press-overlay | bg-beige" data-overlay="press">
    <div class="c-overlay__inner u-fluid d-flex justify-content-start align-item-start align-items-lg-center">
        <div class="c-overlay__close js-close-overlay u-pointer">
            <img class="d-block u-pointer" src="<?php echo get_icon('modal-close.svg'); ?>" alt="Close Modal">
        </div>
        <div class="container-lg">
            <div class="row justify-content-center pb-5 pb-lg-0 mb-5 mb-lg-0">
                <div class="col-lg-4 pr-lg-5 pt-5 pt-lg-0 mb-4 mb-lg-0">
                    <h1 class="t-heading t-red"><?php echo get_field('press_modal_heading','option'); ?></h1>
                    <p><?php echo get_field('press_modal_text','option'); ?></p>
                </div>
                <div class="col-lg-7 offset-xl-1 col-xl-6 mb-5 mb-lg-0 pb-5 pb-lg-0">
                    <form action="#" class="c-form js-contact-form">
                        <div class="c-form__field c-form__field--halfwidth">
                            <input id="first_name" name="first_name" type="text" placeholder="First Name">
                            <label class="c-form__label" for="first_name">First Name</label>
                        </div>
                        <div class="c-form__field c-form__field--halfwidth">
                            <input id="last_name" name="last_name" type="text" placeholder="Last Name">
                            <label class="c-form__label" for="last_name">Last Name</label>
                        </div>
                        <div class="c-form__field">
                            <input id="email" name="email" type="email" placeholder="Email Address">
                            <label class="c-form__label" for="email">Email</label>
                        </div>
                        <div class="c-form__field">
                            <select class="js-selectric transparent" name="enquiry_type" id="enquiry_type">
                                <option value="" selected disabled>Type of Enquiry</option>
                                <option value="Press Enquiry">Press Enquiry</option>
                                <option value="Recruitment & Careers">Recruitment & Careers</option>
                                <option value="General Enquiry">General Enquiry</option>
                            </select>
                            <label class="c-form__label is-for-selectric" for="email">Enquiry Type</label>
                        </div>
                        <div class="c-form__field">
                            <textarea id="message" name="message" placeholder="Message"></textarea>
                            <label class="c-form__label" for="message">Message</label>
                        </div>
                        <div class="c-form__actions | d-flex align-items-start justify-content-between">
                            <div class="c-form__checkboxes"></div>
                            <input id="contact-form-submit" class="c-btn c-btn--large" type="submit" value="Submit">
                        </div>
                        <div class="c-form__messages u-w100">
                            <p class="success">Thanks for getting in touch. A member of the team will get back to you soon.</p>
                            <p class="fail">Please make sure you have the required fields filled in correctly.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>