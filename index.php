<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pranon-base
 */

get_header(); ?>

            <?php
            extract(pranon_base_split_option(array(
                "blog_layout_choice" => array('1','opt-layout-blog'),
                "pagination_choice"  => array('0', 'opt-switch-pagination'),
            )));
            ?>
            <?php

            if($blog_layout_choice ==1):
                $grid_class = 'col-md-12';


            elseif($blog_layout_choice == 2):
                $grid_class = 'col-md-8 col-md-push-4';
                $grid_class_right = 'col-md-4 col-md-pull-8';


            elseif($blog_layout_choice == 3) :
                $grid_class = 'col-md-8';
                $grid_class_right = 'col-md-4';

            endif;
            ?>
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (is_home() && !is_front_page()) : ?>
                        <header class="page-header">
                            <h1 class="page-title"><?php single_post_title(); ?></h1>
                        </header>
                    <?php else : ?>
                        <header class="page-header">
                            <h2 class="page-title"><?php _e('Posts', 'pranon-base'); ?></h2>
                        </header>
                    <?php endif; ?>

                    <div class="row">
                        <div class="<?php echo "$grid_class"; ?>">
                            <div id="primary" class="content-area">
                                <main id="main" class="site-main">

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
                        <div class="<?php echo "$grid_class_right"; ?>">
                               <?php get_sidebar(); ?>
                        </div><!-- .col-md-4 -->
                    </div><!-- .row -->
                </div><!-- .col-md-12 -->
            </div><!-- .row -->
            <?php
            if($pagination_choice == 1){
            }
            ?>

        </div><!-- .container -->
    </div><!-- .wrap -->

<?php get_footer();
