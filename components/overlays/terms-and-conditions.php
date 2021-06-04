<div class="c-overlay js-terms-overlay | bg-beige" data-overlay="terms">
    <div class="c-overlay__inner c-overlay__inner--terms u-fluid d-flex justify-content-start align-item-start align-items-lg-center">
        <div class="c-overlay__close js-close-overlay u-pointer">
            <img class="d-block u-pointer" src="<?php echo get_icon('modal-close.svg'); ?>" alt="Close Modal">
        </div>
        <div class="container-xxl u-h100">
            <div class="row">
                <div class="c-overlay__content | col-lg-8">
                    <h1 class="t-heading t-red pt-5 mb-5">Terms & Conditions</h1>
                    <div class="c-wysiwyg">
                        <?php echo get_field('terms_conditions', 'option'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>