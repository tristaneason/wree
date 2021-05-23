<?php
// Component: Four Thumbs — Static
?>

<section id="fourThumbsStatic" class="fourThumbs">
    <div class="container grid fourths">
        <div class="flex column">
            <a href="<?= get_field('thumbnail_url_1'); ?>">
                <div class="thumbnail"
                    style="background-image: url('<?= get_field('thumbnail_1'); ?>');">
                </div>
                <h3><?= get_field('thumbnail_heading_1'); ?></h3>
            </a>
        </div>
        <div class="flex column">
            <a href="<?= get_field('thumbnail_url_2'); ?>">
                <div class="thumbnail"
                    style="background-image: url('<?= get_field('thumbnail_2'); ?>');">
                </div>
                <h3><?= get_field('thumbnail_heading_2'); ?></h3>
            </a>
        </div>
        <div class="flex column">
            <a href="<?= get_field('thumbnail_url_3'); ?>">
                <div class="thumbnail"
                    style="background-image: url('<?= get_field('thumbnail_3'); ?>');">
                </div>
                <h3><?= get_field('thumbnail_heading_3'); ?></h3>
            </a>
        </div>
        <div class="flex column">
            <a href="<?= get_field('thumbnail_url_4'); ?>">
                <div class="thumbnail"
                    style="background-image: url('<?= get_field('thumbnail_4'); ?>');">
                </div>
                <h3><?= get_field('thumbnail_heading_4'); ?></h3>
            </a>
        </div>
    </div>
</section>
