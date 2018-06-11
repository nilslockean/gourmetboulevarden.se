<?php
/**
 * The file for displaying the portfolio meta.
 *
 * @package	Ava
 * @link	https://themebeans.com/themes/ava
 * @author	Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license	GPL-3.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the content.
 */
if ( post_password_required() ) {
	return;
}

/*
 * Set variables for the content below.
 */
$portfolio_date		 = get_post_meta( $post->ID, '_ava_portfolio_date', true );
$portfolio_client	 = get_post_meta( $post->ID, '_ava_portfolio_client', true );
$portfolio_role		 = get_post_meta( $post->ID, '_ava_portfolio_role', true );
$portfolio_permalink	 = get_post_meta( $post->ID, '_ava_portfolio_permalink', true );
$portfolio_url		 = get_post_meta( $post->ID, '_ava_portfolio_url', true );
$portfolio_cats          = get_post_meta($post->ID, '_ava_portfolio_cats', true );
$portfolio_tags          = get_post_meta( $post->ID, '_ava_portfolio_tags', true) ;
$portfolio_url_clean	 = str_replace( 'http://','', $portfolio_url );
$portfolio_url_clean	 = preg_replace( '/\s+/', '', $portfolio_url_clean );
?>

<div class="project-meta">

	<?php if ( $portfolio_date == 'on' ) { ?>
		<p class="published">
			<span><?php the_time( get_option( 'date_format' ) ); ?></span>
		</p>
	<?php } ?>

	<?php if ( $portfolio_role ) { ?>
		<p class="role">
			<?php _e( 'Role: ', 'ava' ); ?><span><?php echo esc_html( $portfolio_role ); ?></span>
		</p>
	<?php } ?>

	<?php if ( $portfolio_client ) { ?>
		<p class="client">
			<?php _e( 'Client: ', 'ava' ); ?>
			<span>
			<?php if ($portfolio_url) { ?>
				<a href="<?php echo esc_url($portfolio_url); ?>" target="blank"><?php echo esc_html( $portfolio_client ); ?></a>
			<?php } else {
				echo esc_html( $portfolio_client );
			} ?>
			</span>
		</p>
	<?php } ?>

	<?php if ($portfolio_cats == 'on' OR $portfolio_tags == 'on' ) { // DISPLAY TAGS ?>

		<p class="project-taxonomy">
			<?php if ($portfolio_cats == 'on') { // DISPLAY TAGS ?>
				<?php $terms = get_the_terms( $post->ID, 'portfolio_category' ); ?>
				<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
					<?php the_terms($post->ID, 'portfolio_category','#', '&nbsp;&nbsp;&nbsp;#', '&nbsp;&nbsp;&nbsp;&nbsp;'); ?>
				<?php endif;?>
			<?php } ?>

			<?php if ($portfolio_tags == 'on') { // DISPLAY CATEGORY ?>
					<?php the_terms($post->ID, 'portfolio_tag','#', '&nbsp;&nbsp;&nbsp;#', '&nbsp;&nbsp;&nbsp;&nbsp;'); ?>
			<?php } ?>
		</p>

	<?php } ?>

	<?php if ( $portfolio_url && ! $portfolio_client ) { ?>
		<p class="url">
			<?php _e( 'URL: ', 'ava' ); ?><span><a href="<?php echo esc_url( $portfolio_url ); ?>" target="blank"><?php echo esc_html( $portfolio_url_clean ); ?></a></span>
		</p>
	<?php } ?>

	<?php if ( $portfolio_permalink == 'on' ) { ?>
		<p class="permalink">
			<span>
				<?php printf( '<a href="%1s" rel="%2$s">#</a>',
					esc_url( get_the_permalink() ),
					esc_html( get_the_title() )
				); ?>
			</span>
		</p>
	<?php } ?>


	<?php do_action( 'portfolio_professional_likes' ); ?>

</div>
