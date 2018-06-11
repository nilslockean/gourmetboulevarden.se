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

if( $settings->gallery_items ) { ?>

 <div class="beaver--parallax-gallery">

    <?php foreach( $settings->gallery_items as $gallery_item ) {

        $gallery_item_src = wp_get_attachment_image_src( $gallery_item, 'large' ); ?>

        <div class="fullscreen-parallax-item parallax-window" data-parallax="scroll" data-image-src="<?php echo esc_url( $gallery_item_src[0] ); ?>"></div>

    <?php } ?>

    </div>

<?php } ?>
