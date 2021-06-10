<?php
// Component: Four Thumbs — Authors

$author1 = get_field('contributor_1');
$author2 = get_field('contributor_2');
$author3 = get_field('contributor_3');
$author4 = get_field('contributor_4');

$thumb_size = ['size' => '400'];

$authorsPosts = get_posts([
    'author__in' => [$author1['ID'], $author2['ID'], $author3['ID'], $author4['ID']],
    'posts_per_page' => 4
]);
?>

<section id="fourThumbsAuthors" class="fourThumbs">
    <div class="container">
        <h2><?= get_field('contributor_heading'); ?></h2>
        <div class="grid fourths">
            <!-- Author 1 -->
            <div id="author1" class="thumbnail-container">
                <a href="<?= get_author_posts_url($author1['ID']); ?>" class="thumbnail">
                    <img src="<?= get_avatar_url($author1['ID'], $thumb_size); ?>" alt="<?= $author1['display_name']; ?>">
                </a>
                <a href="<?= get_author_posts_url($author1['ID']); ?>" class="thumbnail">
                    <h3><?= $author1['display_name']; ?></h3>
                </a>
            </div>
            <!-- Author 2 -->
            <div id="author2" class="thumbnail-container">
                <a href="<?= get_author_posts_url($author2['ID']); ?>" class="thumbnail">
                    <img src="<?= get_avatar_url($author2['ID'], $thumb_size); ?>" alt="<?= $author2['display_name']; ?>">
                </a>
                <a href="<?= get_author_posts_url($author2['ID']); ?>" class="thumbnail">
                    <h3><?= $author2['display_name']; ?></h3>
                </a>
            </div>
            <!-- Author 3 -->
            <div id="author3" class="thumbnail-container">
                <a href="<?= get_author_posts_url($author3['ID']); ?>" class="thumbnail">
                    <img src="<?= get_avatar_url($author3['ID'], $thumb_size); ?>" alt="<?= $author3['display_name']; ?>">
                </a>
                <a href="<?= get_author_posts_url($author3['ID']); ?>" class="thumbnail">
                    <h3><?= $author3['display_name']; ?></h3>
                </a>
            </div>
            <!-- Author 4 -->
            <div id="author4" class="thumbnail-container">
                <a href="<?= get_author_posts_url($author4['ID']); ?>" class="thumbnail">
                    <img src="<?= get_avatar_url($author4['ID'], $thumb_size); ?>" alt="<?= $author4['display_name']; ?>">
                </a>
                <a href="<?= get_author_posts_url($author4['ID']); ?>" class="thumbnail">
                    <h3><?= $author4['display_name']; ?></h3>
                </a>
            </div>
        </div>

        <div id="authorsPosts" class="authors-posts">
            <h3 class="heading-latest">Latest articles by these authors</h3>
            <div class="grid fourths">
                <?php foreach ($authorsPosts as $authorPost): ?>
                    <div class="card">
                        <a href="<?= get_the_permalink($authorPost->ID); ?>" class="thumbnail">
                            <img src="<?= get_the_post_thumbnail_url($authorPost->ID, 'medium'); ?>" alt="<?= $authorPost->post_title; ?> Thumbnail">
                        </a>
                        <a href="<?= get_the_permalink($authorPost->ID); ?>">
                            <h3><?= $authorPost->post_title; ?></h3>
                        </a>
                        <span class="date"><?= date('F j, Y', strtotime($authorPost->post_date)); ?></span>
                        <span class="name">by <a href="<?= get_author_posts_url($authorPost->post_author); ?>">
                                <?= get_the_author_meta('display_name', $authorPost->post_author); ?></a></span>
                        <p><?= $authorPost->post_excerpt; ?></p>
                        <a href="<?= get_the_permalink($authorPost->ID); ?>" class="continue">
                            <span>Continue reading</span> <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
