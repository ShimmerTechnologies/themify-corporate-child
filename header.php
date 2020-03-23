<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<!-- wp_header -->
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php themify_body_start(); // hook ?>
<div id="pagewrap" class="hfeed site">

	<?php themify_header_before(); // hook ?>

		<div id="header-top-menu" class="clearfix" >

		<?php themify_header_start(); // hook ?>

			<div class="pagewidth clearfix">

					<ul class="contact">
				        <li><img src="<?php print IMAGES; ?>/phone.png" alt="5ink phone number" /><span>1-401-787-8226</span></li>
				        <li class="last"><img src="<?php print IMAGES; ?>/mail.png" alt="5ink email" /><a href="mailto:info@5inkscreenprinting.com">info@5inkscreenprinting.com</a></li>
				    </ul> 

						<?php if(!themify_check('setting-exclude_search_form')): ?>
						<div id="searchform-wrap">
							<?php get_search_form(); ?>
						</div>
						<?php endif ?>
					<!-- /searchform-wrap -->

					<div class="social-widget">
						<?php dynamic_sidebar('social-widget'); ?>

						<?php if ( ! themify_check( 'setting-exclude_rss' ) ) : ?>
							<div class="rss"><a href="<?php echo themify_get( 'setting-custom_feed_url' ) != '' ? themify_get( 'setting-custom_feed_url' ) : get_bloginfo( 'rss2_url' ); ?>"></a></div>
						<?php endif ?>
					</div>
					<!-- /.social-widget -->
			</div>

		</div>

	<div id="headerwrap" class="clearfix">

		<header id="header" class="pagewidth clearfix" itemscope="itemscope" itemtype="https://schema.org/WPHeader">

			<div class="logo-wrap">
				<?php echo themify_logo_image(); ?>
				<?php if ( $site_desc = get_bloginfo( 'description' ) ) : ?>
					<?php global $themify_customizer; ?>
					<div id="site-description" class="site-description"><?php echo class_exists( 'Themify_Customizer' ) ? $themify_customizer->site_description( $site_desc ) : $site_desc; ?></div>
				<?php endif; ?>
			</div>

			<a id="menu-icon" href="#mobile-menu"></a>
			<div id="mobile-menu" class="sidemenu sidemenu-off">

					<nav id="main-nav-wrap" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
						<?php themify_theme_menu_nav(); ?>
						<!-- /#main-nav -->
					</nav>

					<a id="menu-icon-close" href="#"></a>

			</div>
			<!-- /#mobile-menu -->

			<?php themify_header_end(); // hook ?>

		</header>
		<!-- /#header -->

        <?php themify_header_after(); // hook ?>

	</div>
	<!-- /#headerwrap -->

	<div id="body" class="clearfix">

		<?php themify_layout_before(); //hook ?>
