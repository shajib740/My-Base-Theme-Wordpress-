<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package pranon-base
 */

get_header(); ?>
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <header class="page-header">
                        <?php if (have_posts()) : ?>
                            <h1 class="page-title"><?php printf(__('Search Results for: %s', 'twentyseventeen'), '<span>' . get_search_query() . '</span>'); ?></h1>
                        <?php else : ?>
                            <h1 class="page-title"><?php _e('Nothing Found', 'twentyseventeen'); ?></h1>
                        <?php endif; ?>
                    </header><!-- .page-header -->

                    <div class="row">
                        <div class="col-md-8">
                            <section id="primary" class="content-area">
                                <main id="main" class="site-main">

                                    <?php
                                    if (have_posts()) : ?>

                                        <?php
                                        /* Start the Loop */
                                        while (have_posts()) : the_post();

                                            /**
                                             * Run the loop for the search to output the results.
                                             * If you want to overload this in a child theme then include a file
                                             * called content-search.php and that will be used instead.
                                             */
                                            get_template_part('template-parts/content', 'search');

                                        endwhile;

                                        the_posts_navigation();

                                    else :

                                        get_template_part('template-parts/post/content', 'none');

                                    endif; ?>

                                </main><!-- #main -->
                            </section><!-- #primary -->
                        </div><!-- .col-md-8 -->
                        <div class="col-md-4">
                            <?php get_sidebar(); ?>
                        </div><!-- .col-md-4 -->
                    </div><!-- .row -->
                </div><!-- .col-md-12 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .wrap -->

<?php get_footer();
