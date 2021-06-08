<?php
// Layout: Article
?>

<?php get_header(); ?>

<main id="article">
    <section class="container grid two-thirds">
        <article class="post-container">
            <header class="post-header">
                <h1><?php the_title(); ?></h1>
                <span>
                    <?php the_date(); ?> by <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
                </span>
                <img src="<?php the_post_thumbnail_url() ?>" class="img-responsive" alt="">
            </header>
            <div class="post-body">
                <?php the_content(); ?>
            </div>
            <footer class="post-footer">
                <span>More articles by <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a></span>
            </footer>
        </article>
        <div class="">
            <?php include theme_root('/components/sidebar.php'); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
