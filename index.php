<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

			if ( is_home() && ! is_front_page() ) : ?>
				<header class="blog-header">
					<div class="row">
						<div class="columns small-12">
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</div>
					</div>
				</header>

			<?php
			endif; ?>

			<div class="row">
				<div class="columns small-12 large-8">

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

					<?php
					endwhile; ?>

				</div>
				<div class="columns small-12 large-4">	
					<?php get_sidebar(); ?>
				</div>
			</div>

			<?php
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
