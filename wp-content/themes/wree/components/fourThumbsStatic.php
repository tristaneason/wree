<?php
// Component: Four Thumbs — Static
?>

<section id="fourThumbsStatic" class="fourThumbs">
    <div class="container grid fourths">
        <!-- Thumbnail 1 -->
        <div class="thumbnail-container">
            <a href="<?= get_field('thumbnail_url_1'); ?>" class="thumbnail">
                <img src="<?= get_field('thumbnail_1'); ?>" alt="Thumbnail 1">
            </a>
            <a href="<?= get_field('thumbnail_url_1'); ?>" class="thumbnail">
                <h3><?= get_field('thumbnail_heading_1'); ?></h3>
            </a>
        </div>
        <!-- Thumbnail 2 -->
        <div class="thumbnail-container">
            <a href="<?= get_field('thumbnail_url_2'); ?>" class="thumbnail">
                <img src="<?= get_field('thumbnail_2'); ?>" alt="Thumbnail 2">
            </a>
            <a href="<?= get_field('thumbnail_url_2'); ?>" class="thumbnail">
                <h3><?= get_field('thumbnail_heading_2'); ?></h3>
            </a>
        </div>
        <!-- Thumbnail 3 -->
        <div class="thumbnail-container">
            <a href="<?= get_field('thumbnail_url_3'); ?>" class="thumbnail">
                <img src="<?= get_field('thumbnail_3'); ?>" alt="Thumbnail 3">
            </a>
            <a href="<?= get_field('thumbnail_url_3'); ?>" class="thumbnail">
                <h3><?= get_field('thumbnail_heading_3'); ?></h3>
            </a>
        </div>
        <!-- Thumbnail 4 -->
        <div class="thumbnail-container">
            <a href="<?= get_field('thumbnail_url_4'); ?>" class="thumbnail">
                <img src="<?= get_field('thumbnail_4'); ?>" alt="Thumbnail 4">
            </a>
            <a href="<?= get_field('thumbnail_url_4'); ?>" class="thumbnail">
                <h3><?= get_field('thumbnail_heading_4'); ?></h3>
            </a>
        </div>
    </div>
</section>
