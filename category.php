<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package van
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			van_projects_archive_header(); ?>

			<div class="row section-padding">
				
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post(); ?>
				
					<div class="columns small-12 large-4 item">
						<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
					</div>

				<?php
				endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
				
				<div class="columns small-12">
					<?php the_posts_navigation(); ?>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();