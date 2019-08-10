	</div><!-- #content -->
	<?php  
	$email = get_field('email','option');
	$social[] = array('linkedin','fab fa-linkedin');
	$social[] = array('facebook','fab fa-facebook-square');
	$social[] = array('instagram','fab fa-instagram');
	$social[] = array('twitter','fab fa-twitter-square');
	?>
	<footer id="colophon" class="site-footer clear" role="contentinfo">
		<div class="wrapper">
			<div class="flexbox">
				<div class="col left locations-list">
					<?php get_template_part('template-parts/locations') ?>
				</div>
				<div class="col right">
					<div class="wrap">

						<?php if ($email) { ?>
						<div class="rcol1">
							<div class="enquiry-email"><a href="mailto:<?php echo antispambot($email,1) ?>"><?php echo antispambot($email) ?></a></div>	
						</div>
						<?php } ?>

						<div class="rcol2 fwrap clear">
							<div class="social-links">
								<?php  
								$i=1; foreach ($social as $s) { 
									$social_link = get_field( $s[0],'option' );
									$social_icon = $s[1];
									?>
									<?php if ($social_link) { ?>
									<a class="social<?php echo($i==1) ? ' first':'';?>" href="<?php echo $social_link ?>" target="_blank">
										<span class="icon"><i class="<?php echo $social_icon ?>"></i><span class="sr-only"><?php echo $s[0]; ?></span></span>
									</a>
									<?php $i++; } ?>
								<?php } ?>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
