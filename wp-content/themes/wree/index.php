<!DOCTYPE html>
<html>
    <?php include 'components/head.php'; ?>
    <body <?php body_class(); ?>>
        <?php
        include 'components/header.php';

        if (is_front_page())
            include 'templates/home.php';
        elseif (if_home())
            include 'layouts/blog.php';
        elseif (is_single())
            include 'layouts/article.php';
        elseif (is_page())
            include 'layouts/default.php';
        elseif (is_author())
            include 'layouts/author.php';
        elseif (is_category())
            include 'layouts/category.php';
        elseif (is_tag())
            include 'layouts/tag.php';
        else
            include 'layouts/default.php';

        include 'components/footer.php';
        wp_footer();
        ?>
    </body>
</html>
