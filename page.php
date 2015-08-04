<?php get_header(); ?>
<?php the_post(); ?>
<?php do_action('contentheader'); ?>

<div class="container">
	<div class="row">
		<div class="col-xd-12 col-sm-8 " role="main">
			<h1><?php the_title( ); ?></h1>
			<div>
				<?php the_content( ); ?>
			</div>
		</div>

		<div class="hidden-xs col-sm-4" role="complementary">
			<?php get_template_part( 'sidebar' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
