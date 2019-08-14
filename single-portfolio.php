<?php get_header(); ?>
<div id="primary" class="full-content-area clear default-content singleportfolio">
	<main id="main" class="site-main wrapper clear" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<header class="entry-header">
			<a href="<?php echo get_permalink(8) ?>" class="allbtn"><span><i></i></span>Back to All</a>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>
		

	<?php endwhile;  ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
