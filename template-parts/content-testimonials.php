<?php  
$args = array(
	'posts_per_page'=> -1,
	'post_type'		=> 'testimonials',
	'post_status'	=> 'publish'
);
$items = new WP_Query($args);
if ( $items->have_posts() ) { ?>
<div class="testimonials-section">
	<div class="wrapper">
		<div id="testimonials" class="innerwrap">
			<ul class="slides">
			<?php $i=1; while ( $items->have_posts() ) : $items->the_post(); ?>
				<li class="testimonial">
					<div class="middle">
						<div class="text"><?php the_content(); ?></div>
						<div class="author"><?php the_title(); ?></div>
					</div>
				</li>
			<?php $i++; endwhile; wp_reset_postdata(); ?>
			</ul>
		</div>
	</div>
</div>
<?php } ?>