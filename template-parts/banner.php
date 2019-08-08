<?php
if ( is_front_page() || is_home() ) { 
	$slides = get_field('slides'); 
	$slide_class = ' flexslider';
	if($slides) {
		// $count = count($slides);
		// print_r($count);
		// if($count>1) {
		// 	$slide_class = ' flexslider';
		// }
	}
	?>
	<?php if ($slides) { ?>
	<div class="home-sliders">
		<div class="slideshow<?php echo $slide_class ?>">
			<ul class="slides">
				<?php foreach ($slides as $e) { ?>
				<li class="slide-item">
					<img src="<?php echo $e['url']; ?>" alt="<?php echo $e['title']; ?>" />
				</li>	
				<?php } ?>
			</ul>
		</div>
	</div>
	<?php } ?>
	
<?php } else {
	$banner = get_field('banner');
	if($banner) { ?>
	<div class="subpage-banner clear">
		<img src="<?php echo $banner['url'] ?>" alt="<?php echo $banner['title'] ?>" />
	</div>
	<?php } ?>
<?php } ?>