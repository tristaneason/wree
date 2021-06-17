<?php
// Component: Hero

$hero_cta = get_field('hero_cta_url');
$hero_cta_id = $hero_cta->ID;
$featured_post = get_field('featured_post_main');
$featured_id = $featured_post->ID;
$featured_date = date('F j, Y', strtotime($featured_post->post_date));
?>

<style>
    <?php if (get_field('hero_type') === 'Statement'): ?>
    #componentHero {
        background-image: url('<?= get_field('hero_background'); ?>');
        background-position: <?= get_field('hero_background_position'); ?>;
    }
    <?php else: ?>
    #componentHero {
        background-image: url('<?= get_the_post_thumbnail_url($featured_id); ?>');
        background-position: <?= get_field('featured_post_background_position'); ?>;
    }
    <?php endif; ?>
</style>

<section id="componentHero" class="flex align-center">
    <?php if (get_field('hero_type') === 'Statement'): ?>
        <div class="container statement">
            <h1><?= get_field('hero_heading'); ?></h1>
            <h2><?= get_field('hero_subheading'); ?></h2>
            <a href="<?= get_permalink($hero_cta_id); ?>" class="button large">
                <?= get_field('hero_cta'); ?>
            </a>
        </div>
    <?php else: ?>
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
    <?php endif; ?>
</section>
