<section class="faqs | module module-<?php echo $mod_num; ?>">
    <div class="container-xxl">
        <div class="js-hidden | row">
            <div class="col-xl-10 offset-xl-1">
                <?php if ($m['title']) : ?>
                    <h1 class="t-heading mb-5"><?php echo $m['title']; ?></h1>
                <?php endif; ?>

                <?php $count = 1; if ($m['faqs']) : foreach($m['faqs'] as $question) : ?>
                    <div class="faqs__question-container js-faq-question | u-rel d-flex flex-wrap u-pointer">
                        <h3 class="question t-subheading t-black mb-0" data-count="<?php echo $count; ?>"><?php echo $question['question']; ?></h3>
                        <div class="answer js-faq-answer pt-3 pt-lg-0"><?php echo $question['answer']; ?></div>
                        <img class="icon align-self-lg-center u-pointer" src="<?php echo get_icon('close-icon.svg'); ?>" alt="Open Question">
                    </div>
                <?php $count++; endforeach; endif; ?>
            </div>
        </div>
    </div>
</section>