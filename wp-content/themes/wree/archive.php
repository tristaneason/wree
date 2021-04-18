<?php
// Layout: Blog
?>

<main id="layoutBlog">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="grid fourths">
            <?php
            while (have_posts()) {
                the_post();
                include __DIR__ . '/components/card.php';
            }
            ?>
        </div>
    </div>
</main>
