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
		esc_html_x( 'Posted on %s', 'post date', 'van' ),
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
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'van' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'van' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'van' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'van' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'van' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
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
					<?php
						previous_post_link( '<div class="nav-previous">%link</div>', 'Previous Post' );
						next_post_link( '<div class="nav-next">%link</div>', 'Next Post' );
					?>
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

	<div class="row">
		<div class="columns small-12">
			<?php the_content(); ?>
		</div>
	</div>

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