<?php
/*
tagDiv - 2017
*/
/**
* Load the speed booster framework + theme specific files
*/
// load the deploy mode
require_once('td_deploy_mode.php');

// load the config
require_once('includes/td_config.php');
add_action('td_global_after', array('td_config', 'on_td_global_after_config'), 9); //we run on 9 priority to allow plugins to updage_key our apis while using the default priority of 10

// load the wp booster
require_once('includes/wp_booster/td_wp_booster_functions.php');

require_once('includes/td_css_generator.php');
require_once('includes/shortcodes/td_misc_shortcodes.php');
require_once('includes/widgets/td_page_builder_widgets.php'); // widgets


/*
* mobile theme css generator
* in wp-admin the main theme is loaded and the mobile theme functions are not included
* required in td_panel_data_source
* @todo - look for a more elegant solution(ex. generate the css on request)
*/

require_once('mobile/includes/td_css_generator_mob.php');

/* ----------------------------------------------------------------------------
* Woo Commerce
*/
// breadcrumb
/*add_filter('woocommerce_breadcrumb_defaults', 'td_woocommerce_breadcrumbs');
function td_woocommerce_breadcrumbs() {
return array(
'delimiter' => ' <i class="td-icon-right td-bread-sep"></i> ',
'wrap_before' => '<div class="entry-crumbs" itemprop="breadcrumb">',
'wrap_after' => '</div>',
'before' => '',
'after' => '',
'home' => _x('Home', 'breadcrumb', 'woocommerce'),
);
}*/

// use own pagination
/*if (!function_exists('woocommerce_pagination')) {
// pagination
function woocommerce_pagination() {
echo td_page_generator::get_pagination();
}
}*/


// Number of product per page 8
// add_filter('loop_shop_per_page', create_function('$cols', 'return 4;'));
add_action( 'loop_shop_per_page', function($cols) {
    return 4;
});
if (!function_exists('woocommerce_output_related_products')) {
// Number of related products
function woocommerce_output_related_products() {
woocommerce_related_products(array(
'posts_per_page' => 4,
'columns' => 4,
'orderby' => 'rand',
)); // Display 4 products in rows of 1
}
}
/* ----------------------------------------------------------------------------
* bbPress
*/
// change avatar size to 40px
function td_bbp_change_avatar_size($author_avatar, $topic_id, $size) {
$author_avatar = '';
if ($size == 14) {
$size = 40;
}

$topic_id = bbp_get_topic_id( $topic_id );
if ( !empty( $topic_id ) ) {
if ( !bbp_is_topic_anonymous( $topic_id ) ) {
$author_avatar = get_avatar( bbp_get_topic_author_id( $topic_id ), $size );
} else {
$author_avatar = get_avatar( get_post_meta( $topic_id, '_bbp_anonymous_email', true ), $size );
}
}
return $author_avatar;
}


add_filter('bbp_get_topic_author_avatar', 'td_bbp_change_avatar_size', 20, 3);
add_filter('bbp_get_reply_author_avatar', 'td_bbp_change_avatar_size', 20, 3);
add_filter('bbp_get_current_user_avatar', 'td_bbp_change_avatar_size', 20, 3);

//add_action('shutdown', 'test_td');
function test_td () {
   if (!is_admin()){
    td_api_base::_debug_get_used_on_page_components();
    }
}

/**
* tdStyleCustomizer.js is required
*/
if (TD_DEBUG_LIVE_THEME_STYLE) {
add_action('wp_footer', 'td_theme_style_footer');
// new live theme demos
function td_theme_style_footer() {
    ?>
    <div id="td-theme-settings" class="td-live-theme-demos td-theme-settings-small">
    <div class="td-skin-body">
    <div class="td-skin-wrap">
    <div class="td-skin-container td-skin-buy"><a target="_blank" href="http://themeforest.net/item/newspaper/5489609?ref=tagdiv">BUY NEWSPAPER NOW!</a></div>
    <div class="td-skin-container td-skin-header">GET AN AWESOME START!</div>
    <div class="td-skin-container td-skin-desc">With easy <span>ONE CLICK INSTALL</span> and fully customizable options, our demos are the best start you'll ever get!!</div>
    <div class="td-skin-container td-skin-content">
    <div class="td-demos-list">
    <?php
    $td_demo_names = array();
    foreach (td_global::$demo_list as $demo_id => $stack_params) {
    $td_demo_names[$stack_params['text']] = $demo_id;
    ?>

    <div class="td-set-theme-style"><a href="<?php echo td_global::$demo_list[$demo_id]['demo_url'] ?>" class="td-set-theme-style-link td-popup td-popup-<?php echo $td_demo_names[$stack_params['text']] ?>" data-img-url="<?php echo td_global::$get_template_directory_uri ?>/demos_popup/large/<?php echo $demo_id; ?>.jpg"><span></span></a></div>

    <?php } ?>

    <div class="td-set-theme-style-empty"><a href="#" class="td-popup td-popup-empty1"></a></div>

    <div class="td-set-theme-style-empty"><a href="#" class="td-popup td-popup-empty2"></a></div>

    <div class="clearfix"></div>

    </div>

    </div>

    <div class="td-skin-scroll"><i class="td-icon-read-down"></i></div>

    </div>

    </div>

    <div class="clearfix"></div>

    <div class="td-set-hide-show"><a href="#" id="td-theme-set-hide"></a></div>

    <div class="td-screen-demo" data-width-preview="380"></div>

    </div>

    <?php

    }
}
//td_demo_state::update_state("art_creek", 'full');
//print_r(td_global::$all_theme_panels_list);

