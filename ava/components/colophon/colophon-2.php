<?php
/**
 * The template for displaying the colophon.
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

/**
 * Only display the colophon if the option is selected in the Customizer.
 */
 $visibility = ( false == get_theme_mod( 'colophon_active' , ava_defaults( 'colophon_active' ) ) ) ? ' hidden ' : ''; ?>

<footer id="site-colophon" class="site-colophon colophon-2<?php echo esc_attr( $visibility ); ?>" itemscope itemtype="http://schema.org/WPFooter">

    <?php do_action( 'ava_before_colophon' ); ?>

    <div class="site-colophon__inner colophon-2">

        <div class="site-colophon__left flex__center">

            <?php ava_get_social_navigation( 'colophon-social' ); ?>

            <?php
            /**
             * Only display if the option is selected in the Customizer.
             */
            $visibility = ( false == get_theme_mod( 'colophon_menu' , ava_defaults( 'colophon_menu' ) ) ) ? ' hidden ' : ''; ?>

            <?php if ( get_theme_mod( 'colophon_menu' , ava_defaults( 'colophon_menu' ) ) || is_customize_preview() ) : ?>
                <?php if ( has_nav_menu( 'colophon' ) ) : ?>
                    <nav class="main-navigation colophon-navigation<?php echo esc_attr( $visibility ); ?>" aria-label="<?php esc_attr_e( 'Colophon Menu', 'ava' ); ?>">
                        <?php ava_get_menu( 'colophon', 'colophon_menu', '', 1 ); ?>
                    </nav>
                <?php elseif ( is_customize_preview() ) :
                    ava_customizer_add_menu( 'right', esc_attr__( 'Colophon' , 'ava' ) );
                endif; ?>
            <?php endif; ?>

        </div>

        <div class="site-colophon__right flex__center">
            <?php ava_site_info(); ?>
        </div>

    </div>

    <?php do_action( 'ava_after_colophon' ); ?>

</footer>