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

			<?php
			while ( have_posts() ) : the_post();

				// PAGE CONTENT
				van_page_content();

				// SERVICES
				van_services();

				// PROJECTS WP QUERY
				$args = array(
					'post_type' 	 => 'projects',
					'orderby'		 => 'rand',
					'posts_per_page' => 6
				);
				// the query
				$projects = new WP_Query( $args ); ?>

				<?php if ( $projects->have_posts() ) : ?>
					
					<section class="row">
				
						<?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
						
						<div class="columns small-12 large-4">
							<?php get_template_part( 'template-parts/content', 'projects' ); ?>
						</div>

						<?php endwhile;
						wp_reset_postdata(); ?>
					</section>
				
				<?php endif;

				// NOTICES REPEATER
				van_notices();

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();