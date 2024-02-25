<?php
/*
Plugin Name: My Custom Plugin
Description: Wordpress plugin for course management for an projects.
Version: 1.0
Author: Bikay
Author URI: http://bi-kay.com
*/

/////////////////////////////////////////////////////
// Actived plugin 
// Create table and insert vale to database
/////////////////////////////////////////////////////
global $jal_db_version;
$jal_db_version = "1.0";

function jal_install() {
   global $wpdb;
   global $jal_db_version;

   $table_name = $wpdb->prefix . "city";
   $table_type = $wpdb->prefix . "type";

   $sql ="CREATE TABLE ".$table_name." (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      name_city VARCHAR(225) DEFAULT '' NOT NULL,
      UNIQUE KEY id (id)
    );";

   $sql_type ="CREATE TABLE ".$table_type." (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      type_name VARCHAR(225) DEFAULT '' NOT NULL,
      UNIQUE KEY id (id)
    );";

   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);
   dbDelta($sql_type);

   add_option("jal_db_version", $jal_db_version);
}
function jal_install_data() {
   global $wpdb;
   $table_name = $wpdb->prefix . "city";
   $name_city = "Paris";
   $rows_affected = $wpdb->insert( $table_name, array( 'name_city' => $name_city) );

   $table_type = $wpdb->prefix . "type";
   $type_name = "Villa";
   $rows_affected = $wpdb->insert( $table_type, array( 'type_name' => $type_name) );
}
// register_activation_hook(__FILE__,'jal_install');
// register_activation_hook(__FILE__,'jal_install_data');



/////////////////////////////////////////////////////
// Uninstall Plugin
// Drop table in database
/////////////////////////////////////////////////////

function pluginUninstall() {

global $wpdb;
$table_city = $wpdb->prefix."city";
$table_type = $wpdb->prefix."type";
$table = $wpdb->prefix."postmeta";
//Delete any options thats stored also?
//delete_option('wp_yourplugin_version');
   $wpdb->query("DROP TABLE IF EXISTS $table_city");
   $wpdb->delete( $table, array( 'meta_key' => '_my_meta_value_key_city'), array( '%d' ) );

   $wpdb->query("DROP TABLE IF EXISTS $table_type");
   //$wpdb->delete( $table, array( 'meta_key' => '_my_meta_value_key_type'), array( '%d' ) );
   

}
// register_deactivation_hook( __FILE__, 'pluginUninstall' );

/////////////////////////////////////////////////////
// add custom file to display on post page and page
// insert to table post meta
/////////////////////////////////////////////////////
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_meta_box() {

   $screens = array( 'post', 'page', 'book' );

   foreach ( $screens as $screen ) {

      add_meta_box(
         'myplugin_sectionid',
         __( 'My Custom file', 'myplugin_textdomain' ),
         'myplugin_meta_box_callback',
         $screen
      );
   }
}
// add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_meta_box_callback( $post ) {
   global $wpdb;
   $table_name = $wpdb->prefix . "city";
   $table_type = $wpdb->prefix . "type";
   // Add an nonce field so we can check for it later.
   wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

   /*
    * Use get_post_meta() to retrieve an existing value
    * from the database and use the value for the form.
    */
   $value = get_post_meta( $post->ID, '_my_meta_value_key_city', true );

   echo '<label for="myplugin_new_field_city">';
   _e( 'City Area', 'myplugin_textdomain' );
   echo '</label> ';
   //echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field" value="' . esc_attr( $value ) . '" size="25" />';
   

   $post_id = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC");
   //print_r($post_id);
   echo'<select id="myplugin_new_field_city" name="myplugin_new_field_city">';
   foreach ($post_id as $rows) {
   ?>
      <option value="<?php echo $rows->id;?>" <?php if($rows->id == esc_attr( $value )){?> selected <?php }?> ><?php echo $rows->name_city;?></option>
   <?php
   }   
   echo'</select> note : [city]id_post[/city] <br><br>';

   $value_type = get_post_meta( $post->ID, '_my_meta_value_key_type', true );

   echo '<label for="myplugin_new_field_type">';
   _e( 'Type', 'myplugin_textdomain' );
   echo '</label> ';

   $type_id = $wpdb->get_results("SELECT * FROM $table_type ORDER BY id DESC");
   //print_r($post_id);
   echo'<select id="myplugin_new_field_type" name="myplugin_new_field_type">';
   foreach ($type_id as $rows) {
   ?>
      <option value="<?php echo $rows->id;?>" <?php if($rows->id == esc_attr( $value_type )){?> selected <?php }?> ><?php echo $rows->type_name;?></option>
   <?php
   }   
   echo'</select> note : [type]id_post[/type]';

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_meta_box_data( $post_id ) {

   /*
    * We need to verify this came from our screen and with proper authorization,
    * because the save_post action can be triggered at other times.
    */

   // Check if our nonce is set.
   if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
      return;
   }

   // Verify that the nonce is valid.
   if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
      return;
   }

   // If this is an autosave, our form has not been submitted, so we don't want to do anything.
   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
   }

   // Check the user's permissions.
   if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

      if ( ! current_user_can( 'edit_page', $post_id ) ) {
         return;
      }

   } else {

      if ( ! current_user_can( 'edit_post', $post_id ) ) {
         return;
      }
   }

   /* OK, it's safe for us to save the data now. */
   
   // Make sure that it is set.
   if ( ! isset( $_POST['myplugin_new_field_city'] ) ) {
      return;
   }
   if ( ! isset( $_POST['myplugin_new_field_type'] ) ) {
      return;
   }

   // Sanitize user input.
   $my_data_city = sanitize_text_field( $_POST['myplugin_new_field_city'] );
   $my_data_type = sanitize_text_field( $_POST['myplugin_new_field_type'] );

   // Update the meta field in the database.
   update_post_meta( $post_id, '_my_meta_value_key_city', $my_data_city );
   update_post_meta( $post_id, '_my_meta_value_key_type', $my_data_type );
}
// add_action( 'save_post', 'myplugin_save_meta_box_data' );