function asset_style() {
    $theme_uri = get_template_directory_uri();
    $version = '20200915';

    //wp_enqueue_script( 'jquery-1.12.1', plugin_dir_url( __FILE__ ) . 'framework/jquery-ui-1.12.1.custom/external/jquery/jquery.js' );
    wp_enqueue_script( 'jquery-bootstrap', $theme_uri . '/js/bootstrap.min.js' );
    wp_enqueue_script( 'jquery-bootstrap-datepicker', $theme_uri . '/js/bootstrap-datepicker.min.js' );


    //wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'framework/bootstrap/css/bootstrap.css' );
    wp_enqueue_style( 'fontAwesomeV4', get_template_directory_uri() . '/font-awesome-4.7.0/css/font-awesome.min.css' );


    wp_enqueue_style( 'bk-css', $theme_uri . '/css/style_page.css', array(), $version );
    wp_enqueue_style( 'bk-bootrap-css', $theme_uri . '/css/bootstrap.min.css', array(), $version );
    wp_enqueue_style( 'bk-bootrap-datepicker-css', $theme_uri . '/css/bootstrap-datepicker.min.css', array(), $version );
    wp_enqueue_style( 'bk-cssv2', $theme_uri . '/css/style_page_2.css', array(), $version );

    // Datatable CSS
    wp_enqueue_style( 'datatable', 'https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap4.css', array(),'2.0.0' );

    wp_enqueue_script( 'jquery-highcharts', $theme_uri . '/js/highcharts.js' );
    wp_enqueue_script( 'jquery-modules_data', $theme_uri . '/js/modules/data.js' );
    wp_enqueue_script( 'jquery-modules_exporting', $theme_uri . '/js/modules/exporting.js' );
    wp_enqueue_script( 'jquery-modules_accessibility', $theme_uri . '/js/modules/accessibility.js' );

    // wp_enqueue_script( 'jquery-1.7.1', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' );
    // Datatable JS
    // wp_enqueue_script( 'datatable', 'https://cdn.datatables.net/2.0.0/js/dataTables.min.js' );

    wp_enqueue_script( 'jquer-custom', $theme_uri . '/js/bk-custom.js' );
}
add_action( 'wp_footer', 'asset_style' );

/** Head Font Preloading **/
function font_preloading_preload_key_requests() { ?>
    <link rel="preload" as="font" type="font/woff" href="https://cambodia-redd.org/wp-content/plugins/social-icons/assets/fonts/socicon.woff" crossorigin="anonymous">
    <link rel="preload" as="font" type="font/woff" href="https://cambodia-redd.org/wp-content/plugins/revslider/public/assets/fonts/revicons/revicons.woff?5510888" crossorigin="anonymous">
    <link rel="preload" as="font" type="font/woff" href="https://cambodia-redd.org/wp-content/themes/Newspaper/images/icons/newspaper.woff?14" crossorigin="anonymous">
    <link rel="preload" as="font" type="font/woff2" href="https://cambodia-redd.org/wp-content/themes/Newspaper/fonts/Battambang.woff2" crossorigin="anonymous">

    <link rel="preload" href="//maps.google.com" crossorigin="anonymous">

<?php }
add_action( 'wp_head', 'font_preloading_preload_key_requests' );


/**
 * Register a custom menu page.
 */
function wpdocs_register_my_custom_menu_page() {
    add_menu_page('Projects','List Projects',
        'projects_list',
        'myplugin/list-projects.php',
        '',
        plugins_url( 'myplugin/images/icon.png' ),
        6
    );
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );

//Detect deprecated error messages
add_filter('deprecated_constructor_trigger_error', '__return_false');

//Sum Emission Reductions
function sum_emission_by_year($type, $status, $start, $end) {

    global $wpdb;
    $result = 0;
    if($type == 'single' && $status == 'issued') {
        $result = $wpdb->get_row("SELECT SUM(issued) as total_issued FROM `redd_project_annual_emission_reductions` WHERE issuse_date BETWEEN '".$start."-01-01' AND '".$end."-12-31'");
    }
    elseif($type == 'single' && $status == 'verifield') {
        $result = $wpdb->get_results("SELECT SUM(verified) as total_verifield FROM `redd_project_annual_emission_reductions` WHERE issuse_date BETWEEN '".$start."-01-01' AND '".$end."-12-31'");
    }
    elseif($type == 'between' && $status == "verifield") {
        $result = $wpdb->get_results("SELECT SUM(verified) as total_data_verifield_btw FROM `redd_project_annual_emission_reductions` WHERE issuse_date BETWEEN '".$start."-01-01' AND '".$end."-12-31'");
    }

    return $result;

}

function count_project_by_status($status) {
    global $wpdb;
    $result = 0;

    if($status == 'approval') {
        $result = $wpdb->get_row("SELECT COUNT(id) as approval FROM `redd_project` WHERE date_approval != '0000-00-00 00:00:00' AND id != 0");
    }
    elseif($status == 'pipline') {
        $result = $wpdb->get_row("SELECT COUNT(id) as pipline FROM `redd_project` WHERE date_approval = '0000-00-00 00:00:00' AND id != 0");
    }
    else {
        $result = $wpdb->get_row("SELECT SUM(area) as total_area FROM `redd_project` WHERE date_approval != '0000-00-00 00:00:00'");
    }

    return $result;
}