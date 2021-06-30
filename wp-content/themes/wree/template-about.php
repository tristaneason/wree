<?php
// Template Name: About
?>

<?php get_header(); ?>

<main id="templateAbout">
    <section class="container grid two-thirds">
        <article class="">
            <header class="post-header">
                <h1><?php the_title(); ?></h1>
                <img src="<?= get_the_post_thumbnail_url(); ?>" alt="About WREE">
            </header>
            <div class="">
                <h2><?php the_field('who_we_are_heading'); ?></h2>
                <?php the_field('who_we_are'); ?>
                <h2><?php the_field('wree_history_heading'); ?></h2>
                <?php the_field('wree_history'); ?>
            </div>
            <footer class="post-footer">

            </footer>
        </article>
        <div class="">
            <?php include theme_root('/components/sidebar.php'); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
