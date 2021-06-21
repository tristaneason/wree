<?php
// Component: Recent Articles

$recentPosts = get_posts([
    'post_type' => 'post',
    'posts_per_page' => '4',
    'orderby' => 'date'
]);
?>

<section id="componentRecentArticles">
    <div class="container">
        <h2></h2>
        <div class="grid two-thirds">
            <div class="articles-list">
                <?php foreach ($recentPosts as $recentPost): ?>
                    <article class="article-snippet flex align-center space-between">
                        <div class="padding">
                            <h3 class="h5">
                                <a href="<?= get_permalink($recentPost->ID); ?>">
                                    <?= $recentPost->post_title; ?>
                                </a>
                            </h3>
                            <span class="text-small">
                                <?= date('F j, Y', strtotime($recentPost->post_date)); ?>
                            </span>
                            <span class="text-small">
                                by <a href="<?= get_author_posts_url($recentPost->post_author); ?>"><?= get_the_author_meta('display_name', $recentPost->post_author); ?></a>
                            </span>
                            <p><?= $recentPost->post_excerpt; ?></p>
                        </div>
                        <a href="<?= get_permalink($recentPost->ID); ?>" class="thumbnail-link">
                            <img src="<?= get_the_post_thumbnail_url($recentPost->ID, 'medium'); ?>" class="thumbnail" alt="<?= $recentPost->post_title; ?> Thumbnail">
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
            <div>
                <?php include theme_root('/components/sidebar.php'); ?>
            </div>
        </div>
        <?php include theme_root('/components/buttonGetRecentArticles.php'); ?>
    </div>
</section>
