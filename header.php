<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	
	<?php // force Internet Explorer to use the latest rendering engine available ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">

	<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/apple-touch-icon.png">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/favicon-32x32.png">
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/library/images/icons/favicon.ico">
	<![endif]-->
	<?php // or, set /favicon.ico for IE10 win ?>

	<!-- Atreemo tracking -->
	<script type="text/javascript" src="https://tracking.atreemo.com/Scripts/TrackingInit.js">
	<script type="text/javascript">AtreemoTrackingLbr.init(["Marugame, https://marugame.webecast.acteol.com"]);</script>
	<script type="text/javascript" src="https://tracking.atreemo.com/Scripts/Tracking.js"/>

	<?php wp_head(); ?>
</head>

<body <?php body_class(''); ?> data-barba="wrapper">

<div id="page" class="site">

	<div id="content" class="site-content u-rel" data-barba="container" data-barba-namespace="default">

		<div class="c-cursor js-cursor-wrap">
			<div class="cursor js-cursor-play"></div>
			<div class="cursor js-cursor-close"></div>
		</div>

		<header id="site-header" class="<?php if (is_product()) { echo 'is-single-product'; } ?>">		
			<div class="header-inner | container-fluid">
				<div class="row justify-content-between">
					<a href="<?php echo get_site_url(); ?>" class="c-logo | col-auto pr-0">
						<img class="c-logo__symbol" src="<?php echo get_icon('logo-symbol.svg'); ?>" alt="Marugame Logo">
						<img class="c-logo__text c-logo__text--white" src="<?php echo get_icon('logo-text--white.svg'); ?>" alt="Marugame">
						<img class="c-logo__text c-logo__text--black" src="<?php echo get_icon('logo-text--black.svg'); ?>" alt="Marugame">
					</a>
					<div class="menu-links | col d-none d-xl-block t-right">
						<?php foreach(get_field('menu_links', 'option') as $link) : ?>
							<?php $link_classlist = ($link['add_dropdown_menu']) ? 'has-dropdown js-menu-link-parent' : ''; ?>
							<div class="menu-links__link-container <?php echo $link_classlist; ?> | d-inline-block t-center u-rel">
								<a class="parent-link | u-rel" href="<?php echo $link['link']['url']; ?>" title="<?php echo $link['link']['title']; ?>" target="<?php echo $link['link']['target']; ?>">
									<?php echo $link['link']['title']; ?>
									<?php if (! $link['add_dropdown_menu']) : ?>
										<span class="wiggle"></span>
									<?php endif; ?>
								</a>
								<?php if ($link['add_dropdown_menu']) : ?>
									<div class="dropdown-container js-menu-links-dropdown">
										<?php 
											$link_count = 1; 
											$num_links = count($link['dropdown_links']);
											
											foreach($link['dropdown_links'] as $link) : 
												$link_class = '';
												if ($link_count == 1) {
													$link_class = 'dropdown-link--first';
												} else if ($link_count == $num_links) {
													$link_class = 'dropdown-link--last';
												}
												?>
													<a class="dropdown-link <?php echo $link_class; ?> | d-block t-center" href="<?php echo $link['link']['url']; ?>" title="<?php echo $link['link']['title']; ?>" target="<?php echo $link['link']['target']; ?>"><?php echo $link['link']['title']; ?></a>
											<?php $link_count++; 
											endforeach; 
										?>
									</div>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>

						<?php if (get_field('order_online_link', 'option')) : $btn = get_field('order_online_link', 'option'); ?>
							<a class="menu-links__btn" href="<?php echo $btn['url']; ?>" title="<?php echo $btn['title']; ?>" target="<?php echo $btn['target']; ?>" ><?php echo $btn['title']; ?></a>
						<?php endif; ?>

						<?php if (get_field('marugame_club_sign_in', 'option')) : $btn = get_field('marugame_club_sign_in', 'option'); ?>
							<a class="menu-links__btn" href="<?php echo $btn['url']; ?>" title="<?php echo $btn['title']; ?>" target="<?php echo $btn['target']; ?>" ><?php echo $btn['title']; ?></a>
						<?php endif; ?>
					</div>
					<div class="js-open-nav hamburger">
						<img class="d-block" src="<?php echo get_icon('hamburger.svg'); ?>" alt="Menu">
					</div>
				</div>
			</div>
		</header>

		<div id="primary" class="content-area u-rel">
			<main id="main" class="site-main u-rel">
				<?php if (is_front_page()) : ?>
					<div class="js-lottie-home-line js-lottie-anim"></div>
				<?php endif; ?>

