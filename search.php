<?php get_header(); ?>

<div class="container">
    <div class="row">
        
        <div class="col-xd-12 col-sm-8 " role="main">
        	<h1>Zoekresultaten voor <?php echo $_GET['s'] ?></h1>
            <?php while ( have_posts() ) : the_post(); ?>
				<article class="">
					<a href="<?php echo get_permalink(); ?>"><h2><?php echo get_the_title(); ?></h2></a>
					<?php echo the_excerpt(); ?>
				</article>				
			<?php endwhile; ?>
        </div>

        <div class="hidden-xs col-sm-4" role="complementary">
            <?php get_template_part( 'sidebar' ); ?>
        </div>

    </div>
</div>
<?php get_footer(); ?>