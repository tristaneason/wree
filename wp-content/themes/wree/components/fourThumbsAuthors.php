<?php
// Component: Four Thumbs — Authors

$author1 = get_field('contributor_1');
$author2 = get_field('contributor_2');
$author3 = get_field('contributor_3');
$author4 = get_field('contributor_4');

$thumb_size = ['size' => '400'];
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
            <div id="author1" class="flex column">
                <a href="<?= get_author_posts_url($author1['ID']); ?>">
                    <div class="thumbnail"></div>
                    <h3><?= $author1['display_name']; ?></h3>
                </a>
            </div>
            <!-- Author 2 -->
            <div id="author2" class="flex column">
                <a href="<?= get_author_posts_url($author2['ID']); ?>">
                    <div class="thumbnail"></div>
                    <h3><?= $author2['display_name']; ?></h3>
                </a>
            </div>
            <!-- Author 3 -->
            <div id="author3" class="flex column">
                <a href="<?= get_author_posts_url($author3['ID']); ?>">
                    <div class="thumbnail"></div>
                    <h3><?= $author3['display_name']; ?></h3>
                </a>
            </div>
            <!-- Author 4 -->
            <div id="author4" class="flex column">
                <a href="<?= get_author_posts_url($author4['ID']); ?>">
                    <div class="thumbnail"></div>
                    <h3><?= $author4['display_name']; ?></h3>
                </a>
            </div>
        </div>
    </div>
</section>
