<?php
/**
 * TEMPLATE NAME: Contact
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package van
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				// CUSTOM PAGE HEADER WITH HERO IMAGE
				van_page_header();

				// CONTACT INFO
				van_contact_info(); ?>

				<div class="row">
					<div class="columns small-12">
						<?php the_content(); ?>
					</div>
				</div>			

				<!-- CONTACT TEXT -->
				<?php van_contact_text();				

				// MAP
				van_map();

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();