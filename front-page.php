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
								<div><a href="tel:<?php echo format_phone_number($phone); ?>" class="phone"><?php echo $phone ?></a></div>
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

	<?php get_template_part('template-parts/content','testimonials'); ?>

	<?php if ( $partners = get_field('partners','option') ) { ?>
	<div class="partners-section wrapper">
		<div class="partners-section">
			<?php foreach ($partners as $p) { 
			$attID = $p['ID'];
			$website = get_field("url",$attID);  
			$target = '';
			if($website!='#'){
				$target = ' target="_blank"';
			}
			$before_link = '';
			$after_link = '';
			if($website) {
				$before_link = '<a href="'.$website.'"'.$target.'>';
				$after_link = '</a>';
			}
			?>
			<div class="partner">
				<?php echo $before_link; ?><img src="<?php echo $p['url']; ?>" alt="<?php echo $p['title']; ?>"><?php echo $after_link; ?>
			</div>	
			<?php } ?>
		</div>	
	</div><!-- wrapper -->
	<?php } ?>

</div><!-- #primary -->
<?php
get_footer();
