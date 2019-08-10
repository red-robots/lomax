<?php
$args = array(
	'posts_per_page'=> -1,
	'post_type'		=> 'locations',
	'post_status'	=> 'publish'
);
$locations = get_posts($args);
if ( $locations ) {  ?>
<div class="foot-title" style="display:none;">Locations</div>
<div class="locations">
	<div class="flexrow clear">
		<?php foreach ($locations as $e) { 
		$p_id = $e->ID;
		$loc = $e->post_title;
		$address = get_field('address',$p_id);
		$telephone = get_field('phone',$p_id);
		?>
		<div class="loc flexbox">
			<?php if ($loc) { ?>
			<div class="name"><?php echo $loc ?></div>	
			<?php } ?>
			<?php if ($address) { ?>
			<address class="address"><?php echo $address ?></address>	
			<?php } ?>
			<?php if ($telephone) { ?>
			<div class="telephone"><a href="tel:<?php echo format_phone_number($telephone); ?>"><?php echo $telephone ?></a></div>	
			<?php } ?>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>