<?php
	
	require_once (dirname(__FILE__) . '/options/ieport_config.php');
	require_once (dirname(__FILE__) . '/class-tgm-plugin-activation.php');
	add_action( 'tgmpa_register', 'ieport_register_required_plugins' );
	
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	/*
	 * Load jQuery
	 */ 
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"), false);
	   wp_enqueue_script('jquery');
	}
	
	/*
	 *  Clean up the <head>
	 */
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');

	/*
	 * add resources to theme Header
	 */ 
	 
	 
	function theme_js() {
	
		global $wp_scripts;
	
		wp_register_script( 'html5_shiv', get_template_directory_uri() . '/js/html5shiv.js', '', '', false );
		wp_register_script( 'respond_js', get_template_directory_uri() . '/js/respond.min.js', '', '', false );
	
		$wp_scripts->add_data( 'html5_shiv', 'conditional', 'lt IE 9' );
		$wp_scripts->add_data( 'respond_js', 'conditional', 'lt IE 9' );
	
		wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'theme_js', get_template_directory_uri() . '/js/theme.js', array('jquery', 'bootstrap_js'), '', true );
		if(is_rtl()){
		    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min-rtl.css',false,'3.3.7','all');
		}else{
		    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css',false,'3.1.1','all');
		}
		
	}
	add_action( 'wp_enqueue_scripts', 'theme_js' );
	 	

	/*
	 *	Register Menus and Pages
	 */
	
	function register_theme_menus() {
		if (function_exists('register_nav_menus')) {
			register_nav_menus(
				array(
					'header-menu'	=> __( 'Header Menu' )
				)
			);
			register_nav_menus(
				array(
					'footer-menu'	=> __( 'Footer Menu' )
				)
			);	
			register_nav_menus(
				array(
					'main_nav' => 'Main Navigation Menu'
				)
			);					
		}
	}
	add_action( 'init', 'register_theme_menus' );
	
	
	/*
	 * Register Widget Areas
	 */

	function create_widget( $name, $id, $description ) {
		register_sidebar(array(
			'name' => __( $name ),	 
			'id' => $id, 
			'description' => __( $description ),
			'before_widget' => '<div class="widget">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		));
	}


	create_widget( 'Front Page Left', 'front-left', 'Displays on the left of the homepage' );


	/*
	 * Theme supports
	 */
	 
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	
	/*
	 *	Register plug-ins dependencies of theme
	 */
	
	function ieport_register_required_plugins() {
		$plugins = array(
			array(
				'name'               => 'Redux', 
				'slug'               => 'redux-framework', 
				'source'             => get_stylesheet_directory() . '/lib/plugins/redux-framework.3.6.15.zip', 
				'required'           => true, 
				'version'            => '3.6.15', 
				'force_activation'   => true, 
				'force_deactivation' => true, 
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			array(
				'name'               => 'Contact7', 
				'slug'               => 'contact7', 
				'source'             => get_stylesheet_directory() . '/lib/plugins/save-contact-form-7.zip', 
 				'required'           => true, 
				'version'            => '2.0', 
 				'force_activation'   => true, 
 				'force_deactivation' => true, 
 				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
 				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
 			),
			array(
				'name'               => 'Mega Menu', 
				'slug'               => 'megamenu', 
				'source'             => get_stylesheet_directory() . '/lib/plugins/wpmega-mnu-pro.zip', 
				'required'           => true, 
				'version'            => '2.1.0', 
				'force_activation'   => true, 
				'force_deactivation' => true, 
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),
			array(
				'name'               => 'WPML', 
				'slug'               => 'wpml', 
				'source'             => get_stylesheet_directory() . '/lib/plugins/WPML-Addons.zip', 
				'required'           => true, 
				'version'            => '4.3.9', 
				'force_activation'   => true, 
				'force_deactivation' => true, 
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			)
		);
		$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
			'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
			/* translators: %s: plugin name. */
			'installing'                      => __( 'Installing Plugin: %s', 'theme-slug' ),
			/* translators: %s: plugin name. */
			'updating'                        => __( 'Updating Plugin: %s', 'theme-slug' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'theme-slug' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). */
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'theme-slug'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). */
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'theme-slug'
			),
			
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'theme-slug'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'theme-slug'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'theme-slug'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'theme-slug'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'theme-slug'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'theme-slug' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'theme-slug' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'theme-slug' ),
			/* translators: 1: plugin name. */
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'theme-slug' ),
			/* translators: 1: plugin name. */
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'theme-slug' ),
			/* translators: 1: dashboard link. */
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'theme-slug' ),
			'dismiss'                         => __( 'Dismiss this notice', 'theme-slug' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'theme-slug' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'theme-slug' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		  )
		);

		tgmpa( $plugins, $config );
	}


?>