	</div><!-- #content -->
	<?php  
	$email = get_field('email','option');
	$email = preg_replace('/\s+/', '', $email);
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
	?>
	<footer id="colophon" class="site-footer clear" role="contentinfo">
		<div class="wrapper">
			<div class="flexbox">
				<div class="col left locations-list">
					<?php get_template_part('template-parts/locations') ?>
				</div>
				<div class="col right">
					<div class="wrap">

						<?php  
							$hasSocial = (!$socialLinks) ? 'noSocial':'hasSocial';
							$hasEmail = (!$email) ? 'noEmail':'hasEmail';
						?>

						<?php if ($email) { ?>
						<div class="rcol1 <?php echo $hasSocial ?>">
							<div class="enquiry-email"><a href="mailto:<?php echo antispambot($email,1) ?>"><?php echo antispambot($email) ?></a></div>	
						</div>
						<?php } ?>

						<?php if ($socialLinks) { ?>
						<div class="rcol2 fwrap clear <?php echo $hasEmail ?>">
							<div class="social-links">
								<?php  
								$i=1; foreach ($socialLinks as $s) { 
									$social_link = $s[0];;
									$social_icon = $s[1]; ?>
									<a class="social<?php echo($i==1) ? ' first':'';?>" href="<?php echo $social_link ?>" target="_blank">
										<span class="icon"><i class="<?php echo $social_icon ?>"></i><span class="sr-only"><?php echo $s[0]; ?></span></span>
									</a> 
								<?php $i++; } ?>
							</div>
						</div>
						<?php } ?>
						
					</div>
				</div>
			</div>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
