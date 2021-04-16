<?php get_header(); ?>

<main id="index">
    <section class="container grid fourths">
        <?php
        while (have_posts()) {
            the_post();
            include __DIR__ . '/components/card.php';
        }
        ?>
    </section>
</main>

<?php get_footer(); ?>
