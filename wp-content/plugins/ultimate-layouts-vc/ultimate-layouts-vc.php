<?php
/*
Plugin Name: Ultimate Layouts - Responsive Grid – Addon For Visual Composer - Shared on Null-24.com
Plugin URI: http://beeteam368.com/ultimate-layouts/
Description: Json, Ajax, Carousel, Masonry, Grid, List, Timeline, Content Blocks, Creative ... Best Choice For Building Your Website.
Author: BeeTeam368
Author URI: http://beeteam368.com/ultimate-layouts/
Version: 2.2.0
License: Commercial
*/

if(!defined('ABSPATH')){
	die('-1');
}

if(!defined('UL_BETE_VER')){
	define('UL_BETE_VER','2.2.0');
};

if(!defined('UL_BETE_PLUGIN_URL')){
    define('UL_BETE_PLUGIN_URL', plugin_dir_url(__FILE__));
};

if(!defined('UL_BETE_PLUGIN_PATH')){
    define('UL_BETE_PLUGIN_PATH', plugin_dir_path(__FILE__));
};

if(!defined('UL_BETE_THEME_PATH')){
    define('UL_BETE_THEME_PATH', get_template_directory());
};

if(!defined('UL_BETE_PREFIX')){
    define('UL_BETE_PREFIX', 'ul_bt_');
};

if(!defined('UL_BETE_SETUP')){
    define('UL_BETE_SETUP', '0'); //0: default, 1: NO-TGM-Activation Class, 2: NO-install-required-plugins
};

require_once('includes/functions.php');
require_once('includes/query-class.php');
require_once('includes/reg-shortcode/elements.php');
require_once('includes/reg-shortcode/html-shortcode.php');
require_once('includes/reg-shortcode/reg-shortcode.php');
require_once('includes/plugin-settings/plugin-settings.php');
require_once('includes/reg-vc/reg-vc.php');
if(UL_BETE_SETUP == '0'){
	require_once('includes/class-tgm-plugin-activation.php');
}