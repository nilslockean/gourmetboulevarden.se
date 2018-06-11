<?php
/**
 * The template for displaying the footer
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

/*
 * Don't show the #site-header on the error 404 page template.
 *
 * @link https://codex.wordpress.org/Function_Reference/is_404
 */
if ( ! is_404() ) : ?>

		</div><!-- .site-content__inner -->

		</div><!-- .site-content -->

		<?php
		// Retrieve the footer.
		do_action( 'ava_do_footer' );

	endif;
	?>

	</div><!-- .site -->

	<?php

	/*
	 * @hooked ava_search
	 * @hooked ava_flyout
	 */
	do_action( 'ava_after_page' );

	wp_footer();
	?>

	</body>

</html>
