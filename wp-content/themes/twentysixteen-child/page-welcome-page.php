<?php
/**
 * Template Name: Welcome page
 */

/*
 * Image header is forbidden only for this page.
 */
get_header(); ?>

<div id="primary" class="content-area">
    <div class="wellcome-img">
        <img src="https://www.test.local/wp-content/uploads/2020/03/wp_pic-1.jpg" alt="welcome page">
        <div id="join-btn-area"><a id="join-btn" title="Login" href="/login" type="button">Enter Test site</a></div>
    </div>

    <main id="main" class="site-main" role="main">
        <?php
        // Start the loop.
        while (have_posts()) :
            the_post();

            // Include the page content template.
            get_template_part('template-parts/content', 'page');

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }

            // End of the loop.
        endwhile;
        ?>

    </main><!-- .site-main -->

    <?php get_sidebar('content-bottom'); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

