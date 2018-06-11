<?php
/**
 * Beaver Builder module, front-end instance
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
$post_classes = 'project '.$hover_style;

/*
 * Is the Photoswipe lightbox option enabled?
 */
$lightbox = ( 'on' == $settings->lightbox ) ? 'photoswipe__portfolio' : null ; ?>

<div class="portfolio portfolio--ethan <?php echo esc_attr( $settings->alignment ); ?> <?php echo esc_attr( $settings->lightbox_style ); ?>">

	<div class="hfeed <?php echo esc_attr( $lightbox ); ?>" itemscope itemtype="http://schema.org/ImageGallery">

		<?php if ( 'media' === $settings->media_source ) : ?>

			<?php if ( ! empty( $settings->media ) ) : ?>

				<?php foreach ( $settings->media as $media_item ) { ?>

						<?php
						$media_item_src 	= wp_get_attachment_image_src( $media_item, 'large' );
						$media_item_caption 	= wp_get_attachment_caption( $media_item );
						$media_item_title 	= get_the_title( $media_item ); ?>

						<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" <?php post_class( esc_attr( $post_classes ) ); ?>>

							<?php
							if ( 'on' === $settings->lightbox ) {

								echo '<a href="'.esc_url( $media_item_src[0] ).'" class="lightbox-link" itemprop="contentUrl" data-size="'.esc_attr( $media_item_src[1] ) .'x'. esc_attr( $media_item_src[2] ).'">';

									echo '<img src="'.esc_url( $media_item_src[0] ).'" class="project__thumb wp-post-image">';

								echo '</a>';

								echo '<figcaption itemprop="caption description">'.esc_html( $media_item_caption ).'</figcaption>';

							} else {
								echo '<img src="' . esc_url( $media_item_src[0] ) . '" class="project__thumb wp-post-image">';
							} ?>

							<?php if ( 'project__hover--scaled' === $hover_style || 'project__hover--opacity' === $hover_style ) : ?>

								<div class="project__overlay">
									<div>
										<h2 class="entry-title"><?php echo esc_html( $media_item_title ); ?></h2>
									</div>
								</div>

							<?php endif; ?>

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
					if( $settings->lightbox == 'on' ) {

						$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large', true );

						echo '<a href="' . esc_url( $src[0] ) . '" class="lightbox-link" itemprop="contentUrl" data-size="'.esc_attr( $src[1] ) .'x'. esc_attr( $src[2] ).'">';

							the_post_thumbnail( 'large' , array( 'class' => 'project__thumb', 'title' => get_the_title(), 'alt' => get_the_title() ) );

						echo '</a>';

						echo '<figcaption itemprop="caption description">Image caption</figcaption>';

					} else {
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

						the_post_thumbnail( 'ava-portfolio-featured' , array( 'class' => 'project__thumb' ) );
					} ?>

					<?php if ( $hover_style == 'project__hover--scaled' || $hover_style == 'project__hover--opacity' ) : ?>

						<div class="project__overlay">
							<div>
								<?php the_title( '<h2 class="entry-title">', '</h2>'); ?>
							</div>
						</div>

					<?php endif; ?>

				</figure>

			<?php endwhile; ?>

			<?php wp_reset_query(); ?>

		<?php endif; ?>

	</div>

	<?php
	if( $settings->lightbox == 'on' ) {
		get_template_part( 'components/portfolio/photoswipe' );
	} ?>

</div>
