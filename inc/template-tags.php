<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package van
 */

if ( ! function_exists( 'van_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function van_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	// $byline = sprintf(
	// 	esc_html_x( 'by %s', 'post author', 'van' ),
	// 	'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	// );

	echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'van_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function van_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'van' ) );
		if ( $categories_list && van_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( '/%1$s', 'van' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function van_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'van_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'van_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so van_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so van_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in van_categorized_blog.
 */
function van_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'van_categories' );
}
add_action( 'edit_category', 'van_category_transient_flusher' );
add_action( 'save_post',     'van_category_transient_flusher' );


// GET CATEGORY
function pso_post_meta(){

	if ('projects' == get_post_type() ){
		$category = get_the_terms( get_the_ID(), 'service' );
		if ( $category ){
			echo '<span class="post-meta">'.esc_html( $category[0]->name ).'</span>';
		}
	} 

}


/**
 * Display navigation to next/previous post when applicable.
 * CUSTOM SINGLE-POST NAVIGATION
 * TO GO IN TEMPLATE TAGS
 */
function van_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<div class="row">
		<div class="columns small-12">	
			<nav class="navigation posts-navigation" role="navigation">
				<div class="nav-links section-padding">
					<?php if ( is_singular( 'projects' ) ){
						previous_post_link( '<div class="nav-previous">%link</div>', 'Previous Project' ); ?>
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/project-nav.jpg" alt="Project Nav Icon">
						<?php next_post_link( '<div class="nav-next">%link</div>', 'Next Project' );
					} else{
						previous_post_link( '<div class="nav-previous">%link</div>', 'Previous Post' ); ?>
						<?php next_post_link( '<div class="nav-next">%link</div>', 'Next Post' );
					} ?>
				</div><!-- .nav-links -->
			</nav><!-- .navigation -->
		</div>
	</div>
	<?php
}


// PAGE HEADER (SITE-WIDE)
function van_page_header(){

	$page_header_subtitle = get_field( 'van_page_header_subtitle' ); ?>

	<div class="row">
		<div class="columns small-12">
			<header class="page-header" style="background-image: url( <?php echo ( has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id() ) : '' ); ?> ); ">
				
				<h1><?php the_title(); ?></h1>

				<?php if ( $page_header_subtitle ){ ?>
					<p class="italic"><?php echo esc_html( $page_header_subtitle ); ?></p>
				<?php } ?>
			</header>
		</div>
	</div>

<?php }


// PAGE HEADER SIMPLE (SITE-WIDE)
function van_page_header_simple(){ ?>

	<header class="page-header-simple">
		<div class="row">
			<div class="columns small-12">
				<h1><?php single_post_title(); ?></h1>
			</div>
		</div>
	</header>

<?php }


// PAGE CONTENT (SITE-WIDE)
function van_page_content(){ ?>

	<section class="page-content">
		<div class="row section-padding">
			<?php if ( !is_front_page() ){ ?>
				<div class="columns small-12 large-8 large-centered">
					<?php the_content(); ?>
				</div>
			<?php } else{ ?>
				<div class="columns small-12 large-10">
					<?php the_content(); ?>
				</div>
			<?php } ?>
		</div>
	</section>

<?php }


// SOCIAL MEDIA OPTIONS (SITE-WIDE)
function van_social_media() {
	if ( function_exists( 'get_field') ){
		$twitter = get_field('van_twitter', 'option');
		$facebook = get_field('van_facebook', 'option');
		$tumblr = get_field('van_tumblr', 'option');
		$instagram = get_field('van_instagram', 'option'); ?>

		<nav class="social-media">
			<ul>
				<?php
				if( $twitter ) { ?>
					<li>
						<?php echo '<a href="'. esc_url( $twitter) .'" target="_blank"><i class="fa fa-twitter"></i></a>'; ?>
					</li>
				<?php }
				if( $facebook ) { ?>
					<li>
						<?php echo '<a href="'. esc_url( $facebook) .'" target="_blank"><i class="fa fa-facebook"></i></a>'; ?>
					</li>
				<?php }
				if( $tumblr ) { ?>
					<li>
						<?php echo '<a href="'. esc_url( $instagram ) .'" target="_blank"><i class="fa fa-tumblr"></i></a>'; ?>
					</li>
				<?php }
				if( $instagram ) { ?>
					<li>
						<?php echo '<a href="'. esc_url( $instagram ) .'" target="_blank"><i class="fa fa-instagram"></i></a>'; ?>
					</li>
				<?php } ?>
			</ul>
		</nav>
	<?php }
}


// SERVICES REPEATER (SERVICES)
function van_services() {
	if ( function_exists( 'get_field') ){
		$services = get_field( 'van_services', 21 );

		if ( $services ){ ?>

			<section class="row section-padding">

			<?php foreach ( $services as $service ){
				$services_icon = $service['van_services_icon'];
				$services_title = $service['van_services_title'];
				$services_info = $service['van_services_info']; ?>

				<div class="columns small-12 large-4 item">
					<div class="box">
						<?php if ( $services_icon ){ ?>
							<i class="fa fa-<?php echo esc_html( $services_icon ); ?>"></i>
						<?php }
						if ( $services_title ){ ?>
							<h3><?php echo esc_html( $services_title ); ?></h3>
						<?php }
						if ( $services_info ){
							echo wp_kses_post( $services_info );	
						} ?>
					</div>
				</div>

			<?php } ?>
				
			</section>

		<?php }
	}
}


// CLIENTS REPEATER (SERVICES)
function van_clients(){
	if ( function_exists( 'get_field' ) ){
		$clients = get_field( 'van_clients' );

		if ( $clients ){ ?>

			<section class="row section-padding clients">
				<h3><?php esc_html_e( 'We Have Worked With', 'van' ); ?></h3>
				<div class="border"></div>

				<?php foreach ( $clients as $client ){
					$client_logo = $client['van_clients_logo']; ?>

					<div class="columns small-12 medium-6 large-2">
						<?php if ( $client_logo ){ ?>
							<img src="<?php echo esc_url( $client_logo['url'] ); ?>" alt="<?php echo $client_logo['alt']; ?>
">
						<?php } ?>
					</div>

				<?php } ?>
			</section>	

		<?php }
	}
}


// SERVICES TESTIMONIALS
function van_testimonials(){
	if ( function_exists( 'get_field' ) ){
		$testimonials = get_field( 'van_testimonials' );

		if ( $testimonials ){ ?>

			<section class="row section-padding slider">
				
					<?php foreach ( $testimonials as $testimonial ){ 
						$testimonial_quote = $testimonial['van_testimonial_quote'];
						$testimonial_name = $testimonial['van_testimonial_name'];
						$testimonial_title = $testimonial['van_testimonial_title'];

						if ( $testimonial_quote ){ ?>

							<div class="columns small-12">
								<div class="slider-item">
									<?php echo wp_kses_post( $testimonial_quote ); ?>
									<div class="border"></div>
									<?php if ( $testimonial_name ){ ?>
										<h3><?php echo esc_html( $testimonial_name ); ?></h3>
									<?php }
									if ( $testimonial_title ){ ?>
										<p><?php echo esc_html( $testimonial_title ); ?></p>
									<?php } ?>
								</div>
							</div>

						<?php }
					} ?>

			</section>

		<?php }
	}
}


// NOTICES REPEATER (FRONT PAGE AND ABOUT)
function van_notices(){
	if ( function_exists( 'get_field' ) ){
		$notices = get_field( 'van_notices' );

		if ( $notices ){ ?>

			<section class="row section-padding">
				
			<?php foreach ( $notices as $notice ){
				$notices_title = $notice['van_notices_title'];
				$notices_info = $notice['van_notices_info'];
				$notices_link = $notice['van_notices_link'];
				$notices_link_text = $notice['van_notices_link_text']; ?>

				<div class="columns small-12 large-6">
					<div class="card item">
						<?php if ( $notices_title ){ ?>
							<h3><?php echo esc_html( $notices_title ); ?></h3>
						<?php }
						if ( $notices_info ){
							echo wp_kses_post( $notices_info );
						}
						if ( $notices_link){ ?>
							<a class="btn" href="<?php echo esc_url( '/'.$notices_link ); ?>"><?php echo esc_html( $notices_link_text ); ?></a>
						<?php } ?>
					</div>
				</div>

			<?php } ?>

			</section>

		<?php }
	}
}


// MAP (CONTACT PAGE)
function van_map(){
	if ( function_exists( 'get_field' ) ){
		$map = get_field( 'van_map' );

		if ( $map ){ ?>

			<section class="row section-padding">
				<div class="columns small-12">
					<img src="<?php echo esc_url( $map['url'] ); ?>" alt="<?php echo $map['alt']; ?> ">
				</div>
			</section>

		<?php }
	}
}


// CONTACT INFO (CONTACT PAGE)
function van_contact_info(){
	$telephone_number = get_field( 'van_telephone_number' );
	$address = get_field( 'van_address' );
	$email = get_field( 'van_email' ); ?>

	<section class="row section-padding">
		<div class="columns small-12 large-3">
			<div class="box box-simple">
				<?php if ( $telephone_number ){ ?>
					<i class="fa fa-phone" aria-hidden="true"></i>
					<p class="italic"><?php echo esc_html( $telephone_number ); ?></p>
				<?php } ?>
			</div>
		</div>
		<div class="columns small-12 large-6">
			<div class="box box-simple">
				<?php if ( $address ){ ?>
					<i class="fa fa-map-marker" aria-hidden="true"></i>
					<p class="italic"><?php echo esc_html( $address ); ?></p>
				<?php } ?>
			</div>
		</div>
		<div class="columns small-12 large-3">
			<div class="box box-simple">
				<?php if ( $email ){ ?>
					<i class="fa fa-envelope" aria-hidden="true"></i>
					<p class="italic"><?php echo esc_html( $email ); ?></p>
				<?php } ?>
			</div>
		</div>
	</section>

<?php }


// CONTACT TEXT (CONTACT)
function van_contact_text(){
	if ( function_exists( 'get_field' ) ){
		$contact_text = get_field( 'van_contact_text' );

		if ( $contact_text ){ ?>

			<section class="row section-padding">
				<div class="columns small-12 large-10 large-centered">
					<?php echo wp_kses_post( $contact_text ); ?>
				</div>
			</section>

		<?php }
	}
}


// OUR TEAM HEADER (ABOUT PAGE)
function van_our_team_header(){
	$our_team_header_icon = get_field( 'van_our_team_header_icon' );
	$our_team_header_title = get_field( 'van_our_team_header_title' );
	$our_team_header_info = get_field( 'van_our_team_header_info'); ?>

	<section class="row section-padding">
		<div class="columns small-12">
			<div class="cta">
				<?php if ( $our_team_header_icon ){ ?>
					<img src="<?php echo esc_url( $our_team_header_icon['url'] ); ?>" alt="<?php echo $our_team_header_icon['alt']; ?>">
				<?php }
				if ( $our_team_header_title ){ ?>
					<h3><?php echo esc_html( $our_team_header_title ); ?></h3>
				<?php }
				if ( $our_team_header_info ){
					echo wp_kses_post( $our_team_header_info );
				} ?>
			</div>
		</div>
	</section>

<?php }


// OUR TEAM REPEATER (ABOUT PAGE)
function van_our_team(){
	if ( function_exists( 'get_field' ) ){
		$our_team = get_field( 'van_our_team' );

		if ( $our_team ){ ?>

			<section class="row">
				
				<?php foreach ( $our_team as $our_team_item ){
					$our_team_image = $our_team_item['van_our_team_image'];
					$our_team_name = $our_team_item['van_our_team_name'];
					$our_team_position = $our_team_item['van_our_team_position']; ?>

					<div class="columns small-12 large-3 box box-simple">
						<?php if ( $our_team_image ){ ?>
							<img src="<?php echo esc_url( $our_team_image['url'] ); ?>" alt="<?php echo esc_url( $our_team_image['alt'] ); ?>">
						<?php }
						if ( $our_team_name ){ ?>
							<h3><?php echo esc_html( $our_team_name ); ?></h3>
						<?php }
						if ( $our_team_position ){ ?>
							<p class="italic"><?php echo esc_html( $our_team_position ); ?></p>
						<?php } ?>
					</div>

				<?php } ?>

			</section>

		<?php }
	}
}


// OUR HISTORY REPEATER (ABOUT)
function van_history(){
	if ( function_exists( 'get_field' ) ){
		$history = get_field( 'van_about_history');

		if ( $history ){ ?>

			<section class="row section-padding history">
				
				<?php foreach ( $history as $history_item ){
					$content_choice = $history_item['van_content_choice'];
					$about_history_image = $history_item['van_about_history_image'];
					$about_history_title = $history_item['van_about_history_title'];
					$about_history_info = $history_item['van_about_history_info']; ?>

					<?php if ( $content_choice == "Image" ){
						if ( $about_history_image ){ ?>
							<div class="columns small-12 large-4 item">
								<img src="<?php echo esc_url( $about_history_image['url'] ); ?>" alt="<?php echo $about_history_image['alt']; ?>">
							</div>
						<?php }
					} elseif ( $content_choice == "Text" ){
						if ( $about_history_title ){ ?>
							<div class="columns small-12 large-4 item">
								<div class="box">
									<h3><?php echo esc_html( $about_history_title ); ?></h3>
									<?php if ( $about_history_info ){
										echo wp_kses_post( $about_history_info );
									} ?>
								</div>
							</div>
						<?php }
					}
				} ?>

			</section>

		<?php }
	}
}


// SHARE THIS (BLOG)
function van_share(){ ?>

	<div class="share">
		<p>Share this:</p>
		<a href="http://twitter.com/intent/tweet?status=<?php the_title(); ?>+<?php echo get_permalink(); ?>">
			<i class="fa fa-twitter" aria-hidden="true"></i>
			|
		</a>
		<a href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>&title=<?php the_title(); ?>">
			<i class="fa fa-facebook" aria-hidden="true"></i>
			|
		</a>
		<a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>">
			<i class="fa fa-google-plus" aria-hidden="true"></i>
		</a>
	</div>

<?php }


// PROJECTS ARCHIVE HEADER (PROJECTS)
function van_projects_archive_header(){
	$projects_image = get_field( 'van_projects_header_image', 'options' );
	$projects_title = get_field( 'van_projects_header_title', 'options' );
	$projects_subtitle = get_field( 'van_projects_header_subtitle', 'options' );

	if ( $projects_image ){ ?>

		<div class="row">
			<div class="columns small-12">
				<header class="page-header" style="background-image: url( <?php echo esc_url( $projects_image['url'] ); ?> );" alt="<?php echo $about_history_image['alt']; ?>">
					<?php if ( $projects_title ){ ?>
						<h1><?php echo esc_html( $projects_title ); ?></h1>
					<?php } ?>
					<?php if ( $projects_subtitle ){ ?>
						<p class="italic"><?php echo esc_html( $projects_subtitle ); ?></p>
					<?php } ?>
				</header>
			</div>
		</div>

	<?php }
}


// SINGLE PROJECT INFO
function van_single_project_info(){
	$project_info_skills = get_field( 'van_projects_skills' );
	$project_info_client = get_field( 'van_projects_client' );
	$project_info_link = get_field( 'van_projects_link' );

	if ( $project_info_skills ){ ?>
		<div class="single-project-info">
			<p><?php echo esc_html_e( 'Skills', 'van' ); ?></p>
			<p><?php echo esc_html( $project_info_skills ); ?></p>
		</div>
	<?php }
	if ( $project_info_client ){ ?>
		<div class="single-project-info">
			<p><?php echo esc_html_e( 'Clients', 'van' ); ?></p>
			<p><?php echo esc_html( $project_info_client ); ?></p>
		</div>
	<?php }
	if ( $project_info_link ){ ?>
		<a class="btn" href="<?php echo esc_html( $project_info_link ); ?>">Visit Site</a>
	<?php }

}


// SINGLE PROJECT IMAGE REPEATER
function van_project_image(){
	if ( function_exists( 'get_field' ) ){
		$project_images = get_field( 'van_project_images' );

		if ( $project_images ){ ?>

			<section class="row">
				<div class="columns small-12 project-slider">
				
					<?php foreach ( $project_images as $project_image ){
						$project_single_image = $project_image['van_project_single_image']; 

						if ( $project_single_image ){ ?>

							<img src="<?php echo esc_url( $project_single_image['url'] ); ?>" alt="<?php echo esc_url( $project_single_image['alt'] ); ?>">						

						<?php }
					}?>

				</div>
			</section>

		<?php }
	}
}


// POSTS WP QUERY SINGLE PROJECT
function van_posts_query(){

	$args = array(
		'orderby'        => 'rand',
		'posts_per_page' => '3',
	);
	
	// the query
	$related_posts = new WP_Query( $args ); ?>

	<?php if ( $related_posts->have_posts() ) : ?>
		<!-- pagination here -->
		<div class="row section-padding related-posts">
			<h2><?php echo esc_html_e( 'Maybe These Will Interest You', 'van' ); ?></h2>
			<div class="border"></div>
			<!-- the loop -->
			<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
				<div class="columns small-12 large-4">
					<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
				</div>
			<?php endwhile; ?>
			<!-- end of the loop -->
		</div>
		<!-- pagination here -->
	
		<?php wp_reset_postdata(); ?>
	
	<?php endif;

}