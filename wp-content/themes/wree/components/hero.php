<?php
// Component: Hero

$featured_post = get_field('featured_post_main');
$featured_id = $featured_post->ID;
$featured_date = date('F j, Y', strtotime($featured_post->post_date));
?>

<style>
    #componentHero {
        background-image: url('<?= get_the_post_thumbnail_url($featured_id); ?>');
        background-position: center;
    }
</style>

<section id="componentHero" class="flex align-center">
    <div class="container flex column justify-center">
        <h1><?= get_the_title($featured_id); ?></h1>
        <h2><?= get_the_excerpt($featured_id); ?></h2>
        <div class="cta">
            <a href="<?= get_permalink($featured_id); ?>" class="button large">
                Read More
            </a>
        </div>
    </div>
</section>
