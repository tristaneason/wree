<?php
// Component: Sidebar
?>

<aside class="sidebar">
    <?php if (is_single()): ?>
        <section class="author-bio">
            <h3 class="mt-0">About <?php the_author(); ?></h3>
            <img src="<?= $author_avatar; ?>" alt="<?php the_author(); ?>" class="author-thumb">
            <p class="author-description"><?= $author_desc; ?></p>
            <h4>More articles by <?= $author_name; ?></h4>
            <?php foreach ($author_posts as $author_post): ?>
                <div class="author-article flex align-center">
                    <a href="<?php the_permalink($author_post['ID']); ?>" class="mr-05">
                        <img src="<?= get_the_post_thumbnail_url($author_post['ID']); ?>" alt="<?= $author_post['post_title']; ?> Thumbnail" class="img-responsive">
                    </a>
                    <h5 class="h6 mt-0">
                        <a href="<?php the_permalink($author_post['ID']); ?>"><?= $author_post['post_title']; ?></a>
                    </h5>
                </div>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
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
