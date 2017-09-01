<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<?php
extract(pranon_base_split_option(array(
    'sticky_nav_menu'  => array('0', 'opt-switch-sticky'),
    'mobile_menu'  => array('0', 'opt-layout-mobile'),
    'mobile_menu_effect'  => array('0', 'opt-mobile-menu-effect'),
)));
?>

<?php if($sticky_nav_menu == 1) : ?>
    <div class = "fixedToTop">

    </div>
<?php endif; ?>

<nav id="site-navigation" class="main-navigation navbar navbar-default" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'pranon-base' ); ?>">
    <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#base-navbar-collapse" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
    </div>
    
      <?php if (has_nav_menu('top')) : ?>
        <div class="navbar navbar-horizontal">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="base-navbar-collapse">
                <?php wp_nav_menu( array(
                        'container' => FALSE,
                        'theme_location' => 'top',
                        'items_wrap' => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
                        'walker' => new Pranon_Base_Walker(), 
                    )
                );
                ?>
            </div> <!-- .navbar-collapse -->
        </div> <!-- .navbar -->
                                <?php endif; ?><!-- #site-navigation -->

</nav><!-- #site-navigation -->
