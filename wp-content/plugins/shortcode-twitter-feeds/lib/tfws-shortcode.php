<?php
// widget  Shortcode  starts here 
function tfws_shortcode( $atts ) {
	extract( shortcode_atts(
		array(
			'username' => 'swadeshswain',
			'width' => '',
			'height'=> '440',
			'theme' => 'light',
			'color' => '#2B7BB9',
			'tweets' => '',
			'header' =>'',
			'footer' =>'',
			'borders' =>'',
			'scrollbar' =>'',
			'background' =>'',
		), $atts )
	);	
		$tfws_layout = array();
		$tfws_layout[] = ( $header == 'no' )? 'noheader': '';
		$tfws_layout[] = ( $footer == 'no' )? 'nofooter': '';
		$tfws_layout[] = ( $borders == 'no' )? 'noborders': '';
		$tfws_layout[] = ( $scrollbar == 'no' )? 'noscrollbar': '';
		$tfws_layout[] = ( $background == 'yes' )? 'transparent': '';
	    $tfws_layout = implode(" ",$tfws_layout);
$output = '<a class="twitter-timeline"  data-width="'.$width.'" data-chrome="'.$tfws_layout.'" data-height="'.$height.'" data-tweet-limit="'.$tweets.'"  data-dnt="true" data-theme="'.$theme.'" data-link-color="'.$color.'" href="https://twitter.com/'.$username.'">Tweets by "'.$username.'"</a> ' ;
	return $output;
}
add_shortcode( 'tfws', 'tfws_shortcode' );
add_filter('widget_text', 'do_shortcode');