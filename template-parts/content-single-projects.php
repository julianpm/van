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
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>
		<div class="border"></div>
	</header><!-- .entry-header -->

	<?php van_post_navigation(); ?>

	<div class="row section-padding">
		<div class="columns small-9">
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</div>
		<div class="columns small-3">
			<?php van_single_project_info(); ?>
		</div>
	</div>

	<?php van_posts_query(); ?>

</article><!-- #post-## -->
