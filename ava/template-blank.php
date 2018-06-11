<?php
/**
 * Template Name: Blank Template
 *
 * A template without any header or footer elements. A blank canvas.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main page-item single-page">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'components/page/content', 'page' );

		endwhile;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
