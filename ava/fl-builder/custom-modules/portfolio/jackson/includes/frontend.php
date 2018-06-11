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

/*
 * Set the hover style as a variable that we can use anywhere in the loop.
 */
$hover_style = $settings->hover_style;

/*
 * Add the following classes to the posts.
 */
$post_classes = 'project '.$hover_style; ?>

<div class="portfolio portfolio--jackson">

    <?php if( 'media' == $settings->media_source ) : ?>

        <?php if( ! empty( $settings->media ) ) : ?>

            <?php foreach( $settings->media as $media_item ) { ?>

                <?php
                $media_item_src = wp_get_attachment_image_src( $media_item, 'todo' );
                $media_item_title = get_the_title( $media_item );
                $feat_image = 'background-image: url(' . esc_url( $media_item_src[0] ) . ');'; ?>

                <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" <?php post_class( esc_attr( $post_classes ) ); ?>>

                    <div class="project__intrinsic">

                        <div class="project__thumb" style="<?php echo esc_attr( $feat_image ); ?>"></div>

                        <?php if ( $hover_style == 'project__hover--scaled' || $hover_style == 'project__hover--opacity' ) : ?>

                            <div class="project__overlay">
                                <div>
                                    <h5 class="entry-title"><?php echo esc_html( $media_item_title ); ?></h5>
                                </div>
                            </div>

                        <?php endif; ?>

                    </div>

                </figure>

            <?php } //end foreach ?>

        <?php endif; ?>

    <?php else : ?>

        <?php
        $args = array(
            'post_type'          => 'portfolio',
            'posts_per_page'     => $settings->number,
            'portfolio_category' => $settings->slug,
            'orderby'            => 'menu_order',
            'order'              => 'ASC',
        );
        $loop = new WP_Query( $args );

        while ( $loop->have_posts() ) : $loop->the_post();

            global $post; ?>

            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" id="post-<?php the_ID(); ?>" <?php post_class( esc_attr( $post_classes ) ); ?>>

                <?php
                /*
                 * Let's check if there's an external url included on the back end.
                 * If there is, that will be assigned as the $portfolio_url variable, if not,
                 * the post permalink will be assigned.
                 */
                $external_url = get_post_meta( $post->ID, '_ava_portfolio_external_url', true );
                $portfolio_url = ( $external_url ) ? $external_url : get_the_permalink();
                $portfolio_url_class = ( $external_url ) ? 'class=project-link project__link--external' : '';
                $portfolio_url_target = ( $external_url ) ? '_blank' : '_self';

                printf( '<a href="%1s" data-id="%2$s" %3$s target="%4$s" class="project__link"></a>',
                    esc_url( $portfolio_url ),
                    esc_attr( get_the_ID() ),
                    esc_attr( $portfolio_url_class ),
                    esc_attr( $portfolio_url_target )
                );
                ?>

                <div class="project__intrinsic">

                    <?php

                    global $post;

                    // Grab the featured image.
                    $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'todo' );
                    $feat_image = 'background-image: url(' . esc_url( $feat_image[0] ) . ');';
                    ?>

                    <div class="project__thumb" style="<?php echo esc_attr( $feat_image ); ?>"></div>

                    <?php if ( $hover_style == 'project__hover--scaled' || $hover_style == 'project__hover--opacity' ) : ?>

                        <div class="project__overlay">
                            <div>
                                <?php the_title( '<h5 class="entry-title">', '</h5>'); ?>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>

            </figure>

       <?php endwhile; wp_reset_query(); ?>

   <?php endif; ?>

</div>