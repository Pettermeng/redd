<?php
/*
Plugin Name: Custom Disable
Plugin URI: http://www.cis.com.kh
Description: For customize to disable some part.
Version: 1.0
Author: MSCH
Author URI: http://www.cis.com.kh
License: CIT
*/

/*-----------------------------*/
/*  Disable the new admin bar  */
/*-----------------------------*/
add_filter( 'show_admin_bar', '__return_false' );

/*-------------------------*/
/*  Add a favicon to your  */
/*-------------------------*/

function blog_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
}
add_action('wp_head', 'blog_favicon');

/*------------------------*/
/*  Change Admin Logo   */ 
/*------------------------*/
function custom_admin_logo() {
	echo '<style type="text/css">
	#header-logo { background-image: url('.get_bloginfo('home').'/cdccpanel/images/admin-logo.png) !important; }
	</style>';
} 
add_action('admin_head', 'custom_admin_logo');

/*----------------------------------------*/
/*  Remove Menus in CMS Dashboard   */
/*----------------------------------------*/

function remove_menus () {
	global $menu;
	//$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	$restricted = array(__('Dashboard'), __('Links'), __('Tools'), __('Comments'), __('Appearance'), __('Plugins'));
	end ($menu);
	
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
	
	global $submenu;
	//unset( $GLOBALS['submenu']['options-writing.php'][25] );
	//Settings Menu
	unset($submenu['options-general.php'][10]); // General Options
  	unset($submenu['options-general.php'][15]); // Writing
  	unset($submenu['options-general.php'][20]); // Reading
  	unset($submenu['options-general.php'][25]); // Discussion
  	unset($submenu['options-general.php'][30]); // Media
  	unset($submenu['options-general.php'][35]); // Privacy
  	unset($submenu['options-general.php'][40]); // Permalinks
  	unset($submenu['options-general.php'][45]); // Misc

}
//add_action('admin_menu', 'remove_menus');

/*------------------------*/
/*  Hide update message   */
/*------------------------*/
add_action('admin_menu','wphidenag');
function wphidenag() {
	remove_action( 'admin_notices', 'update_nag', 3 );
}

/*-----------------------------------*/
/*      Edit the Help dropdown       */
/*-----------------------------------*/
//hook loading of new page and edit page screens
add_action('load-page-new.php','add_custom_help_page');
add_action('load-page.php','add_custom_help_page');
function add_custom_help_page() {
//the contextual help filter
add_filter('contextual_help','custom_page_help');
}
function custom_page_help($help) {
//keep the existing help copy
//echo $help;
//add some new copy
echo "<h5>Custom Features</h5>";
echo "<p>Content placed above the more divider will appear in column 1. Content placed below the divider will appear in column 2.</p>";
}


/*-----------------------------------*/
/*         Remove Generator          */
/*-----------------------------------*/
function no_generator() { return ''; }
add_filter( 'the_generator', 'no_generator' );


/*-----------------------------------*/
/*  Change Footer Text in WP Admin   */
/*-----------------------------------*/
function remove_footer_admin () {
	echo 'Copyright © 2011 The Council for the Development of Cambodia (CDC).';
}
//add_filter('admin_footer_text', 'remove_footer_admin');
?>