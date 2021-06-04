<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>			
			</main><!-- #main -->

			<?php // Footer Japan illustrated scene
				$pages_with_footer_illustration = array('9'); 
				if (in_array(get_the_ID(), $pages_with_footer_illustration) || is_page_template('templates/gallery.php')) : ?>
					<img class="footer-illustration-mobile | u-rel d-block d-md-none" src="<?php echo get_image('footer-illustration-mobile.svg'); ?>" alt="Illustration">
					<img class="footer-illustration-desktop | u-rel d-none d-md-block" src="<?php echo get_image('footer-illustration-desktop.svg'); ?>" alt="Illustration">
				<?php endif;
			?>

			<footer id="site-footer" class="u-rel">
				<div class="footer | container-xxl u-rel">
					<div class="row justify-content-between flex-column flex-lg-row align-items-lg-center">
						<div class="footer__top | col-auto d-flex flex-column flex-lg-row align-items-lg-center u-px-mob-15 u-rel">
							<a class="footer__logo" href="<?php echo get_site_url(); ?>" title="Marugame Home">
								<img class="d-inline-block" src="<?php echo get_icon('logo-symbol.svg'); ?>" alt="Marugame">
							</a>
							<div class="footer__menu | d-flex flex-wrap">
								<?php if (get_field('footer_menu_links', 'option')) : foreach(get_field('footer_menu_links', 'option') as $link) : ?>
									<a class="link d-inline-block" href="<?php echo $link['link']['url']; ?>" title="<?php echo $link['link']['title']; ?>" target="<?php echo $link['link']['target']; ?>"><?php echo $link['link']['title']; ?></a>
								<?php endforeach; endif; ?>
							</div>
						</div>
						<div class="footer__socials | col-auto u-px-mob-15">
							<?php if (get_field('instagram', 'option')) : ?>
								<a class="d-inline-block" href="<?php the_field('instagram', 'option'); ?>" target="_blank" title="Instagram">
									<img class="d-block" src="<?php echo get_icon('instagram--white.svg'); ?>" alt="Instagram">
								</a>
							<?php endif; ?>
							<?php if (get_field('facebook', 'option')) : ?>
								<a class="d-inline-block" href="<?php the_field('facebook', 'option'); ?>" target="_blank" title="Facebook">
									<img class="d-block" src="<?php echo get_icon('facebook--white.svg'); ?>" alt="Facebook">
								</a>
							<?php endif; ?>
							<?php if (get_field('twitter', 'option')) : ?>
								<a class="d-inline-block" href="<?php the_field('twitter', 'option'); ?>" target="_blank" title="Twitter">
									<img class="d-block" src="<?php echo get_icon('twitter--white.svg'); ?>" alt="Twitter">
								</a>
							<?php endif; ?>
						</div>
					</div>
					<div class="row">
						<div class="footer__credits | col d-flex justify-content-between u-px-mob-15">
							<span>&copy Marugame <?php echo date('Y'); ?></span>
							<span><a href="https://ignitecreates.com" target="_blank" title="Ignite">Creative by Ignite</a></span>
						</div>
					</div>
				</div>
			</footer><!-- #site-footer -->

			<?php 
				// Mobile navigation
				include('components/nav.php');

				// Club Signup overlay
				include('components/overlays/club-signup.php');
				
				// Cookie Banner
				include('components/cookie-banner.php');
			?>

		</div><!-- #primary -->
	</div><!-- #content -->

	<?php // Outside barba container

		// Page transition effect
		include('components/page-transition.php');

		// Google Maps js
		$api_key = get_field('google_maps_api_key', 'option');
			?>	
				<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key; ?>"></script>
				<script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/google-maps/google-maps.js"></script>
		<?php
	?>
	
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>
