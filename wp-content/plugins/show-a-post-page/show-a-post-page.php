<?php
/*
Plugin Name: Show a post or page
Plugin URI: http://www.cis.com.kh
Description: Display a specific post (or Page) with standard WP template tags.
Version: 0.1
Author: CIS
Author URI: http://www.cis.com.kh
*/

function get_a_post($id='GETPOST') {
	global $post, $tableposts, $tablepostmeta, $wp_version, $wpdb;

	if($wp_version < 1.5)
		$table = $tableposts;
	else
		$table = $wpdb->posts;

	$now = current_time('mysql');
	$name_or_id = '';
	$orderby = 'post_date';

	if( !$id || 'GETPOST' == $id || 'GETRANDOM' == $id ) {
		if( $wp_version < 2.1 )
			$query_suffix = "post_status = 'publish'";
		else
			$query_suffix = "post_type = 'post' AND post_status = 'publish'";
	} elseif('GETPAGE' == $id) {
		if($wp_version < 2.1)
			$query_suffix = "post_status = 'static'";
		else
			$query_suffix = "post_type = 'page' AND post_status = 'publish'";
	} elseif('GETSTICKY' == $id) {
		if($wp_version < 1.5)
			$table .= ', ' . $tablepostmeta;
		else
			$table .= ', ' . $wpdb->postmeta;
		$query_suffix = "ID = post_id AND meta_key = 'sticky' AND meta_value = 1";
	} else {
		$query_suffix = "(post_status = 'publish' OR post_status = 'static')";

		if(is_numeric($id)) {
			$name_or_id = "ID = '$id' AND";
		} else {
			$name_or_id = "post_name = '$id' AND";
		}
	}

	if('GETRANDOM' == $id)
		$orderby = 'RAND()';

	$post = $wpdb->get_row("SELECT * FROM $table WHERE $name_or_id post_date <= '$now' AND $query_suffix ORDER BY $orderby DESC LIMIT 1");
	get_post_custom($post->ID);

	if($wp_version < 1.5)
		start_wp();
	else
		setup_postdata($post);
}

function custom_excerpt_length( $length ) {
    if(function_exists('qtranxf_getLanguage')) {
        if (qtranxf_getLanguage()=="en"){
            return 100;
        }else {
            return 500;
        }
    }else{
        return 150;
    }
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999);

function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
	} else {
		echo $excerpt;
	}
}

function show_post_page_func( $atts ){
	$a = shortcode_atts( array(
        'id' =>0,
        'content'=>'No'
    ), $atts );
	global $wpdb;
	$post_id =  $a['id'];
	$content =  $a['content'];
	get_a_post($post_id);
    ob_start();
?>
	<style>
        .single_post_page{text-align:justify;min-height: 138px;overflow:hidden;}
		.single_post_page img{float:left;margin-right: 15px;}
		.single_post_page p a{
			background:#06529E;
			padding: 3px 10px;
			color:#FFF !important;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			-o-border-radius: 5px;
			border-radius: 5px;
		}
        .widget .single_post_page h1{
            color:#FFF !important;
            font-size: 16px;
            font-weight: bold;
            margin:0;
        }
    </style>
    <div class="single_post_page">
    <?php echo get_the_post_thumbnail( $post_id, 'medium' );?>
    <h1 style="padding:0;text-align: center;"><?php the_title();?></h1>
        <?php //the_excerpt_max_charlength(460);?>
        <?php if($content=='No'){
            the_excerpt();
        ?>
            <div class="vc_btn3-container vc_btn3-center">
                <a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-outline vc_btn3-color-success" href="<?php echo get_permalink($post_id)?>" title="">
                    <?php _e("[:km]អានបន្ត[:en]Read More[:]");?> <i class="fa fa-long-arrow-right"></i>
                </a>
            </div>
        <?php
        }else{
            the_content();
        }
        ?>
    </div>
	<?php
    return ob_get_clean();
}
add_shortcode( 'Show', 'show_post_page_func' );
?>