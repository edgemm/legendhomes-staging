<?php get_header(); ?>

	<main class="main clear" role="main">
		
		<section id="content">

			<div class="container clear">

				<article <?php post_class( array( 'sixteen', 'columns' ) ); ?>>
	
					<?php get_template_part('loop'); ?>
		
					<?php get_template_part('pagination'); ?>
	
				</article>

			</div>
			<!-- /.container -->

		</section>
		<!-- /#conent -->

	</main>

<?php get_footer(); ?>
