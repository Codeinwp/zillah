<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zillah
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article single-post-alt entry-content-wrap' ); ?>>

	<header class="entry-header">
		<div class="content-inner-wrap content-inner-wrap-alt">
			<?php
			zillah_posted_date();
			the_title( '<h1 class="entry-title">', '</h1>' );
			zillah_category();
			zillah_comments_number();
			?>
		</div>
	</header><!-- .entry-header -->

	<?php
	if ( has_post_thumbnail() ) {
		echo '<div class="post-thumbnail-wrap">';
		the_post_thumbnail();
		echo '</div>';
	}
	?>

	<?php zillah_hook_entry_before(); ?>
	<div class="entry-content">
		<div class="content-inner-wrap">
			<?php
			zillah_hook_entry_top();

			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. */
						__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'zillah' ), array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zillah' ),
					'after'  => '</div>',
				)
			);

			zillah_hook_entry_bottom();
			?>
		</div>
	</div><!-- .entry-content -->
	<?php zillah_hook_entry_after(); ?>

	<footer class="entry-footer">
		<div class="content-inner-wrap">
			<?php zillah_entry_footer(); ?>
		</div>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

<?php
$author_first_name  = get_the_author_meta( 'first_name' );
$author_last_name   = get_the_author_meta( 'last_name' );
$author_description = wp_kses_post( nl2br( get_the_author_meta( 'description' ) ) );

if ( ! empty( $author_first_name ) || ! empty( $author_last_name ) || ! empty( $author_description ) ) {

	echo '<div class="author-details-wrap">';
	echo '<div class="content-inner-wrap">';

	echo '<div class="author-details-img-wrap">';
	echo get_avatar( get_the_author_meta( 'user_email' ), '100' );
	echo '</div>';

	$author_name = '';
	if ( ! empty( $author_first_name ) ) {
		$author_name .= sanitize_text_field( $author_first_name ) . ' ';
	}
	if ( ! empty( $author_last_name ) ) {
		$author_name .= sanitize_text_field( $author_last_name );
	}

	echo '<div class="author-details-title" itemprop="author">';
	if ( $author_name !== '' ) {
		echo '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( $author_name ) . '">' . esc_html( $author_name ) . '</a>';
	}
	echo '</div>';

	if ( ! empty( $author_description ) ) {
		echo '<div class="author-details-content">' . $author_description . '</div>';
	}

	echo '</div>';
	echo '</div>';

}
?>
