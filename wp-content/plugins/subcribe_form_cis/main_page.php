<?php

/*

Plugin Name: SUBCRIBETION FORM(IMYMEMINE)

Description: Subsribe Form

Author: IMYMEMINE

Version: 1.0

*/

define('sfc_url', WP_PLUGIN_URL.'/subcribe_form_cis');

date_default_timezone_set('Asia/Bangkok');

$today_date = date("Y-m-d");

include("pagenavi.php");

//CREAT TABLE WHEN PLUGIN IS ACTIVED

function create_sfc_table () {

	global $wpdb;

	$table_name = $wpdb->prefix . "subscribe_cis";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

	/* Create the tables which are required for First Visit Message */

	$sql = "CREATE TABLE " . $table_name . " (

	`id` INT(10) NOT NULL AUTO_INCREMENT,

	`user_data` VARCHAR(500) NOT NULL,

	`sub_date` VARCHAR(255) NOT NULL,

	`status` INT(1) NOT NULL DEFAULT '0',

	PRIMARY KEY (`id`)

	) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	dbDelta($sql);

	}

}

@@register_activation_hook(__FILE__,'create_sfc_table');

//------------------------------------------------------

function sfc_scripts() {

	$version = null;

	//wp_enqueue_style('jquery.mobile', plugins_url('css/jquery.mobile.custom.structure.css',__FILE__),array(), $version);

	

	wp_register_script( "js_sfc", sfc_url.'/js/jquery_sfc.js', array('jquery'),$version );

	wp_register_script( "jquery.validate", sfc_url.'/js/jquery.validate.js', array('jquery'),$version );

	wp_localize_script( 'js_sfc', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

	

	wp_enqueue_script('js_sfc');

	wp_enqueue_script('jquery');

	wp_enqueue_script('jquery.validate');

	wp_enqueue_script('jquery-form');

}

if (!is_admin()) {

	add_action( 'wp_footer', 'sfc_scripts' );

}

if (isset($_GET['page']) && $_GET['page'] == 'sfc_subscribers') {

	add_action('admin_print_scripts', 'sfc_scripts');

}

function sfc_menu_items(){

    add_menu_page('Subscribe', 'Subscribe', 1, 'sfc_main', 'sfc_main_func','dashicons-email-alt');

	add_submenu_page('sfc_main', 'Reference', 'Reference', 1, 'sfc_main', 'sfc_main_func');

	add_submenu_page('sfc_main', 'Subscribers', 'Subscribers', 1, 'sfc_subscribers', 'sfc_subscribers_func');

} 

add_action('admin_menu', 'sfc_menu_items');

function sfc_main_func(){

	include('sfc_admin_form.php');

}

add_action( 'admin_init', 'sfc_ref_func' );

function sfc_ref_func() { // whitelist options

	register_setting( 'sfc_ref', 'post_category' );

}

function sfc_subscribers_func(){

	include('sfc_subscriber_list.php');

}

function display_sfc_form_func(){
	ob_start();
	include('sf_frontpage_form.php');
	return ob_get_clean();
}

add_shortcode( 'SFC_Form', 'display_sfc_form_func' );

add_action("wp_ajax_submit_subscriber", "submit_subscriber_func");

add_action("wp_ajax_nopriv_submit_subscriber", "submit_subscriber_func");

function submit_subscriber_func(){

	global $wpdb;

	date_default_timezone_set('Asia/Bangkok');

	$today_date = date("Y-m-d");

	if(isset($_POST['data'])){

		$data = serialize($_POST['data']);

	}

	$mydata 	= unserialize($data);

	$email 		= $mydata['email'];

	

	//$captcha	= $_POST['g-recaptcha-response'];

	$subject	= 'Confirm';

	$status = 0;

	$exist	= $wpdb->get_var("SELECT COUNT(id) FROM {$wpdb->prefix}subscribe_cis WHERE user_data REGEXP '.*\"email\";s:[0-9]+:\"$email\".*'");

	

	if($exist ==1){

		echo json_encode(array('error'=>'email'));

	/*}elseif($captcha ==''){

		echo json_encode(array('error'=>'captcha'));*/

	}else{

		$query = $wpdb->prepare("INSERT INTO {$wpdb->prefix}subscribe_cis SET user_data=%s, sub_date=%s, status=%d",$data,$today_date,$status);

		$wpdb->query($query);

		if($query){
			echo json_encode(array('error'=>'<p>Successfully subscribed ,Thanks you for your subscribe.</p>'));
			$email 	= $user_data['email'];
			$headers = array('Content-Type: text/html; charset=UTF-8');
			$smg  	= '<h3>This is an automated message from Cambodia REDD+. You are not required to respond to this email.</h3>';
			$smg 	.= '<p>Thank you for registering for our Website. Your registration form has been successfully submitted.<p>';
			$smg 	.= '<p>Our authorized personnel will contact you if any further information is required. You will be notified of any updates via this email.<p>';
			$smg	.= '<p>Please contact us if you have any enquiries.</p>';
			wp_mail( $email, 'Cambodia REDD+', $smg,$headers);
		}
	}
	die();
}

// A function to perform actions when a post is published.

function on_post_publish( $ID, $post ) {

	global $wpdb;

	$get_actived = $wpdb->get_results("SELECT user_data FROM {$wpdb->prefix}subscribe_cis WHERE status=1");

	add_filter( 'wp_mail_content_type', 'set_html_content_type' );

	$selected_cats = get_option('post_category');//Get newsletter REF

	foreach($get_actived as $active){

		$actives = unserialize($active->user_data);

		$email 	 = $actives['email'];

		$smg  = '<h3><a href="'.get_permalink($ID).'">'.get_the_title($ID).'</a></h3>';

		$smg .= '<p>'.get_excerpt_by_id($ID).'<p><br>';

		$smg .= '<a href="'.get_permalink($ID).'">Read More</a>';

		if ( in_category($selected_cats)) {

			wp_mail( $email, 'Newsletter-Cambodia REDD+', $smg,'','');

		}

	}

	remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

}

add_action('publish_post','on_post_publish', 10, 2);

function get_excerpt_by_id($post, $length = 10, $tags = '<a><em><strong>', $extra = ' . . .') {

	if(is_int($post)) {

		// get the post object of the passed ID

		$post = get_post($post);

	} elseif(!is_object($post)) {

		return false;

	}

 

	if(has_excerpt($post->ID)) {

		$the_excerpt = $post->post_excerpt;

		return apply_filters('the_content', $the_excerpt);

	} else {

		$the_excerpt = $post->post_content;

	}

 

	$the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);

	$the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);

	$excerpt_waste = array_pop($the_excerpt);

	$the_excerpt = implode($the_excerpt);

	$the_excerpt .= $extra;

 

	return apply_filters('the_content', $the_excerpt);

}

