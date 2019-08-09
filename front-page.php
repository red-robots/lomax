<?php
get_header(); ?>
<div id="primary" class="full-content-area clear">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php  
			$intro = get_field('intro');
		?>
		<?php if ($intro) { ?>
		<div class="home-intro text-center">
			<div class="wrapper"><?php echo $intro ?></div>
		</div>
		<?php } ?>
	
	<?php endwhile; ?>

		<?php  
		$contact_form = get_field('contact_form');
		$args = array(
			'posts_per_page'=> -1,
			'post_type'		=> 'locations',
			'post_status'	=> 'publish'
		);
		$locations = new WP_Query($args);
		?>

	<div class="contact-section">
		<div class="wrapper clear">
			<div class="col location">
				<h3 class="title"><span>Get Started</span></h3>
				<div class="title2">LOCATIONS</div>
				<?php if ( $locations->have_posts() ) { ?>
				<ul id="locationlist" class="locations">
					<?php $i=1; while ( $locations->have_posts() ) : $locations->the_post(); 
						$address = get_field('address'); 
						$phone = get_field('phone'); 
						?>
						<li class="info<?php echo ($i==1) ? ' open first':'';?>">
							<a href="#" class="name"><span><?php echo get_the_title(); ?></span></a>
							<address class="details">
								<?php echo $address ?>
								<?php if ($phone) { ?>
								<a href="tel:<?php echo format_phone_number($phone); ?>" class="phone"><?php echo $phone ?></a>	
								<?php } ?>
							</address>
						</li>
					<?php $i++; endwhile; wp_reset_postdata(); ?>
				<?php } ?>
				</ul>
			</div>
			<div class="col form">
				<?php echo $contact_form ?>
			</div>
		</div>
	</div>

</div><!-- #primary -->
<?php
get_footer();
