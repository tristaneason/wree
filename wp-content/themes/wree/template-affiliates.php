<?php
// Template Name: Affiliates

$affiliates = get_field('affiliates');
?>

<?php get_header(); ?>

<main id="templateAffiliates">
    <section class="container grid two-thirds">
        <article class="">
            <header class="post-header">
                <h1><?php the_title(); ?></h1>
            </header>
            <div class="post-body">
                <?php foreach ($affiliates as $link): ?>
                    <div class="flex align-center space-between affiliate">
                        <div>
                            <h2 class="h4">
                                <a href="<?= $link['affiliate_url']; ?>" target="_blank">
                                    <?= $link['affiliate_name']; ?>
                                </a>
                            </h2>
                            <?= $link['affiliate_description']; ?>
                        </div>
                        <a href="<?= $link['affiliate_url']; ?>" target="_blank">
                            <img src="<?= $link['affiliate_logo']['url']; ?>" alt="<?= $link['affiliate_logo']['alt']; ?>">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <footer class="post-footer">

            </footer>
        </article>
        <?php include theme_root('/components/sidebar.php'); ?>
    </section>
</main>

<?php get_footer(); ?>
