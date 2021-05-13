<?php
// Component: Header

$header_static_args = [
    'menu' => 'Header Static Pages',
    'container' => false,
    'items_wrap' => '%3$s',
    'depth' => 1,
];
?>

<header id="componentHeader">
    <!-- Mobile Nav Start -->
    <section id="mobileNavIconContainer" class="container hidden-lg-xl">
        <div class="flex persist-row align-center space-between">
            <span id="mobileTitle" class="font-heading">Women for Racial and Economic Equality</span>
            <span id="mobileNavIcon">
                <i class="fas fa-bars"></i>
                <i class="fas fa-times hidden"></i>
            </span>
        </div>
    </section>
    <section id="mobileNavContainer" class="container hidden-lg-xl hidden">
        <h3>Main Pages</h3>
        <ul class="static-nav">
            <?php wp_nav_menu($header_static_args); ?>
            <li><a href="/contact-wree/">Contact</a></li>
        </ul>
        <h3>Article Categories</h3>
        <?php include theme_root('/components/nav.php'); ?>
    </section>
    <!-- Mobile Nav End -->

    <!-- Desktop Nav Start -->
    <section id="headerTopContainer" class="container grid thirds">
        <div id="headerTopLeft" class="flex align-center">
            <ul><?php wp_nav_menu($header_static_args); ?></ul>
        </div>
        <div id="headerTopCenter">
            <?php include theme_root('/components/logo.php'); ?>
        </div>
        <div id="headerTopRight" class="flex align-center">
            <a href="/contact-wree/" class="button small">Contact</a>
        </div>
    </section>
    <section id="headerBottomContainer" class="container">
        <strong class="hidden-lg-xl">Article Categories</strong>
        <?php include theme_root('/components/nav.php'); ?>
    </section>
    <!-- Desktop Nav End -->
</header>
