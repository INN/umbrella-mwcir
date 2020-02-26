<?php
global $shown_ids;

$sticky = get_option( 'sticky_posts' );
if ( empty( $sticky ) ) {
	return;
}

$args = array(
	'posts_per_page' => 1,
	'post__in'  => $sticky,
	'ignore_sticky_posts' => 1
);
$query = new WP_Query( $args );

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$shown_ids[] = get_the_ID();

		if ( $sticky && $sticky[0] && ! is_paged() ) {
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix sticky entry-content sticky-solo'); ?>>
					<div class="sticky-main-feature row-fluid">

						<?php // if we have a thumbnail image, show it
							if ( has_post_thumbnail() ) {
								?>
									<div class="<?php largo_hero_class(get_the_ID()); ?>">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'large' ); ?>
										</a>
									</div>
								<?php
							} // end thumbnail
						?>

						<?php largo_maybe_top_term( array( 'post' => $post ) ); ?>

						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<h5 class="byline"><?php largo_byline( true, false, get_the_ID() ); ?></h5>

						<div class="entry-content">
							<?php
								largo_excerpt( $post, 2 );
								$shown_ids[] = get_the_ID();
							?>
						</div>

					</div> <!-- end sticky-main-feature -->
				</article><!-- end sticky-solo or sticky-related -->
			<?php 
		} // is_paged
	}
}
