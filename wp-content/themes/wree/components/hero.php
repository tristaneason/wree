<?php
// Component: Hero

$featured_post = get_field('featured_post_main');
$featured_id = $featured_post->ID;
$featured_date = date('F j, Y', strtotime($featured_post->post_date));
?>

<style>
    #componentHero {
        background-image: url('<?= get_the_post_thumbnail_url($featured_id); ?>');
        background-position: <?= get_field('featured_post_background_position'); ?>;
    }
</style>

<section id="componentHero" class="flex align-center">
    <div class="container flex column justify-center featured-article">
        <span class="label">Featured Article</span>
        <a href="<?= get_permalink($featured_id); ?>">
            <h1><?= get_the_title($featured_id); ?></h1>
        </a>
        <h2><?= get_the_excerpt($featured_id); ?></h2>
        <a href="<?= get_permalink($featured_id); ?>">
            <h3 class="cta">Continue reading</h3>
        </a>
    </div>
</section>