///////////////////////////////////////////////////////////////////





/////////////////////////////////////////////////////
// Setup menu admin and sub menu
/////////////////////////////////////////////////////
// Add menu and pages to WordPress admin area
add_action('admin_menu', 'analyse_config');

// Add page menu
function analyse_config() {
   global $current_user;
   if ( current_user_can('administrator') || current_user_can('redd_team') || current_user_can('rts_admin') ) {
   	 // This is the menu on the side
   	add_menu_page( 'Projects', 'Projects', $current_user->roles[0], 'admin-page', 'list_projects','',30 );
      add_submenu_page('admin-page','List Projects','List Projects',$current_user->roles[0],'admin-page','list_projects');
      add_submenu_page( 'admin-page', 'Add Project', 'Add Project', $current_user->roles[0], 'add_project', 'add_project' );

      // status
      add_submenu_page( 'admin-page', 'Project status', 'Project status', $current_user->roles[0], 'project_status', 'project_status' );
      add_submenu_page( 'admin-page', 'Add project status', 'Add project status', $current_user->roles[0], 'add_project_status', 'add_project_status' );

      // Document
      add_submenu_page( 'admin-page', 'Project document', 'Project document', $current_user->roles[0], 'project_document', 'project_document' );
      add_submenu_page( 'admin-page', 'Add project document', 'Add project document', $current_user->roles[0], 'add_project_document', 'add_project_document' );

      // Annual emission reductions
      add_submenu_page('admin-page','Annual emission reductions','Annual emission reductions',$current_user->roles[0],'annual_emission_reductions','annual_emission_reductions');
      add_submenu_page('admin-page', 'Add Annual emission reductions', 'Add Annual emission reductions', $current_user->roles[0], 'add_annual_emission_reductions', 'add_annual_emission_reductions' );

      add_menu_page( 'Organizational Category', 'Organizational category', $current_user->roles[0], 'organizational_category', 'list_organizational_category','',32 );
      add_submenu_page('organizational_category','Organizational category','Organizational category',$current_user->roles[0],'organizational_category','organizational_category');
      add_submenu_page('organizational_category', 'Add Organizational category', 'Add Organizational category',$current_user->roles[0], 'add_organizational_category', 'add_organizational_category' );
      
      // Project type
      add_menu_page( '', 'Project Type', $current_user->roles[0], 'project_type', 'list_project_type','',31 );
      add_submenu_page('project_type','Project Type','Project Type',$current_user->roles[0],'project_type','project_type');
      add_submenu_page('project_type', 'Add Project Type', 'Add Project Type', $current_user->roles[0], 'add_project_type', 'add_project_type' );

      // Document type
      add_menu_page( '', 'Document Type', $current_user->roles[0], 'document_type', 'list_document_type','',33 );
      add_submenu_page('document_type','Document Type','Document Type',$current_user->roles[0],'document_type','document_type');
      add_submenu_page('document_type', 'Add Document Type', 'Add Document Type', $current_user->roles[0], 'add_document_type', 'add_document_type' );

      add_menu_page( 'Forest Reference Level', 'Forest Reference Level',$current_user->roles[0], 'forest_reference_level', 'forest_reference_level','',34 );

      add_menu_page( 'Email config', 'Email config', $current_user->roles[0], 'email_config', 'email_config','',35 );
   }elseif ( current_user_can('rts_reviewer') ) {
      // This is the menu on the side
     add_menu_page( 'Projects', 'Projects', $current_user->roles[0], 'admin-page', 'list_projects','',30 );
     add_submenu_page('admin-page','List Projects','List Projects',$current_user->roles[0],'admin-page','list_projects');
     add_submenu_page( 'admin-page', 'Add Project', 'Add Project', $current_user->roles[0], 'add_project', 'add_project' );

     // status
     add_submenu_page( 'admin-page', 'Project status', 'Project status', $current_user->roles[0], 'project_status', 'project_status' );
     add_submenu_page( 'admin-page', 'Add project status', 'Add project status', $current_user->roles[0], 'add_project_status', 'add_project_status' );

     // Document
     add_submenu_page( 'admin-page', 'Project document', 'Project document', $current_user->roles[0], 'project_document', 'project_document' );
     add_submenu_page( 'admin-page', 'Add project document', 'Add project document', $current_user->roles[0], 'add_project_document', 'add_project_document' );

     // Annual emission reductions
     add_submenu_page('admin-page','Annual emission reductions','Annual emission reductions',$current_user->roles[0],'annual_emission_reductions','annual_emission_reductions');
     add_submenu_page('admin-page', 'Add Annual emission reductions', 'Add Annual emission reductions', $current_user->roles[0], 'add_annual_emission_reductions', 'add_annual_emission_reductions' );
  
   }

}

