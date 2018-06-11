<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

					// Let's check if Beaver Builder is active and this is a single portfolio post.
			if ( is_singular( 'portfolio' ) ) {
				get_template_part( 'components/portfolio/single-portfolio' );
			} else {
				get_template_part( 'components/post/content', get_post_format() );
			}

			/*
			 * If comments are open or we have at least one comment, load up the comment template.
			 *
			 * @link https://codex.wordpress.org/Function_Reference/comments_open/
			 * @link https://codex.wordpress.org/Template_Tags/get_comments_number/
			 * @link https://developer.wordpress.org/reference/functions/comments_template/
			 */
			if ( 'portfolio' !== get_post_type() && ( comments_open() || get_comments_number() ) ) :
				comments_template();
			endif;

		endwhile;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
// Let's display the post minibar on singular posts only.
if ( is_singular( 'post' ) ) {
	get_template_part( 'components/post/minibar' );
}

get_footer();
