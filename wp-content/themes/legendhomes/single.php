<?php get_header(); ?>

	<main class="main clear" role="main">
		
		<section id="content">

			<div class="container clear">
	
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		
				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'eleven', 'columns' ) ); ?>>

					<span class="date"><?php the_time('F j, Y'); ?></span>
		
					<!-- post thumbnail -->
					<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists
						$thmb_attr = array(
							'class' => 'attachment-$size alignleft'
						);
					?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail( 'medium', $thmb_attr ); // Fullsize image for the single post ?>
						</a>
					<?php endif; ?>
					<!-- /post thumbnail -->
		
					<!-- post details -->
					<span class="author"><?php _e( 'Wrritten by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
					<!-- /post details -->
		
					<?php the_content(); // Dynamic Content ?>
		
					<?php edit_post_link(); // Always handy to have Edit Post Links available ?>
		
				</article>
				<!-- /article -->
		
			<?php endwhile; ?>
		
			<?php else: ?>
		
				<!-- article -->
				<article>
		
					<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
		
				</article>
				<!-- /article -->
		
			<?php endif; ?>
			
			<?php get_sidebar(); ?>

			</div>
			<!-- /.container -->

		</section>
		<!-- /#conent -->
	</main>

<?php get_footer(); ?>
