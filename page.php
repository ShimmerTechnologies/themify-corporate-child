<?php
/**
 * Template for page view including query categories
 * @package themify
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<section>

<?php if(is_page( array( 9, 'home') ) == false) { ?>
	<header>
		<div class="headerwrap">
			<div class="pagewidth">
			<!-- page-title -->
			<?php if($themify->page_title != "yes"): ?>
					<h1 class="page-title"><?php the_title(); ?></h1>
			<?php endif; ?>
			<!-- /page-title -->
			</div>
		</div>
		<?php if( is_page( array( 4359, 'products') ) == false
		 && is_page( 4492 ) == false
		 && is_page( 4490 ) == false
		 && is_page( 4488 ) == false
		 && is_page( 4495 ) == false
		 && is_page( 4497) == false) { ?>
		<div class="breadcrumb">
			<nav class="pagewidth">
				<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
			</nav>
		</div>
		<?php } else { ?>
		<div class="page-menu">

			<?php $products_menu = array(
					'menu' => 'Products',
					'container' => 'nav',
					'container_class' => 'pagewidth',
					'after' => '<span> - </span>',
					'depth' => 0
					); 

					wp_nav_menu( $products_menu ); ?>				

		</div>
		<?php  } ?>
	</header>
<?php } ?>

<!-- layout-container -->
<div id="layout" class="pagewidth clearfix">

	<?php themify_content_before(); // hook ?>
	<!-- content -->
	<div id="content" class="clearfix">
    	<?php themify_content_start(); // hook ?>

		<?php
		/////////////////////////////////////////////
		// 404
		/////////////////////////////////////////////
		if(is_404()): ?>
			<h1 class="page-title"><?php _e('404','themify'); ?></h1>
			<p><?php _e( 'Page not found.', 'themify' ); ?></p>
			<?php if( current_user_can('administrator') ): ?>
				<p><?php _e( '@admin Learn how to create a <a href="https://themify.me/docs/custom-404" target="_blank">custom 404 page</a>.', 'themify' ); ?></p>
			<?php endif; ?>
		<?php endif; ?>

		<?php
		/////////////////////////////////////////////
		// PAGE
		/////////////////////////////////////////////
		?>
		<?php if ( ! is_404() && have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div id="page-<?php the_ID(); ?>" class="type-page">

			<div class="page-content entry-content">

				<?php if ( $themify->hide_page_image != 'yes' && has_post_thumbnail() ) : 

					if(is_page( 2 ) ) { ?>

					<figure class="post-image" style="float: left; max-width: 300px; padding: 10px 15px 0 0; margin-bottom: 0;"><?php themify_image( "{$themify->auto_featured_image}w={$themify->image_page_single_width}&h={$themify->image_page_single_height}&ignore=true" ); ?></figure>
					
					<?php } else if( is_page( array( 4359, 'products')) || is_page( 4492 ) || is_page( 4490 ) || is_page( 4488 ) || is_page( 4495 )	|| is_page( 4497) ) { ?>

					<figure class="post-image" style="float: right; max-width: 340px; padding: 10px 0 0 20px; margin-bottom: 0; padding-bottom: 50px;"><?php themify_image( "{$themify->auto_featured_image}w={$themify->image_page_single_width}&h={$themify->image_page_single_height}&ignore=true" ); ?></figure>

					<?php } else { ?>

					<figure class="post-image"><?php themify_image( "{$themify->auto_featured_image}w={$themify->image_page_single_width}&h={$themify->image_page_single_height}&ignore=true" ); ?></figure>

					<?php } ?>

				<?php endif; ?>

				<?php if( is_page( array( 4359, 'products') ) 
				 || is_page( 4492 ) 
				 || is_page( 4490 ) 
				 || is_page( 4488 ) 
				 || is_page( 4495 ) 
				 || is_page( 4497) ) { ?>
				<div class="breadcrumb-products">
					<nav class="pagewidth">
						<?php if( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
					</nav>
				</div>

				<?php }

				the_content(); ?>		

				<?php wp_link_pages(array('before' => '<p class="post-pagination"><strong>'.__('Pages:','themify').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				<?php edit_post_link(__('Edit','themify'), '[', ']'); ?>

				<!-- comments -->
				<?php if(!themify_check('setting-comments_pages') && $themify->query_category == ""): ?>
					<?php comments_template(); ?>
				<?php endif; ?>
				<!-- /comments -->

			</div>
			<!-- /.post-content -->

			</div><!-- /.type-page -->
		<?php endwhile; endif; ?>


		<?php
		/////////////////////////////////////////////
		// Query Category
		/////////////////////////////////////////////
		if('' != $themify->query_category): ?>

			<?php
			// Categories for Query Posts or Portfolios
			$categories = '0' == $themify->query_category? themify_get_all_terms_ids($themify->query_taxonomy) : explode(',', str_replace(' ', '', $themify->query_category));
			$qpargs = array(
				'post_type' => $themify->query_post_type,
				'tax_query' => array(
					array(
						'taxonomy' => $themify->query_taxonomy,
						'field' => 'id',
						'terms' => $categories
					)
				),
				'posts_per_page' => $themify->posts_per_page,
				'paged' => $themify->paged,
				'order' => $themify->order,
				'orderby' => $themify->orderby
			);
			?>

			<?php
			query_posts(apply_filters('themify_query_posts_page_args', $qpargs)); ?>

			<?php if(have_posts()): ?>

				<?php
				/////////////////////////////////////////////
				// Entry Filter
				/////////////////////////////////////////////
				if ( 'portfolio' == $themify->query_post_type && ( count( $categories ) > 1 ) ) : ?>
					<?php get_template_part( 'includes/filter', $themify->query_post_type ); ?>
				<?php endif; // portfolio query ?>

				<!-- loops-wrapper -->
				<div id="loops-wrapper" class="loops-wrapper <?php echo "$themify->layout $themify->post_layout "; echo isset( $themify->query_post_type ) && ! in_array( $themify->query_post_type, array( 'post', 'page' ) ) ? $themify->query_post_type : ''; ?>">

					<?php while(have_posts()) : the_post(); ?>

						<?php get_template_part('includes/loop', $themify->query_post_type); ?>

					<?php endwhile; ?>

				</div>
				<!-- /loops-wrapper -->

				<?php if ( themify_is_query_page() ) : ?>
					<?php if ( $themify->page_navigation != 'yes' ): ?>
						<?php get_template_part( 'includes/pagination' ); ?>
					<?php endif; // show page navigation ?>
				<?php endif; // is query page ?>

			<?php else : ?>

			<?php endif; ?>

			<?php wp_reset_query(); ?>

		<?php endif; ?>

		<?php themify_content_end(); // hook ?>
	</div>
	<!-- /content -->
    <?php themify_content_after(); // hook ?>

	<?php
	/////////////////////////////////////////////
	// Sidebar
	/////////////////////////////////////////////
	if ($themify->layout != 'sidebar-none') {
			if( is_page( 4454 ) ) { ?>
				<aside id="sidebar" itemscope="itemscope" itemtype="https://schema.org/WPSidebar"> 
				<?php if(is_active_sidebar( 'contact-us' ) ) :  					
						 get_sidebar('contact-us'); ?> 
				</aside> 
				<?php endif; 

				} else if( is_page( 2 ) ) { ?>

				<aside id="sidebar" itemscope="itemscope" itemtype="https://schema.org/WPSidebar"> 
				<?php if(is_active_sidebar( 'about-us' ) ) :  					
						 get_sidebar('about-us'); ?> 
				</aside> 
				<?php endif; 

				} else {	

					get_sidebar(); 

				}
	}
	?>

</div>
<!-- /layout-container -->
</section>
<?php get_footer(); ?>