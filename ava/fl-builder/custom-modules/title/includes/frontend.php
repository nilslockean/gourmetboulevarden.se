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

<div class="bb--title">

    <div class="bb--title__inner">

        <?php if ( ! empty( $settings->title ) ) : ?>
            <h2 class="bb--video_block__title">
                <?php echo esc_html( $settings->title ); ?>
            </h2>
        <?php endif; ?>

    </div>

</div>