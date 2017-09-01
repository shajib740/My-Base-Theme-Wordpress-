<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pranon-base
 */

get_header(); ?>
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php if (have_posts()) : ?>
                        <header class="page-header">
                            <?php
                            the_archive_title('<h1 class="page-title">', '</h1>');
                            the_archive_description('<div class="taxonomy-description">', '</div>');
                            ?>
                        </header><!-- .page-header -->
                    <?php endif; ?>


                    <div class="row">
                        <div class="col-md-8">
                            <div id="primary" class="content-area">
                                <main id="main" class="site-main" role="main">

                                    <?php
                                    if (have_posts()) :

                                        /* Start the Loop */
                                        while (have_posts()) : the_post();

                                            /*
                                             * Include the Post-Format-specific template for the content.
                                             * If you want to override this in a child theme, then include a file
                                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                             */
                                            get_template_part('template-parts/post/content', get_post_format());

                                        endwhile;

                                        the_posts_navigation();

                                    else :

                                        get_template_part('template-parts/post/content', 'none');

                                    endif; ?>

                                </main><!-- #main -->
                            </div><!-- #primary -->
                        </div><!-- .col-md-8 -->
                        <div class="col-md-4">
                            <?php get_sidebar(); ?>
                        </div><!-- .col-md-4 -->
                    </div><!-- .row -->
                </div><!-- .col-md-12 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div> <!-- .wrap -->

<?php get_footer();