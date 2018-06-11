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

if ( ! empty( $settings->number ) && $settings->number == '3'  ) {
    $class = ' product-grid__three-count';
} else {
    $class = null;
}

if ( ! empty( $settings->number_cols ) && $settings->number_cols == '9'  ) {
    $columns_class = ' product-columns__nine-count';
} else {
    $columns_class = null;
}

if ( 'columns' == $settings->grid_type && ! empty( $settings->number_cols ) ) {
    $num = $settings->number_cols;
} else {
    $num = $settings->number;
} ?>

<div class="beaver--wc-products">

    <div class="hfeed product-grid product-grid__<?php echo esc_attr( $settings->grid_type ); echo esc_attr( $class . $columns_class ); ?>">

    <?php
    $args = array(
        'post_type' => 'product',
        'stock' => 1,
        'posts_per_page' => $num,
        'product_cat' => $settings->slug,
        'orderby' =>'date',
        'order' => 'ASC'
        );
    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post(); ?>

        <li <?php post_class(); ?>>
            <?php
            /**
             * woocommerce_before_shop_loop_item hook.
             *
             * @hooked woocommerce_template_loop_product_link_open - 10
             */
            do_action( 'woocommerce_before_shop_loop_item' );

            /**
             * woocommerce_before_shop_loop_item_title hook.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );

            /**
             * woocommerce_shop_loop_item_title hook.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );

            /**
             * woocommerce_after_shop_loop_item_title hook.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );

            /**
             * woocommerce_after_shop_loop_item hook.
             *
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action( 'woocommerce_after_shop_loop_item' );
            ?>
        </li>

    <?php endwhile; wp_reset_query(); ?>

    </div>

</div>