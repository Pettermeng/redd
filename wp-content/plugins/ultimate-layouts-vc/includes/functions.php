<?php
//Extra fields
if(!function_exists('ultimate_layouts_extra_fields') && !function_exists('save_ultimate_layouts_extra_fields') && !function_exists('register_ultimate_layouts_extra_fields')){
	function ultimate_layouts_extra_fields($term_obj){
		$term_id 				= isset($term_obj->term_id)?$term_obj->term_id:'';
		$color 					= get_option("ultimate_layouts_color_$term_id")?get_option("ultimate_layouts_color_$term_id"):'';
		$background_color 		= get_option("ultimate_layouts_background_color_$term_id")?get_option("ultimate_layouts_background_color_$term_id"):'';
		?>
        <div class="form-field ultimate_layouts_extra_fields">          	
            <label for="ultimate_layouts_color"><?php echo __('TERM/CATEGORY COLOR [Ultimate Layouts]', 'ultimate_layouts'); ?></label>            
            <input type="text" id="ultimate_layouts_color" name="ultimate_layouts_color" value="<?php echo $color;?>" class="jscolor {required:false} jscolor-active" autocomplete="off">
            <p class="description"><?php echo __('Choose color of category, tag, taxonomy name on items', 'ultimate_layouts'); ?></p>            
        </div>
        <div class="form-field ultimate_layouts_extra_fields">
        	<label for="ultimate_layouts_background_color"><?php echo __('TERM/CATEGORY BACKGROUND COLOR [Ultimate Layouts]', 'ultimate_layouts'); ?></label>
            <input type="text" id="ultimate_layouts_background_color" name="ultimate_layouts_background_color" value="<?php echo $background_color;?>" class="jscolor {required:false} jscolor-active" autocomplete="off">
            <p class="description"><?php echo __('Choose background color of category, tag, taxonomy name on items', 'ultimate_layouts'); ?></p>            
        </div>
        <?php
	}
	
	function save_ultimate_layouts_extra_fields($term_id) {
		if(isset($_POST[sanitize_key('ultimate_layouts_color')])) {
			$color = $_POST['ultimate_layouts_color'];
			update_option( "ultimate_layouts_color_$term_id", $color);
		}
		
		if(isset($_POST[sanitize_key('ultimate_layouts_background_color')])) {
			$background_color = $_POST['ultimate_layouts_background_color'];
			update_option( "ultimate_layouts_background_color_$term_id", $background_color);
		}
	}
	
	function register_ultimate_layouts_extra_fields(){	
		$taxonomies_types = get_taxonomies();
		if(is_array($taxonomies_types)&&!empty($taxonomies_types)){
			foreach($taxonomies_types as $taxonomy){
				if($taxonomy!=='post_format'){
					add_action($taxonomy.'_add_form_fields', 'ultimate_layouts_extra_fields');
					add_action($taxonomy.'_edit_form_fields', 'ultimate_layouts_extra_fields');
					
					add_action('edited_'.$taxonomy, 'save_ultimate_layouts_extra_fields', 10, 2);
					add_action('created_'.$taxonomy, 'save_ultimate_layouts_extra_fields', 10, 2);
				}
			}
		}
	}
	
	add_action('init', 'register_ultimate_layouts_extra_fields', 9998);
}

