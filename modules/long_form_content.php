<section class="long-form-content">
    <div class="container-xxl">
        <div class="js-hidden row">
            <div class="col-lg-8 offset-xl-1 col-xl-7">
                <div class="c-wysiwyg">
                    <?php echo $m['content']; ?>
                </div>
                <?php if ($m['add_button']) {
                    echo get_arrow_button($m['button'], 'mt-4');
                } ?>
            </div>
        </div>
    </div>
</section>