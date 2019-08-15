<?php 
get_header(); 
$current_link = get_permalink( get_the_ID() ); ?>
<div id="primary" class="full-content-area clear default-content singleportfolio">
	<main id="main" class="site-main clear" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

				<?php /* NEXT / PREVIOUS CUSTOM POST */ ob_start(); ?>
				<div class="next-prev-post clear">
					<?php
					$args = array(
						'posts_per_page'   => -1,
						'post_type'        => 'portfolio',
						'post_status'      => 'publish'
					);
					$items = new WP_Query($args);
					$posts = array();
					while ( $items->have_posts() ) : $items->the_post(); 
						$posts[] += $post->ID;
					endwhile;  wp_reset_postdata();

					// Identify the position of the current product within the $posts-array 
					$current = array_search(get_the_ID(), $posts);
					$index = $current-1;
					$key = ($index>0) ? $index : 0;
					// Identify ID of previous product
					$prevID = ( isset($posts[$key]) && $posts[$key] ) ? $posts[$key] : '';

					// Identify ID of next product
					$nextID = ( isset($posts[$current+1]) && $posts[$current+1] ) ? $posts[$current+1] : '';
					$prevLink = (!empty($prevID)) ? get_permalink($prevID) : '';
					$showPrevLink = ($prevLink==$current_link) ?  false : true;

					// Link "previous product"
					if ($showPrevLink) {
						if (!empty($prevID)) { ?>
						<a class="prev" href="<?php echo get_permalink($prevID); ?>"><span class="arrow"><i class="fas fa-chevron-left"></i></span></a>
						<?php }
					}
					// Link "next product"
					if (!empty($nextID)) { ?>
					<a class="next" href="<?php echo get_permalink($nextID); ?>"><span class="arrow"><i class="fas fa-chevron-right"></i></span></a>
					<?php } ?>
				</div>
				<?php $navPosts = ob_get_contents(); ob_end_clean(); ?>

		<header class="entry-header">
			<div class="wrapper">
				<div class="allbtn"><a href="<?php echo get_permalink(8) ?>"><span><i></i></span>Back to All</a></div>
				<div class="titlewrap">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php echo $navPosts; ?>
				</div>

			</div>
		</header>
		


		
		<?php  
			$square_footage = get_field('square_footage');
			$architect = get_field('architect');
		?>
		<div class="project-info clear">
			<div class="wrapper">
			<?php if ($square_footage) { ?>
				<span class="sqfoot"><?php echo $square_footage ?></span>
			<?php } ?>
			<?php if ($architect) { ?>
				<span class="architect"><?php echo $architect ?></span>
			<?php } ?>
			</div>
		</div>

		<?php  
			$post_id = get_the_ID();
			$post_thumbnail_id = get_post_thumbnail_id( $post_id );
			$galleries = get_field('gallery');
			$altTxt = ($post_thumbnail_id) ? trim(get_the_title($post_thumbnail_id)) : '';
			$img = wp_get_attachment_image_src($post_thumbnail_id,'medium_large'); 
			$mainImage = wp_get_attachment_image($post_thumbnail_id,'full','',array('class'=>'ssimage mainpic','alt'=>$altTxt));
			$square = get_bloginfo('template_url') . '/images/square.png';
		?>

		<?php if ($galleries) { ?>
			<div class="wrapper slider-outer-wrap">
				<div class="project-sliders">
					<ul class="sliders">
						<?php foreach ($galleries as $g) { 
							$image_title = $g['title'];
							$image_src = $g['url'];
							?>
							<li class="slide gallery" style="background-image:url('<?php echo $image_src;?>')">
								<span class="span-image">
									<img class="ssimage" src="<?php echo $square?>" alt="" aria-hidden="true" />
									<span class="imagetitle"><span class="span"><?php echo $image_title ?></span></span>
								</span>
							</li>
						<?php } ?>	
					</ul>
				</div>
			</div>
		<?php } ?>

	<?php endwhile;  ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
