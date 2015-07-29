<?php get_header(); ?>

<div class="container">
    <div class="row">
        
        <div class="col-xd-12 col-sm-8 " role="main">
            <?php the_content( ); ?>

            <?php if ( have_posts() ) : ?>
                <section>
                    <h2>Alle berichten</h2>

                    <?php while ( have_posts() ) : the_post(); ?>
                        <article>
                            <a href="<?php echo the_permalink(); ?>"><h3><?php  the_title() ?></h3></a>
                            <div>
                                <?php the_excerpt(); ?>
                            </div>
                        </article>
                    <?php endwhile; ?>

                    <div>
                        <?php the_posts_pagination( ); ?>
                    </div>

                </section>
            <?php else: ?>
                geen resultaten...
            <?php endif; ?>
        </div>

        <div class="hidden-xs col-sm-4" role="complementary">
            <?php get_template_part( 'sidebar' ); ?>
        </div>

    </div>
</div>
<?php get_footer(); ?>