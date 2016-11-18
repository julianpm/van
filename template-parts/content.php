<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package van
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) :
			if ( ! is_singular( 'projects' ) ){ ?>
				<div class="entry-meta">
					<div class="posted-on-wrapper">
						<?php van_posted_on();
						van_entry_footer(); ?>
					</div>
					<?php van_share(); ?>
				</div><!-- .entry-meta -->
			<?php }
		endif; ?>
	</header><!-- .entry-header -->

	<?php if ( ! is_singular( 'projects' ) ){
		if ( has_post_thumbnail() ){ ?>
			<div class="featured-image">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php }
	} ?>

	<div class="entry-content">
		<?php the_excerpt();
		if ( ! is_singular( 'projects' ) ){ ?>
			<a class="btn" href="<?php the_permalink(); ?>"><?php echo esc_html( 'read more', 'pso' ); ?></a>
		<?php } ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
