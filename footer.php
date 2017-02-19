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
				<div class="columns small-12">
					<p class="italic">© <?php echo date( 'Y' ); ?> - <?php echo esc_html_e( 'Savour', 'svr' ); ?></p>
					<?php van_social_media(); ?>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
