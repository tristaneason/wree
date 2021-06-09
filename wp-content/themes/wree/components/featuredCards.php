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

</style>

<section id="featuredCards">
    <div class="container">
        <h2 class="text-center mt-0">Read Our Latest Articles</h2>
    </div>
    <div class="container grid halves">
        <div id="featuredPost1" class="card">
            <a href="<?= get_permalink($id_1); ?>" class="thumbnail">
                <img src="<?= get_the_post_thumbnail_url($id_1); ?>" alt="Featured Post Thumbnail 1">
            </a>
            <span class="category"><?= get_the_category($id_1)[0]->name; ?></span>
            <a href="<?= get_permalink($id_1); ?>">
                <h2 class="title h3"><?= get_the_title($id_1); ?></h2>
            </a>
            <span class="date"><?= $date_1; ?></span>
            <span class="name">by <a href="<?= get_author_posts_url($feat_1->post_author); ?>"><?= get_the_author_meta('display_name', $feat_1->post_author); ?></a></span>
            <p class="excerpt"><?= get_the_excerpt($id_1); ?></p>
            <a href="<?= get_permalink($id_1); ?>" class="continue">
                Continue reading <i class="fas fa-long-arrow-alt-right"></i>
            </a>
        </div>
        <div id="featuredPost2" class="card">
            <a href="<?= get_permalink($id_2); ?>" class="thumbnail">
                <img src="<?= get_the_post_thumbnail_url($id_2); ?>" alt="Featured Post Thumbnail 2">
            </a>
            <span class="category"><?= get_the_category($id_2)[0]->name; ?></span>
            <a href="<?= get_permalink($id_2); ?>">
                <h2 class="title h3"><?= get_the_title($id_2); ?></h2>
            </a>
            <span class="date"><?= $date_2; ?></span>
            <span class="name">by <a href="<?= get_author_posts_url($feat_2->post_author); ?>"><?= get_the_author_meta('display_name', $feat_2->post_author); ?></a></span>
            <p class="excerpt"><?= get_the_excerpt($id_2); ?></p>
            <a href="<?= get_permalink($id_2); ?>" class="continue">
                Continue reading <i class="fas fa-long-arrow-alt-right"></i>
            </a>
        </div>
    </div>
</section>
