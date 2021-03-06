<?php // Template Name: Contact ?>

<?php get_header(); ?>

	<main class="main clear" role="main">
		
		<section id="content">

			<div class="container clear">
	
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>	
	
				<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'eleven', 'columns' ) ); ?>>
	
					<?php the_content(); ?>
	
				</article>
	
			<?php endwhile; ?>
	
				<?php get_sidebar(); ?>
	
			<?php endif; ?>

			</div>
			<!-- /.container -->

		</section>
		<!-- /#conent -->

	</main>

<?php get_footer(); ?>