<?php
// Layout: Category
?>

<?php get_header(); ?>

<main id="category">
    <?php if (have_posts()): ?>
        <section class="container grid thirds">
            <?php while (have_posts()): ?>
                <?php
                the_post();
                $post_date = date('F j, Y', strtotime(get_the_date()));
                ?>
                <article class="card">
                    <header class="post-header">
                        <div class="thumbnail">
                            <img src="<?php the_post_thumbnail_url('large'); ?>" alt="">
                        </div>
                    </header>
                    <div class="">
                        <h2>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <span class="date"><?= $post_date; ?></span>
                        <span class="name">by <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>"><?= get_the_author_meta('display_name'); ?></a></span>
                        <?php the_excerpt(); ?>
                    </div>
                    <footer class="post-footer">
                        <a href="<?= get_permalink($id_1); ?>" class="continue">
                            Continue reading <i class="fas fa-long-arrow-alt-right"></i>
                        </a>
                    </footer>
                </article>
            <?php endwhile; ?>
        </section>
    <?php else: ?>
        <section class="container grid two-thirds">
            <div class="">
                <h1 class="h3" style="margin-bottom: 3rem">There are currently no articles for this category yet. We'll be working on getting more out as the time goes by.</h1>
                <img src="/wp-content/uploads/2021/06/homes-for-families-banner.jpg" alt="Homes for Families Banner" class="img-responsive">
            </div>
            <?php include theme_root('/components/sidebar.php'); ?>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
