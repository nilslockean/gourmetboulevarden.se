<?php
/**
 * The template for displaying the footer.
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

if ( is_active_sidebar( 'footer-col-1' ) || is_customize_preview() ) : ?>

    <footer id="site-footer" class="site-footer" itemscope itemtype="http://schema.org/WPFooter">

    	<div class="site-footer__inner footer-4">

    	    <div class="site-footer__widgets">

                <?php do_action( 'ava_before_footer_widgets' ); ?>

    	        <?php if ( is_active_sidebar( 'footer-col-1' ) || is_customize_preview() ) : ?>
    	            <div class="site-footer__inner-col col-1">
                        <?php do_action( 'ava_before_first_footer_col' ); ?>
    	                <?php dynamic_sidebar( 'footer-col-1' ); ?>
                        <?php do_action( 'ava_after_first_footer_col' ); ?>
    	            </div>
    	        <?php endif; ?>

                <?php do_action( 'ava_after_footer_widgets' ); ?>

    	    </div>

    	</div>

    </footer>

<?php endif;