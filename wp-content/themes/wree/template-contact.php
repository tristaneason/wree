<?php
// Template Name: Contact
?>

<?php get_header(); ?>

<main id="templateContact">
    <section class="container grid two-thirds">
        <article class="">
            <header class="post-header">
                <h1><?php the_title(); ?></h1>
            </header>
            <div class="post-body">
                <?= do_shortcode(get_field('contact_form')); ?>
            </div>
            <footer class="post-footer">

            </footer>
        </article>
        <?php include theme_root('/components/sidebar.php'); ?>
    </section>
</main>

<?php get_footer(); ?>
