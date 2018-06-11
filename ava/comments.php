<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Ava
 * @link        https://themebeans.com/themes/ava
 * @author      Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @copyright   Copyright (c) 2018, ThemeBeans of Inventionn LLC
 * @license     GPL-3.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

<div class="comments-area__inner">

	<?php
	if ( have_comments() ) :
	?>
		<h5 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One Comment %2$s', '%1$s Comments %2$s', get_comments_number(), 'comments title', 'ava' ) ),
					number_format_i18n( get_comments_number() ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				);
			?>
		</h5>

	<?php else : ?>

	<h5 class="comments-title">
		<?php esc_html_e( 'Leave a Response', 'ava' ); ?>
	</h5>

	<?php endif; ?>

	<?php comment_form(); ?>

	<?php if ( have_comments() ) : ?>

	<div id="comments-list" class="comments">
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'ava' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'ava' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'ava' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="commentlist block comment-list">
			<?php
				wp_list_comments(
					array(
						'style'      => 'ol',
						'short_ping' => true,
						'callback'   => 'ava_comments',
					)
				);
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'ava' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'ava' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'ava' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.
		?>

	</div><!-- END #comments-list.comments -->

	<?php
	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'ava' ); ?></p>
	<?php
	endif;
	?>

</div><!-- .comments-area__inner -->

</div><!-- #comments -->
