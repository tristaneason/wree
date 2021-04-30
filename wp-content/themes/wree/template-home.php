<?php
// Template Name: Home
?>

<?php get_header(); ?>

<main id="templateHome">
    <?php include theme_root('/components/hero.php'); ?>
    <?php include theme_root('/components/featuredCards.php'); ?>
    <section id="iconLinks" class="container">
        <div class="grid fourths">
            <div class="flex column">
                <img src="<?php the_field(''); ?>" alt="<?php the_field(''); ?> Thumbnail">
                <h3><?php the_field(''); ?></h3>
            </div>
            <div class="flex column">
                <img src="<?php the_field(''); ?>" alt="<?php the_field(''); ?> Thumbnail">
                <h3><?php the_field(''); ?></h3>
            </div>
            <div class="flex column">
                <img src="<?php the_field(''); ?>" alt="<?php the_field(''); ?> Thumbnail">
                <h3><?php the_field(''); ?></h3>
            </div>
            <div class="flex column">
                <img src="<?php the_field(''); ?>" alt="<?php the_field(''); ?> Thumbnail">
                <h3><?php the_field(''); ?></h3>
            </div>
        </div>
    </section>
    <?php include theme_root('/components/ctaSection.php'); ?>
    <section id="joinWree" class="container">
        <div class="flex column align-center">
            <h2><?php the_field(''); ?></h2>
            <?php the_field(''); ?>
            <a href="#" class="button">Contribute to WREE</a>
        </div>
    </section>
    <section id="authors" class="container">
        <h2><?php the_field(''); ?></h2>
        <div class="grid fourths">
            <?php // while (have_posts()): ?>
            <?php // endwhile; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