function set_html_content_type() {

	return 'text/html';

}

//ADMIN STUFF----------------------------------

add_action("wp_ajax_sfc_load_subscriber_for_admin", "sfc_load_subscriber_for_admin_func");

add_action("wp_ajax_nopriv_sfc_load_subscriber_for_admin", "sfc_load_subscriber_for_admin_func");

function sfc_load_subscriber_for_admin_func(){

	global $wpdb;

	include("pagination_css.php");

	$page 		= $_POST['paged'];

	//$schl_title	= $_POST['schl_title'];

	if($page=='') $page=1;

	$per_page	= 50;

	?>

    <div class="fixed-table-pagination">

    	<?php

        if($page != ''){

			$where = "WHERE 1=1";

			/*if($schl_title != ''){

				$where .= " AND TITLE LIKE '{$schl_title}%'";

			}*/

			$limit_val=gen_pagination("{$wpdb->prefix}subscribe_cis",$page,$per_page,$where,'');

			if ($limit_val !="" ) $limit = " LIMIT ".$limit_val;

			$sql_filter="SELECT * FROM {$wpdb->prefix}subscribe_cis $where ORDER BY id DESC".$limit;

		}

		?>

    </div>

    <table class="widefat table table-hover" id="tblProv" width="100%">

    <div class="fixed-table-container">

	<thead>
    	<tr>
            <th style="width:25px; text-align:center;">#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Stautus</th>
            <th style="width:120px; text-align:center;">Action</th>
       </tr>
	</thead>

    </div>

    <tbody>

    	<?php 

		$members=$wpdb->get_results($sql_filter);

		$i += (int)$start_rec[0] + 1;

			foreach ($members as $member){

				$user_data = unserialize($member->user_data);

				?>

		<tr id="<?php echo $song->id;?>">

			<td><?php echo $i;?></td>

            <td><?php echo $user_data['full_name'];?></td>

			<td><?php echo $user_data['email'];?></td>

            <td><?php echo $user_data['phone'];?></td>
            <td><?php if($member->status==0){echo "Deactive";}else{echo '<span style="color:green;">Active</span>';} ?></td>
            <td style="text-align:center;">
                <a href="#status" class="status" id="<?php echo $member->id;?>" title="Status">
				<?php if($member->status==1){echo "Deactive";}else{echo 'Active';} ?></a> |
                <a href="#" class="delete_user" id="<?php echo $member->id;?>" title="delete">Delete</a>

            </td>

		</tr><?php

	$i++;

	}?>

    </tbody>

	</table>

    <div class="fixed-table-pagination">

    	<?php $limit_val = gen_pagination($wpdb->prefix."subscribe_cis",$page,$per_page,$where,'');?>

    </div>

	<?php

	die();

}

add_action("wp_ajax_act_sfc_change_status", "sfc_change_status_func");

add_action("wp_ajax_nopriv_act_sfc_change_status", "sfc_change_status_func");

function sfc_change_status_func(){

	global $wpdb;

	$id = $_POST['id'];

	$status = $wpdb->get_var("SELECT status FROM {$wpdb->prefix}subscribe_cis WHERE id={$id}");

	if($status==1){

		$new_status = 0;

	}else{

		$new_status = 1;

	}

	$update_stat = $wpdb->prepare("UPDATE {$wpdb->prefix}subscribe_cis SET status = %d WHERE id=%d;",$new_status,$id);

	$wpdb->query($update_stat);

	die();

}

add_action("wp_ajax_act_sfc_delete_user", "sfc_delete_user_func");

add_action("wp_ajax_nopriv_act_sfc_delete_user", "sfc_delete_user_func");

function sfc_delete_user_func(){

	global $wpdb;

	$id = $_POST['id'];

	$del_user = $wpdb->prepare("DELETE FROM {$wpdb->prefix}subscribe_cis WHERE id=%d;",$id);

	$wpdb->query($del_user);

	die();

}

?>