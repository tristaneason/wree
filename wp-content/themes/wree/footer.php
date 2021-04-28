<?php
// Component: Footer

$nav_args_1 = [
    'menu' => 'Footer - Quick Menu',
    'menu_class' => '',
    'menu_id' => 'footerNav1',
    'container' => false,
    'items_wrap' => '%3$s',
    'depth' => 1,
];

$nav_args_2 = [
    'menu' => 'Footer - Article Categories',
    'menu_class' => '',
    'menu_id' => 'footerNav2',
    'container' => false,
    'items_wrap' => '%3$s',
    'depth' => 1,
];
?>

<?php include theme_root('/components/ctaSection.php'); ?>

<footer id="componentFooter" class="container">
    <div class="grid fourths">
        <section id="footerSection1" class="flex column">
            <h3>Quick Menu</h3>
            <nav>
                <ul class="flex column">
                    <?php wp_nav_menu($nav_args_1); ?>
                </ul>
            </nav>
        </section>
        <section id="footerSection2" class="flex column">
            <h3>Article Categories</h3>
            <nav>
                <ul class="flex column">
                    <?php wp_nav_menu($nav_args_2); ?>
                </ul>
            </nav>
        </section>
        <section id="footerSection3" class="flex column">
            <h3>Contact Info</h3>
            <div class="">
                <h4 class="margin-top">Email</h4>
                <a href="mailto:wreeusa@protonmail.com">wreeusa@protonmail.com</a>
            </div>
            <div class="">
                <h4>Address</h4>
                <address>
                    <a href="https://goo.gl/maps/Zc8RtgcKGQ5fNTHy7" target="_blank">
                        <span>1808 Hylan Blvd. Suite 1009</span>
                        <span>Staten Island, New York 10305</span>
                    ​</a>
                </address>
            </div>
        </section>
        <section id="footerSection4" class="flex">
            <?php include theme_root('/components/logo.php'); ?>
        </section>
    </div>
</footer>

<?php include theme_root('/components/footerSocial.php'); ?>

<?php wp_footer(); ?>
</body>
</html>
