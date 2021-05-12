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
    <section id="headerTop" class="container grid thirds">
        <div id="headerTopLeft" class="flex align-center">
            <ul>
                <?php wp_nav_menu($header_static_args); ?>
            </ul>
        </div>
        <div id="headerTopCenter">
            <?php include theme_root('/components/logo.php'); ?>
        </div>
        <div id="headerTopRight" class="flex persist-row align-center justify-end">
            <a href="#" class="button small">Contact</a>
        </div>
    </section>
    <section id="headerBottom" class="container">
        <?php include theme_root('/components/nav.php'); ?>
    </section>
</header>
