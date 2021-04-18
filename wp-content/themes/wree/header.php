<?php
// Component: Header
?>
<!DOCTYPE html>
<html>
<?php include 'components/head.php'; ?>
<body <?php body_class(); ?>>
    <header id="componentHeader">
        <div class="container flex align-center space-between">
            <?php include theme_root('/components/logo'); ?>
            <?php include theme_root('/components/nav'); ?>
        </div>
    </header>
