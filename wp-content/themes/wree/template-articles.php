<?php
// Template Name: Articles
?>

<main id="templateBlog">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <section id="cards" class="grid fourths">
            <?php
            while (have_posts()) {
                the_post();
                include __DIR__ . '/components/card.php';
            }
            ?>
        </section>
    </div>
</main>
