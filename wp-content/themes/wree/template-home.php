<?php
// Template Name: Home
?>

<?php get_header(); ?>

<main id="templateHome">
    <?php include theme_root('/components/hero.php'); ?>
    <?php include theme_root('/components/featuredCards.php'); ?>
    <?php include theme_root('/components/iconLinks.php'); ?>
    <?php include theme_root('/components/ctaSection.php'); ?>
    <?php include theme_root('/components/joinWree.php'); ?>
    <section id="authors" class="container">
        <h2><?= get_field(''); ?></h2>
        <div class="grid fourths">
            <?php // while (have_posts()): ?>
            <?php // endwhile; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