add_action('admin_head', 'my_custom_css_admin');
function my_custom_css_admin() {
  echo '<style>
   #toplevel_page_admin-page ul.wp-submenu-wrap li:nth-child(4),#toplevel_page_admin-page ul.wp-submenu-wrap li:nth-child(5){
         display: none;
      }
   #toplevel_page_admin-page ul.wp-submenu-wrap li:nth-child(6),#toplevel_page_admin-page ul.wp-submenu-wrap li:nth-child(7){
         display: none;
      }
   #toplevel_page_admin-page ul.wp-submenu-wrap li:nth-child(8),#toplevel_page_admin-page ul.wp-submenu-wrap li:nth-child(9){
         display: none;
      }
  </style>';
}

// this funtion will display as page
function email_config(){
   $wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
   include($wp_plugin_dir.'/include/email_config.php');
}

function list_projects(){
	$wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/list_projects.php');
}

function add_project(){
	$wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/add_project.php');
}

function project_status(){
	$wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/project_status.php');
}

function add_project_status(){
	$wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/add_project_status.php');
}

function project_document(){
   $wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
   include($wp_plugin_dir.'/include/project_document.php');
}

function add_project_document(){
   $wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
   include($wp_plugin_dir.'/include/add_project_document.php');
}

function organizational_category(){
	$wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/organizational_category.php');
}

function add_organizational_category(){
	$wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/add_organizational_category.php');
}

function project_type(){
	$wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/project_type.php');
}

function add_project_type(){
	$wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/add_project_type.php');
}

function document_type(){
   $wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/document_type.php');
}

function add_document_type(){
   $wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/add_document_type.php');
}


function annual_emission_reductions(){
   
   $wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/annual_emission_reductions.php');
}

function add_annual_emission_reductions(){
   $wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/add_annual_emission_reductions.php');
}

function forest_reference_level(){
   $wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
	include($wp_plugin_dir.'/include/forest_reference_level.php');
}







/////////////////////////////////////////////////////
// shortcode get value to display on single page
/////////////////////////////////////////////////////
// [city]id_post[/city]
function city_shortcode( $atts, $id = null ) {
   global $wpdb;
   $table_name = $wpdb->prefix . "city";

   $ids = get_post_meta($id, '_my_meta_value_key_city', true);
   $row_val = $wpdb->get_row("SELECT * FROM $table_name WHERE id='".$ids."'");
   return $row_val->name_city;
}
add_shortcode( 'city', 'city_shortcode' );

function type_shortcode( $atts, $id = null ) {
   global $wpdb;
   $table_type = $wpdb->prefix . "type";

   $ids = get_post_meta($id, '_my_meta_value_key_type', true);
   $row_val = $wpdb->get_row("SELECT * FROM $table_type WHERE id='".$ids."'");
   return $row_val->type_name;
}
add_shortcode( 'type', 'type_shortcode' );


// plugin uninstallation
register_uninstall_hook( __FILE__, 'my_fn_uninstall' );
function my_fn_uninstall() {
    delete_option( 'admin-page' );
}

?>
