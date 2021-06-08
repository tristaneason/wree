<?php
// Template Name: Home
?>

<?php get_header(); ?>

<main id="templateHome">
    <?php include theme_root('/components/hero.php'); ?>
    <?php include theme_root('/components/featuredCards.php'); ?>
    <?php include theme_root('/components/recentArticles.php'); ?>
    <?php include theme_root('/components/fourThumbsStatic.php'); ?>
    <?php include theme_root('/components/ctaSection.php'); ?>
    <?php include theme_root('/components/joinWree.php'); ?>
    <?php include theme_root('/components/fourThumbsAuthors.php'); ?>
</main>

<?php get_footer(); ?>
