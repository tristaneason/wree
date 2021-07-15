<?php
// Template: Author

$author_ID = get_the_author_meta('ID');
$author_avatar = get_avatar_url($author_ID, ['size' => '400']);
$author_desc = get_the_author_meta('description');

$authorPosts = get_posts([
    'author' => $author_ID,
    'post_type' => 'post',
    'posts_per_page' => -1,
    'orderby' => 'date'
]);
?>

<?php get_header(); ?>

<main id="author">
    <section class="container grid two-thirds">
        <div class="">
            <h1 class="mt-0">Articles by <?php the_author(); ?></h1>
            <div class="grid halves">
                <?php foreach ($authorPosts as $authorPost):
                    $post_date = date('F j, Y', strtotime($authorPost->post_date));
                    ?>
                    <article class="card">
                        <header class="post-header">
                            <div class="thumbnail">
                                <a href="<?= get_permalink($authorPost->ID); ?>" class="thumbnail-link">
                                    <img src="<?= get_the_post_thumbnail_url($authorPost->ID, 'medium'); ?>" class="thumbnail" alt="<?= $authorPost->post_title; ?> Thumbnail">
                                </a>
                            </div>
                        </header>
                        <div class="">
                            <span class="category"><?= get_the_category($authorPost->ID)[0]->name; ?></span>
                            <h2 class="mt-0">
                                <a href="<?= get_permalink($authorPost->ID); ?>">
                                    <?= $authorPost->post_title; ?>
                                </a>
                            </h2>
                            <span class="date"><?= $post_date; ?></span>
                            <span class="name">by <a href="<?= get_author_posts_url($authorPost->post_author); ?>"><?= get_the_author_meta('display_name', $authorPost->post_author); ?></a></span>
                            <p><?= $authorPost->post_excerpt; ?></p>
                        </div>
                        <footer class="post-footer">
                            <a href="<?= get_permalink($authorPost->ID); ?>" class="continue">
                                Continue reading <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </footer>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="">
            <?php include theme_root('/components/sidebar.php'); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
