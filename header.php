<!-- Theme Name: ${N_name} Theme -->
<!-- Theme URI: http:// -->
<!-- Author: Amin Arab -->
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon"
	href="<?php bloginfo('template_directory');?>/images/favicon.ico">
	 
	<?php if (is_search()) { ?>
	<meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
    if (function_exists('is_tag') && is_tag()) {
        single_tag_title(__('Tag Archive for ', 'hms_d') . "&quot;");
        echo '&quot; - ';
    } elseif (is_archive()) {
        wp_title('');
        echo __('Archive -', 'hms_d');
    } elseif (is_search()) {
        echo __('Search for ', 'hms_d') . '&quot;' . wp_specialchars($s) . '&quot; - ';
    } elseif (! (is_404()) && (is_single()) || (is_page())) {
        wp_title('');
        echo ' - ';
    } elseif (is_404()) {
        echo __('Not Found - ', 'hms_d');
    }
    if (is_home()) {
        bloginfo('name');
        echo ' - ';
        bloginfo('description');
    } else {
        bloginfo('name');
    }
    if ($paged > 1) {
        echo ' - page ' . $paged;
    }
    ?>
	</title>



	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	
		<?php if (is_page_template('about_us.php')) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/about_us.css">
	<?php } ?>
	<?php if (is_page_template('contact_us.php')) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/contact_us.css">
	<?php } ?>
	<?php if (is_page_template('home.php')) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/home.css">
	<?php } ?>
	<?php if (is_page_template('category.php')) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/category.css">
	<?php } ?>
	<?php if (is_page_template('product.php')) { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/product.css">
	<?php } ?>


	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php if ( is_singular() ) wp_enqueue_script('comment-reply'); ?>

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	<?php wp_nav_menu( array( 'theme_location' => 'main_nav' ) ); ?>
	