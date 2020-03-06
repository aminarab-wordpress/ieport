<?php

/*
 * Template Name: contact_us_ieport Page
 */
// CustomPageTemplate
?>
<!-- Name -->
<!-- contact_us_ieport -->
<!-- customFieldNames -->
<!--
			-->

<!-- shortCodes -->
 
		
<!-- dynamicSideBars -->
<!-- <?php
if (is_active_sidebar('customer_service')) {
    dynamic_sidebar('customer_service');
}
?>
			<?php
if (is_active_sidebar('find_a_location')) {
    dynamic_sidebar('find_a_location');
}
?>
			<?php
if (is_active_sidebar('find_a_dealer')) {
    dynamic_sidebar('find_a_dealer');
}
?>
			-->
<!-- themeOptions -->
<!-- <?php echo $GLOBALS['redux_demo']['zoom']; ?>
			 -->
			
<?php get_header();  the_post(); $post = get_post(); ?>
<section>
	<h2 id="post-title"><?php the_title(); ?></h2>

	<div id="main-content">
	
		<?php echo do_shortcode('[contact-form-7 id="5" title="Contact form 1"]'); ?>
		<?php //echo do_shortcode('[googlemap width="200" height="200" src="[url]"]'); ?>
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<?php var_dump(get_post_meta($post->ID, 'DELTA_SWEDEN')); ?>
			<?php var_dump(get_post_meta($post->ID, 'DELTA_IRAN')); ?>
			<?php var_dump(get_post_meta($post->ID, 'DELTA_OMAN')); ?>
			<?php var_dump(get_post_meta($post->ID, 'DELTA_UNITED_ARAB_EMIRATES')); ?>
		</div>
		<?php echo the_content(); ?>

	</div>
</section>

<?php get_footer(); ?>