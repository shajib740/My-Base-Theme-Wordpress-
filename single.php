<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package pranon-base
 */

get_header(); ?>
            <?php
            extract(pranon_base_split_option(array(
                "layout_choice"       => array('1','opt-layout'),
                "sidebar_switch"      => array('0','opt-switch-sidebar'),
                "navigation_switch"   => array('0','opt-switch-navigation'),
                "related_post_switch" => array('0','opt-text'),
                "comments_switch"     => array('0','opt-switch-page')
            )));
            ?>
            <?php

            if(($sidebar_switch == 0)||($layout_choice == 1)):
                $grid_class = 'col-md-12';

            elseif($layout_choice == 2):
                $grid_class = 'col-md-8 col-md-push-4';
                $grid_class_right = 'col-md-4 col-md-pull-8';

            elseif($layout_choice == 3) :
                $grid_class = 'col-md-8';
                $grid_class_right = 'col-md-4';

            endif;
            ?>
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="<?php echo $grid_class;?>">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">

                            <?php
                            while (have_posts()) : the_post();

                                get_template_part('template-parts/post/content', get_post_format());

                                // If comments are open or we have at least one comment, load up the comment template.
                                if($comments_switch == 1) {
                                    if (comments_open() || get_comments_number()) :
                                        comments_template();
                                    endif;
                                }

                                if($navigation_switch == 1){
                                    the_post_navigation();
                                }


                            endwhile; // End of the loop.
                            ?>

                        </main><!-- #main -->
                    </div><!-- #primary -->
                    <div class = "related-post-heading">
                        <?php
                        if($related_post_switch == 1){

                        }
                        ?>
                    </div>
                </div><!-- .col-md-8 -->

                <div class="<?php echo $grid_class_right; ?>">
                    <?php get_sidebar(); ?>
                </div>

            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .wrap -->
<?php get_footer();
