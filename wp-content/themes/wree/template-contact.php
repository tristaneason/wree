<?php
// Template Name: Contact
?>

<?php get_header(); ?>

<main id="templateContact">
    <section class="container grid whole">
        <article class="">
            <header class="post-header">
                <h1><?php the_title(); ?></h1>
            </header>
            <div class="">
                <?= do_shortcode(get_field('contact_form')); ?>
            </div>
            <footer class="post-footer">
                <h3>Contact Info</h3>
                <span class="font-bold">Address</span>
                <address>
                    1808 Hylan Blvd. Suite 1009<br>Staten Island, New York 10305
                </address>
                <span class="font-bold d-block">Email</span>
                <a href="mailto:wree-info@usvanguard.net">wree-info@usvanguard.net</a>
                <span class="font-bold d-block">Phone</span>
                <a href="tel:501-492-6720">+1 (501) 492-6720</a>
            </footer>
        </article>
    </section>
</main>

<?php get_footer(); ?>
