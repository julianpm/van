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
				<div class="columns small-12">
					<ul class="project-options">
						<li>
							<a href="#" data-filter="*">All</a>
						</li>
						<li>
							<a href="#" data-filter=".service-audio">Audio</a>
						</li>
						<li>
							<a href="#" data-filter=".service-video">Video</a>
						</li>
						<li>
							<a href="#" data-filter=".service-design">Design</a>
						</li>
						<li>
							<a href="#" data-filter=".service-branding">Branding</a>
						</li>
					</ul>
				</div>
			</div>
				
			<div class="row">
				<div class="columns small-12 projects-wrapper">
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post(); ?>
					
						<!-- <div class="columns small-12 large-4"> -->
							<?php get_template_part( 'template-parts/content', 'projects' ); ?>
						<!-- </div> -->

					<?php
					endwhile; ?>
				</div>
			</div>
		
		<?php
		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();