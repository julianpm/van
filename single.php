<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package van
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="row section-padding">
				<div class="columns small-12 large-8">
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'single' );

						#the_post_navigation();

					endwhile; // End of the loop.
					?>
					<?php van_post_navigation(); ?>
				</div>
				<div class="columns small-12 large-4">
					<?php get_sidebar(); ?>
					
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
