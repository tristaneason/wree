<?php
// Component: Nav

$header_cat_args = [
    'menu' => 'Header Article Categories',
    'container' => false,
    'items_wrap' => '%3$s',
    'depth' => 2,
];
?>

<nav id="componentNav">
    <ul id="navContainer">
        <?php wp_nav_menu($header_cat_args); ?>
    </ul>
</nav>
