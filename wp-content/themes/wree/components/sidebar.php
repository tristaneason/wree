<?php
// Component: Sidebar
?>

<aside class="sidebar">
    <?php if (is_single()): ?>
        <section class="author-bio border-1 p-1">
            <h3 class="mt-0">About <?php the_author(); ?></h3>
            <img src="<?= $author_avatar; ?>" alt="<?php the_author(); ?>" class="author-thumb">
            <p class="author-description"><?= $author_desc; ?></p>
            <h4>More articles by <?= $author_name; ?></h4>
            <?php foreach ($author_posts as $author_post): ?>
                <div class="author-article border-1 flex align-center space-between">
                    <a href="<?php the_permalink($author_post['ID']); ?>" class="mr-05">
                        <img src="<?= get_the_post_thumbnail_url($author_post['ID']); ?>" alt="<?= $author_post['post_title']; ?> Thumbnail" class="img-responsive">
                    </a>
                    <a href="<?php the_permalink($author_post['ID']); ?>" class="my-0"><?= $author_post['post_title']; ?></a>
                </div>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
    <?php if (is_author()): ?>
        <section class="author-bio border-1 p-1">
            <h3 class="mt-0">About <?php the_author(); ?></h3>
            <img src="<?= $author_avatar; ?>" alt="<?php the_author(); ?>" class="author-thumb">
            <p class="author-description"><?= $author_desc; ?></p>
        </section>
    <?php endif; ?>
    <section class="meeting-section border-1 p-1">
        <h3 class="mt-0">Next WREE Event</h3>
        <?= get_field('meeting_type'); ?>
        <?php if (get_field('meeting_type', 'option') === 'Meeting'): ?>
            <p class="bg-emphasis">Board meeting on Zoom</p>
        <?php elseif (get_field('meeting_type', 'option') === 'Webinar'): ?>
            <p class="bg-emphasis">Webinar on Zoom</p>
        <?php else: ?>
            <p class="bg-emphasis">Meeting on Zoom</p>
        <?php endif; ?>
        <b>Date</b>: <?= get_field('meeting_date', 'option'); ?>
        <br>
        <b>Time</b>: <?= get_field('meeting_time', 'option'); ?>
        <?= get_field('meeting_description', 'option'); ?>
        <a href="<?= get_field('meeting_button_url', 'option'); ?>" class="button small" target="_blank">
            <?= get_field('meeting_button_text', 'option'); ?>
        </a>
    </section>
    <section class="about-section border-1 p-1">
        <h3 class="mt-0">What We Do</h3>
        <?= get_field('what_we_do', 'option'); ?>
    </section>
    <section class="contact-section border-1 p-1">
        <h3 class="mt-0">Contact WREE</h3>
        <span class="font-bold">Address</span>
        <address>
            <?= get_field('street', 'option'); ?><br>
            <?= get_field('city', 'option'); ?>, <?= get_field('state', 'option'); ?> <?= get_field('zip', 'option'); ?>
        </address>
        <span class="font-bold d-block">Email</span>
        <a href="mailto:<?= get_field('email', 'option'); ?>">
            <?= get_field('email', 'option'); ?>
        </a>
        <span class="font-bold d-block">Phone</span>
        <a href="tel:<?= get_field('phone', 'option'); ?>">
            <?= get_field('phone', 'option'); ?>
        </a>
    </section>
    <?php if (is_single() && $article_tags): ?>
        <section class="tag-section border-1 p-1">
            <h3 class="mt-0">Tags</h3>
            <?php foreach ($article_tags as $tag): ?>
                <a href="<?= get_tag_link($tag->term_id); ?>" class="tag">
                    <?= $tag->name; ?>
                </a>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
</aside>
