<?php
/*
 * Plugin Name: Wordpress Twitter Feeds With Shortcode
 * Version: 2.0.0
 * Plugin URI: http://swadeshswain.com
 * Description: Display an official Twitter  Timeline feed to your page, post and widget section using the shortcode [tfws username="your twitter username"]  .
 * Author: swadeshswain
 * Author URI: http://swadeshswain.com/
 * Text Domain: shortcode-twitter-feeds
 * Domain Path: /languages/
 * License: GPL v3
 */

/**
 *  Twitter Feed With Shortcode
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
 if ( ! defined( 'WPINC' ) ) {
	die;
 }
 define( 'TFWS_URL_PATH', plugin_dir_url( __FILE__ ) );
   define( 'TFWS_PLUGIN_PATH', plugin_dir_path(__FILE__) ); 
   require_once(TFWS_PLUGIN_PATH . 'lib/tfws-twitter-feed-script.php' );
   include( TFWS_PLUGIN_PATH . 'lib/tfws-shortcode.php');
 // init process for registering tinymce button
 add_action('init', 'tfws_shortcode_button_init');
 function tfws_shortcode_button_init() {
      //Abort early if the user will never see TinyMCE
      if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
           return;
      //Add a callback to regiser the tinymce plugin   
      add_filter("mce_external_plugins", "tfws_register_tinymce_plugin"); 
      // Add a callback to add the button to the TinyMCE toolbar
      add_filter('mce_buttons', 'tfws_add_tinymce_button');
}
//This callback registers the plug-in
function tfws_register_tinymce_plugin($plugin_array) {
    $plugin_array['tfws_button'] = TFWS_URL_PATH . '/js/tfws-shortcode.js' ;
    return $plugin_array;
}
//This callback adds the button to the toolbar
function tfws_add_tinymce_button($buttons) {
            //Add the button ID to the $button array
    $buttons[] = "tfws_button";
    return $buttons;
}
?>