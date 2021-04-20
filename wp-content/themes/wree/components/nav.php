<?php
// Component: Nav

$nav_args = [
    'menu' => 'Header Nav',
    'menu_class' => '',
    'menu_id' => 'headerNav',
    'container' => false,
    'items_wrap' => '%3$s',
    'depth' => 2,
];
?>

<nav id="componentNav">
    <ul class="flex space-between align-center">
        <?php wp_nav_menu($nav_args); ?>
        <span class="search">
            <span>Search</span>
            <i class="fas fa-search"></i>
        </span>
    </ul>
</nav>
