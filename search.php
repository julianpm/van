<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package van
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php
			if ( have_posts() ) : ?>

				<header class="page-header-simple">
					<div class="row">
						<div class="columns small-12">
							<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'van' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						</div>
					</div>
				</header>
	
				<div class="row section-padding">
						
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post(); ?>

						<div class="columns small-12">
							
							<?php get_template_part( 'template-parts/content', 'search' ); ?>

						</div>

					<?php	
					endwhile;

					the_posts_navigation(); ?>
					
				</div>

			<?php
			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php

get_footer();