//meta box video
if(!function_exists('ultimate_layouts_video_link') && !function_exists('ultimate_layouts_video_link_metabox') && !function_exists('ultimate_layouts_video_link_save')){
	function ultimate_layouts_video_link($post){
		$video_link = get_post_meta($post->ID, '_ultimate_layouts_video_link', true);
		
		$html_metabox = '';
		$html_metabox .='<div class="ul-metabox-wrapper">';
		$html_metabox .=	'<div class="elm-label"><label for="ultimate_layouts_video_link">'.esc_html__('Video URL', 'ultimate_layouts').':</label></div>';
		$html_metabox .=	'<div class="elm-fields">
								<textarea rows="5" cols="60" id="ultimate_layouts_video_link" name="ultimate_layouts_video_link">'.esc_html($video_link).'</textarea>
								<div class="elm-descriptions">'.
									wp_kses(__(
										'Paste the url from popular video sites like YouTube, Vimeo, Dailymotion, Facebook, Twitch, SoundCloud or your file upload (*.mp4, [audio]*.mp3).
										<br><br><strong>For example:</strong><br><br><code>https://www.youtube.com/watch?v=mecUiCoVNM0</code><br><code>https://youtu.be/pAaxxTSasWU</code><br><br><code>https://vimeo.com/channels/staffpicks/169993072</code><br><code>https://vimeo.com/167177444</code><br><br><code>http://www.dailymotion.com/video/x38rzz8_giant-snake-eats-security-guard_animals</code><br><br><code>https://www.twitch.tv/dotamajor/v/70986078</code><br><code>https://www.twitch.tv/dotamajor</code><br><br><code>https://www.facebook.com/leagueoflegends/videos/10157218236550556/</code><br><br><code>https://api.soundcloud.com/tracks/137693578</code><br><code>https://soundcloud.com/universalmusic/coldplay-the-hardest-part</code>', 'ultimate_layouts'), 
										array('br'=>array(), 'code'=>array(), 'strong'=>array())		
									)
								.'</div>
							</div>';	
		$html_metabox .='</div>';		
		echo $html_metabox;	
	}
	
	function ultimate_layouts_video_link_metabox(){
		$post_types = get_post_types(array());
		if(is_array($post_types) && !empty($post_types)){
			foreach ($post_types as $post_type){
				if($post_type!=='revision' && $post_type!=='nav_menu_item' && $post_type!=='attachment' && $post_type!=='ultimate_layouts_bt'){
					add_meta_box('ultimate_layouts_video_link_metabox', esc_html__('VIDEO Settings [Ultimate Layouts]', 'ultimate_layouts'), 'ultimate_layouts_video_link', $post_type);
				}
			}
		}
	}
	add_action('add_meta_boxes', 'ultimate_layouts_video_link_metabox');
	
	function ultimate_layouts_video_link_save($post_id){
		if(!isset($_POST['ultimate_layouts_video_link'])){
			return;
		}
		$video_link = sanitize_text_field(trim($_POST['ultimate_layouts_video_link']));
		update_post_meta($post_id, '_ultimate_layouts_video_link', $video_link);
	}
	add_action('save_post', 'ultimate_layouts_video_link_save');	
}

//custom css function
if(!function_exists('ultimate_layouts_parse_custom_css') && !function_exists('ultimate_layouts_startsWith') && !function_exists('ultimate_layouts_get_google_font_name') && !function_exists('ultimate_layouts_create_css_custom_font')){
	
	function ultimate_layouts_startsWith($haystack, $needle){
		return !strncmp($haystack, $needle, strlen($needle));
	}

	function ultimate_layouts_get_google_font_name($family_name){
		$name = $family_name;
		if(ultimate_layouts_startsWith($family_name, 'http')){
			$idx = strpos($name,'=');
			if($idx > -1){
				$name = substr($name, $idx);
			}
		}
		$idx = strpos($name,':');
		if($idx > -1){
			$name = substr($name, 0, $idx);
			$name = str_replace('+',' ', $name);
		}
		return $name;
	}
	
	function ultimate_layouts_create_css_custom_font($font, $font_size, $letter_spacing, $font_weight, $font_style, $text_transform, $line_height){	
		$font_css='';	
		if($font!=''){
			$font_css.='font-family:"'.ultimate_layouts_get_google_font_name($font).'" !important;';
		}
		if($font_size!=''){
			$font_css.='font-size:'.$font_size.' !important;';
		}
		if($letter_spacing!=''){
			$font_css.='letter-spacing:'.$letter_spacing.' !important;';
		}
		if($font_weight!='' && $font_weight!='default'){
			$font_css.='font-weight:'.$font_weight.' !important;';
		}
		if($font_style!='' && $font_style!='default'){
			$font_css.='font-style:'.$font_style.' !important;';
		}
		if($text_transform!='' && $text_transform!='default'){
			$font_css.='text-transform:'.$text_transform.' !important;';
		}
		if($line_height!=''){
			$font_css.='line-height:'.$line_height.' !important;';
		}		
		return $font_css;
	}
	
	function ultimate_layouts_custom_font($params){
		if(!isset($params) || empty($params) || !is_array($params)){
			return;
		}
		
		$customCSS='';
		
		$title_font					= (isset($params['title_font'])&&trim($params['title_font'])!='')?trim($params['title_font']):'';
		$title_font_size			= (isset($params['title_font_size'])&&trim($params['title_font_size'])!='')?trim($params['title_font_size']):'';
		$title_letter_spacing		= (isset($params['title_letter_spacing'])&&trim($params['title_letter_spacing'])!='')?trim($params['title_letter_spacing']):'';
		$title_font_weight			= (isset($params['title_font_weight'])&&trim($params['title_font_weight'])!='')?trim($params['title_font_weight']):'';
		$title_font_style			= (isset($params['title_font_style'])&&trim($params['title_font_style'])!='')?trim($params['title_font_style']):'';
		$title_text_transform		= (isset($params['title_text_transform'])&&trim($params['title_text_transform'])!='')?trim($params['title_text_transform']):'';
		$title_line_height			= (isset($params['title_line_height'])&&trim($params['title_line_height'])!='')?trim($params['title_line_height']):'';
		
		$qv_title_font_size			= (isset($params['qv_title_font_size'])&&trim($params['qv_title_font_size'])!='')?trim($params['qv_title_font_size']):'';
		$qv_title_letter_spacing	= (isset($params['qv_title_letter_spacing'])&&trim($params['qv_title_letter_spacing'])!='')?trim($params['qv_title_letter_spacing']):'';
		$qv_title_font_weight		= (isset($params['qv_title_font_weight'])&&trim($params['qv_title_font_weight'])!='')?trim($params['qv_title_font_weight']):'';
		$qv_title_font_style		= (isset($params['qv_title_font_style'])&&trim($params['qv_title_font_style'])!='')?trim($params['qv_title_font_style']):'';
		$qv_title_text_transform	= (isset($params['qv_title_text_transform'])&&trim($params['qv_title_text_transform'])!='')?trim($params['qv_title_text_transform']):'';
		$qv_title_line_height		= (isset($params['qv_title_line_height'])&&trim($params['qv_title_line_height'])!='')?trim($params['qv_title_line_height']):'';
		
		$metas_font					= (isset($params['metas_font'])&&trim($params['metas_font'])!='')?trim($params['metas_font']):'';
		$metas_font_size			= (isset($params['metas_font_size'])&&trim($params['metas_font_size'])!='')?trim($params['metas_font_size']):'';
		$metas_letter_spacing		= (isset($params['metas_letter_spacing'])&&trim($params['metas_letter_spacing'])!='')?trim($params['metas_letter_spacing']):'';
		$metas_font_weight			= (isset($params['metas_font_weight'])&&trim($params['metas_font_weight'])!='')?trim($params['metas_font_weight']):'';
		$metas_font_style			= (isset($params['metas_font_style'])&&trim($params['metas_font_style'])!='')?trim($params['metas_font_style']):'';
		$metas_text_transform		= (isset($params['metas_text_transform'])&&trim($params['metas_text_transform'])!='')?trim($params['metas_text_transform']):'';
		$metas_line_height			= (isset($params['metas_line_height'])&&trim($params['metas_line_height'])!='')?trim($params['metas_line_height']):'';
		
		$excerpt_font				= (isset($params['excerpt_font'])&&trim($params['excerpt_font'])!='')?trim($params['excerpt_font']):'';
		$excerpt_font_size			= (isset($params['excerpt_font_size'])&&trim($params['excerpt_font_size'])!='')?trim($params['excerpt_font_size']):'';
		$excerpt_letter_spacing		= (isset($params['excerpt_letter_spacing'])&&trim($params['excerpt_letter_spacing'])!='')?trim($params['excerpt_letter_spacing']):'';
		$excerpt_font_weight		= (isset($params['excerpt_font_weight'])&&trim($params['excerpt_font_weight'])!='')?trim($params['excerpt_font_weight']):'';
		$excerpt_font_style			= (isset($params['excerpt_font_style'])&&trim($params['excerpt_font_style'])!='')?trim($params['excerpt_font_style']):'';
		$excerpt_text_transform		= (isset($params['excerpt_text_transform'])&&trim($params['excerpt_text_transform'])!='')?trim($params['excerpt_text_transform']):'';
		$excerpt_line_height		= (isset($params['excerpt_line_height'])&&trim($params['excerpt_line_height'])!='')?trim($params['excerpt_line_height']):'';
		
		$filter_font				= (isset($params['filter_font'])&&trim($params['filter_font'])!='')?trim($params['filter_font']):'';
		$filter_font_size			= (isset($params['filter_font_size'])&&trim($params['filter_font_size'])!='')?trim($params['filter_font_size']):'';
		$filter_letter_spacing		= (isset($params['filter_letter_spacing'])&&trim($params['filter_letter_spacing'])!='')?trim($params['filter_letter_spacing']):'';
		$filter_font_weight			= (isset($params['filter_font_weight'])&&trim($params['filter_font_weight'])!='')?trim($params['filter_font_weight']):'';
		$filter_font_style			= (isset($params['filter_font_style'])&&trim($params['filter_font_style'])!='')?trim($params['filter_font_style']):'';
		$filter_text_transform		= (isset($params['filter_text_transform'])&&trim($params['filter_text_transform'])!='')?trim($params['filter_text_transform']):'';
		$filter_line_height			= (isset($params['filter_line_height'])&&trim($params['filter_line_height'])!='')?trim($params['filter_line_height']):'';
		
		$tab_font					= (isset($params['tab_font'])&&trim($params['tab_font'])!='')?trim($params['tab_font']):'';
		$tab_font_size				= (isset($params['tab_font_size'])&&trim($params['tab_font_size'])!='')?trim($params['tab_font_size']):'';
		$tab_letter_spacing			= (isset($params['tab_letter_spacing'])&&trim($params['tab_letter_spacing'])!='')?trim($params['tab_letter_spacing']):'';
		$tab_font_weight			= (isset($params['tab_font_weight'])&&trim($params['tab_font_weight'])!='')?trim($params['tab_font_weight']):'';
		$tab_font_style				= (isset($params['tab_font_style'])&&trim($params['tab_font_style'])!='')?trim($params['tab_font_style']):'';
		$tab_text_transform			= (isset($params['tab_text_transform'])&&trim($params['tab_text_transform'])!='')?trim($params['tab_text_transform']):'';
		$tab_line_height			= (isset($params['tab_line_height'])&&trim($params['tab_line_height'])!='')?trim($params['tab_line_height']):'';
		
		$pagination_font			= (isset($params['pagination_font'])&&trim($params['pagination_font'])!='')?trim($params['pagination_font']):'';
		$pagination_font_size		= (isset($params['pagination_font_size'])&&trim($params['pagination_font_size'])!='')?trim($params['pagination_font_size']):'';
		$pagination_letter_spacing	= (isset($params['pagination_letter_spacing'])&&trim($params['pagination_letter_spacing'])!='')?trim($params['pagination_letter_spacing']):'';
		$pagination_font_weight		= (isset($params['pagination_font_weight'])&&trim($params['pagination_font_weight'])!='')?trim($params['pagination_font_weight']):'';
		$pagination_font_style		= (isset($params['pagination_font_style'])&&trim($params['pagination_font_style'])!='')?trim($params['pagination_font_style']):'';
		$pagination_text_transform	= (isset($params['pagination_text_transform'])&&trim($params['pagination_text_transform'])!='')?trim($params['pagination_text_transform']):'';
		$pagination_line_height		= (isset($params['pagination_line_height'])&&trim($params['pagination_line_height'])!='')?trim($params['pagination_line_height']):'';
		
		$price_font					= (isset($params['price_font'])&&trim($params['price_font'])!='')?trim($params['price_font']):'';
		$price_font_size			= (isset($params['price_font_size'])&&trim($params['price_font_size'])!='')?trim($params['price_font_size']):'';
		$price_letter_spacing		= (isset($params['price_letter_spacing'])&&trim($params['price_letter_spacing'])!='')?trim($params['price_letter_spacing']):'';
		$price_font_weight			= (isset($params['price_font_weight'])&&trim($params['price_font_weight'])!='')?trim($params['price_font_weight']):'';
		$price_font_style			= (isset($params['price_font_style'])&&trim($params['price_font_style'])!='')?trim($params['price_font_style']):'';
		$price_text_transform		= (isset($params['price_text_transform'])&&trim($params['price_text_transform'])!='')?trim($params['price_text_transform']):'';
		$price_line_height			= (isset($params['price_line_height'])&&trim($params['price_line_height'])!='')?trim($params['price_line_height']):'';
		
		$atcb_font					= (isset($params['atcb_font'])&&trim($params['atcb_font'])!='')?trim($params['atcb_font']):'';
		$atcb_font_size				= (isset($params['atcb_font_size'])&&trim($params['atcb_font_size'])!='')?trim($params['atcb_font_size']):'';
		$atcb_letter_spacing		= (isset($params['atcb_letter_spacing'])&&trim($params['atcb_letter_spacing'])!='')?trim($params['atcb_letter_spacing']):'';
		$atcb_font_weight			= (isset($params['atcb_font_weight'])&&trim($params['atcb_font_weight'])!='')?trim($params['atcb_font_weight']):'';
		$atcb_font_style			= (isset($params['atcb_font_style'])&&trim($params['atcb_font_style'])!='')?trim($params['atcb_font_style']):'';
		$atcb_text_transform		= (isset($params['atcb_text_transform'])&&trim($params['atcb_text_transform'])!='')?trim($params['atcb_text_transform']):'';
		$atcb_line_height			= (isset($params['atcb_line_height'])&&trim($params['atcb_line_height'])!='')?trim($params['atcb_line_height']):'';
		
		$prefix_id					= (isset($params['custom_css_id'])&&trim($params['custom_css_id'])!='')?('#'.trim($params['custom_css_id'])):'';
		
		/*get google fonts*/		
			$googleFontsEcho 			= array();		
			if($title_font!=''){
				array_push($googleFontsEcho, $title_font);
			}
			if($metas_font!=''){
				array_push($googleFontsEcho, $metas_font);
			}
			if($excerpt_font!=''){
				array_push($googleFontsEcho, $excerpt_font);
			}
			if($filter_font!=''){
				array_push($googleFontsEcho, $filter_font);
			}	
			if($tab_font!=''){
				array_push($googleFontsEcho, $tab_font);
			}
			if($pagination_font!=''){
				array_push($googleFontsEcho, $pagination_font);
			}
			if($price_font!=''){
				array_push($googleFontsEcho, $price_font);
			}
			if($atcb_font!=''){
				array_push($googleFontsEcho, $atcb_font);
			}			
			$newURLGoogleFonts = urlencode(implode('|', $googleFontsEcho));
			if($newURLGoogleFonts!=''){
				$customCSS.='<link rel="stylesheet" id="ul-google-fonts-css" href="https://fonts.googleapis.com/css?family='.urlencode(implode('|', $googleFontsEcho)).'" type="text/css" media="all" />';
			}
		/*get google fonts*/
		
		/*title font custom*/
			$title_font_css = ultimate_layouts_create_css_custom_font($title_font, $title_font_size, $title_letter_spacing, $title_font_weight, $title_font_style, $title_text_transform, $title_line_height);
			$title_quickview_css = ultimate_layouts_create_css_custom_font($title_font, '', '', '', '', '', '');
			$title_quickview_css_1 = ultimate_layouts_create_css_custom_font('', $qv_title_font_size, $qv_title_letter_spacing, $qv_title_font_weight, $qv_title_font_style, $qv_title_text_transform, $qv_title_line_height);
			if($title_font_css!=''){
				$title_font_css = 	$prefix_id.'.ultimate-layouts-container h3.ultimate-layouts-title, 
									'.$prefix_id.'.ultimate-layouts-container h3.ultimate-layouts-title a{'.$title_font_css.'}';									
			}
			if($title_quickview_css!=''){
				$title_quickview_css = 	'.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style h3.ultimate-layouts-title,
										.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style h3.ultimate-layouts-title a{'.$title_quickview_css.'}';									
			}
			if($title_quickview_css_1!=''){
				$title_quickview_css_1 	= 	'.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style h3.ultimate-layouts-title,
											.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style h3.ultimate-layouts-title a{'.$title_quickview_css_1.'}';									
			}
			$title_ratio_font_size = '';
			if($title_font_size!=''){
				$title_ratio_font_size=	$prefix_id.'.ultimate-layouts-container .ul-cb-style-listing h3.ultimate-layouts-title, 
										'.$prefix_id.'.ultimate-layouts-container .ul-cb-style-listing h3.ultimate-layouts-title a{
											font-size:calc('.$title_font_size.' * 0.78) !important;
											font-size:-webkit-calc('.$title_font_size.' * 0.78) !important;
											font-size:-moz-calc('.$title_font_size.' * 0.78) !important;
											font-size:-ms-calc('.$title_font_size.' * 0.78) !important;
											font-size:-o-calc('.$title_font_size.' * 0.78) !important;
										}';
			};
		/*title font custom*/
		
		/*meta font custom*/
			$metas_font_css = ultimate_layouts_create_css_custom_font($metas_font, $metas_font_size, $metas_letter_spacing, $metas_font_weight, $metas_font_style, $metas_text_transform, $metas_line_height);
			if($metas_font_css!=''){
				$metas_font_css = 	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas>.ultimate-layouts-metas-wrap>*, 
									'.$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas-st2>.ultimate-layouts-metas-wrap>*,
									'.$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas a, 
									'.$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas-st2 a,
									'.$prefix_id.'.ultimate-layouts-container .ultimate-layouts-categories>a,
									'.$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas>.ultimate-layouts-metas-wrap>* .ldc-ul_cont span, 
									'.$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas-st2>.ultimate-layouts-metas-wrap>* .ldc-ul_cont span,
									.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ultimate-layouts-metas>.ultimate-layouts-metas-wrap>*,
									.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ultimate-layouts-metas a,
									.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ultimate-layouts-categories>a,
									.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ultimate-layouts-metas>.ultimate-layouts-metas-wrap>* .ldc-ul_cont span,
									.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ultimate-layouts-metas-st2>.ultimate-layouts-metas-wrap>* .ldc-ul_cont span{'.$metas_font_css.'}';
				if($metas_font_size!=''){					
					$metas_font_css .=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas-st2>.ultimate-layouts-metas-wrap>* i.fa,
										'.$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas>.ultimate-layouts-metas-wrap>* .ldc-ul_cont span:before, 
										'.$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas-st2>.ultimate-layouts-metas-wrap>* .ldc-ul_cont span:before,
										.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ultimate-layouts-metas-st2>.ultimate-layouts-metas-wrap>* i.fa,
										.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ultimate-layouts-metas>.ultimate-layouts-metas-wrap>* .ldc-ul_cont span:before,
										.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ultimate-layouts-metas-st2>.ultimate-layouts-metas-wrap>* .ldc-ul_cont span:before{
											font-size:'.$metas_font_size.' !important;
										}';
				}
			}
		/*meta font custom*/
		
		/*excerpt font custom*/
			$excerpt_font_css = ultimate_layouts_create_css_custom_font($excerpt_font, $excerpt_font_size, $excerpt_letter_spacing, $excerpt_font_weight, $excerpt_font_style, $excerpt_text_transform, $excerpt_line_height);
			if($excerpt_font_css!=''){
				$excerpt_font_css = $prefix_id.'.ultimate-layouts-container .ultimate-layouts-excerpt,'. 
									$prefix_id.'.ultimate-layouts-container .ultimate-layouts-excerpt p,
									.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ul-quick-view-content .ul-quick-view-body .ul-single-post-content,
									.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ul-quick-view-content .ul-quick-view-body .ul-single-post-content p{'.$excerpt_font_css.'}';
			}
		/*excerpt font custom*/
		
		/*filter font custom*/
			$filter_font_css = ultimate_layouts_create_css_custom_font($filter_font, $filter_font_size, $filter_letter_spacing, $filter_font_weight, $filter_font_style, $filter_text_transform, $filter_line_height);
			if($filter_font_css!=''){
				$filter_font_css = $prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ultimate-layouts-sc-filter-container .ultimate-layouts-filter-item{'.$filter_font_css.'}';
			}
		/*filter font custom*/
		
		/*tab font custom*/
			$tab_font_css = ultimate_layouts_create_css_custom_font($tab_font, $tab_font_size, $tab_letter_spacing, $tab_font_weight, $tab_font_style, $tab_text_transform, $tab_line_height);
			if($tab_font_css!=''){
				$tab_font_css = $prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ul-smart-tab-filter .ul-smart-tab-title-wrap .ul-smart-tab-title{'.$tab_font_css.'}';
			}
		/*tab font custom*/
		
		/*pagination font custom*/
			$pagination_font_css = ultimate_layouts_create_css_custom_font($pagination_font, $pagination_font_size, $pagination_letter_spacing, $pagination_font_weight, $pagination_font_style, $pagination_text_transform, $pagination_line_height);
			if($pagination_font_css!=''){
				$pagination_font_css = 	$prefix_id.'.ultimate-layouts-container .ul-pagination-wrap .ul-loadmore-style,
										'.$prefix_id.'.ultimate-layouts-container .ul-pagination-wrap .ul-page-numbers .paginationjs .paginationjs-pages ul li>a {'.$pagination_font_css.'}';
			}
		/*pagination font custom*/
		
		/*price font custom*/
			$price_font_css = ultimate_layouts_create_css_custom_font($price_font, $price_font_size, $price_letter_spacing, $price_font_weight, $price_font_style, $price_text_transform, $price_line_height);
			if($price_font_css!=''){
				$price_font_css = 	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-woo-element .ultimate-layouts-woo-price-cart-block .ultimate-layouts-woo-price .amount,
									.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ultimate-layouts-woo-element .ultimate-layouts-woo-price-cart-block .ultimate-layouts-woo-price .amount
									{'.$price_font_css.'}';
			}
		/*price font custom*/
		
		/*add to cart font custom*/
			$atcb_font_css = ultimate_layouts_create_css_custom_font($atcb_font, $atcb_font_size, $atcb_letter_spacing, $atcb_font_weight, $atcb_font_style, $atcb_text_transform, $atcb_line_height);
			if($atcb_font_css!=''){
				$atcb_font_css = 	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-woo-element .ultimate-layouts-woo-price-cart-block .ultimate-layouts-woo-cart .add_to_cart_button,
									.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ultimate-layouts-woo-element .ultimate-layouts-woo-price-cart-block .ultimate-layouts-woo-cart .add_to_cart_button
									{'.$atcb_font_css.'}';
			}
		/*add to cart font custom*/
		
		$css_content = $title_font_css.$title_quickview_css.$title_quickview_css_1.$title_ratio_font_size.$excerpt_font_css.$metas_font_css.$filter_font_css.$tab_font_css.$pagination_font_css.$price_font_css.$atcb_font_css;
		if($css_content!=''){
			$customCSS.='<style type="text/css">'.$css_content.'</style>';
		}
		
		if($customCSS!=''){
			return $customCSS;
		}else{
			return '';
		}		
	}
	
	function ultimate_layouts_parse_custom_css($params){
		if(!isset($params) || empty($params) || !is_array($params)){
			return;
		}
		
		$customCSS='';	
		
		$layout_style				= (isset($params['layout_style'])&&trim($params['layout_style'])!=''&&is_numeric(trim($params['layout_style'])))?trim($params['layout_style']):'0';
		$list_style					= (isset($params['list_style'])&&trim($params['list_style'])!=''&&is_numeric(trim($params['list_style'])))?trim($params['list_style']):'0';
		$carousel_f_style			= (isset($params['carousel_f_style'])&&trim($params['carousel_f_style'])!=''&&is_numeric(trim($params['carousel_f_style'])))?trim($params['carousel_f_style']):'0';
		$timeline_style				= (isset($params['timeline_style'])&&trim($params['timeline_style'])!=''&&is_numeric(trim($params['timeline_style'])))?trim($params['timeline_style']):'0';
		$carousel_t_style			= (isset($params['carousel_t_style'])&&trim($params['carousel_t_style'])!=''&&is_numeric(trim($params['carousel_t_style'])))?trim($params['carousel_t_style']):'0';
		
		$gap_hor					= (isset($params['gap_hor'])&&trim($params['gap_hor'])!='')?trim($params['gap_hor']):'';
		$gap_ver					= (isset($params['gap_ver'])&&trim($params['gap_ver'])!='')?trim($params['gap_ver']):'';
				
		$title_color				= (isset($params['title_color'])&&trim($params['title_color'])!='')?trim($params['title_color']):'';
		$title_hover_color			= (isset($params['title_hover_color'])&&trim($params['title_hover_color'])!='')?trim($params['title_hover_color']):'';
		$metas_o_color				= (isset($params['metas_o_color'])&&trim($params['metas_o_color'])!='')?trim($params['metas_o_color']):'';
		$metas_o_hover_color		= (isset($params['metas_o_hover_color'])&&trim($params['metas_o_hover_color'])!='')?trim($params['metas_o_hover_color']):'';
		$metas_t_color				= (isset($params['metas_t_color'])&&trim($params['metas_t_color'])!='')?trim($params['metas_t_color']):'';
		$metas_t_hover_color		= (isset($params['metas_t_hover_color'])&&trim($params['metas_t_hover_color'])!='')?trim($params['metas_t_hover_color']):'';
		$metas_t_background_color	= (isset($params['metas_t_background_color'])&&trim($params['metas_t_background_color'])!='')?trim($params['metas_t_background_color']):'';
		$text_color					= (isset($params['text_color'])&&trim($params['text_color'])!='')?trim($params['text_color']):'';
		$background_color			= (isset($params['background_color'])&&trim($params['background_color'])!='')?trim($params['background_color']):'';
		$border_color				= (isset($params['border_color'])&&trim($params['border_color'])!='')?trim($params['border_color']):'';
		$shadow_color				= (isset($params['shadow_color'])&&trim($params['shadow_color'])!='')?trim($params['shadow_color']):'';
		$filter_overlay_color		= (isset($params['filter_overlay_color'])&&trim($params['filter_overlay_color'])!='')?trim($params['filter_overlay_color']):'';
		
		$title_color_small			= (isset($params['title_color_small'])&&trim($params['title_color_small'])!='')?trim($params['title_color_small']):'';
		$title_hover_color_small	= (isset($params['title_hover_color_small'])&&trim($params['title_hover_color_small'])!='')?trim($params['title_hover_color_small']):'';
		$metas_o_color_small		= (isset($params['metas_o_color_small'])&&trim($params['metas_o_color_small'])!='')?trim($params['metas_o_color_small']):'';
		$metas_o_hover_color_small	= (isset($params['metas_o_hover_color_small'])&&trim($params['metas_o_hover_color_small'])!='')?trim($params['metas_o_hover_color_small']):'';
		
		$price_color				= (isset($params['price_color'])&&trim($params['price_color'])!='')?trim($params['price_color']):'';
		$price_d_color				= (isset($params['price_d_color'])&&trim($params['price_d_color'])!='')?trim($params['price_d_color']):'';
		$star_bg_color				= (isset($params['star_bg_color'])&&trim($params['star_bg_color'])!='')?trim($params['star_bg_color']):'';
		$star_color					= (isset($params['star_color'])&&trim($params['star_color'])!='')?trim($params['star_color']):'';
		$btn_cart_color				= (isset($params['btn_cart_color'])&&trim($params['btn_cart_color'])!='')?trim($params['btn_cart_color']):'';
		$btn_cart_hover_color		= (isset($params['btn_cart_hover_color'])&&trim($params['btn_cart_hover_color'])!='')?trim($params['btn_cart_hover_color']):'';
		$btn_cart_bg_color			= (isset($params['btn_cart_bg_color'])&&trim($params['btn_cart_bg_color'])!='')?trim($params['btn_cart_bg_color']):'';
		$btn_cart_bg_hover_color	= (isset($params['btn_cart_bg_hover_color'])&&trim($params['btn_cart_bg_hover_color'])!='')?trim($params['btn_cart_bg_hover_color']):'';
		
		$main_color_1				= (isset($params['main_color_1'])&&trim($params['main_color_1'])!='')?trim($params['main_color_1']):'';
		$main_color_2				= (isset($params['main_color_2'])&&trim($params['main_color_2'])!='')?trim($params['main_color_2']):'';
		
		$inf_scr_color				= (isset($params['inf_scr_color'])&&trim($params['inf_scr_color'])!='')?trim($params['inf_scr_color']):'';
		
		$stab_color					= (isset($params['stab_color'])&&trim($params['stab_color'])!='')?trim($params['stab_color']):'';
		$stab_bg_color				= (isset($params['stab_bg_color'])&&trim($params['stab_bg_color'])!='')?trim($params['stab_bg_color']):'';
		
		$sync_slider_height_d		= (isset($params['sync_slider_height_d'])&&trim($params['sync_slider_height_d'])!='')?trim($params['sync_slider_height_d']):'';
		$sync_slider_height_t		= (isset($params['sync_slider_height_t'])&&trim($params['sync_slider_height_t'])!='')?trim($params['sync_slider_height_t']):'';
		$sync_slider_height_m		= (isset($params['sync_slider_height_m'])&&trim($params['sync_slider_height_m'])!='')?trim($params['sync_slider_height_m']):'';
			
		$sync_slider_width_d		= (isset($params['sync_slider_width_d'])&&trim($params['sync_slider_width_d'])!='')?trim($params['sync_slider_width_d']):'';
		$sync_slider_width_t		= (isset($params['sync_slider_width_t'])&&trim($params['sync_slider_width_t'])!='')?trim($params['sync_slider_width_t']):'';
		$sync_slider_width_m		= (isset($params['sync_slider_width_m'])&&trim($params['sync_slider_width_m'])!='')?trim($params['sync_slider_width_m']):'';
		
		$prefix_id					= (isset($params['custom_css_id'])&&trim($params['custom_css_id'])!='')?('#'.trim($params['custom_css_id'])):'';
		
		if($gap_hor!=''){
			if($layout_style=='2' && $carousel_f_style=='0'){//carousel free style 1
				$customCSS.=	$prefix_id.'.ultimate-layouts-container.ultimate-layouts-global-carousel-settings .carousel-wrapper-control .ultimate-layouts-carousel-f-1{margin-right:-'.$gap_hor.' !important;}';
				$customCSS.=	$prefix_id.'.ultimate-layouts-container.ultimate-layouts-global-carousel-settings .carousel-wrapper-control .ultimate-layouts-carousel-f-1 .ultimate-layouts-item
								{padding-right:'.$gap_hor.' !important;padding-bottom:'.$gap_hor.' !important;}';
			}elseif($layout_style=='5'){
				$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-creative-basic{margin-right:-'.$gap_hor.' !important;margin-bottom:-'.$gap_hor.' !important;}';
				$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-creative-basic .ultimate-layouts-item .ultimate-layouts-entry-wrapper .ultimate-layouts-picture .ultimate-layouts-picture-wrap>a,'.
								$prefix_id.'.ultimate-layouts-container .ultimate-layouts-creative-basic .ultimate-layouts-item .ultimate-layouts-entry-wrapper .ultimate-layouts-picture 
								.ultimate-layouts-picture-wrap .ultimate-layouts-overlay{right:'.$gap_hor.' !important;bottom:'.$gap_hor.' !important;}';
				$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-creative-basic .ultimate-layouts-item .ultimate-layouts-entry-wrapper .ultimate-layouts-picture 
								.ultimate-layouts-picture-wrap .ultimate-layouts-absolute-content{padding-right:calc(20px + '.$gap_hor.');padding-right:-webkit-calc(20px + '.$gap_hor.');
								padding-right:-moz-calc(20px + '.$gap_hor.');padding-right:-ms-calc(20px + '.$gap_hor.');padding-right:-o-calc(20px + '.$gap_hor.');}';	
				$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-creative-basic .ultimate-layouts-item .ultimate-layouts-entry-wrapper .ultimate-layouts-picture 
								.ultimate-layouts-picture-wrap .ultimate_layouts_post_format.ul-bottom-right{right:'.$gap_hor.' !important;bottom:'.$gap_hor.' !important;}';
				$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-creative-basic .ultimate-layouts-item .ultimate-layouts-entry-wrapper .ultimate-layouts-picture 
								.ultimate-layouts-picture-wrap .ultimate_layouts_post_format.ul-bottom-left{bottom:'.$gap_hor.' !important;}';											
			}else{
				$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-listing-wrap{margin-left:-'.$gap_hor.' !important;margin-right:-'.$gap_hor.' !important;}';
				$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-listing-wrap .ultimate-layouts-item{padding-left:'.$gap_hor.' !important;padding-right:'.$gap_hor.' !important;}';
			}
		}
		
		if($gap_ver!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-listing-wrap{margin-bottom:-'.$gap_ver.' !important;}';
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-listing-wrap .ultimate-layouts-item{margin-bottom:'.$gap_ver.' !important;}';
		}
		
		if($title_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container h3.ultimate-layouts-title,'.
							$prefix_id.'.ultimate-layouts-container h3.ultimate-layouts-title a:not(:hover){color:'.$title_color.' !important;}';	
		}
		
		if($title_color_small!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ul-cb-style-listing h3.ultimate-layouts-title,'.
							$prefix_id.'.ultimate-layouts-container .ul-cb-style-listing h3.ultimate-layouts-title a:not(:hover){color:'.$title_color_small.' !important;}';	
		}
		
		if($title_hover_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container h3.ultimate-layouts-title a:hover{color:'.$title_hover_color.' !important;}';	
		}
		
		if($title_hover_color_small!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ul-cb-style-listing h3.ultimate-layouts-title a:hover{color:'.$title_hover_color_small.' !important;}';	
		}
		
		if($metas_o_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas > .ultimate-layouts-metas-wrap > *,'.
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas > .ultimate-layouts-metas-wrap > * .kodex_like_button,'.
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas a:not(:hover){color:'.$metas_o_color.' !important;}';	
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas .ultimate-layouts-social-share .ultimate-layouts-share-item a{color:#FFF !important;}';				
		}
		
		if($metas_o_color_small!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ul-cb-style-listing .ultimate-layouts-metas > .ultimate-layouts-metas-wrap > *,'.
							$prefix_id.'.ultimate-layouts-container .ul-cb-style-listing .ultimate-layouts-metas > .ultimate-layouts-metas-wrap > * .kodex_like_button,'.
							$prefix_id.'.ultimate-layouts-container .ul-cb-style-listing .ultimate-layouts-metas a:not(:hover){color:'.$metas_o_color_small.' !important;}';	
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ul-cb-style-listing .ultimate-layouts-metas .ultimate-layouts-social-share .ultimate-layouts-share-item a{color:#FFF !important;}';				
		}

		if($metas_o_hover_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas a:hover{color:'.$metas_o_hover_color.' !important;}';	
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas .ultimate-layouts-social-share .ultimate-layouts-share-item a:hover{color:#FFF !important;}';
		}
		
		if($metas_o_hover_color_small!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ul-cb-style-listing .ultimate-layouts-metas a:hover{color:'.$metas_o_hover_color_small.' !important;}';
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ul-cb-style-listing .ultimate-layouts-metas .ultimate-layouts-social-share .ultimate-layouts-share-item a:hover{color:#FFF !important;}';		
		}
			
		if($metas_t_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas-st2 > .ultimate-layouts-metas-wrap > *,'.
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas-st2 > .ultimate-layouts-metas-wrap > * .kodex_like_button,'.
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas-st2 a:not(:hover){color:'.$metas_t_color.' !important;}';	
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas-st2 .ultimate-layouts-social-share .ultimate-layouts-share-item a{color:#FFF !important;}';				
		}

		if($metas_t_hover_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas-st2 a:hover{color:'.$metas_t_hover_color.' !important;}';
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas-st2 .ultimate-layouts-social-share .ultimate-layouts-share-item a:hover{color:#FFF !important;}';		
		}

		if($metas_t_background_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-metas-st2 > .ultimate-layouts-metas-wrap{background-color:'.$metas_t_background_color.' !important;}';
		}

		if($text_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-excerpt,'.							
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-excerpt p,'.
							$prefix_id.'.ultimate-layouts-container{color:'.$text_color.' !important;}';	
		}

		if($background_color!=''){				
			
			if($layout_style=='4' && $list_style=='8'){//list style 9
				$customCSS.=$prefix_id.'.ultimate-layouts-container .ultimate-layouts-listing-list-9 .ultimate-layouts-item .ultimate-layouts-entry-wrapper 
										.ultimate-layouts-picture + .ultimate-layouts-content:before{border-right-color:'.$background_color.' !important;}';
				$customCSS.=$prefix_id.'.ultimate-layouts-container .ultimate-layouts-listing-list-9 .ultimate-layouts-item:nth-child(even) .ultimate-layouts-entry-wrapper 
										.ultimate-layouts-picture + .ultimate-layouts-content:before{border-right-color:rgba(255,255,255,0) !important;border-left-color:'.$background_color.' !important;}';	
			};
			
			if($layout_style=='4' && ($list_style=='1' || $list_style=='7')){//list style 2,8
				$customCSS.=$prefix_id.'.ultimate-layouts-container .ultimate-layouts-listing-wrap .ultimate-layouts-item .ultimate-layouts-content{background-color:'.$background_color.' !important;}';
			}elseif($layout_style=='4' && ($list_style=='0' || $list_style=='6' || $list_style=='9')){
				$customCSS.=$prefix_id.'.ultimate-layouts-container .ultimate-layouts-item{background-color:'.$background_color.' !important;}';
			}elseif($layout_style=='9' && ($timeline_style=='0' || $timeline_style=='1')){
				$customCSS.=$prefix_id.'.ultimate-layouts-container .ultimate-layouts-item .ultimate-layouts-entry-wrapper{background-color:'.$background_color.' !important;}';
				$customCSS.=$prefix_id.'.ultimate-layouts-container .ultimate-layouts-timeline-basic .ultimate-layouts-item .ultimate-layouts-entry-wrapper .ultimate-layouts-timeline-data
							{background-color:'.$background_color.' !important;}';
				$customCSS.=$prefix_id.'.ultimate-layouts-container .ultimate-layouts-timeline-basic .ultimate-layouts-item .ultimate-layouts-entry-wrapper:before{border-left-color:'.$background_color.' !important;}';
				$customCSS.=$prefix_id.'.ultimate-layouts-container .ultimate-layouts-timeline-basic .ultimate-layouts-item:nth-child(even) .ultimate-layouts-entry-wrapper:before
							{border-left-color:transparent !important;border-right-color:'.$background_color.' !important;}';
				$customCSS.=$prefix_id.'.ultimate-layouts-container .ultimate-layouts-timeline-basic:before{background-color:'.$background_color.' !important;}';
				$customCSS.='@media(max-width:767px){
								'.$prefix_id.'.ultimate-layouts-container .ultimate-layouts-timeline-basic .ultimate-layouts-item .ultimate-layouts-entry-wrapper:before,
								'.$prefix_id.'.ultimate-layouts-container .ultimate-layouts-timeline-basic .ultimate-layouts-item:nth-child(even) .ultimate-layouts-entry-wrapper:before
								{border-left-color:transparent !important;border-right-color:transparent !important;border-bottom-color:'.$background_color.' !important;}
							}';
			}elseif(($layout_style=='1' && ($carousel_t_style=='1' || $carousel_t_style=='2')) || ($layout_style=='2' && $carousel_f_style=='0')){
				$customCSS.=$prefix_id.'.ultimate-layouts-container.ultimate-layouts-global-carousel-settings .carousel-wrapper-control .ultimate-layouts-carousel-t .ultimate-layouts-content
							{background-color:'.$background_color.' !important;}';
			}else{
				$customCSS.=$prefix_id.'.ultimate-layouts-container .ultimate-layouts-item .ultimate-layouts-entry-wrapper{background-color:'.$background_color.' !important;}';
			}
		}

		if($border_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-listing-wrap .ultimate-layouts-item .ultimate-layouts-entry-wrapper{border-color:'.$border_color.' !important;}';	
		}

		if($shadow_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-listing-wrap .ultimate-layouts-item .ultimate-layouts-entry-wrapper
										{box-shadow:0 0 12px '.$shadow_color.' !important;-webkit-box-shadow:0 0 12px '.$shadow_color.' !important;}';	
		}
		
		if($filter_overlay_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-listing-wrap .ultimate-layouts-filter-overlay{background-color:'.$filter_overlay_color.' !important;}';	
		}
		
		if($price_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-woo-element .ultimate-layouts-woo-price-cart-block .ultimate-layouts-woo-price .amount{color:'.$price_color.' !important;}';	
		}
		if($price_d_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-woo-element .ultimate-layouts-woo-price-cart-block .ultimate-layouts-woo-price del .amount{color:'.$price_d_color.' !important;}';	
		}
		if($star_bg_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-woo-element .ultimate-layouts-woo-rating-block .ultimate-layouts-woo-rating .ultimate-layouts-woo-star:before{color:'.$star_bg_color.' !important;}';	
		}
		if($star_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-woo-element .ultimate-layouts-woo-rating-block .ultimate-layouts-woo-rating .ultimate-layouts-woo-star .ultimate-layouts-woo-star-rating:before{color:'.$star_color.' !important;}';	
		}
		if($btn_cart_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-woo-element .ultimate-layouts-woo-price-cart-block .ultimate-layouts-woo-cart .add_to_cart_button:not(:hover){color:'.$btn_cart_color.' !important;}';	
		}
		if($btn_cart_hover_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-woo-element .ultimate-layouts-woo-price-cart-block .ultimate-layouts-woo-cart .add_to_cart_button:hover{color:'.$btn_cart_hover_color.' !important;}';	
		}
		if($btn_cart_bg_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-woo-element .ultimate-layouts-woo-price-cart-block .ultimate-layouts-woo-cart .add_to_cart_button:not(:hover){background-color:'.$btn_cart_bg_color.' !important;}';	
		}
		if($btn_cart_bg_hover_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-woo-element .ultimate-layouts-woo-price-cart-block .ultimate-layouts-woo-cart .add_to_cart_button:hover{background-color:'.$btn_cart_bg_hover_color.' !important;}';	
		}
		
		if($main_color_1!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-control-pop>*:not(:hover){background-color:'.$main_color_1.' !important;}';
			
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-icon-video:hover:after{border-left-color:'.$main_color_1.' !important;}';
			
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-icon-lightbox:hover>span span:nth-child(1),'. 
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-icon-lightbox:hover>span span:nth-child(2){background-color:'.$main_color_1.' !important;}';
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-icon-lightbox:hover>span span:nth-child(1):before{border-bottom-color:'.$main_color_1.' !important;}';
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-icon-lightbox:hover>span span:nth-child(1):after{border-top-color:'.$main_color_1.' !important;}';
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-icon-lightbox:hover>span span:nth-child(2):before{border-right-color:'.$main_color_1.' !important;}';
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-icon-lightbox:hover>span span:nth-child(2):after{border-left-color:'.$main_color_1.' !important;}';
			
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-icon-link:hover i.fa{color:'.$main_color_1.' !important;}';	
			
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-readmore-btn:not(:hover){background-color:'.$main_color_1.' !important;}';
			
			$customCSS.=	$prefix_id.'.ultimate-layouts-container.ultimate-layouts-masonry-mode .ul-masonry-mode-loading .ultimate-layouts-masonry-loading,'.
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-listing-wrap .ultimate-layouts-filter-loading{color:'.$main_color_1.' !important;}';
							
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-listing-grid-6 .ultimate-layouts-item:hover .ultimate-layouts-absolute-content,'.
							$prefix_id.'.ultimate-layouts-container.ultimate-layouts-global-carousel-settings .carousel-wrapper-control .ultimate-layouts-carousel-t-2 .ultimate-layouts-item:hover .ultimate-layouts-absolute-content,'.
							$prefix_id.'.ultimate-layouts-container.ultimate-layouts-global-carousel-settings .carousel-wrapper-control .ultimate-layouts-carousel-f-1 .ultimate-layouts-item:hover .ultimate-layouts-absolute-content,'.
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-block-content-9 .ul-block-content-item .ul-block-content-item-layout .ul-cb-style-large .ul-bc-wrapper-listing .ultimate-layouts-item:hover .ultimate-layouts-absolute-content,'.
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-block-content-10 .ul-block-content-item .ul-block-content-item-layout .ul-cb-style-large .ul-bc-wrapper-listing .ultimate-layouts-item:hover .ultimate-layouts-absolute-content,'.
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-block-content-23 .ul-block-content-item .ul-block-content-item-layout .ul-cb-style-large .ul-bc-wrapper-listing .ultimate-layouts-item:hover .ultimate-layouts-absolute-content,'.
							$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-1 .ul-big-slider-wrapper .ultimate-layouts-item:hover .ultimate-layouts-absolute-content,'.
							$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-2 .ul-big-slider-wrapper .ultimate-layouts-item:hover .ultimate-layouts-absolute-content,'.
							$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-1 .ul-small-slider-wrapper .ul-small-slider-content .ultimate-layouts-item .ultimate-layouts-entry-wrapper:hover,'.
							$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-1 .ul-small-slider-wrapper .ul-small-slider-content .ultimate-layouts-item.slick-current.slick-active .ultimate-layouts-entry-wrapper,'.
							$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-2 .ul-small-slider-wrapper .ul-small-slider-content .ultimate-layouts-item:hover,'.
							$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-3 .ul-small-slider-wrapper .ul-small-slider-content .ultimate-layouts-item.slick-current.slick-active .ultimate-layouts-picture-wrap:after
							{background-color:'.$main_color_1.' !important;}';	
							
			$customCSS.=	$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-2 .ul-small-slider-wrapper .ul-small-slider-content .ultimate-layouts-item:hover
							{border-right-color:'.$main_color_1.' !important;}';				
			
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ul-smart-tab-filter{border-bottom-color:'.$main_color_1.' !important;}';
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ul-smart-tab-filter .ul-smart-tab-title-wrap .ul-smart-tab-title{background-color:'.$main_color_1.' !important;}';
			
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ul-pagination-wrap .ul-page-numbers .paginationjs .paginationjs-pages ul li.active>a
							{background-color:'.$main_color_1.' !important;border-color:'.$main_color_1.' !important;}';
							
			$customCSS.=	'.ul_quickview_p_'.str_replace('#', '', $prefix_id).'.ul-quick-view-style .ultimate-layouts-woo-element .ultimate-layouts-woo-price-cart-block .ultimate-layouts-woo-cart .add_to_cart_button:not(:hover){background-color:'.$main_color_1.' !important;}';		
			
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-block-content-27 .ul-block-content-item .ul-block-content-item-layout .ul-bc-column.ul-cb-style-listing .ultimate-layouts-item.ul-active-big-post-class,
							'.$prefix_id.'.ultimate-layouts-container .ultimate-layouts-block-content-27 .ul-block-content-item .ul-block-content-item-layout .ul-bc-column.ul-cb-style-large .ul-bc-wrapper-listing .ultimate-layouts-item:hover .ultimate-layouts-absolute-content{background-color:'.$main_color_1.' !important;}';
							
			$customCSS.=	$prefix_id.'.ultimate-layouts-container.ultimate-layouts-global-carousel-settings .carousel-wrapper-control .ultimate-layouts-carousel-t .slick-dots li:hover,
							'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-global-carousel-settings .carousel-wrapper-control .ultimate-layouts-carousel-t .slick-dots li.slick-active
							{background-color:'.$main_color_1.' !important;}';		
							
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-excerpt .ultimate-layouts-readmore-excerpt:not(:hover){color:'.$main_color_1.' !important;}';																
		}
		
		if($main_color_2!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ul-s-dropdown-filter .ultimate-layouts-sc-filter-container .filter-dropdown-wrapper:not(.active-dropdown) .ul-default-dd-filter
							{background-color:'.$main_color_2.' !important;}';
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ultimate-layouts-sc-filter-container:not([data-display-type="1"]) .ul-filter-action:not(.active-elm):hover,'.
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ul-smart-tab-filter .ul-filter-elements-wrap .ul-filter-action.active-elm
							{color:'.$main_color_2.' !important;}';
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ultimate-layouts-sc-filter-container[data-display-type="2"] .nav__dropdown .ul-filter-action:not(.active-elm):hover,'.
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ul-smart-tab-filter .ul-filter-elements-wrap .nav__dropdown .ul-filter-action.active-elm
							{color:#FFFFFF !important;}';					
		}
		
		if($inf_scr_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ul-pagination-wrap .ul-infinite-action .ul-infinite-loading{color:'.$inf_scr_color.' !important;}';
		}
		
		if($stab_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ul-smart-tab-filter .ul-smart-tab-title-wrap .ul-smart-tab-title,'.
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ul-smart-tab-filter .ul-smart-tab-title-wrap .ul-smart-tab-title a,'.
							$prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ul-smart-tab-filter .ul-smart-tab-title-wrap .ul-smart-tab-title a:focus{color:'.$stab_color.' !important;}';
		}
		
		if($stab_bg_color!=''){
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ul-smart-tab-filter{border-bottom-color:'.$stab_bg_color.' !important;}';
			$customCSS.=	$prefix_id.'.ultimate-layouts-container .ultimate-layouts-filter-container .ul-smart-tab-filter .ul-smart-tab-title-wrap .ul-smart-tab-title{background-color:'.$stab_bg_color.' !important;}';
		}
					
		if($sync_slider_height_m!=''){
			$customCSS.=	'@media(min-width:0px){
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ul-big-slider-wrapper .ultimate-layouts-picture .ultimate-layouts-picture-wrap{height:'.$sync_slider_height_m.' !important;}
							}';
		}
		if($sync_slider_height_t!=''){
			$customCSS.=	'@media(min-width:768px){
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ul-big-slider-wrapper .ultimate-layouts-picture .ultimate-layouts-picture-wrap{height:'.$sync_slider_height_t.' !important;}
							}';
		}		
		if($sync_slider_height_d!=''){
			$customCSS.=	'@media(min-width:1280px){
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ul-big-slider-wrapper .ultimate-layouts-picture .ultimate-layouts-picture-wrap{height:'.$sync_slider_height_d.' !important;}
							}';
		}
		
		if($sync_slider_width_m!=''){
			$customCSS.=	'@media(min-width:0px){
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ul-small-slider-wrapper{max-width:'.$sync_slider_width_m.' !important;}
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-2 .ul-big-slider-wrapper .ultimate-layouts-absolute-content{
									max-width:calc('.$sync_slider_width_m.' - 2px) !important;
									max-width:-webkit-calc('.$sync_slider_width_m.' - 2px) !important;
									max-width:-moz-calc('.$sync_slider_width_m.' - 2px) !important;
									max-width:-ms-calc('.$sync_slider_width_m.' - 2px) !important;
								}
							}';
			$customCSS.=	'@media(max-width:'.$sync_slider_width_m.'){
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-2 .ul-small-slider-wrapper:before,
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-2 .ul-small-slider-wrapper:after {
									display:none;
								}
							}';				
		}					
		if($sync_slider_width_t!=''){
			$customCSS.=	'@media(min-width:768px){
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ul-small-slider-wrapper{max-width:'.$sync_slider_width_t.' !important;}
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-2 .ul-big-slider-wrapper .ultimate-layouts-absolute-content{
									max-width:calc('.$sync_slider_width_t.' - 2px) !important;
									max-width:-webkit-calc('.$sync_slider_width_t.' - 2px) !important;
									max-width:-moz-calc('.$sync_slider_width_t.' - 2px) !important;
									max-width:-ms-calc('.$sync_slider_width_t.' - 2px) !important;
								}
							}';
			$customCSS.=	'@media(max-width:'.$sync_slider_width_t.'){
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-2 .ul-small-slider-wrapper:before,
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-2 .ul-small-slider-wrapper:after {
									display:none;
								}
							}';				
		}		
		if($sync_slider_width_d!=''){
			$customCSS.=	'@media(min-width:1280px){
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ul-small-slider-wrapper{max-width:'.$sync_slider_width_d.' !important;}
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-2 .ul-big-slider-wrapper .ultimate-layouts-absolute-content{
									max-width:calc('.$sync_slider_width_d.' - 2px) !important;
									max-width:-webkit-calc('.$sync_slider_width_d.' - 2px) !important;
									max-width:-moz-calc('.$sync_slider_width_d.' - 2px) !important;
									max-width:-ms-calc('.$sync_slider_width_d.' - 2px) !important;
								}
							}';
			$customCSS.=	'@media(max-width:'.$sync_slider_width_d.'){
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-2 .ul-small-slider-wrapper:before,
								'.$prefix_id.'.ultimate-layouts-container.ultimate-layouts-sync-slider-settings .ultimate-layouts-sync-s-2 .ul-small-slider-wrapper:after {
									display:none;
								}
							}';				
		}		
		
		if($customCSS!=''){
			return '<style type="text/css">'.$customCSS.'</style>';
		}else{
			return '';
		}
	}
}

