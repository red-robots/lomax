<?php
/**
 * Template Name: Contact
 */

get_header(); ?>
<div id="primary" class="full-content-area clear pagecontact">
	<main id="main" class="site-main wrapper clear" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>
			<div class="entry-content"><?php the_content(); ?></div>
		<?php endwhile;  ?>

		<?php  

		$email = get_field('email','option');
		$socialLinks = array();
		$social[] = array('linkedin','fab fa-linkedin');
		$social[] = array('facebook','fab fa-facebook-square');
		$social[] = array('instagram','fab fa-instagram');
		$social[] = array('twitter','fab fa-twitter-square');
		foreach ($social as $s) { 
			$social_link = get_field( $s[0],'option' );
			$social_link = preg_replace('/\s+/', '', $social_link);
			$social_icon = $s[1];
			if($social_link) {
				$socialLinks[] = array($social_link,$social_icon);
			}
		}


		$args = array(
			'posts_per_page'=> -1,
			'post_type'		=> 'locations',
			'post_status'	=> 'publish'
		);
		$locations = get_posts($args);
		if ( $locations ) {  ?>
		<section class="locations-section clear">
			<aside id="locations" class="leftcol locations">
				<ul class="locationList">
				<?php foreach ($locations as $e) { 
					$p_id = $e->ID; 
					$name = $e->post_title;
					$mapSlug = $e->post_name;
					$map = get_field('map',$p_id);
					$mapHover = ($map) ? $map['url'] : '';
					$address = get_field('address',$p_id);
					$phone = get_field('phone',$p_id); 
					?>
					<li class="info mapinfo" data-map="#map_<?php echo $mapSlug ?>">
						<div class="inside">
							<p class="name"><?php echo $name ?></p>
							<?php if ($address || $phone) { ?>
							<address>
								<div class="address"><?php echo $address; ?></div>
								<div class="phone"><?php echo $phone; ?></div>
							</address>
							<?php } ?>
						</div>
					</li>	
				<?php } ?>
				</ul>
			</aside>

			<div class="rightcol">
				<div class="mapcontainer clear">
					<div class="mapimage">
						<img src="<?php echo get_bloginfo('template_url') ?>/images/map.png" data-default="#image-map" usemap="#image-map" alt="" class="basemap" aria-hidden="true" />

						<map id="themaps" name="image-map">
						<?php foreach ($locations as $e) {  
							$p_id = $e->ID; 
							$mapName = $e->post_title; 
							$mapSlug = $e->post_name;
							$map = get_field('map',$p_id);
							$map_area = get_field('map_area',$p_id); ?>
							<?php if ($map) { 
								$map_area = str_replace('<area','<area data-mapid="#map_'.$mapSlug.'" data-mapname="'.$mapName.'"',$map_area); ?>
								<?php echo $map_area ?>
							<?php } ?>
						<?php } ?>
						</map>


						<?php foreach ($locations as $e) {  
							$p_id = $e->ID;  
							$mapSlug = $e->post_name;
							$map = get_field('map',$p_id); ?>
							<?php if ($map) { ?>
							<img id="map_<?php echo $mapSlug ?>" src="<?php echo $map['url'] ?>" alt="<?php echo $map['title'] ?>" class="maphover" />
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>

		</section>
		<?php } ?>

		<section class="form-section clear">
			<div class="leftcol contact-social-links">
				<?php if ($email) { ?>
				<div class="email-info">
					<div class="stitle">Email</div>
					<a href="mailto:<?php echo antispambot($email,1) ?>"><?php echo antispambot($email) ?></a>
				</div>
				<?php } ?>
				
				<?php if ($socialLinks) { ?>
				<div class="social-info">
					<div class="stitle">Follow Us</div>
					<?php  
					$i=1; foreach ($socialLinks as $s) { 
						$social_link = $s[0];;
						$social_icon = $s[1]; ?>
						<a class="social<?php echo($i==1) ? ' first':'';?>" href="<?php echo $social_link ?>" target="_blank">
							<span class="icon"><i class="<?php echo $social_icon ?>"></i><span class="sr-only"><?php echo $s[0]; ?></span></span>
						</a> 
					<?php $i++; } ?>
				</div>
				<?php } ?>
			</div>

			<div class="rightcol">
				<?php $contact_form = get_field('contact_form'); ?>
				<?php if ($contact_form) { ?>
					<div class="contact-section">
						<?php echo $contact_form ?>
					</div>
				<?php } ?>
			</div>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
