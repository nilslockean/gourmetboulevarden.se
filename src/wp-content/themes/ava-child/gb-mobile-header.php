<?php

function ava_mobile_header() {

	$ava_mobilecart      = get_theme_mod( 'header_mobile_cart', ava_defaults( 'header_mobile_cart' ) );
	$ava_mobilesearch    = get_theme_mod( 'header_mobile_search', ava_defaults( 'header_mobile_search' ) );
	$mobile_primary_menu = get_theme_mod( 'header_mobile_primary_menu', ava_defaults( 'header_mobile_primary_menu' ) );

	$visibility = ( false == $mobile_primary_menu ) ? ' hidden ' : ''; ?>

	<header class="site-mobile-header">
		<div class="site-mobile-header__inner flex__center">
			<div class="site-mobile-header__left flex__center">
        <?php if ( !empty(get_theme_mod('phone_number')) ): ?>
          <span class="fl-icon">
						<a href="tel:<?php echo get_theme_mod('phone_number'); ?>" target="_self" style="color: <?php echo get_theme_mod('mobile_header_phone_icon_color'); ?>;">
						  <i class="dashicons dashicons-phone"></i>
		        </a>
          </span>
        <?php endif; ?>
				<?php
				if ( $ava_mobilesearch && ! $ava_mobilecart || is_customize_preview() ) :
					ava_get_search_trigger( 'header_mobile_search' );
				endif;
				ava_get_cart_icon( 'header_mobile_cart' );
				?>

				<?php
				if ( $mobile_primary_menu || is_customize_preview() ) :
					if ( has_nav_menu( 'primary' ) ) :
						printf( '<nav class="main-navigation ' . esc_attr( $visibility ) . '" aria-label="%s" itemscope itemtype="http://schema.org/SiteNavigationElement">', esc_html( 'Primary Menu', 'ava' ) );
						ava_get_menu( 'primary', 'primary-menu', 'primary-menu', 1 );
						printf( '</nav>' );
					endif;
				endif;
				?>

			</div>

			<div class="site-mobile-header__middle flex__center">
				<?php ava_the_custom_logo( false ); ?>
			</div>

			<div class="site-mobile-header__right flex__center">
			<?php
			if ( $ava_mobilesearch && $ava_mobilecart || is_customize_preview() ) :
				ava_get_search_trigger( 'header_mobile_search' );
				endif;
			?>

				<div class="trigger-wrapper">
					<button id="menu-toggle" class="menu-toggle" aria-controls="mobile-menu" aria-expanded="false">
					<div class="hamburger-inner"></div>
					</button>
				</div>

			</div>

		</div>
	</header>

<?php
}

?>
