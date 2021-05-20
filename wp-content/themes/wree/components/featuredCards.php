<?php
// Component: Featured Cards
?>

<?php
$feat_1 = get_field('featured_post_1');
$feat_2 = get_field('featured_post_2');
$id_1 = $feat_1->ID;
$id_2 = $feat_2->ID;
$date_1 = date('F j, Y', strtotime($feat_1->post_date));
$date_2 = date('F j, Y', strtotime($feat_2->post_date));

// var_dump($feat_1);
?>

<style>
    #featuredPost1 .thumbnail {
        background-image: url('<?= get_the_post_thumbnail_url($id_1); ?>');
    }
    #featuredPost2 .thumbnail {
        background-image: url('<?= get_the_post_thumbnail_url($id_2); ?>');
    }
</style>

<section id="featuredCards" class="">
    <div class="container grid halves">
        <div id="featuredPost1" class="card grid two-thirds">
            <div class="flex column">
                <span class="category"><?= get_the_category($id_1)[0]->name; ?></span>
                <a href="<?= get_permalink($id_1); ?>">
                    <h2 class="title h3"><?= get_the_title($id_1); ?></h2>
                </a>
                <span class="date"><?= $date_1; ?></span>
                <p class="excerpt"><?= get_the_excerpt($id_1); ?></p>
            </div>
            <a href="<?= get_permalink($id_1); ?>" class="thumbnail hidden-tablet"></a>
        </div>
        <div id="featuredPost2" class="card grid two-thirds">
            <div class="flex column">
                <span class="category"><?= get_the_category($id_2)[0]->name; ?></span>
                <a href="<?= get_permalink($id_2); ?>">
                    <h2 class="title h3"><?= get_the_title($id_2); ?></h2>
                </a>
                <span class="date"><?= $date_2; ?></span>
                <p class="excerpt"><?= get_the_excerpt($id_2); ?></p>
            </div>
            <a href="<?= get_permalink($id_2); ?>" class="thumbnail hidden-tablet"></a>
        </div>
    </div>
</section>
