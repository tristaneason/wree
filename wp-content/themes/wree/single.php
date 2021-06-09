<?php
// Layout: Article
?>

<?php
get_header();

$th_size = ['size' => '200'];
$author_id = get_the_author_meta('ID');
$author_url = get_author_posts_url($author_id);
$author_desc = get_the_author_meta('description');
$author_name = get_the_author_meta('display_name');
$author_avatar = get_avatar_url($author_id, $th_size);
$author_posts = wp_get_recent_posts([
    'author' => get_the_author_meta('ID'),
    'numberposts' => 3,
    'post_status' => 'publish'
]);
?>

<main id="article">
    <section class="container grid two-thirds">
        <article class="post-container">
            <header class="post-header">
                <span class="category"><?= get_the_category()[0]->name; ?></span>
                <h1><?php the_title(); ?></h1>
                <span class="credit">
                    <?php the_date(); ?> by <a href="<?= $author_url; ?>"><?= $author_name; ?></a>
                </span>
                <img src="<?php the_post_thumbnail_url() ?>" class="featured-image img-responsive" alt="Image for <?php the_title(); ?>">
            </header>
            <div class="post-body">
                <?php the_content(); ?>
                <div class="share-icons flex persist-row align-center justify-end">
                    <span class="text-small"><em>Share this article</em></span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=&description=<?php the_excerpt(); ?>">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
            <footer class="post-footer hidden-mobile">
                <div class="flex align-center">
                    <img src="<?= $author_avatar; ?>" alt="<?= $author_name; ?>" class="author-thumb">
                    <div class="">
                        <h5 class="h6"><?= $author_name; ?></h5>
                        <p class="author-description"><?= $author_desc; ?></p>
                    </div>
                </div>
                <div>
                    More articles by <a href="<?= $author_url; ?>"><?= $author_name; ?></a>
                </div>
            </footer>
        </article>
        <div class="">
            <?php include theme_root('/components/sidebar.php'); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
