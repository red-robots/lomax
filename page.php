<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */


get_header(); ?>

	<div id="primary" class="full-content-area clear default-content">
		<main id="main" class="site-main wrapper clear" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php 
				$img = get_field('featured_image'); 
				$contentClass = ($img) ? 'has-image':'no-image';
			?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>

			<article id="post-<?php the_ID(); ?>" <?php post_class($contentClass); ?>>
				<div class="entry-content"><?php the_content(); ?></div>
			</article>

			<?php if ($img) { ?>
			<div class="featuredImg">
				<img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>" />
			</div>	
			<?php } ?>

		<?php endwhile;  ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
