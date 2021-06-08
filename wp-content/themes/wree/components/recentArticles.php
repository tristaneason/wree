<?php
// Component: Recent Articles

$recentPosts = get_posts([
    'post_type' => 'post',
    'posts_per_page' => '4',
    'orderby' => 'date'
]);
?>

<section id="componentRecentArticles">
    <div class="container">
        <h2></h2>
        <div class="grid two-thirds">
            <div class="articles-list">
                <?php foreach ($recentPosts as $recentPost): ?>
                    <article class="article-snippet flex persist-row align-center space-between">
                        <div class="padding">
                            <h3 class="h5">
                                <a href="<?= get_permalink($recentPost->ID); ?>">
                                    <?= $recentPost->post_title; ?>
                                </a>
                            </h3>
                            <span class="text-small">
                                <?= date('F j, Y', strtotime($recentPost->post_date)); ?>
                            </span>
                            <span class="text-small">
                                by <a href="<?= get_author_posts_url($recentPost->post_author); ?>"><?= get_the_author_meta('display_name', $recentPost->post_author); ?></a>
                            </span>
                            <p><?= $recentPost->post_excerpt; ?></p>
                        </div>
                        <a href="<?= get_permalink($recentPost->ID); ?>" class="thumbnail-link">
                            <img src="<?= get_the_post_thumbnail_url($recentPost->ID, 'medium'); ?>" class="thumbnail" alt="<?= $recentPost->post_title; ?> Thumbnail">
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
            <aside class="sidebar">
                <section class="meeting-section">
                    <h3>Monthly Meetings</h3>
                    <p>Join us! Monthly Meetings via ZOOM<br>@ 8:30 PM EST</p>
                    <p>Our next meeting is June 9, 2021</p>
                    <a href="/contact-wree/" class="button small">Contact us to join</a>
                </section>
                <section class="about-section">
                    <h3>What We Do</h3>
                    <p>Still committed to Peace as our first priority, WREE focuses on the many social issues that prevent Peace and Prosperity for all.There are many issues that need as much support and activism from our members and friends that they can provide. Community Volunteerism is powerful.</p>
                </section>
                <section class="contact-section">
                    <h3>Contact WREE</h3>
                    <span class="font-bold">Address</span>
                    <address>
                        1808 Hylan Blvd. Suite 1009<br>Staten Island, New York 10305
                    </address>
                    <span class="font-bold d-block">Email</span>
                    <a href="mailto:wree-info@usvanguard.net">wree-info@usvanguard.net</a>
                    <span class="font-bold d-block">Phone</span>
                    <a href="tel:501-492-6720">+1 (502) 492-6720</a>
                </section>
            </aside>
        </div>
        <?php include theme_root('/components/buttonGetRecentArticles.php'); ?>
    </div>
</section>
