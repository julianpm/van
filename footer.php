<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package van
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="row">
				<div class="columns small-12 footer">
					<div class="footer-left">
						<a href="<?php esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/van_logo.png" alt="Van Logo">
						</a>
						<p><?php esc_html_e( 'Graphic Design & Art Direction', 'van' ); ?></p>
					</div>
					<div class="footer-right">
						<p>lkj</p>
						<p>asd</p>
						<p>kjf</p>
						<p>l;j</p>
					</div>
				</div>
				<div class="columns small-12 footer-bottom">
					<p><?php esc_html_e( '&#169;2016 Vandesign. All rights reserved.', 'van' ); ?></p>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
