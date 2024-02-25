<?php
if(!class_exists('my_ultimateLayouts_elements')){
	class my_ultimateLayouts_elements{
		//Image
		static function ultimateLayouts_thumbnail($post_id = 0, $size = 'thumbnail', $link = true, $link_target = false, $quick_view = true, $quick_view_mode = false, $export_background = false, $ext_class = '', $lazyload = array(false, ''), $format = array(false, 'ul-bottom-right')){	
					
			if($post_id == 0){
				$post_id = get_the_ID();
			}
			
			if(get_post_type($post_id)=='attachment'){
				$attachment_id = $post_id;
			}else{
				if(!has_post_thumbnail()){
					return '';
				}
				$attachment_id = get_post_thumbnail_id($post_id);				
			}
			
			$picture_meta 	= wp_get_attachment_image_src($attachment_id, $size);
			$image_url 		= $picture_meta[0];
			$background_img = '';
			if($export_background){
				$background_img = 'background-image:url('.$image_url.');';
			}
			
			$custom_wrap_css = '';
			if($background_img!=''){
				$custom_wrap_css = 'style="'.$background_img.'"';
			}
			
			$before_img 	= '';
			$after_img 		= '';			
			if($link){
				$html_link_target 	= ($link_target==true)?'target="_blank"':'';
				$get_permalink		= esc_url(get_permalink($post_id));
				$attr_open_post	= '';
				if($quick_view && $quick_view_mode){
					$get_permalink		= 'javascript:;';
					$attr_open_post	= 'data-open-post="ultimate-layouts-quick-view"';
				}
				$before_img 		= '<a '.$attr_open_post.' data-post-id="'.esc_attr($post_id).'" href="'.$get_permalink.'" title="'.esc_attr(the_title_attribute(array('echo'=>0))).'" '.$html_link_target.' '.$custom_wrap_css.' class="ultimate-layouts-picture-link">';
				$after_img			= '</a>';
            };
			
			$format_icon = '';
			if($format[0]==true){
				$post_format = get_post_format($post_id);
				switch($post_format){
					case 'image':
						$format_icon='<span class="ultimate_layouts_post_format '.$format[1].'"><i class="fa fa-camera" aria-hidden="true"></i></span>';
						break;
					case 'gallery':
						$format_icon='<span class="ultimate_layouts_post_format '.$format[1].'"><i class="fa fa-picture-o" aria-hidden="true"></i></span>';
						break;						
					case 'video':
						$format_icon='<span class="ultimate_layouts_post_format '.$format[1].'"><i class="fa fa-play-circle-o" aria-hidden="true"></i></span>';
						break;
					case 'audio':
						$format_icon='<span class="ultimate_layouts_post_format '.$format[1].'"><i class="fa fa-volume-up" aria-hidden="true"></i></span>';
						break;
					case 'quote':
						$format_icon='<span class="ultimate_layouts_post_format '.$format[1].'"><i class="fa fa-quote-right" aria-hidden="true"></i></span>';
						break;	
					/*case 'aside':
						$format_icon='<span class="ultimate_layouts_post_format '.$format[1].'"></span>';
						break;*/
					case 'link':
						$format_icon='<span class="ultimate_layouts_post_format '.$format[1].'"><i class="fa fa-link" aria-hidden="true"></i></span>';
						break;
					/*case 'status':
						$format_icon='<span class="ultimate_layouts_post_format '.$format[1].'"></span>';
						break;*/
					case 'chat':
						$format_icon='<span class="ultimate_layouts_post_format '.$format[1].'"><i class="fa fa-weixin" aria-hidden="true"></i></span>';
						break;			
				}
			}
			
			if(function_exists('wp_get_attachment_image_srcset')){
				
				$placeholder_bg	= '';
				$placeholder 	= '';				
				$styleRatio		= '';				
				$classLazy 		= '';
				
				if($lazyload[0]==true){
					$classLazy = 'ul-lazysizes-effect ul-lazysizes-load';					
					$placeholder 	= UL_BETE_PLUGIN_URL.'assets/front-end/images/placeholder.png';
					$ratio 			= $picture_meta[2]/$picture_meta[1]*100;
					$styleRatio		= ' style="padding-top:'.$ratio.'%"';
					
					if($lazyload[1]!=''){
						$placeholder_bg = '<span class="ul-placeholder-bg" style="background-color:'.$lazyload[1].';padding-top:'.$ratio.'%;"></span>';	
					}else{
						$placeholder_bg = '<span class="ul-placeholder-bg"'.$styleRatio.'></span>';
					}
				}
				
				$image_srcset 			= wp_get_attachment_image_srcset($attachment_id, $size);
				$image_sizes 			= wp_get_attachment_image_sizes($attachment_id, $size);				
				$html_image_url 		= $image_url!=''?($lazyload[0]==true?' src="'.$placeholder.'" data-src="'.$image_url.'"':' src="'.$image_url.'"'):'';
				$html_image_responsive 	= ($image_srcset!=''&&$image_sizes!='')?($lazyload[0]==true?' data-srcset="'.$image_srcset.'" data-sizes="'.$image_sizes.'"':' srcset="'.$image_srcset.'" sizes="'.$image_sizes.'"'):'';							
				$print_html_image 		= $html_image_url!=''?'<img class="ultimate-layouts-img '.$ext_class.' '.$classLazy.'"'.$html_image_url.$html_image_responsive.' alt="'.esc_attr(get_the_title($attachment_id)).'"/>'.$placeholder_bg:'';							
				return $before_img.$print_html_image.$after_img.$format_icon;				
			} else {
				return $before_img.wp_get_attachment_image($attachment_id, $size).$after_img.$format_icon;
			}
		}
		
		//big avatar on image
		static function ultimateLayouts_big_avatar($post_id = 0, $show = false, $link = true){
			if(!$show){
				return '';
			}
			
			if($post_id == 0){
				$post_id = get_the_ID();
			}
			
			$before_author	='';	
			$after_author 	= '';		
			
			$before_author 	.= '<div class="ul-big-avatar">';
			if($link){
				$before_author 	.= '<a class="ul-big-avatar-link" href="'.get_author_posts_url(get_the_author_meta('ID')).'">';
				$after_author 	.= '</a>';
			}
			$after_author 	.= '</div>';
			
			$author_img = get_avatar(get_post_field('post_author', $post_id), 100 );
			
			return $before_author.$author_img.$after_author;
		}
		
		//Title
		static function ultimateLayouts_title($post_id = 0, $show = true, $link = true, $link_target = false, $quick_view = true, $quick_view_mode = false, $litmit = false, $ext_class = ''){
			if(!$show){
				return '';
			}
			
			if($post_id == 0){
				$post_id = get_the_ID();
			}
			$html_limit			= $litmit?'ultimate-layouts-limit-1line':'';
			$before_title 		= '<h3 class="ultimate-layouts-title entry-title '.$html_limit.' '.$ext_class.'">';
			$after_title 		= '</h3>';		
			
			$before_link_title	= '';
			$after_link_title	= '';	
			if($link){
				$html_link_target 	= ($link_target==true)?'target="_blank"':'';
				$get_permalink		= esc_url(get_permalink($post_id));
				$attr_open_post	= '';
				if($quick_view && $quick_view_mode){
					$get_permalink		= 'javascript:;';
					$attr_open_post	= 'data-open-post="ultimate-layouts-quick-view"';
				}
				$before_link_title 	= '<a '.$attr_open_post.' data-post-id="'.esc_attr($post_id).'" href="'.$get_permalink.'" title="'.esc_attr(the_title_attribute(array('echo'=>0))).'" '.$html_link_target.'  class="ultimate-layouts-title-link">';
				$after_link_title	= '</a>';
            };
			return $before_title.$before_link_title.esc_html(strip_tags(get_the_title())).$after_link_title.$after_title;
		}
		
		//Excerpt
		static function ultimateLayouts_excerpt($post_id = 0, $show = true, $s_excerpt_f='get_the_excerpt', $strip_shortcodes = true, $strip_HTMLs = true, $excerpt_length = 0, $readmore = array(false, ''), $ext_class = ''){
			
			if(!$show){
				return '';
			}
			
			if($post_id == 0){
				$post_id = get_the_ID();
			}
			
			$subreadmorebtn = '';			
			if($readmore[0]){	
				$read_more_text = $readmore[1];			
				$get_permalink		= esc_url(get_permalink($post_id));				
				$txt_read_more	 	= $read_more_text!=''?$read_more_text:__('Read More', 'ultimate_layouts');
				$subreadmorebtn		.=	' &nbsp; &nbsp; <a href="'.$get_permalink.'" title="'.esc_attr(the_title_attribute(array('echo'=>0))).'" class="ultimate-layouts-readmore-excerpt">
											<span>'.$txt_read_more.'</span>
											<i class="fa fa-angle-double-right ul-readmore-icon" aria-hidden="true"></i>
										</a>';
			}
			
			$before_excerpt 		= '<div class="ultimate-layouts-excerpt '.$ext_class.'">';
			$after_excerpt 			= $subreadmorebtn.'</div>';
			
			if($s_excerpt_f=='the_excerpt'){
				$get_the_excerpt = apply_filters('the_excerpt', get_the_excerpt());
			}else{
				$get_the_excerpt = get_the_excerpt();
			}
			
			if($strip_HTMLs){
				$excerpt = trim(strip_tags($get_the_excerpt));
			}else{
				$excerpt = trim($get_the_excerpt);
			}
			
			if($excerpt==''){
				return '';
			}
			
			if($strip_shortcodes){
				//$excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
				$excerpt = trim(strip_shortcodes($excerpt));
            };
			
			if($excerpt_length > 0 && $strip_HTMLs){
				if(strlen($excerpt) > $excerpt_length){
					//$limit_excerpt = substr($excerpt, 0, $excerpt_length);
					$limit_excerpt = mb_substr($excerpt, 0, $excerpt_length, 'UTF-8');
					$limit_excerpt = trim(preg_replace('/\s+/', ' ', $limit_excerpt));
					return $before_excerpt.$limit_excerpt.'...'.$after_excerpt;
				}else{
					return $before_excerpt.$excerpt.$after_excerpt;
				}
			};
			
			return $before_excerpt.$excerpt.$after_excerpt;
		}
		
			/*video function*/
			private static function getYoutubeID($url = ''){ //Youtube
				$pattern = 
					'%^# Match any youtube URL
					(?:https?://)?  # Optional scheme. Either http or https
					(?:www\.)?      # Optional www subdomain
					(?:             # Group host alternatives
					  youtu\.be/    # Either youtu.be,
					| youtube\.com  # or youtube.com
					  (?:           # Group path alternatives
						/embed/     # Either /embed/
					  | /v/         # or /v/
					  | /watch\?v=  # or /watch\?v=
					  )             # End path alternatives.
					)               # End host alternatives.
					([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
					$%x'
					;
				$result = preg_match($pattern, trim($url), $matches);
				if($result){
					return $matches[1];
				}
				return '';
			}
			
			private static function getVimeoID($url = ''){ //Vimeo
				$result = preg_match("/(?:https?:\/\/)?(?:www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/", trim($url), $matches);
				if($result){		
					return $matches[3];
				}
				return '';
			}
			
			private static function getDailymotionID($url = ''){ //Dailymotion
				$id = strtok(basename(trim($url)), '_');
				if(!empty($id)){
					return $id;
				}
				return '';
			}
			
			private static function getTwitchID($url = ''){ //Twitch
				$split_url = explode('/', trim($url));
				if(count($split_url)>0){
					$count = count($split_url)-1;
					if(strpos($url, '/v/')){					
						return '<iframe src="https://player.twitch.tv/?video=v'.$split_url[$count].'" frameborder="0" scrolling="no"></iframe>';
					}else{					
						return '<iframe src="https://player.twitch.tv/?channel='.$split_url[$count].'" frameborder="0" scrolling="no"></iframe>';
					}
				}
				return '';
			}
			
			private static function createVideoIframe($post_id = 0, $url = ''){
				
				if($post_id == 0){
					$post_id = get_the_ID();
				}
				
				$iframe = '';
				$iframe_json = array();
				if(strpos($url, 'youtube.com') || strpos($url, 'youtu.be')){
					if(self::getYoutubeID($url)==''){
						return '';
					}
					$iframe='<div class="ultimate-layouts-video-wrapper"><iframe src="//www.youtube.com/embed/'.self::getYoutubeID($url).'?autoplay=1" frameborder="0" allowfullscreen></iframe></div>';
				}elseif(strpos($url, 'vimeo.com')){
					if(self::getVimeoID($url)==''){
						return '';
					}
					$iframe='<div class="ultimate-layouts-video-wrapper"><iframe src="//player.vimeo.com/video/'.self::getVimeoID($url).'?autoplay=1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
				}elseif(strpos($url, 'dailymotion.com') || strpos($url, 'dai.ly')){
					if(self::getDailymotionID($url)==''){
						return '';
					}
					$iframe='<div class="ultimate-layouts-video-wrapper"><iframe frameborder="0" src="//www.dailymotion.com/embed/video/'.self::getDailymotionID($url).'?autoplay=1" allowfullscreen></iframe></div>';
				}elseif(strpos($url, 'facebook.com')){
					$iframe='<div id="fb-root"></div><div class="ultimate-layouts-video-wrapper"><div class="fb-video" data-href="'.$url.'" data-width="500" data-allowfullscreen="true" data-autoplay="true"></div></div>';
				}elseif(strpos($url, 'twitch.tv')){	
					$iframe='<div class="ultimate-layouts-video-wrapper">'.self::getTwitchID($url).'</div>';
				}elseif(strpos($url, '.mp4') || strpos($url, '.ogv') || strpos($url, '.webm')){		
					$mp4 = '';
					if(strpos($url, '.mp4')){
						$mp4=' mp4="'.$url.'"';
					}
					$ogv = '';
					if(strpos($url, '.ogv')){
						$ogv=' ogv="'.$url.'"';
					}
					$webm = '';
					if(strpos($url, '.webm')){
						$webm=' webm="'.$url.'"';
					}
					$poster='';
					if(has_post_thumbnail($post_id) && $imgsource = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), '1200x675_ul_grid_16_9_3x')){
						$poster = ' poster="'.$imgsource[0].'"';
					}
					$iframe=do_shortcode('<div class="ultimate-layouts-video-wrapper">[video'.$mp4.$ogv.$webm.$poster.' autoplay="on"]</div>');
				}elseif(strpos($url, '.mp3') || strpos($url, '.m4a') || strpos($url, '.ogg') || strpos($url, '.wav') || strpos($url, '.wma')){
					$mp3 = '';
					if(strpos($url, '.mp3')){
						$mp3=' mp3="'.$url.'"';
					}
					
					$m4a = '';
					if(strpos($url, '.m4a')){
						$m4a=' m4a="'.$url.'"';
					}
					
					$ogg = '';
					if(strpos($url, '.ogg')){
						$ogg=' ogg="'.$url.'"';
					}
					
					$wav = '';
					if(strpos($url, '.wav')){
						$wav=' wav="'.$url.'"';
					}
					
					$wma = '';
					if(strpos($url, '.wma')){
						$wma=' wma="'.$url.'"';
					}
					
					$poster='';
					if(has_post_thumbnail($post_id) && $imgsource = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), '1200x675_ul_grid_16_9_3x')){
						$poster = ' style="background-image: url('.$imgsource[0].')"';
					}
					$iframe=do_shortcode('<div class="ultimate-layouts-video-wrapper ultimate-layouts-audio-wrapper"><span class="ultimate-layouts-audio-bg"'.$poster.'></span>[audio'.$mp3.$m4a.$ogg.$wav.$wma.' autoplay="1"]</div>');
				}elseif(strpos($url, '//api.soundcloud.com/') || strpos($url, '//soundcloud.com/')){
					$iframe='<div class="ultimate-layouts-video-wrapper ultimate-layouts-soundcloud-wrapper"><iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.urlencode($url).'&amp;auto_play=true&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe></div>';
				}else{
					return '';
				}
								
				array_push($iframe_json, $iframe);				
				return json_encode($iframe_json);
			}
			/*video function*/
		
		//Hover Icon
		static function ultimateLayouts_hover_icon($post_id = 0, $icon_video = false, $video_url_meta = array(false, '_ultimate_layouts_video_link'), $meta_video = '', $icon_image = true, $icon_link = true, $link_target = false, $quick_view = true, $quick_view_mode = false, $rnd_id = '', $ext_class = ''){

			if($post_id == 0){
				$post_id = get_the_ID();
			}
			
			$before_lightbox 	= '<div class="ultimate-layouts-control-pop '.$ext_class.'">';
			$content_lightbox	= '';
			$after_lightbox 	= '</div>';
			
			//$post_format 		= get_post_format($post_id);
			if($video_url_meta[0]==true && $video_url_meta[1]!=''){
				$url 				= get_post_meta($post_id, $video_url_meta[1], true);
			}else{
				$url 				= get_post_meta($post_id, '_ultimate_layouts_video_link', true);
			}
			$iframe_video		= self::createVideoIframe($post_id, $url);
			
			if($icon_video /*&& $post_format=='video'*/ && !empty($iframe_video) && $iframe_video!=''){								
				$content_lightbox	.= 	'<span data-type="video" 
											data-source="'.esc_attr($rnd_id.$post_id).'" 
											data-caption="'.esc_attr(strip_tags(get_the_title())).'" 
											class="ultimate-layouts-icon-video ultimate-layouts-control-lightbox-oc"
									  	>';
				$content_lightbox	.= 		'<script>
												if(typeof(ultimate_layouts_video_source)=="undefined"){var ultimate_layouts_video_source=[];}; 
												ultimate_layouts_video_source["'.esc_attr($rnd_id.$post_id).'"]='.$iframe_video.';
											</script>';
                $content_lightbox	.= '</span>';
			}
			
			if($icon_image && ($iframe_video=='' || $icon_video==false)){
				$content_lightbox	.='<span data-type="image" 
										data-source="'.esc_attr(wp_get_attachment_image_url(get_post_thumbnail_id($post_id), 'full')).'" 
										data-caption="'.esc_attr(strip_tags(get_the_title())).'" 
										class="ultimate-layouts-icon-lightbox ultimate-layouts-control-lightbox-oc"
									  >';
				$content_lightbox	.=	'<span><span></span><span></span></span>';
				$content_lightbox	.='</span>';
			}			
			
			if($icon_link){
				$html_link_target 	= ($link_target==true)?'target="_blank"':'';
				$get_permalink		= esc_url(get_permalink($post_id));
				$attr_open_post	= '';
				if($quick_view){
					$get_permalink		= 'javascript:;';
					$attr_open_post	= 'data-open-post="ultimate-layouts-quick-view"';
				}
				$content_lightbox	.='<a '.$attr_open_post.' data-post-id="'.esc_attr($post_id).'" href="'.$get_permalink.'" title="'.esc_attr(the_title_attribute(array('echo'=>0))).'" '.$html_link_target.' class="ultimate-layouts-icon-link">';
				$content_lightbox	.=	'<i class="fa fa-link"></i>';
				$content_lightbox	.=	'<i class="fa fa-chain-broken"></i>';
				$content_lightbox	.='</a>';
			}
			
			return $before_lightbox.$content_lightbox.$after_lightbox;
		}
		
		//Overlay
		//Taxonomy
		static function ultimateLayouts_overlay($post_id = 0, $show = true, $taxonomies, $settings, $static_color, $ext_class = ''){
			if(!$show){
				return '';
			}
			
			if($post_id == 0){
				$post_id = get_the_ID();
			}
			
			$background_color = '';
			
			if($settings){
				$new_multi_taxonomies 		= explode(',', $taxonomies);
				$new_multi_taxonomies_array	= array();
				
				foreach ($new_multi_taxonomies as $new_multi_taxonomies_item) {						
					array_push($new_multi_taxonomies_array, trim($new_multi_taxonomies_item));
				}
				
				if(is_array($new_multi_taxonomies_array)){
					$taxonomies = $new_multi_taxonomies_array;
				}
				
				$taxonomies_listing = wp_get_post_terms($post_id, $taxonomies, array('fields' => 'all'));
				
				if(!is_wp_error($taxonomies_listing)&&!empty($taxonomies_listing)){	
					$taxonomy_item = $taxonomies_listing[0];
					if(!is_wp_error($taxonomy_item)&&!empty($taxonomy_item)){
						$item_background_color = get_option('ultimate_layouts_background_color_'.$taxonomy_item->term_id)?'background-color:#'.get_option('ultimate_layouts_background_color_'.$taxonomy_item->term_id).';':'';
						if($item_background_color!=''){
							$background_color = 'style="'.$item_background_color.'"';	
						}
					}		
				}
				
			}else{
				if($static_color!=''){
					$background_color = 'style="background-color:'.$static_color.' !important;"';
				}
			}
			
			return '<div class="ultimate-layouts-overlay '.$ext_class.'"><div '.$background_color.'></div></div>';
		}
		
		static private function my_get_highest_parent($id){
			$cat = get_category($id);
			$parent = $cat->parent;		
			if($parent == 0){
				//return $id;
				return true;
			}else{
				//my_get_highest_parent($parent);
				return false;
			}
		}
		
		//Taxonomy
		static function ultimateLayouts_taxonomy($post_id = 0, $show = true, $taxonomies, $link_target = false, $style = '0', $display_parent = false, $exclude_items = '', $color = '0', $text_color ='', $bg_color = '', $ext_class = ''){
			
			if(!$show){
				return '';
			}
			
			if($post_id == 0){
				$post_id = get_the_ID();
			}
			
			$style_cat = '';
			if($style!='0'){
				$style_cat = ' ul-style-cat-'.$style;
			}
			
			$before_taxonomy 		= '<div class="ultimate-layouts-categories '.$ext_class.$style_cat.'">';
			$content_taxonomy		= '';
			$after_taxonomy 		= '</div>';
			
			$new_multi_taxonomies 		= explode(',', $taxonomies);
			$new_multi_taxonomies_array	= array();
			
			foreach ($new_multi_taxonomies as $new_multi_taxonomies_item) {						
				array_push($new_multi_taxonomies_array, trim($new_multi_taxonomies_item));
			}
			
			if(is_array($new_multi_taxonomies_array)){
				$taxonomies = $new_multi_taxonomies_array;
				if($exclude_items!=''){
					$exclude_array = explode(',', $exclude_items);
					$new_exclude_array = array();
					foreach ($exclude_array as $item) {						
						array_push($new_exclude_array, trim($item));
					}
					if(is_array($new_exclude_array)){
						$taxonomies = array_values(array_diff($taxonomies, $new_exclude_array));
					}
				}
			}
						
			$taxonomies_listing = wp_get_post_terms($post_id, $taxonomies, array('fields' => 'all'));
						
			if(!is_wp_error($taxonomies_listing)&&!empty($taxonomies_listing)){	
				$html_link_target 	= ($link_target==true)?'target="_blank"':'';		
				foreach($taxonomies_listing as $taxonomy_item){
					$id = $taxonomy_item->term_id;						
					$item_name 				= ($taxonomy_item->name);
					$item_color				= get_option('ultimate_layouts_color_'.$taxonomy_item->term_id)?'color:#'.get_option('ultimate_layouts_color_'.$taxonomy_item->term_id).';':'';
					$item_background_color 	= get_option('ultimate_layouts_background_color_'.$taxonomy_item->term_id)?'background-color:#'.get_option('ultimate_layouts_background_color_'.$taxonomy_item->term_id).';':'';
					$term_color				= '';
					
					if(($item_color!='' || $item_background_color!='') && $color=='0'){
						$term_color='style="'.$item_color.$item_background_color.'"';
					}elseif($color=='1'){
						$item_color				= $text_color!=''?'color:'.$text_color.';':'';
						$item_background_color 	= $bg_color!=''?'background-color:'.$bg_color.';':'';
						if($item_color!='' || $item_background_color!=''){
							$term_color='style="'.$item_color.$item_background_color.'"';
						}
					}
					
					$link_opt = '';
					
					if(trim(get_option('ultimate_layouts_cat_link'))=='1'){
						$link_opt = 'href="javascript:;"';
					}else{
						$link_opt = 'href="'.esc_url(get_term_link($taxonomy_item)).'"';
					}
					
					if($display_parent==true){	
						if(self::my_get_highest_parent($id)){
							$content_taxonomy.= '<a '.$link_opt.' title="'.esc_attr($item_name).'" '.$html_link_target.' '.$term_color.' class="ul-taxonomy '.$taxonomy_item->taxonomy.' '.$taxonomy_item->slug.'">'.esc_html($item_name).'</a>';	
						}
					}else{
						$content_taxonomy.= '<a '.$link_opt.' title="'.esc_attr($item_name).'" '.$html_link_target.' '.$term_color.' class="ul-taxonomy '.$taxonomy_item->taxonomy.' '.$taxonomy_item->slug.'">'.esc_html($item_name).'</a>';
					}
				}
			}else{
				return '';
			}
			
			return $before_taxonomy.$content_taxonomy.$after_taxonomy;
		}
		
		private static function get_custom_meta($post_id = 0, $custom_meta = '', $block = false){
			$content_meta	='';
			
			if($custom_meta!=''){				
				if($post_id == 0){
					$post_id = get_the_ID();
				}
							
				$class_float_left='';
				$class_float_right='';				
				if($block){
					$class_float_left='class="flt-left"';
					$class_float_right='class="flt-right"';
				}
				
				$custom_meta_items 		= explode(',', trim($custom_meta));
				foreach ($custom_meta_items as $custom_meta_item) {						
					if($custom_meta_item!=''){
						$custom_meta_data = explode('|', trim($custom_meta_item));
						if(count($custom_meta_data)==1){
							$meta_key = trim($custom_meta_data[0]);
							
							if(function_exists('pvc_get_post_views') && $meta_key=='post_views_counter_support'){
								$meta = apply_filters('ultimate_layouts_number_format', pvc_get_post_views($post_id));
							}else{
								$meta = apply_filters('ultimate_layouts_number_format', get_post_meta($post_id, $meta_key, true));
							}
							
							if(!is_wp_error($meta)&&!empty($meta)){
								$content_meta .='<div '.$class_float_left.'><span>'.$meta.'</span></div>';
							}
						}elseif(count($custom_meta_data)==2){
							$meta_key = trim($custom_meta_data[1]);
							
							if(function_exists('pvc_get_post_views') && $meta_key=='post_views_counter_support'){
								$meta = apply_filters('ultimate_layouts_number_format', pvc_get_post_views($post_id));
							}else{
								$meta = apply_filters('ultimate_layouts_number_format', get_post_meta($post_id, $meta_key, true));
							}
							
							if(!is_wp_error($meta)&&!empty($meta)){
								$content_meta .='<div '.$class_float_left.'><i class="'.trim($custom_meta_data[0]).'" aria-hidden="true"></i> <span>'.$meta.'</span></div>';
							}
						}
					}
				}
				
			}
			return $content_meta;
		}
		
		static function get_social_share($post_id = 0, $share_list = array()){
			if(count($share_list)==0){
				return;
			}			
			if($post_id == 0){
				$post_id = get_the_ID();
			}
			
			$before_share = '<div class="ultimate-layouts-social-share">';
			$content_share = '';
			$after_share = '</div>';
			
			$title 		= urlencode(html_entity_decode(get_the_title($post_id), ENT_COMPAT, 'UTF-8'));
			$picture 	= urlencode(wp_get_attachment_url( get_post_thumbnail_id($post_id)));
			$link		= urlencode(get_permalink($post_id));
			$blog_info	= urlencode(get_bloginfo('name'));
			
			if(isset($share_list['facebook']) && $share_list['facebook']==true){	
				$onclick 		= "window.open('https://www.facebook.com/sharer/sharer.php?u=".$link."','facebook-share-dialog','width=600,height=400');return false;";
				$content_share .='<div class="ultimate-layouts-share-item ul-facebook">';
				$content_share .=	'<a title="'.esc_attr__('Share on Facebook', 'ultimate_layouts').'" href="javascript:;" target="_blank" rel="nofollow" onclick="'.$onclick.'">';
				$content_share .=		'<i class="fa fa-facebook"></i>';
				$content_share .=	'</a>';
				$content_share .='</div>';			
			}
			if(isset($share_list['twitter']) && $share_list['twitter']==true){
				$onclick 		="window.open('http://twitter.com/share?text=".$title."&amp;url=".$link."','twitter-share-dialog','width=600,height=400');return false;";
				$content_share .='<div class="ultimate-layouts-share-item ul-twitter">';
				$content_share .=	'<a title="'.esc_attr__('Share on Twitter', 'ultimate_layouts').'" href="javascript:;" target="_blank" rel="nofollow" onclick="'.$onclick.'">';
				$content_share .=		'<i class="fa fa-twitter"></i>';
				$content_share .=	'</a>';
				$content_share .='</div>';
			}
			if(isset($share_list['google']) && $share_list['google']==true){
				$onclick 		="window.open('https://plus.google.com/share?url=".$link."','googleplus-share-dialog','width=600,height=400');return false;";
				$content_share .='<div class="ultimate-layouts-share-item ul-google">';
				$content_share .=	'<a title="'.esc_attr__('Share on Google Plus', 'ultimate_layouts').'" href="javascript:;" target="_blank" rel="nofollow" onclick="'.$onclick.'">';
				$content_share .=		'<i class="fa fa-google-plus"></i>';
				$content_share .=	'</a>';
				$content_share .='</div>';
			}
			if(isset($share_list['linkedIn']) && $share_list['linkedIn']==true){
				$onclick 		= "window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=".$link."&amp;title=".$title."&amp;source=".$blog_info."','linkedin-share-dialog','width=600,height=400');return false;";
				$content_share .='<div class="ultimate-layouts-share-item ul-linkedin">';
				$content_share .=	'<a title="'.esc_attr__('Share on LinkedIn', 'ultimate_layouts').'" href="javascript:;" target="_blank" rel="nofollow" onclick="'.$onclick.'">';
				$content_share .=		'<i class="fa fa-linkedin"></i>';
				$content_share .=	'</a>';
				$content_share .='</div>';
			}
			if(isset($share_list['tumblr']) && $share_list['tumblr']==true){
				$onclick 		="window.open('http://www.tumblr.com/share/link?url=".$link."&amp;name=".$title."','tumblr-share-dialog','width=600,height=400');return false;";
				$content_share .='<div class="ultimate-layouts-share-item ul-tumblr">';
				$content_share .=	'<a title="'.esc_attr__('Share on Tumblr', 'ultimate_layouts').'" href="javascript:;" target="_blank" rel="nofollow" onclick="'.$onclick.'">';
				$content_share .=		'<i class="fa fa-tumblr"></i>';
				$content_share .=	'</a>';
				$content_share .='</div>';
			}			
			if(isset($share_list['pinterest']) && $share_list['pinterest']==true){
				$onclick 		="window.open('//pinterest.com/pin/create/button/?url=".$link."&amp;media=".$picture."&amp;description=".$title."','pin-share-dialog','width=600,height=400');return false;";
				$content_share .='<div class="ultimate-layouts-share-item ul-pinterest">';
				$content_share .=	'<a title="'.esc_attr__('Pin this', 'ultimate_layouts').'" href="javascript:;" target="_blank" rel="nofollow" onclick="'.$onclick.'">';
				$content_share .=		'<i class="fa fa-pinterest"></i>';
				$content_share .=	'</a>';
				$content_share .='</div>';
			}
			if(isset($share_list['vk']) && $share_list['vk']==true){
				$onclick 		="window.open('//vkontakte.ru/share.php?url=".$link."','vk-share-dialog','width=600,height=400');return false;";
				$content_share .='<div class="ultimate-layouts-share-item ul-vk">';
				$content_share .=	'<a title="'.esc_attr__('Share on VK', 'ultimate_layouts').'" href="javascript:;" target="_blank" rel="nofollow" onclick="'.$onclick.'">';
				$content_share .=		'<i class="fa fa-vk"></i>';
				$content_share .=	'</a>';
				$content_share .='</div>';
			}
			if(isset($share_list['email']) && $share_list['email']==true){
				$onclick 		= "mailto:?subject=".$title."&amp;body=".$link."";
				$content_share .='<div class="ultimate-layouts-share-item ul-email">';
				$content_share .=	'<a title="'.esc_attr__('Email this', 'ultimate_layouts').'" href="'.$onclick.'">';
				$content_share .=		'<i class="fa fa-envelope"></i>';
				$content_share .=	'</a>';
				$content_share .='</div>';
			}
			
			return $before_share.$content_share.$after_share;
		}
		
		//Timeline Time
		static function ultimateLayouts_post_time($post_id = 0, $format = 'F j, Y'){
			if($post_id == 0){
				$post_id = get_the_ID();
			}
			return '<span class="ultimate-layouts-timeline-data"><span>'.esc_html(date_i18n($format, get_the_time('U', $post_id))).'</span></span>';
		}
		
		//Post Meta Style 1
		static function ultimateLayouts_metas_1($post_id = 0, $show = true, $user = true, $avatar = false, $time = array(true, 'F j, Y'), $comment = true, $like = false, $share=false, $custom_meta = '', $share_text = '', $author_text = '', $ext_class = ''){
			if(!$show){
				return '';
			}
			if($post_id == 0){
				$post_id = get_the_ID();
			}
			
			$before_meta 	= '<div class="ultimate-layouts-metas posted-on '.$ext_class.'"><div class="ultimate-layouts-metas-wrap">';
			$content_meta	='';
			$after_meta 	= '</div></div>';
			
			if($user){
				$str_avatar = '<i class="fa fa-user" aria-hidden="true"></i>';
				$class_avatar = '';
				if($avatar==true){
					$str_avatar = '<span class="ul-author-avatar"'.$class_avatar.'>'.get_avatar(get_post_field('post_author', $post_id), 100 ).'</span>';
					$class_avatar = ' data-author-ava="1"';
				}
				if($author_text!=''){
					$str_avatar = '<span>'.$author_text.'</span> ';
				}
				$content_meta	.='<div data-class="ul-author-metas">'.$str_avatar.' <span>'.esc_html(get_the_author()).'</span></div>';
			}
			if($time[0]){
				$content_meta	.='<div data-class="ul-time-metas"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <span>'.esc_html(date_i18n($time[1], get_the_time('U', $post_id))).'</span></div>';
			}
			if($comment){
				$content_meta	.='<div data-class="ul-comment-metas"><i class="fa fa-commenting" aria-hidden="true"></i> <span>'.esc_html(apply_filters('ultimate_layouts_number_format', get_comments_number($post_id))).'</span></div>';
			}
			$content_meta		.=self::get_custom_meta($post_id, $custom_meta, false);
			if($like && function_exists('ldc_like_counter_p')){
				$content_meta	.='<div data-class="ul-likes-metas">'.ldc_like_counter_p('', $post_id).'</div>';
			}else{			
				if($like && class_exists('Kodex_Posts_Likes_Public')){
					$content_meta	.='<div data-class="ul-likes-metas">'.do_shortcode('[kodex_post_like_buttons postid="'.$post_id.'"]').'</div>';
				}	
			}
			if($share){
				$social_share	 = self::get_social_share($post_id, array('facebook'=>true, 'twitter'=>true, 'google'=>true, 'linkedIn'=>true, 'tumblr'=>true, 'pinterest'=>true, 'vk'=>true, 'email'=>true,));
				$txt_share_text	 = $share_text!=''?$share_text:__('Share', 'ultimate_layouts');
				$content_meta	.='<div data-action="share"><a href="javascript:;" title="'.$txt_share_text.'" class="ultimate-layouts-social-share-btn"><i class="fa fa-share-alt" aria-hidden="true"></i> <span>'.$txt_share_text.'</span></a>'.$social_share.'</div>';
			}
			
			return $before_meta.$content_meta.$after_meta;
		}
		
		static function ultimateLayouts_metas_2($post_id = 0, $show = true, $user = false, $avatar = false, $time = array(false, 'F j, Y'), $comment = false, $like = true, $share=true, $read_more = true, $link_target = false, $quick_view = true, $quick_view_mode = false, $custom_meta = '', $block = false, $share_text = '', $read_more_text = '', $author_text = '', $ext_class = ''){
			if(!$show){
				return '';
			}
			if($post_id == 0){
				$post_id = get_the_ID();
			}
			
			$class_float_left='';
			$class_float_right='';
			
			if($block){
				$class_float_left='class="flt-left"';
				$class_float_right='class="flt-right"';
			}
						
			$before_meta 	= '<div class="ultimate-layouts-metas-st2 posted-on '.$ext_class.'"><div class="ultimate-layouts-metas-wrap">';
			$content_meta	='';
			$after_meta 	= '</div></div>';
			
			if($like && function_exists('ldc_like_counter_p')){
				$content_meta	.='<div '.$class_float_left.' data-class="ul-likes-metas">'.ldc_like_counter_p('', $post_id).'</div>';
			}else{
				if($like && class_exists('Kodex_Posts_Likes_Public')){
					$content_meta	.='<div '.$class_float_left.' data-class="ul-likes-metas">'.do_shortcode('[kodex_post_like_buttons postid="'.$post_id.'"]').'</div>';
				}	
			}
			$content_meta		.=self::get_custom_meta($post_id, $custom_meta, true);
			if($share){
				$social_share	 = self::get_social_share($post_id, array('facebook'=>true, 'twitter'=>true, 'google'=>true, 'linkedIn'=>true, 'tumblr'=>true, 'pinterest'=>true, 'vk'=>true, 'email'=>true,));
				$txt_share_text	 = $share_text!=''?$share_text:__('Share', 'ultimate_layouts');
				$content_meta	.='<div '.$class_float_left.' data-action="share"><a href="javascript:;" title="'.$txt_share_text.'" class="ultimate-layouts-social-share-btn"><i class="fa fa-share-alt" aria-hidden="true"></i> <span>'.$txt_share_text.'</span></a>'.$social_share.'</div>';
			}			
			if($user){
				$str_avatar = '<i class="fa fa-user" aria-hidden="true"></i>';
				$class_avatar = '';
				if($avatar==true){
					$str_avatar = '<span class="ul-author-avatar">'.get_avatar(get_post_field('post_author', $post_id), 100 ).'</span>';
					$class_avatar = ' data-author-ava="1"';
				}
				if($author_text!=''){
					$str_avatar = '<span>'.$author_text.'</span> ';
				}
				$content_meta	.='<div '.$class_float_left.' data-class="ul-author-metas"'.$class_avatar.'>'.$str_avatar.' <span>'.esc_html(get_the_author()).'</span></div>';
			}
			if($time[0]){
				$content_meta	.='<div '.$class_float_left.' data-class="ul-time-metas"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <span>'.esc_html(date_i18n($time[1], get_the_time('U', $post_id))).'</span></div>';
			}
			if($comment){
				$content_meta	.='<div '.$class_float_left.' data-class="ul-comment-metas"><i class="fa fa-commenting" aria-hidden="true"></i> <span>'.esc_html(apply_filters('ultimate_layouts_number_format', get_comments_number($post_id))).'</span></div>';
			}		
			if($read_more){
				$html_link_target 	= ($link_target==true)?'target="_blank"':'';
				$get_permalink		= esc_url(get_permalink($post_id));
				$attr_open_post	= '';
				if($quick_view && $quick_view_mode){
					$get_permalink		= 'javascript:;';
					$attr_open_post	= 'data-open-post="ultimate-layouts-quick-view"';
				}
				$txt_read_more	 	= $read_more_text!=''?$read_more_text:__('Read More', 'ultimate_layouts');
				$content_meta		.='<div '.$class_float_right.'>
										<a '.$attr_open_post.' data-post-id="'.esc_attr($post_id).'" href="'.$get_permalink.'" title="'.esc_attr(the_title_attribute(array('echo'=>0))).'" '.$html_link_target.'  class="ultimate-layouts-readmore-link">
											<span>'.$txt_read_more.'</span>
											<i class="fa fa-angle-double-right ul-readmore-icon" aria-hidden="true"></i>
										</a>
									  </div>';
			}	
			
			return $before_meta.$content_meta.$after_meta;
		}
		
		static function woo_price($product, $show_price = true){
			if(!$show_price){
				return '';
			}
			
			$html_price 	= 	'';
			$html_price 	.= 	'<div class="ultimate-layouts-woo-price">';
			$html_price 	.= 		$product->get_price_html();
			$html_price 	.= 	'</div>';
			
			return $html_price;
		}
		
		static function woo_rating($product, $show_rating = true){
			if(!$show_rating){
				return '';
			}
			
			$rating = $product->get_average_rating();
			
			$rating_html 	= 	'';
			
			$rating_html 	.=	'<div class="ultimate-layouts-woo-rating">';		
			$rating_html 	.= 		'<div class="ultimate-layouts-woo-star" title="' . sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $rating) . '">';				
			$rating_html 	.= 			'<span class="ultimate-layouts-woo-star-rating" style="width:'.(( $rating / 5) * 100).'%"></span>';				
			$rating_html 	.= 		'</div>';
			$rating_html 	.= 	'</div>';
						
			return $rating_html;
		}
		
		static function woo_add_cart($product, $_get_post, $show_cart = true){
			if(!$show_cart){
				return '';
			}
			$html_cart 	= 	'';
			$html_cart .= 	'<div class="ultimate-layouts-woo-cart">';
			ob_start();
				woocommerce_template_loop_add_to_cart($_get_post, $product);
			$html_cart .= ob_get_clean();			
			$html_cart .= 	'</div>';
			return $html_cart;
		}
		
		static function woo_elm_basic($product, $_get_post, $show_price = true, $show_rating = true, $show_cart = true){
			$price_elm 	= self::woo_price($product, $show_price);
			$rating_elm = self::woo_rating($product, $show_rating);
			$cart_elm 	= self::woo_add_cart($product, $_get_post, $show_cart);
			
			if($price_elm!='' || $rating_elm!='' || $cart_elm!=''){
				$html_woo = '';
				$html_woo .= '<div class="ultimate-layouts-woo-element">';
				if($rating_elm!=''){
					$html_woo .=	'<div class="ultimate-layouts-woo-rating-block">
										'.$rating_elm.'
									</div>';
				}
				if($price_elm!='' || $cart_elm!=''){
					$html_woo .=	'<div class="ultimate-layouts-woo-price-cart-block">
										'.$price_elm.$cart_elm.'
									</div>';
				}
				$html_woo .= '</div>';
				
				return $html_woo;
			}else{
				return '';
			}
		}
		
		static function google_adsense($goo_ads_client = '', $goo_ads_id = '', $goo_ads_offset = '', $current_post = 0){
			if($goo_ads_client=='' || $goo_ads_id=='' || $goo_ads_offset==''){
				return '';
			}
			$html = '';
			$html.='<article class="ultimate-layouts-item hentry ul-google-adsense-each-post">';
			$html.=		'<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>';
			$html.=		'<ins class="adsbygoogle" style="display:block" data-ad-client="'.$goo_ads_client.'" data-ad-slot="'.$goo_ads_id.'" data-ad-format="auto"></ins>';
			$html.=		'<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
			$html.='</article>';
			
			$exp_offset = explode(',', trim($goo_ads_offset));
			foreach($exp_offset as $exp_offset_item){
				$current_offset = trim($exp_offset_item);
				if(!is_numeric($current_offset)){
					return '';
				}
				$current_offset = (int)$current_offset;
				if($current_post==$current_offset){
					return $html;
				}
			}			
		}
		
		static function ul_geodir_get_rating_stars($post_id = 0, $show_rating = true){			
			if($post_id == 0){
				$post_id = get_the_ID();
			}
			
			if($show_rating==false || get_post_type($post_id)!='gd_place' || !function_exists('geodir_get_rating_stars')){
				return '';
			}
			
			$post_avgratings = geodir_get_post_rating($post_id);
			
			return '<div class="ultimate_layouts_geodir_rating">'.geodir_get_rating_stars($post_avgratings, $post_id).'</div>';
		}
	}
}