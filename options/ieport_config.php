<?php

if (! function_exists('remove_demo')) {

    function remove_demo()
    {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_filter('plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2);

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array(
                ReduxFrameworkPlugin::instance(),
                'admin_notices'
            ));
        }
    }
}

remove_demo();

if (! class_exists('Redux')) {
    return;
}

$opt_name = "redux_demo";
$theme = wp_get_theme();

$args = array(
    'opt_name' => $opt_name,
    'display_name' => $theme->get('Name'),
    'display_version' => $theme->get('Version'),
//     'menu_title' => __($theme->get('Name') . ' Theme Options', 'redux-framework-demo'),
    'menu_title' => 'Theme Options',
    'menu_type'            => 'submenu',
    'update_notice'        => false,
    'customizer' => true
);
Redux::setArgs($opt_name, $args);

Redux::setSection( $opt_name, array(
	'title' => __( 'Layouts', 'redux-framework-demo' ),
	'id' => 'ieport-page-layout',
	'desc' => __( 'you can change page layouts : ', 'redux-framework-demo' ),
	'customizer_width' => '500px',
	'icon' => 'el el-home',
));