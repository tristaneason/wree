<?php
// Template Name: Articles

$all_posts = get_posts([
    'post_type' => 'post',
    'posts_per_page' => -1,
    'orderby' => 'date'
]);
?>

<?php get_header(); ?>

<main id="templateArticles">
    <section class="container grid thirds">
        <?php foreach ($all_posts as $article): ?>
            <?php
            $post_date = date('F j, Y', strtotime($article->post_date));
            ?>
            <article class="card">
                <header class="post-header">
                    <div class="thumbnail">
                        <a href="<?= get_permalink($article->ID); ?>" class="thumbnail-link">
                            <img src="<?= get_the_post_thumbnail_url($article->ID, 'medium'); ?>" class="thumbnail" alt="<?= $article->post_title; ?> Thumbnail">
                        </a>
                    </div>
                </header>
                <div class="">
                    <h2>
                        <a href="<?= get_permalink($article->ID); ?>">
                            <?= $article->post_title; ?>
                        </a>
                    </h2>
                    <span class="category"><?= get_the_category($article->ID)[0]->name; ?></span>
                    <span class="date"><?= $post_date; ?></span>
                    <span class="name">by <a href="<?= get_author_posts_url($article->post_author); ?>"><?= get_the_author_meta('display_name', $article->post_author); ?></a></span>
                    <p><?= $article->post_excerpt; ?></p>
                </div>
                <footer class="post-footer">
                    <a href="<?= get_permalink($article->ID); ?>" class="continue">
                        Continue reading <i class="fas fa-long-arrow-alt-right"></i>
                    </a>
                </footer>
            </article>
        <?php endforeach; ?>
    </section>
</main>

<?php get_footer(); ?>