//Add CSS To Header
if(!function_exists('ultimate_layouts_custom_css_inline') && !function_exists('ultimate_layouts_get_custom_css')){	
	function ultimate_layouts_custom_css_inline($content = '', $shortcode_name = ''){
		$custom_css = '';
		
		preg_match_all('/'.get_shortcode_regex().'/', $content, $matches);
					
		if(isset($matches) && !empty($matches) && is_array($matches)){			
			foreach($matches[2] as $index => $tag){		
				if($tag==trim($shortcode_name)){		
					$params = 		shortcode_parse_atts(trim($matches[3][$index]));
					$custom_css.=	ultimate_layouts_custom_font($params).ultimate_layouts_parse_custom_css($params);					
				}
			}	
		}
		
		if(!empty($matches[5])){
			foreach($matches[5] as $shortcode_content){
				$custom_css.= ultimate_layouts_custom_css_inline($shortcode_content, $shortcode_name);
			}				
		}
		
		return $custom_css;
	}
	
	function ultimate_layouts_get_custom_css(){
		if(is_singular()){
			$post_id 		= get_the_ID();
			$content_post	= get_post($post_id);
			$content 		= $content_post->post_content;
			echo ultimate_layouts_custom_css_inline($content, 'ult_layout');			
		}
	}
	
	//add_action('wp_head', 'ultimate_layouts_get_custom_css'); //disabled addcss to header
}

