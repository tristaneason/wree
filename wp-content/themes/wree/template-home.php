<?php
// Template Name: Home

$banner_separator = get_field('banner_separator_image');
?>

<?php get_header(); ?>

<main id="templateHome">
    <?php include theme_root('/components/hero.php'); ?>
    <?php include theme_root('/components/featuredCards.php'); ?>
    <section id="bannerHome" class="banner-separator">
        <img src="<?= esc_url($banner_separator['url']); ?>" alt="<? esc_attr($banner_separator['alt']); ?>">
    </section>
    <?php include theme_root('/components/recentArticles.php'); ?>
    <?php include theme_root('/components/fourThumbsStatic.php'); ?>
    <?php include theme_root('/components/ctaSection.php'); ?>
    <?php include theme_root('/components/joinWree.php'); ?>
    <?php include theme_root('/components/fourThumbsAuthors.php'); ?>
</main>

<?php get_footer(); ?>
