<?php

/** Add Custom Admin Page **/

function make_a_wish_add_admin_page(){

	// Generate WISH Admin Page 
	add_menu_page('WISH Theme Options', 'Make a WISH', 'manage_options', 'kpc_wish', 'wish_theme_settings', get_stylesheet_directory_uri() . '/images/wish-theme-icon.png', 7);

	// Generate WISH Admin Sub Pages 
	add_submenu_page('kpc_wish', 'WISH Theme Options', 'WISH Theme Options', 'manage_options', 'kpc_wish', 'wish_theme_settings');
	add_submenu_page('kpc_wish', 'WISH Custom CSS', 'Custom CSS', 'manage_options', 'kpc_wish_css', 'wish_theme_custom_css');

	// Activate Custum Settings
	add_action( 'admin_init', 'wish_custom_settings');

}//** Removed it and use ACF Option instead **/
//add_action('admin_menu', 'make_a_wish_add_admin_page');

function wish_custom_settings(){
	register_setting('wish-settings-group', 'first_name');
	add_settings_section('wish-sidebar-options', 'Sidebar Options', 'wish_sidebar_options', 'kpc_wish');
	add_settings_field('sidebar-name', 'First Name', 'wish_sidebar_name', 'kpc_wish', 'wish-sidebar-options');
}

function wish_sidebar_options(){
	echo 'Customise your sidebar Information';
}

function wish_sidebar_name(){
	echo '<input type="text" name="first_name" value="" />';
}

function wish_theme_settings(){
	require_once( get_stylesheet_directory() . '/wish/wish-theme-settings.php');
}

function wish_theme_custom_css(){
	//generate theme header settings page
	echo '<h1>Custom CSS</h1>';
}

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

        // Add parent.
        $parent = acf_add_options_page(array(
            'page_title'  => __('Theme General Settings'),
            'menu_title'  => __('Theme Settings'),
            'redirect'    => false,
        ));

        // Add sub page.
        $child = acf_add_options_page(array(
            'page_title'  => __('Custom CSS'),
            'menu_title'  => __('Custom CSS'),
            'parent_slug' => $parent['menu_slug'],
        ));
    }
}
