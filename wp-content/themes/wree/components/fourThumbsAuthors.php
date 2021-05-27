<?php
// Component: Four Thumbs — Authors

$author1 = get_field('contributor_1');
$author2 = get_field('contributor_2');
$author3 = get_field('contributor_3');
$author4 = get_field('contributor_4');

$thumb_size = ['size' => '400'];

$authorsArgs = [
    'author__in' => [$author1['ID'], $author2['ID'], $author3['ID'], $author4['ID']],
    'posts_per_page' => 4
];

$authorsPosts = get_posts($authorsArgs);
?>

<style>
    #author1 .thumbnail {
        background-image: url('<?= get_avatar_url($author1['ID'], $thumb_size); ?>');
    }
    #author2 .thumbnail {
        background-image: url('<?= get_avatar_url($author2['ID'], $thumb_size); ?>');
    }
    #author3 .thumbnail {
        background-image: url('<?= get_avatar_url($author3['ID'], $thumb_size); ?>');
    }
    #author4 .thumbnail {
        background-image: url('<?= get_avatar_url($author4['ID'], $thumb_size); ?>');
    }
</style>

<section id="fourThumbsAuthors" class="fourThumbs">
    <div class="container">
        <h2><?= get_field('contributor_heading'); ?></h2>
        <div class="grid fourths">
            <!-- Author 1 -->
            <div id="author1" class="flex column author">
                <a href="<?= get_author_posts_url($author1['ID']); ?>">
                    <div class="thumbnail"></div>
                    <h3><?= $author1['display_name']; ?></h3>
                </a>
            </div>
            <!-- Author 2 -->
            <div id="author2" class="flex column author">
                <a href="<?= get_author_posts_url($author2['ID']); ?>">
                    <div class="thumbnail"></div>
                    <h3><?= $author2['display_name']; ?></h3>
                </a>
            </div>
            <!-- Author 3 -->
            <div id="author3" class="flex column author">
                <a href="<?= get_author_posts_url($author3['ID']); ?>">
                    <div class="thumbnail"></div>
                    <h3><?= $author3['display_name']; ?></h3>
                </a>
            </div>
            <!-- Author 4 -->
            <div id="author4" class="flex column author">
                <a href="<?= get_author_posts_url($author4['ID']); ?>">
                    <div class="thumbnail"></div>
                    <h3><?= $author4['display_name']; ?></h3>
                </a>
            </div>
        </div>

        <div id="authorsPosts" class="authors-posts">
            <h3 class="heading-latest">Latest articles by these authors</h3>
            <div class="grid fourths">
                <?php foreach ($authorsPosts as $authorPost): ?>
                    <div class="card">
                        <a href="<?= get_the_permalink($authorPost->ID); ?>" class="flex align-center">
                            <div class="thumbnail" style="background-image: url('<?= get_the_post_thumbnail_url($authorPost->ID, 'medium'); ?>');"></div>
                        </a>
                        <div class="title-excerpt">
                            <a href="<?= get_the_permalink($authorPost->ID); ?>">
                                <h3><?= $authorPost->post_title; ?></h3>
                            </a>
                            <span class="date"><?= date('F j, Y', strtotime($authorPost->post_date)); ?></span>
                            <span class="name">by <a href="<?= get_author_posts_url($authorPost->post_author); ?>">
                                    <?= get_the_author_meta('display_name', $authorPost->post_author); ?></a></span>
                            <p><?= $authorPost->post_excerpt; ?></p>
                            <a href="<?= get_the_permalink($authorPost->ID); ?>" class="flex">
                                <span>Continue reading</span> <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
