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

				// PAGE CONTENT
				van_page_content();

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();