<?php
// Template: Default
?>

<?php get_header(); ?>

<main id="templateDefault">
    <section class="container grid two-thirds">
        <article class="">
            <header class="post-header">
                <h1><?php the_title(); ?></h1>
            </header>
            <div class="post-body">
                <img src="<?php the_post_thumbnail_url() ?>" class="featured-image img-responsive" alt="Image for <?php the_title(); ?>">
                <?php the_content(); ?>
            </div>
            <footer class="post-footer">

            </footer>
        </article>
        <?php include theme_root('/components/sidebar.php'); ?>
    </section>
</main>

<?php get_footer(); ?>
