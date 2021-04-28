<?php
// Component: Hero
?>

<section id="componentHero" class="flex align-center" style="background-image: url('<?php  ?>')">
    <div class="container flex column justify-center">
        <h1><?php the_field('heading'); ?></h1>
        <h2><?php the_field('subheading'); ?></h2>
        <div class="cta flex">
            <a href="<?php the_field('cta_url'); ?>" class="button large">
                <?php the_field('cta_text'); ?>
            </a>
        </div>
    </div>
</section>