//register image size
if(!function_exists('ultimate_layouts_image_sizes')){
	function ultimate_layouts_image_sizes(){
		//mini size		
		if(get_option('ultimate_layouts_img_120_90', '0')=='1'){
			add_image_size('120x90_ul_grid_4e_3e_1x', 120, 90, true);
		}
		
		if(get_option('ultimate_layouts_img_100_100', '0')=='1'){
			add_image_size('100x100_ul_grid_1e_1e_1x', 100, 100, true);
		}
			
		if(get_option('ultimate_layouts_img_200_200', '0')=='1'){	
			add_image_size('200x200_ul_grid_1e_2e_2x', 200, 200, true);
		}
		
		//4:3
		if(get_option('ultimate_layouts_img_400_300', '1')=='1'){
			add_image_size('400x300_ul_grid_4_3_1x', 400, 300, true);
		}
			
		if(get_option('ultimate_layouts_img_800_600', '1')=='1'){	
			add_image_size('800x600_ul_grid_4_3_2x', 800, 600, true);
		}
			
		if(get_option('ultimate_layouts_img_1200_900', '1')=='1'){	
			add_image_size('1200x900_ul_grid_4_3_3x', 1200, 900, true);
		}
		
		//1:1
		if(get_option('ultimate_layouts_img_400_400', '0')=='1'){
			add_image_size('400x400_ul_grid_1_1_1x', 400, 400, true);
		}
		
		if(get_option('ultimate_layouts_img_800_800', '0')=='1'){
			add_image_size('800x800_ul_grid_1_1_2x', 800, 800, true);
		}
			
		if(get_option('ultimate_layouts_img_1200_1200', '0')=='1'){	
			add_image_size('1200x1200_ul_grid_1_1_3x', 1200, 1200, true);
		}
		
		//16:9
		if(get_option('ultimate_layouts_img_400_225', '0')=='1'){
			add_image_size('400x225_ul_grid_16_9_1x', 400, 225, true);
		}
			
		if(get_option('ultimate_layouts_img_800_450', '0')=='1'){	
			add_image_size('800x450_ul_grid_16_9_2x', 800, 450, true);
		}
			
		if(get_option('ultimate_layouts_img_1200_675', '0')=='1'){	
			add_image_size('1200x675_ul_grid_16_9_3x', 1200, 675, true);
		}
		
		//2:3
		if(get_option('ultimate_layouts_img_400_600', '1')=='1'){
			add_image_size('400x600_ul_grid_2_3_1x', 400, 600, true);
		}
			
		if(get_option('ultimate_layouts_img_800_1200', '1')=='1'){	
			add_image_size('800x1200_ul_grid_2_3_2x', 800, 1200, true);
		}
			
		if(get_option('ultimate_layouts_img_1200_1800', '0')=='1'){	
			add_image_size('1200x1800_ul_grid_2_3_3x', 1200, 1800, true);
		}
		
		//Masonry
		if(get_option('ultimate_layouts_img_400_free', '0')=='1'){
			add_image_size('400x600_ul_grid_free_1x', 400, 99999, false);
		}
			
		if(get_option('ultimate_layouts_img_800_free', '0')=='1'){	
			add_image_size('800x1200_ul_grid_free_2x', 800, 99999, false);
		}
			
		if(get_option('ultimate_layouts_img_1200_free', '0')=='1'){	
			add_image_size('1200x1800_ul_grid_free_3x', 1200, 99999, false);
		}	
	}
	add_action('after_setup_theme', 'ultimate_layouts_image_sizes');
}

