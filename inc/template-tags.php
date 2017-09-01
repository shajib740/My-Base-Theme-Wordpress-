<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package pranon-base
 */

if ( ! function_exists( 'pranon_base_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pranon_base_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'pranon-base' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'pranon-base' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'pranon_base_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function pranon_base_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'pranon-base' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'pranon-base' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'pranon-base' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'pranon-base' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'pranon-base' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'pranon-base' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;


if ( ! function_exists( 'pranon_base_link_pages' ) ) :

    /**
     * Display pagination after page content
     */
    function pranon_base_link_pages( $args = array() ) {
        $defaults = array(
            'before'           => '<div class="pagination-wrap clearfix">',
            'after'            => '</div>',
            'link_before'      => '',
            'link_after'       => '',
            'next_or_number'   => 'number',
            'nextpagelink'     => esc_html__( 'Next page', 'breakingstory' ),
            'previouspagelink' => esc_html__( 'Previous page', 'breakingstory' ),
            'pagelink'         => '%',
            'echo'             => 1
        );

        $args = apply_filters( 'wp_link_pages_args', wp_parse_args( $args, $defaults ) );

        global $page, $numpages, $multipage, $more, $pagenow;

        $output = '';
        if ( $multipage ) {
            if ( 'number' == $args[ 'next_or_number' ] ) {
                $output .= $args[ 'before' ] . '<ul class="pagination">';
                $laquo = $page == 1 ? 'class="disabled"' : '';
                $output .= '<li ' . $laquo . '>' . _wp_link_page( $page - 1 ) . ' <i class="zmdi zmdi-chevron-left"></i></a></li>';
                for (
                    $i = 1;
                    $i < ( $numpages + 1 );
                    $i = $i + 1
                ) {
                    $j = str_replace( '%', $i, $args[ 'pagelink' ] );

                    if ( ( $i != $page ) || ( ( ! $more ) && ( $page == 1 ) ) ) {
                        $output .= '<li>';
                        $output .= _wp_link_page( $i );
                    } else {
                        $output .= '<li class="active">';
                        $output .= _wp_link_page( $i );
                    }
                    $output .= $args[ 'link_before' ] . $j . $args[ 'link_after' ];

                    $output .= '</a></li>';
                }
                $raquo = $page == $numpages ? 'class="disabled"' : '';
                $output .= '<li ' . $raquo . '>' . _wp_link_page( $page + 1 ) . ' <i class="zmdi zmdi-chevron-right"></i> </a></li>';
                $output .= '</ul>' . $args[ 'after' ];
            } else {
                if ( $more ) {
                    $output .= $args[ 'before' ] . '<ul class="pager">';
                    $i = $page - 1;
                    if ( $i && $more ) {
                        $output .= '<li class="previous">' . _wp_link_page( $i );
                        $output .= $args[ 'link_before' ] . $args[ 'previouspagelink' ] . $args[ 'link_after' ] . '</li>';
                    }
                    $i = $page + 1;
                    if ( $i <= $numpages && $more ) {
                        $output .= '<li class="next">' . _wp_link_page( $i );
                        $output .= $args[ 'link_before' ] . $args[ 'nextpagelink' ] . $args[ 'link_after' ] . '</a></li>';
                    }
                    $output .= '</ul>' . $args[ 'after' ];
                }
            }
        }

        if ( $args[ 'echo' ] ) {
            echo $output;
        } else {
            return $output;
        }
    }
endif;

if ( ! function_exists( 'pranon_base_posts_pagination' ) ) :
    /**
     * Blog Pagination
     */
    function pranon_base_posts_pagination() {

        if ( $GLOBALS[ 'wp_query' ]->max_num_pages > 1 ) {
            $big   = 999999999; // need an unlikely integer
            $items = paginate_links( apply_filters( 'story_posts_pagination_paginate_links', array(
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'    => '?paged=%#%',
                'prev_next' => TRUE,
                'current'   => max( 1, get_query_var( 'paged' ) ),
                'total'     => $GLOBALS[ 'wp_query' ]->max_num_pages,
                'type'      => 'array',
                'prev_text' => ' <p>PREVIOUS</p>',
                'next_text' => '<p>NEXT</p> ',
                'end_size'  => 1,
                'mid_size'  => 1
            ) ) );

            $pagination = "<div class=\"pagination-wrap clearfix\"><ul class=\"pagination navigation\"><li>";
            $pagination .= join( "</li><li>", (array) $items );
            $pagination .= "</li></ul></div>";

            echo apply_filters( 'story_posts_pagination', $pagination, $items, $GLOBALS[ 'wp_query' ] );
        }
    }
endif;

if ( ! function_exists( 'pranon_base_get_default_logo' ) ) :
    /**
     * Get Default Custom Logo
     */
    function pranon_base_get_default_logo( $html = '' ) {

        if ( empty( $html ) ) :

            $html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home">%2$s</a>',
                esc_url( home_url( '/' ) ),
                '<img class="custom-logo"
							src="' . esc_url( get_template_directory_uri() . '/img/logo.png' ) . '"
							alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"/>'
            );

        endif;

        return $html;

    }

    add_filter( 'get_custom_logo', 'pranon_base_get_default_logo' );
endif;


if ( ! function_exists( 'story_custom_logo' ) ) :
    /**
     * Custom Logo Option
     */
    function story_custom_logo() {
        if ( function_exists( 'the_custom_logo' ) ) :
            the_custom_logo();
        else:
            echo pranon_base_get_default_logo();
        endif;
    }
endif;
