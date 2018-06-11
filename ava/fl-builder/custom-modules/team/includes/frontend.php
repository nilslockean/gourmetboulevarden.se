<?php
/**
 * Ava Beaver Builder module, front-end instance
 *
 * You have access to two variables in this file:
 *
 * $module:   An instance of your module class.
 * $settings: The module's settings.

 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */
 ?>

<div class="bb--team bb--team--<?php echo esc_attr( $settings->grid_size ); ?>">

    <div class="bb--team__inner">

        <?php
        $args = array(
            'post_type'          => 'team',
            'orderby'            => 'date',
            'order'              => 'menu_order',
        );
        $loop = new WP_Query( $args );

        while ( $loop->have_posts() ) : $loop->the_post();

            get_template_part( 'components/team/content-team' );

        endwhile; wp_reset_query(); ?>

    </div>

</div>