if(!function_exists('ultimate_layouts_required_setup') && (UL_BETE_SETUP == '0' || UL_BETE_SETUP == '1')){
	function ultimate_layouts_required_setup($plugins) {
		$_ultimate_layouts_required_setup = array(			
			array(
				'name'     => 'Kodex Posts likes',
				'slug'     => 'kodex-posts-likes',
				'required' => true
			),
		);
		$config = array(
			'domain'            => 'ultimate_layouts',
			'default_path'      => '', 
			'menu'              => 'ultimate-layouts-install-required-plugins',
			'has_notices'       => true, 
			'is_automatic'      => false,
			'message'           => '',
			'strings'           => array(
				'page_title'                       => esc_html__('Install Required &amp; Recommended Plugins', 'ultimate_layouts'),
				'menu_title'                       => esc_html__('Install Plugins', 'ultimate_layouts'),
				'installing'                       => esc_html__('Installing Plugin: %s', 'ultimate_layouts'),
				'oops'                             => esc_html__('Something went wrong with the plugin API.', 'ultimate_layouts'),
				'notice_can_install_required'      => _n_noop(	'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'ultimate_layouts'),
				'notice_can_install_recommended'   => _n_noop(	'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'ultimate_layouts'),
				'notice_cannot_install'            => _n_noop(	'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.',
																'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'ultimate_layouts'),
				'notice_can_activate_required'     => _n_noop(	'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'ultimate_layouts'),
				'notice_can_activate_recommended'  => _n_noop(	'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'ultimate_layouts'),
				'notice_cannot_activate'           => _n_noop(	'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.',
																'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'ultimate_layouts'),
				'notice_ask_to_update'             => _n_noop(	'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 
																'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'ultimate_layouts'),
				'notice_cannot_update'             => _n_noop(	'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.',
																'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'ultimate_layouts'),
				'install_link'                     => _n_noop(	'Begin installing plugin', 'Begin installing plugins', 'ultimate_layouts'),
				'activate_link'                    => _n_noop(	'Activate installed plugin', 'Activate installed plugins', 'ultimate_layouts'),
				'return'                           => esc_html__('Return to Required Plugins Installer', 'ultimate_layouts'),
				'plugin_activated'                 => esc_html__('Plugin activated successfully.', 'ultimate_layouts'),
				'complete'                         => esc_html__('All plugins installed and activated successfully. %s', 'ultimate_layouts')
			)
		); 
		tgmpa($_ultimate_layouts_required_setup, $config);
	}
	add_action('tgmpa_register', 'ultimate_layouts_required_setup');
}

if(!function_exists('ultimate_layouts_video_thumbnail_fetch')){
	function ultimate_layouts_video_thumbnail_fetch($markup, $post_id) {
		$markup .= ' '.get_post_meta($post_id, '_ultimate_layouts_video_link', true);
		return $markup;
	}
	add_filter('video_thumbnail_markup', 'ultimate_layouts_video_thumbnail_fetch', 10, 2);
}

if(!function_exists('ultimate_layouts_number_format')){
	function ultimate_layouts_number_format($number = 0){		
		if(isset($number) && is_numeric($number) && $number > 0){
			$number	= number_format($number, 0, '.', '.' );
		}		
		return $number;
	}
	add_filter('ultimate_layouts_number_format', 'ultimate_layouts_number_format', 10, 2);
}

if(!function_exists('ultimate_layouts_include_template')){
	function ultimate_layouts_include_template($subfolder='', $include_file=''){
		$template_folder = '/ul-templates';
		if(!isset($subfolder) || $subfolder=='' || !isset($include_file) || $include_file==''){
			return 'html-loop/00-grid/0.php';
		}
		$newInlcideFile = UL_BETE_THEME_PATH.$template_folder.'/'.$subfolder.'/'.$include_file.'.php';
		if(file_exists($newInlcideFile)){
			return $newInlcideFile;
		}else{
			return 'html-loop/'.$subfolder.'/'.$include_file.'.php';
		}
	}
}