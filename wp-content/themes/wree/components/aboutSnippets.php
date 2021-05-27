<section id="aboutSnippets">
    <div class="container">
        <div class="flex column">
            <div id="whoWeAre" class="">
                <?php if (get_field('who_we_are_heading')): ?>
                    <h2><?= get_field('who_we_are_heading'); ?></h2>
                <?php else: ?>
                    <h2>Who We Are</h2>
                <?php endif; ?>
                <?= get_field('who_we_are'); ?>
            </div>
            <div id="whatWeDo" class="">
                <?php if (get_field('what_we_do_heading')): ?>
                    <h2><?= get_field('what_we_do_heading'); ?></h2>
                <?php else: ?>
                    <h2>What We Do</h2>
                <?php endif; ?>
                <?= get_field('what_we_do'); ?>
            </div>
        </div>
    </div>
</section>
