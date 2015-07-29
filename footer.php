<footer>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<nav><?php wp_nav_menu( array( 'theme_location' => 'footer-menu'  ) ); ?></nav>
			</div>

			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<nav><?php wp_nav_menu( array( 'theme_location' => 'footer-menu-2'  ) ); ?></nav>
			</div>

			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<?php echo do_shortcode('[contactinfo include="adres, tel, mail"]'); ?>
				<?php echo do_shortcode('[socialbuttons]'); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="text-center bottomText">
					© <?php echo date('Y') ?> <?php bloginfo( 'name' ); ?> | webdesign door <a href="http://www.stijlenvorm.nl/" target="_blank" <?php if ( !is_front_page() ) echo 'rel="nofollow"' ?>> Stijl en Vorm</a>
				</div>
			</div>
		</div>

	</div>
	
</footer>

<?php wp_footer(); ?>
</body>
</html>