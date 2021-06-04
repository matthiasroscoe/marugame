<?php 
$row_class = '';
$module_bg_colour = 'beige';
$text_col_class = 'offset-lg-1';
$lottie_container_class = '';
$heading_colour = '';
$subheading_colour = '';
$text_colour = '';
$button_primary_class = '';
$button_secondary_class = 'c-btn--outline c-btn--outline--red';
$form_colour_class = '';
$form_label_colour = 'beige--dark';
if ($m['module_design'] == 'red') {
    $module_bg_colour = 'red';
    $row_class = 'flex-lg-row-reverse justify-content-center';
    $text_col_class = '';
    $lottie_container_class = 'club-signup__lottie-container-2--red';
    $heading_colour = 't-white';
    $subheading_colour = 't-white';
    $text_colour = 't-white';
    $button_primary_class = 'c-btn--white';
    $button_secondary_class = 'c-btn--outline';
    $form_colour_class = 'c-form--white';
    $form_label_colour = 'beige--dark';
}

$last_module_class .= ($module_count == $mod_num) ? ' module--last' : '';

?>

<section class="club-signup | u-rel module module-<?php echo $mod_num . $last_module_class . ' club-signup--' . $module_bg_colour; ?>">
    <?php if ($m['module_design'] != 'red') : ?>
        <div class="club-signup__lottie-container-1 js-lottie-club-signup-line js-lottie-anim"></div>
    <?php endif; ?>

    <div class="club-signup__inner club-signup__inner--<?php echo $module_bg_colour . $last_module_class; ?>">
        <div class="container-xxl">
            <div class="js-hidden | row <?php echo $row_class; ?>">
                <div class="club-signup__content | col-lg-5 <?php echo $text_col_class; ?>">
                    <h1 class="club-signup__heading | <?php echo $heading_colour; ?> t-heading"><?php echo $m['heading']; ?></h1>
                    <?php if ($m['subheading']): ?>
                        <h3 class="t-subheading <?php echo $subheading_colour; ?>"><?php echo $m['subheading']; ?></h3>
                    <?php endif; ?>
                    <?php if ($m['text']) : ?>
                        <p class="club-signup__text <?php echo $text_colour; ?>"><?php echo $m['text']; ?></p>
                    <?php endif; ?>
                    
                    <div class="club-signup__buttons">
                        <a href="#" class="c-btn c-btn--arrow <?php echo $button_primary_class; ?> mr-2 js-show-club-signup-form">Sign Up</a>
                        <a href="/marugame-club/" class="c-btn c-btn--arrow c-btn--outline <?php echo $button_secondary_class; ?> js-show-club-signup-form">Learn more</a>
                    </div>
    
                    <form class="c-form club-signup__form <?php echo $form_colour_class; ?> js-club-signup-step-1" action="#">
                        <div class="c-form__field c-form__field--halfwidth">
                            <label class="c-form__label <?php echo $form_label_colour; ?>" for="first-name">First Name</label>
                            <input id="first_name" name="first_name" type="text" placeholder="First Name">
                        </div>
                        <div class="c-form__field c-form__field--halfwidth">
                            <label class="c-form__label <?php echo $form_label_colour; ?>" for="last-name">Last Name</label>
                            <input id="last_name" name="last_name" type="text" placeholder="Last Name">
                        </div>
                        <div class="c-form__field">
                            <label class="c-form__label <?php echo $form_label_colour; ?>" for="email">Email</label>
                            <input id="email" name="email" type="email" placeholder="Email Address">
                        </div>
                        <?php 
                                // Get acteol signup vars
                                $supinfo_status = 'standard';
                                $source_id = 'Website Signup Form';
                                if ($m['signup_type'] == 'student') {
                                    $supinfo_status = 'student';
                                    $source_id = 'Student Website Signup Form';
                                } elseif ($m['signup_type'] == 'local_business') {
                                    $supinfo_status = 'student';
                                    $source_id = 'Local Business Website Signup Form';
                                    ?>
                                        <div class="c-form__field">
                                            <label class="c-form__label <?php echo $form_label_colour; ?>" for="local_business">Local Business</label>
                                            <input id="local_business" name="local_business" type="text" placeholder="Local Business">
                                        </div>
                                        <div class="c-form__field">
                                            <label class="c-form__label <?php echo $form_label_colour; ?>" for="local_business_code">Local Business Code</label>
                                            <input id="local_business_code" name="local_business_code" type="text" placeholder="Local Business Code">
                                        </div>
                                    <?php
                                }
                            ?>
                            <input type="hidden" id="supinfo_status" value="<?php echo $supinfo_status; ?>">
                            <input type="hidden" id="source_id" value="<?php echo $source_id; ?>">
                        <div class="c-form__actions | d-flex align-items-start justify-content-between">
                            <label class="c-form__checkbox" for="terms">
                                <input id="terms" name="terms" type="checkbox">
                                <span>I opt-in to receive news & updates from Marugame.</span>
                            </label>
                            <input type="submit" href="#" id="acteol-signup-step-1" class="c-btn <?php echo $form_button_class; ?> c-btn--large" value="Sign Up">
                        </div>
                        <div class="c-form__messages | u-w100">
                            <p class="invalid">Please ensure your email is valid and you have agreed to opt-in.</p>
                            <p class="fail">There has been an error processing your details. Please try again later.</p>
                        </div>
                    </form>
                </div>
                <div class="club-signup__image | col-lg-6">
                    <div class="club-signup__lottie-container-2 <?php echo $lottie_container_class; ?> js-lottie-noodle-bowl js-lottie-anim"></div>
                </div>
            </div>
        </div>
    </div>
</section>