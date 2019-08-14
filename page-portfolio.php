<?php
/**
 * Template Name: Portfolio
 */

get_header(); ?>

	<div id="primary" class="full-content-area clear default-content">
		<main id="main" class="site-main wrapper clear" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header>
				<div class="entry-content"><?php the_content(); ?></div>
			<?php endwhile; ?>

			<?php  
			$posts_per_page = 12;
			$args = array(
				'posts_per_page'=> $posts_per_page,
				'post_type'		=> 'portfolio',
				'post_status'	=> 'publish'
			);
			$projects = new WP_Query($args);
			if ( $projects->have_posts() ) {  ?>
			<section class="portfolio-wrapper clear">
				<div class="flexrow">
				<?php while ( $projects->have_posts() ) : $projects->the_post(); 
					$post_id = get_the_ID();
					$pagelink = get_permalink($post_id);
					$post_thumbnail_id = get_post_thumbnail_id( $post_id );
					$img = wp_get_attachment_image_src($post_thumbnail_id,'full');
					$style = ($img) ? ' style="background-image:url('.$img[0].')"':'';
					$square = get_bloginfo('template_url') . '/images/square.png';
					?>
					<div class="block">
						<a href="<?php echo $pagelink ?>" class="inside clear"<?php echo $style ?>>
							<img src="<?php echo $square ?>" alt="" aria-hidden="true" />
							<span class="titlewrap">
								<span class="title"><?php echo get_the_title(); ?></span>
							</span>
						</a>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</section>
			<?php } ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
