<?php
// Component: Nav

$nav_args = [
    'menu' => 'Header Nav',
    'menu_class' => '',
    'menu_id' => '',
    'container' => false,
    'items_wrap' => '%3$s',
    'depth' => 2,
];
?>

<nav id="componentNav">
    <ul class="flex space-between">
        <?php wp_nav_menu($nav_args); ?>
    </ul>
</nav>
