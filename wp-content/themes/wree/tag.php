<?php
// Layout: Tag
?>

<?php get_header(); ?>

<main id="tag">
    <header class="container">
        <h1 class="mt-0">Articles tagged with <span class="bg-emphasis-primary"><?php single_tag_title(); ?></span></h1>
    </header>
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
                    <h2 class="mt-0">
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
</main>

<?php get_footer(); ?>
