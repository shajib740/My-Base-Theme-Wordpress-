<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pranon-base
 */

?>

</div><!-- #content -->

<?php
 extract(pranon_base_split_option(array(
     'top_switch'  => array('0', 'opt-switch-backToTop'),
     'footer_text'  => array('©Copyright 2017 Story Theme. All Rights Reserved.', 'footer-editor-text'),
 )));
?>

<?php 
	$allowed_tags = 
				array(
						'a'      => array(
                'href'   => array(),
                'title'  => array(),
                'target' => array()
            ),
            'br'     => array(),
            'em'     => array(),
            'strong' => array(),
            'ul'     => array(),
            'li'     => array(),
            'p'      => array(),
        );
 ?>

<footer id="colophon" class="site-footer">
	<div class = "container">
		<div class = "row">
			<div class = "col-md-12">
				<div class="site-info">
					  <span>
								<?php echo wp_kses( $footer_text, $allowed_tags ); ?>
						</span>
				</div><!-- .site-info -->

				<?php if($top_switch == 1) : ?>
				<div class = "backToTop">
					<button><a id = "topButton" href = "#">top</a></button>
				</div>
				<?php endif; ?>

			</div><!--.col-md-12-->
		</div><!--.row-->
	</div><!--.container-->

</footer><!-- #colophon -->
</div> <!-- .site-content-contain -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
