<?php
// Component: Header
?>
<!DOCTYPE html>
<html>
<?php include 'components/head.php'; ?>
<body <?php body_class(); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-52CZVJT"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <header id="componentHeader">
        <div class="container flex align-center space-between">
            <?php include theme_root('/components/logo'); ?>
            <?php include theme_root('/components/nav'); ?>
        </div>
    </header>
