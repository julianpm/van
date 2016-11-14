<?php
/**
 * The template for displaying all single projects.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package van
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="row">
			<div class="columns small-12">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'single-'. get_post_type() );

				endwhile; // End of the loop.
				?>
			</div>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
#get_sidebar();
get_footer();
