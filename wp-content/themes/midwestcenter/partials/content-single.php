<?php
/**
 * The template for displaying content in the single.php template
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'hnews item' ); ?> itemscope itemtype="http://schema.org/Article">

	<?php do_action('largo_before_post_header'); ?>

	<header>

        <?php largo_maybe_top_term(); ?>

        <?php mwcir_photo_header_tag( get_post_thumbnail_id() ); ?>
            <div class="featured-image-bg-layer">
            </div>
            <div class="featured-image-container-content">
                <?php

                if( get_post_thumbnail_id() ) {
                    echo '<div class="featured-image-wrapper"><img class="featured-image-container-mobile-image" src="'.wp_get_attachment_url( get_post_thumbnail_id() ).'"></div>';
                }

                ?>
                <h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
            </div>
        </div>
        <div class="bottom-header-content">
            <?php if ( $subtitle = get_post_meta( $post->ID, 'subtitle', true ) ) : ?>
                <h2 class="subtitle"><?php echo $subtitle ?></h2>
            <?php endif; ?>
            <h5 class="byline"><?php largo_byline(); ?></h5>

            <?php if ( ! of_get_option( 'single_social_icons' ) == false ) {
                largo_post_social_links();
            } ?>
        </div>

<?php largo_post_metadata( $post->ID ); ?>

	</header><!-- / entry header -->

	<?php do_action('largo_after_post_header'); ?>

	<?php get_sidebar(); ?>

	<section class="entry-content clearfix" itemprop="articleBody">
		
		<?php largo_entry_content( $post ); ?>
		
	</section>

	<?php do_action('largo_after_post_content'); ?>

</article>
