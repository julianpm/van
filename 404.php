<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package van
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="row section-padding">
				<div class="columns small-6 small-centered">
					<div class="error-404-wrapper">
						<section class="error-404 not-found">
							<p class="error-404-header"><?php esc_html_e( 'Sorry, page not found !', 'van' ); ?></p>
							<div class="border"></div>
							<div class="page-content">
								<p><?php esc_html_e( 'Apologies, but the page you requested could not be found.', 'van' ); ?></p>
								<p><?php esc_html_e( 'Perhaps searching will help.', 'van'); ?></p>
								<?php get_search_form(); ?>
								<p>Back to <a href="<?php echo esc_url( home_url() ); ?>">home</a> or <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">contact us</a></p>
							</div><!-- .page-content -->
						</section><!-- .error-404 -->
					</div>
				</div>
			</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
