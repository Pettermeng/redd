<?php
if(!class_exists('my_ultimateLayouts_bete_sc')){
	class my_ultimateLayouts_bete_sc {

		static $add_script_core = false;
		static $add_script_slick = false;
		static $add_script_masonry = false;
		static $add_script_priority = false;
		static $add_script_pagination = false;
		static $add_script_malihu = false;		
		
		static function init(){
			add_action('init', array(__CLASS__, 'register_scripts'));	
				
			add_shortcode('ult_layout', array(__CLASS__, 'handle_shortcode'));
			add_shortcode('ult_layout_filter', array(__CLASS__, 'filter_container'));
			add_shortcode('ult_layout_filter_items', array(__CLASS__, 'filter_items'));
			add_shortcode('ult_layout_order_by', array(__CLASS__, 'order_by'));
			add_shortcode('ult_layout_sort_order', array(__CLASS__, 'sort_order'));	
			
			add_action('wp_enqueue_scripts', array(__CLASS__, 'core_enqueue_scripts'), 9999);
			add_action('wp_footer', array(__CLASS__, 'print_script_core'), 0);						
			add_action('wp_footer', array(__CLASS__, 'print_script'), 9999);		
			
			add_action('wp_ajax_ultimatelayoutsajaxaction', array(__CLASS__, 'ajax'));
			add_action('wp_ajax_nopriv_ultimatelayoutsajaxaction', array(__CLASS__, 'ajax'));
			
			add_action('wp_ajax_ultimatelayoutsajaxsingleaction', array(__CLASS__, 'ajax_single'));
			add_action('wp_ajax_nopriv_ultimatelayoutsajaxsingleaction', array(__CLASS__, 'ajax_single'));
			
			add_action('wp_ajax_ultimatelayoutsgetchildrentaxonomies', array(__CLASS__, 'ajax_children'));
			add_action('wp_ajax_nopriv_ultimatelayoutsgetchildrentaxonomies', array(__CLASS__, 'ajax_children'));
		}	
				
		/*Shortcode*/
		static function handle_shortcode($params, $contents=''){
			$css = '';
			extract(
				shortcode_atts(
					array(						
						'layout_style'						=>'',
						'button_gallery_name'				=>'',
						'grid_style'						=>'',
						'list_style'						=>'',
						'carousel_t_style'					=>'',
						'carousel_f_style'					=>'',
						'creative_style'					=>'',
						'timeline_style'					=>'',
						'block_content_style'				=>'',
						'sync_slider_style'					=>'',
						
						'grid_masonry'						=>'',
						
						'show_arrows'						=>'',
						'arrows_outside'					=>'',
						'show_dots'							=>'',
						'infinite'							=>'',
						'autoplay'							=>'',
						'autoplayspeed'						=>'',
						'scrollperpage'						=>'',
						'speed'								=>'',
						'centermode'						=>'',
						
						'sync_slider_height_d'				=>'',
						'sync_slider_height_t'				=>'',
						'sync_slider_height_m'				=>'',
						
						'sync_slider_width_d'				=>'',
						'sync_slider_width_t'				=>'',
						'sync_slider_width_m'				=>'',
						
						'show_elements'						=>'',
						'av_content'						=>'',
						
						'cc_mobile'							=>'',
						'cc_portrait_tablet'				=>'',
						'cc_landscape_tablet'				=>'',
						'cc_small_desktop'					=>'',
						'cc_medium_desktop'					=>'',
						'cc_large_desktop'					=>'',
						'cc_extra_large_desktop'			=>'',
						
						'gap_hor'							=>'',
						'gap_ver'							=>'',
						
						'image_size'						=>'',
						'image_size_s'						=>'',
						
						's_image'							=>'',	
						's_image_link'						=>'',
						's_image_link_target'				=>'',
						's_icon_lightbox_video'				=>'',
						'video_url_meta'					=>'',
						'video_url_meta_key'				=>'',
						's_icon_lightbox_image'				=>'',
						's_icon_link'						=>'',
						's_icon_link_target'				=>'',
						's_image_hover_effect'				=>'',
						's_overlay_hover_effect'			=>'',
						's_overlay_settings'				=>'',
						's_overlay_color'					=>'',
						's_image_post_format'				=>'',
						's_image_post_format_pos'			=>'',
						's_image_avatar'					=>'',
						
						's_title'							=>'',
						's_title_limit'						=>'',
						's_title_link'						=>'',
						's_title_link_target'				=>'',
						
						's_excerpt'							=>'',
						's_excerpt_rbtn'					=>'',
						's_excerpt_f'						=>'',
						's_excerpt_sc'						=>'',
						's_excerpt_sh'						=>'',
						's_excerpt_length'					=>'',
						
						's_categories'						=>'',
						's_s_categories'					=>'',
						's_s_categories_parent'				=>'',
						'ex_items_taxonomies'				=>'',
						's_c_categories'					=>'',
						's_ct_categories'					=>'',
						's_cb_categories'					=>'',
						's_categories_target'				=>'',
						
						's_metas_o'							=>'',
						's_metas_o_author'					=>'',
						's_metas_o_author_avatar'			=>'',
						's_metas_o_time'					=>'',
						'time_format'						=>'',
						's_metas_o_comment'					=>'',
						's_metas_o_like'					=>'',
						's_metas_o_share'					=>'',	
						'custom_meta_o'						=>'',
							
						's_metas_t'							=>'',	
						's_metas_t_author'					=>'',	
						's_metas_t_author_avatar'			=>'',
						's_metas_t_time'					=>'',	
						'time_format_t'						=>'',	
						's_metas_t_comment'					=>'',	
						's_metas_t_like'					=>'',	
						's_metas_t_share'					=>'',	
						'custom_meta_t'						=>'',	
						's_metas_t_readmore'				=>'',	
						's_metas_t_readmore_link_target'	=>'',
						
						'share_text'						=>'',
						'read_more_text'					=>'',
						'before_author_text'				=>'',
						
						'pagination'						=>'',
						'loadmore_text'						=>'',
						'prev_text'							=>'',
						'next_text'							=>'',	
						
						'lazyload'							=>'',
						'lazyload_p'						=>'',
						
						'animate'							=>'',
						
						'geodirectory_rating'				=>'',
						
						'quick_view'						=>'',
						'quick_view_mode'					=>'',
						
						'extra_class'						=>'',
						
						'post_types'						=>'',
						'i_attachment'						=>'',
						'taxonomies'						=>'',
						'multi_post_types'					=>'',
						'multi_taxonomies'					=>'',
						'query_types'						=>'',
						'i_taxonomies'						=>'',
						'e_taxonomies'						=>'',
						'i_ids'								=>'',
						'cq_operator'						=>'',
						'e_ids'								=>'',
						'post_count'						=>'',
						'posts_per_page'					=>'',	
						'order'								=>'',
						'order_by'							=>'',
						'meta_key_query'					=>'',
						'query_author'						=>'',
						'query_include_children'			=>'',
						'today_post'						=>'',
						'datetime_meta'						=>'',
						'woo_query'							=>'',
						'query_offset'						=>'',
						
						'title_color'						=>'',
						'title_hover_color'					=>'',
						'metas_o_color'						=>'',
						'metas_o_hover_color'				=>'',
						'metas_t_color'						=>'',
						'metas_t_hover_color'				=>'',
						'metas_t_background_color'			=>'',
						'text_color'						=>'',
						'background_color'					=>'',
						'border_color'						=>'',
						'shadow_color'						=>'',
						
						'css' 								=>'',	
						
						//small item content block
							's_title_small'							=>'',
							's_title_limit_small'					=>'',
							's_title_link_small'					=>'',
							's_title_link_target_small'				=>'',
							
							's_categories_small'					=>'',
							's_s_categories_small'					=>'',
							's_s_categories_parent_small'			=>'',
							'ex_items_taxonomies_small'				=>'',
							's_c_categories_small'					=>'',
							's_ct_categories_small'					=>'',
							's_cb_categories_small'					=>'',
							's_categories_target_small'				=>'',
							
							's_metas_o_small'						=>'',
							's_metas_o_author_small'				=>'',
							's_metas_o_author_avatar_small'			=>'',
							's_metas_o_time_small'					=>'',
							'time_format_small'						=>'',
							's_metas_o_comment_small'				=>'',
							's_metas_o_like_small'					=>'',
							's_metas_o_share_small'					=>'',	
							'custom_meta_o_small'					=>'',
							
							'title_color_small'						=>'',
							'title_hover_color_small'				=>'',
							'metas_o_color_small'					=>'',
							'metas_o_hover_color_small'				=>'',
						//small item content block		
						
						'woo_show_price' 					=>'',
						'woo_show_rating' 					=>'',
						'woo_show_cart' 					=>'',	
						
						'qv_s_title'						=>'',
						'qv_s_categories'					=>'',
						'qv_s_s_categories'					=>'',
						'qv_s_s_categories_parent'			=>'',
						'qv_ex_items_taxonomies'			=>'',
						'qv_s_c_categories'					=>'',
						'qv_s_ct_categories'				=>'',
						'qv_s_cb_categories'				=>'',
						'qv_s_categories_target'			=>'',
						'qv_s_metas_o'						=>'',
						'qv_s_metas_o_author'				=>'',
						'qv_s_metas_o_author_avatar'		=>'',
						'qv_s_metas_o_time'					=>'',
						'qv_time_format'					=>'',
						'qv_s_metas_o_comment'				=>'',
						'qv_s_metas_o_like'					=>'',
						'qv_custom_meta_o'					=>'',
						'qv_show_share'						=>'',
						'qv_show_content'					=>'',
						'qv_content_stripsc'				=>'',
						'qv_woo_show_rating'				=>'',
						'qv_s_featured_image'				=>'',
						
						'goo_ads_client'				=>'',
						'goo_ads_id'					=>'',
						'goo_ads_offset'				=>'',
					), 
					$params
				)				
			);
			
			//Build Query
			$query_params=array();
			$query_params['post_types'] 		= (isset($params['post_types'])&&trim($params['post_types'])!='')?trim($params['post_types']):'post';
			$query_params['i_attachment'] 		= (isset($params['i_attachment'])&&trim($params['i_attachment'])!='')?trim($params['i_attachment']):'';
			$query_params['taxonomies'] 		= (isset($params['taxonomies'])&&trim($params['taxonomies'])!='')?trim($params['taxonomies']):'category';
			$query_params['multi_post_types'] 	= (isset($params['multi_post_types'])&&trim($params['multi_post_types'])!='')?trim($params['multi_post_types']):'';
			$query_params['multi_taxonomies'] 	= (isset($params['multi_taxonomies'])&&trim($params['multi_taxonomies'])!='')?trim($params['multi_taxonomies']):'';
			$query_params['query_types'] 		= (isset($params['query_types'])&&trim($params['query_types'])!='')?trim($params['query_types']):'0';
			$query_params['i_taxonomies'] 		= (isset($params['i_taxonomies'])&&trim($params['i_taxonomies'])!='')?trim($params['i_taxonomies']):'';
			$query_params['e_taxonomies'] 		= (isset($params['e_taxonomies'])&&trim($params['e_taxonomies'])!='')?trim($params['e_taxonomies']):'';
			$query_params['i_ids'] 				= (isset($params['i_ids'])&&trim($params['i_ids'])!='')?trim($params['i_ids']):'';
			$query_params['cq_operator']		= (isset($params['cq_operator'])&&trim($params['cq_operator'])!=''&&is_numeric(trim($params['cq_operator'])))?trim($params['cq_operator']):'0';	
			$query_params['e_ids'] 				= (isset($params['e_ids'])&&trim($params['e_ids'])!='')?trim($params['e_ids']):'';
			$query_params['query_author'] 		= (isset($params['query_author'])&&trim($params['query_author'])!='')?trim($params['query_author']):'';
			$query_params['query_offset'] 		= (isset($params['query_offset'])&&trim($params['query_offset'])!=''&&is_numeric(trim($params['query_offset'])))?(int)trim($params['query_offset']):'';
			$query_params['query_include_children'] = (isset($params['query_include_children'])&&trim($params['query_include_children'])!=''&&is_numeric(trim($params['query_include_children'])))?trim($params['query_include_children']):'1';
			$query_params['today_post'] 		= (isset($params['today_post'])&&trim($params['today_post'])!=''&&is_numeric(trim($params['today_post'])))?trim($params['today_post']):'0';
			$query_params['datetime_meta'] 		= (isset($params['datetime_meta'])&&trim($params['datetime_meta'])!='')?trim($params['datetime_meta']):'';
			$query_params['woo_query'] 			= (isset($params['woo_query'])&&trim($params['woo_query'])!=''&&is_numeric(trim($params['woo_query'])))?trim($params['woo_query']):'0';
			$query_params['post_count'] 		= (isset($params['post_count'])&&trim($params['post_count'])!=''&&is_numeric(trim($params['post_count'])))?trim($params['post_count']):50;
			$query_params['posts_per_page'] 	= (isset($params['posts_per_page'])&&trim($params['posts_per_page'])!=''&&is_numeric(trim($params['posts_per_page'])))?trim($params['posts_per_page']):10;
			
			$filter = '';
			$order 								= (isset($params['order'])&&trim($params['order'])!='')?trim($params['order']):'DESC';
			$orderby							= (isset($params['order_by'])&&trim($params['order_by'])!='')?trim($params['order_by']):'date';
			
			$sub_opt_query = array();	
			$sub_opt_query['meta_key_query']	= (isset($params['meta_key_query'])&&trim($params['meta_key_query'])!='')?trim($params['meta_key_query']):'';
			$sub_opt_query['paged']				= 1;
			$sub_opt_query['first_query']		= 'on';
			//End Build Query
			
			//Build Options	
			$options = array();			
			$options['layout_style']			= (isset($params['layout_style'])&&trim($params['layout_style'])!=''&&is_numeric(trim($params['layout_style'])))?trim($params['layout_style']):'0';
			$options['button_gallery_name']		= (isset($params['button_gallery_name'])&&trim($params['button_gallery_name'])!='')?trim($params['button_gallery_name']):__('Gallery', 'ultimate_layouts');
			$options['grid_style']				= (isset($params['grid_style'])&&trim($params['grid_style'])!=''&&is_numeric(trim($params['grid_style'])))?trim($params['grid_style']):'0';
			$options['list_style']				= (isset($params['list_style'])&&trim($params['list_style'])!=''&&is_numeric(trim($params['list_style'])))?trim($params['list_style']):'0';
			$options['carousel_t_style']		= (isset($params['carousel_t_style'])&&trim($params['carousel_t_style'])!=''&&is_numeric(trim($params['carousel_t_style'])))?trim($params['carousel_t_style']):'0';
			$options['carousel_f_style']		= (isset($params['carousel_f_style'])&&trim($params['carousel_f_style'])!=''&&is_numeric(trim($params['carousel_f_style'])))?trim($params['carousel_f_style']):'0';
			$options['creative_style']			= (isset($params['creative_style'])&&trim($params['creative_style'])!=''&&is_numeric(trim($params['creative_style'])))?trim($params['creative_style']):'0';
			$options['timeline_style']			= (isset($params['timeline_style'])&&trim($params['timeline_style'])!=''&&is_numeric(trim($params['timeline_style'])))?trim($params['timeline_style']):'0';
			$options['block_content_style']		= (isset($params['block_content_style'])&&trim($params['block_content_style'])!=''&&is_numeric(trim($params['block_content_style'])))?trim($params['block_content_style']):'0';
			$options['sync_slider_style']		= (isset($params['sync_slider_style'])&&trim($params['sync_slider_style'])!=''&&is_numeric(trim($params['sync_slider_style'])))?trim($params['sync_slider_style']):'0';			
			
			//masonry mode for grid
			$options['grid_masonry']			= (isset($params['grid_masonry'])&&trim($params['grid_masonry'])!=''&&is_numeric(trim($params['grid_masonry'])))?trim($params['grid_masonry']):'0';
			//masonry mode for grid
			
			//Carousel Options
			$options['show_arrows']				= (isset($params['show_arrows'])&&trim($params['show_arrows'])!=''&&is_numeric(trim($params['show_arrows'])))?trim($params['show_arrows']):'1';
			$options['arrows_outside']			= (isset($params['arrows_outside'])&&trim($params['arrows_outside'])!=''&&is_numeric(trim($params['arrows_outside'])))?trim($params['arrows_outside']):'0';
			$options['show_dots']				= (isset($params['show_dots'])&&trim($params['show_dots'])!=''&&is_numeric(trim($params['show_dots'])))?trim($params['show_dots']):'1';
			$options['infinite']				= (isset($params['infinite'])&&trim($params['infinite'])!=''&&is_numeric(trim($params['infinite'])))?trim($params['infinite']):'1';
			$options['autoplay']				= (isset($params['autoplay'])&&trim($params['autoplay'])!=''&&is_numeric(trim($params['autoplay'])))?trim($params['autoplay']):'1';
			$options['autoplayspeed']			= (isset($params['autoplayspeed'])&&trim($params['autoplayspeed'])!=''&&is_numeric(trim($params['autoplayspeed'])))?trim($params['autoplayspeed']):5000;
			$options['scrollperpage']			= (isset($params['scrollperpage'])&&trim($params['scrollperpage'])!=''&&is_numeric(trim($params['scrollperpage'])))?trim($params['scrollperpage']):'1';
			$options['speed']					= (isset($params['speed'])&&trim($params['speed'])!=''&&is_numeric(trim($params['speed'])))?trim($params['speed']):500;
			$options['centermode']				= (isset($params['centermode'])&&trim($params['centermode'])!=''&&is_numeric(trim($params['centermode'])))?trim($params['centermode']):'0';
			//Carousel Options
			
			$options['sync_slider_height_d']	= (isset($params['sync_slider_height_d'])&&trim($params['sync_slider_height_d'])!='')?trim($params['sync_slider_height_d']):'';
			$options['sync_slider_height_t']	= (isset($params['sync_slider_height_t'])&&trim($params['sync_slider_height_t'])!='')?trim($params['sync_slider_height_t']):'';
			$options['sync_slider_height_m']	= (isset($params['sync_slider_height_m'])&&trim($params['sync_slider_height_m'])!='')?trim($params['sync_slider_height_m']):'';
			
			$options['sync_slider_width_d']		= (isset($params['sync_slider_width_d'])&&trim($params['sync_slider_width_d'])!='')?trim($params['sync_slider_width_d']):'';
			$options['sync_slider_width_t']		= (isset($params['sync_slider_width_t'])&&trim($params['sync_slider_width_t'])!='')?trim($params['sync_slider_width_t']):'';
			$options['sync_slider_width_m']		= (isset($params['sync_slider_width_m'])&&trim($params['sync_slider_width_m'])!='')?trim($params['sync_slider_width_m']):'';
			
			//Creative Options
			$options['show_elements']			= (isset($params['show_elements'])&&trim($params['show_elements'])!=''&&is_numeric(trim($params['show_elements'])))?trim($params['show_elements']):'0';
			$options['av_content']				= (isset($params['av_content'])&&trim($params['av_content'])!=''&&is_numeric(trim($params['av_content'])))?trim($params['av_content']):'0';
			//Creative Options
			
			//custom columns			
			$options['cc_mobile']				= (isset($params['cc_mobile'])&&trim($params['cc_mobile'])!=''&&is_numeric(trim($params['cc_mobile'])))?trim($params['cc_mobile']):'0';
			$options['cc_portrait_tablet']		= (isset($params['cc_portrait_tablet'])&&trim($params['cc_portrait_tablet'])!=''&&is_numeric(trim($params['cc_portrait_tablet'])))?trim($params['cc_portrait_tablet']):'0';
			$options['cc_landscape_tablet']		= (isset($params['cc_landscape_tablet'])&&trim($params['cc_landscape_tablet'])!=''&&is_numeric(trim($params['cc_landscape_tablet'])))?trim($params['cc_landscape_tablet']):'0';
			$options['cc_small_desktop']		= (isset($params['cc_small_desktop'])&&trim($params['cc_small_desktop'])!=''&&is_numeric(trim($params['cc_small_desktop'])))?trim($params['cc_small_desktop']):'0';
			$options['cc_medium_desktop']		= (isset($params['cc_medium_desktop'])&&trim($params['cc_medium_desktop'])!=''&&is_numeric(trim($params['cc_medium_desktop'])))?trim($params['cc_medium_desktop']):'0';
			$options['cc_large_desktop']		= (isset($params['cc_large_desktop'])&&trim($params['cc_large_desktop'])!=''&&is_numeric(trim($params['cc_large_desktop'])))?trim($params['cc_large_desktop']):'0';
			$options['cc_extra_large_desktop']	= (isset($params['cc_extra_large_desktop'])&&trim($params['cc_extra_large_desktop'])!=''&&is_numeric(trim($params['cc_extra_large_desktop'])))?trim($params['cc_extra_large_desktop']):'0';
			//custom columns
			
			//image size
			$options['image_size']				= (isset($params['image_size'])&&trim($params['image_size'])!='')?trim($params['image_size']):'thumbnail';
			$options['image_size_s']			= (isset($params['image_size_s'])&&trim($params['image_size_s'])!='')?trim($params['image_size_s']):'thumbnail';
			//image size
			
			//image options
			$options['s_image']					= (isset($params['s_image'])&&trim($params['s_image'])!=''&&is_numeric(trim($params['s_image'])))?trim($params['s_image']):'1';
			$options['s_image_link']			= (isset($params['s_image_link'])&&trim($params['s_image_link'])!=''&&is_numeric(trim($params['s_image_link'])))?trim($params['s_image_link']):'1';
			$options['s_image_link_target']		= (isset($params['s_image_link_target'])&&trim($params['s_image_link_target'])!=''&&is_numeric(trim($params['s_image_link_target'])))?trim($params['s_image_link_target']):'0';
			$options['s_icon_lightbox_video']	= (isset($params['s_icon_lightbox_video'])&&trim($params['s_icon_lightbox_video'])!=''&&is_numeric(trim($params['s_icon_lightbox_video'])))?trim($params['s_icon_lightbox_video']):'0';
			$options['video_url_meta']			= (isset($params['video_url_meta'])&&trim($params['video_url_meta'])!=''&&is_numeric(trim($params['video_url_meta'])))?trim($params['video_url_meta']):'0';
			$options['video_url_meta_key']		= (isset($params['video_url_meta_key'])&&trim($params['video_url_meta_key'])!='')?trim($params['video_url_meta_key']):'';
			$options['s_icon_lightbox_image']	= (isset($params['s_icon_lightbox_image'])&&trim($params['s_icon_lightbox_image'])!=''&&is_numeric(trim($params['s_icon_lightbox_image'])))?trim($params['s_icon_lightbox_image']):'1';
			$options['s_icon_link']				= (isset($params['s_icon_link'])&&trim($params['s_icon_link'])!=''&&is_numeric(trim($params['s_icon_link'])))?trim($params['s_icon_link']):'1';
			$options['s_icon_link_target']		= (isset($params['s_icon_link_target'])&&trim($params['s_icon_link_target'])!=''&&is_numeric(trim($params['s_icon_link_target'])))?trim($params['s_icon_link_target']):'0';
			$options['s_image_hover_effect']	= (isset($params['s_image_hover_effect'])&&trim($params['s_image_hover_effect'])!=''&&is_numeric(trim($params['s_image_hover_effect'])))?trim($params['s_image_hover_effect']):'0';
			$options['s_overlay_hover_effect']	= (isset($params['s_overlay_hover_effect'])&&trim($params['s_overlay_hover_effect'])!='')?trim($params['s_overlay_hover_effect']):'';
			$options['s_overlay_settings']		= (isset($params['s_overlay_settings'])&&trim($params['s_overlay_settings'])!=''&&is_numeric(trim($params['s_overlay_settings'])))?trim($params['s_overlay_settings']):'0';
			$options['s_overlay_color']			= (isset($params['s_overlay_color'])&&trim($params['s_overlay_color'])!='')?trim($params['s_overlay_color']):'';
			
			$options['s_image_post_format']	= (isset($params['s_image_post_format'])&&trim($params['s_image_post_format'])!=''&&is_numeric(trim($params['s_image_post_format'])))?trim($params['s_image_post_format']):'0';
			$options['s_image_post_format_pos']	= (isset($params['s_image_post_format_pos'])&&trim($params['s_image_post_format_pos'])!='')?trim($params['s_image_post_format_pos']):'ul-bottom-right';
			
			$options['s_image_avatar']			= (isset($params['s_image_avatar'])&&trim($params['s_image_avatar'])!=''&&is_numeric(trim($params['s_image_avatar'])))?trim($params['s_image_avatar']):'0';
			//image options
			
			//title options
			$options['s_title']					= (isset($params['s_title'])&&trim($params['s_title'])!=''&&is_numeric(trim($params['s_title'])))?trim($params['s_title']):'1';
			$options['s_title_limit']			= (isset($params['s_title_limit'])&&trim($params['s_title_limit'])!=''&&is_numeric(trim($params['s_title_limit'])))?trim($params['s_title_limit']):'0';
			$options['s_title_link']			= (isset($params['s_title_link'])&&trim($params['s_title_link'])!=''&&is_numeric(trim($params['s_title_link'])))?trim($params['s_title_link']):'1';
			$options['s_title_link_target']		= (isset($params['s_title_link_target'])&&trim($params['s_title_link_target'])!=''&&is_numeric(trim($params['s_title_link_target'])))?trim($params['s_title_link_target']):'0';
			//title options		
			
			//excerpt options
			$options['s_excerpt']				= (isset($params['s_excerpt'])&&trim($params['s_excerpt'])!=''&&is_numeric(trim($params['s_excerpt'])))?trim($params['s_excerpt']):'1';
			$options['s_excerpt_rbtn']			= (isset($params['s_excerpt_rbtn'])&&trim($params['s_excerpt_rbtn'])!=''&&is_numeric(trim($params['s_excerpt_rbtn'])))?trim($params['s_excerpt_rbtn']):'0';
			$options['s_excerpt_f']				= (isset($params['s_excerpt_f'])&&trim($params['s_excerpt_f'])!=''&&trim($params['s_excerpt_f'])!='get_the_excerpt')?trim($params['s_excerpt_f']):'get_the_excerpt';
			$options['s_excerpt_sc']			= (isset($params['s_excerpt_sc'])&&trim($params['s_excerpt_sc'])!=''&&is_numeric(trim($params['s_excerpt_sc'])))?trim($params['s_excerpt_sc']):'1';
			$options['s_excerpt_sh']			= (isset($params['s_excerpt_sh'])&&trim($params['s_excerpt_sh'])!=''&&is_numeric(trim($params['s_excerpt_sh'])))?trim($params['s_excerpt_sh']):'1';
			$options['s_excerpt_length']		= (isset($params['s_excerpt_length'])&&trim($params['s_excerpt_length'])!=''&&is_numeric(trim($params['s_excerpt_length'])))?trim($params['s_excerpt_length']):0;
			//excerpt options	
			
			//taxonomy options
			$options['s_categories']			= (isset($params['s_categories'])&&trim($params['s_categories'])!=''&&is_numeric(trim($params['s_categories'])))?trim($params['s_categories']):'1';
			$options['s_s_categories']			= (isset($params['s_s_categories'])&&trim($params['s_s_categories'])!=''&&is_numeric(trim($params['s_s_categories'])))?trim($params['s_s_categories']):'0';
			$options['s_s_categories_parent']	= (isset($params['s_s_categories_parent'])&&trim($params['s_s_categories_parent'])!=''&&is_numeric(trim($params['s_s_categories_parent'])))?trim($params['s_s_categories_parent']):'0';
			$options['ex_items_taxonomies'] 	= (isset($params['ex_items_taxonomies'])&&trim($params['ex_items_taxonomies'])!='')?trim($params['ex_items_taxonomies']):'';
			$options['s_c_categories']			= (isset($params['s_c_categories'])&&trim($params['s_c_categories'])!=''&&is_numeric(trim($params['s_c_categories'])))?trim($params['s_c_categories']):'0';
			$options['s_ct_categories']			= (isset($params['s_ct_categories'])&&trim($params['s_ct_categories'])!='')?trim($params['s_ct_categories']):'';
			$options['s_cb_categories']			= (isset($params['s_cb_categories'])&&trim($params['s_cb_categories'])!='')?trim($params['s_cb_categories']):'';
			$options['s_categories_target']		= (isset($params['s_categories_target'])&&trim($params['s_categories_target'])!=''&&is_numeric(trim($params['s_categories_target'])))?trim($params['s_categories_target']):'0';
			//taxonomy options
			
			//Post Metas 1
			$options['s_metas_o']				= (isset($params['s_metas_o'])&&trim($params['s_metas_o'])!=''&&is_numeric(trim($params['s_metas_o'])))?trim($params['s_metas_o']):'1';
			$options['s_metas_o_author']		= (isset($params['s_metas_o_author'])&&trim($params['s_metas_o_author'])!=''&&is_numeric(trim($params['s_metas_o_author'])))?trim($params['s_metas_o_author']):'1';
			$options['s_metas_o_author_avatar']	= (isset($params['s_metas_o_author_avatar'])&&trim($params['s_metas_o_author_avatar'])!=''&&is_numeric(trim($params['s_metas_o_author_avatar'])))?trim($params['s_metas_o_author_avatar']):'0';
			$options['s_metas_o_time']			= (isset($params['s_metas_o_time'])&&trim($params['s_metas_o_time'])!=''&&is_numeric(trim($params['s_metas_o_time'])))?trim($params['s_metas_o_time']):'1';
			$options['time_format']				= (isset($params['time_format'])&&trim($params['time_format'])!='')?trim($params['time_format']):'F j, Y';
			$options['s_metas_o_comment']		= (isset($params['s_metas_o_comment'])&&trim($params['s_metas_o_comment'])!=''&&is_numeric(trim($params['s_metas_o_comment'])))?trim($params['s_metas_o_comment']):'1';
			$options['s_metas_o_like']			= (isset($params['s_metas_o_like'])&&trim($params['s_metas_o_like'])!=''&&is_numeric(trim($params['s_metas_o_like'])))?trim($params['s_metas_o_like']):'0';
			$options['s_metas_o_share']			= (isset($params['s_metas_o_share'])&&trim($params['s_metas_o_share'])!=''&&is_numeric(trim($params['s_metas_o_share'])))?trim($params['s_metas_o_share']):'0';
			$options['custom_meta_o']			= (isset($params['custom_meta_o'])&&trim($params['custom_meta_o'])!='')?trim($params['custom_meta_o']):'';
			//Post Metas 1
			
			//Post Metas 2
			$options['s_metas_t']				= (isset($params['s_metas_t'])&&trim($params['s_metas_t'])!=''&&is_numeric(trim($params['s_metas_t'])))?trim($params['s_metas_t']):'1';
			$options['s_metas_t_author']		= (isset($params['s_metas_t_author'])&&trim($params['s_metas_t_author'])!=''&&is_numeric(trim($params['s_metas_t_author'])))?trim($params['s_metas_t_author']):'0';
			$options['s_metas_t_author_avatar']	= (isset($params['s_metas_t_author_avatar'])&&trim($params['s_metas_t_author_avatar'])!=''&&is_numeric(trim($params['s_metas_t_author_avatar'])))?trim($params['s_metas_t_author_avatar']):'0';
			$options['s_metas_t_time']			= (isset($params['s_metas_t_time'])&&trim($params['s_metas_t_time'])!=''&&is_numeric(trim($params['s_metas_t_time'])))?trim($params['s_metas_t_time']):'0';
			$options['time_format_t']			= (isset($params['time_format_t'])&&trim($params['time_format_t'])!='')?trim($params['time_format_t']):'F j, Y';
			$options['s_metas_t_comment']		= (isset($params['s_metas_t_comment'])&&trim($params['s_metas_t_comment'])!=''&&is_numeric(trim($params['s_metas_t_comment'])))?trim($params['s_metas_t_comment']):'0';
			$options['s_metas_t_like']			= (isset($params['s_metas_t_like'])&&trim($params['s_metas_t_like'])!=''&&is_numeric(trim($params['s_metas_t_like'])))?trim($params['s_metas_t_like']):'1';
			$options['s_metas_t_share']			= (isset($params['s_metas_t_share'])&&trim($params['s_metas_t_share'])!=''&&is_numeric(trim($params['s_metas_t_share'])))?trim($params['s_metas_t_share']):'1';
			$options['custom_meta_t']			= (isset($params['custom_meta_t'])&&trim($params['custom_meta_t'])!='')?trim($params['custom_meta_t']):'';
			$options['s_metas_t_readmore']		= (isset($params['s_metas_t_readmore'])&&trim($params['s_metas_t_readmore'])!=''&&is_numeric(trim($params['s_metas_t_readmore'])))?trim($params['s_metas_t_readmore']):'1';
			$options['s_metas_t_readmore_link_target']	= (isset($params['s_metas_t_readmore_link_target'])&&trim($params['s_metas_t_readmore_link_target'])!=''&&is_numeric(trim($params['s_metas_t_readmore_link_target'])))?trim($params['s_metas_t_readmore_link_target']):'0';
			//Post Metas 2
			
			$options['share_text']				= (isset($params['share_text'])&&trim($params['share_text'])!='')?trim($params['share_text']):'';
			$options['read_more_text']			= (isset($params['read_more_text'])&&trim($params['read_more_text'])!='')?trim($params['read_more_text']):'';
			$options['before_author_text']		= (isset($params['before_author_text'])&&trim($params['before_author_text'])!='')?trim($params['before_author_text']):'';
			
			//Pagination
			$options['pagination']				= (isset($params['pagination'])&&trim($params['pagination'])!=''&&is_numeric(trim($params['pagination'])))?trim($params['pagination']):'0';
			$options['loadmore_text']			= (isset($params['loadmore_text'])&&trim($params['loadmore_text'])!='')?trim($params['loadmore_text']):'';
			$options['prev_text']				= (isset($params['prev_text'])&&trim($params['prev_text'])!='')?trim($params['prev_text']):'';
			$options['next_text']				= (isset($params['next_text'])&&trim($params['next_text'])!='')?trim($params['next_text']):'';
			//Pagination
			
			//Animate
			$options['animate']					= (isset($params['animate'])&&trim($params['animate'])!='')?trim($params['animate']):'default';
			//Animate
			
			//Lazyload
			$options['lazyload']				= (isset($params['lazyload'])&&trim($params['lazyload'])!=''&&is_numeric(trim($params['lazyload'])))?trim($params['lazyload']):'0';
			$options['lazyload_p']				= (isset($params['lazyload_p'])&&trim($params['lazyload_p'])!='')?trim($params['lazyload_p']):'';
			//Lazyload
			
			$options['geodirectory_rating']		= (isset($params['geodirectory_rating'])&&trim($params['geodirectory_rating'])!=''&&is_numeric(trim($params['geodirectory_rating'])))?trim($params['geodirectory_rating']):'0';
			
			$options['quick_view']				= (isset($params['quick_view'])&&trim($params['quick_view'])!=''&&is_numeric(trim($params['quick_view'])))?trim($params['quick_view']):'1';
			$options['quick_view_mode']			= (isset($params['quick_view_mode'])&&trim($params['quick_view_mode'])!=''&&is_numeric(trim($params['quick_view_mode'])))?trim($params['quick_view_mode']):'0';
			
			//extra class
			$options['extra_class']				= (isset($params['extra_class'])&&trim($params['extra_class'])!='')?trim($params['extra_class']):'';
			$options['rnd_id']					= 'ul'.rand(1, 99999);
			//extra class
			
				//small item content blocks
					//title options
					$options['s_title_small']				= (isset($params['s_title_small'])&&trim($params['s_title_small'])!=''&&is_numeric(trim($params['s_title_small'])))?trim($params['s_title_small']):'1';
					$options['s_title_limit_small']			= (isset($params['s_title_limit_small'])&&trim($params['s_title_limit_small'])!=''&&is_numeric(trim($params['s_title_limit_small'])))?trim($params['s_title_limit_small']):'0';
					$options['s_title_link_small']			= (isset($params['s_title_link_small'])&&trim($params['s_title_link_small'])!=''&&is_numeric(trim($params['s_title_link_small'])))?trim($params['s_title_link_small']):'1';
					$options['s_title_link_target_small']	= (isset($params['s_title_link_target_small'])&&trim($params['s_title_link_target_small'])!=''&&is_numeric(trim($params['s_title_link_target_small'])))?trim($params['s_title_link_target_small']):'0';
					//title options	
					
					//taxonomy options
					$options['s_categories_small']			= (isset($params['s_categories_small'])&&trim($params['s_categories_small'])!=''&&is_numeric(trim($params['s_categories_small'])))?trim($params['s_categories_small']):'1';
					$options['s_s_categories_small']		= (isset($params['s_s_categories_small'])&&trim($params['s_s_categories_small'])!=''&&is_numeric(trim($params['s_s_categories_small'])))?trim($params['s_s_categories_small']):'0';
					$options['s_s_categories_parent_small']	= (isset($params['s_s_categories_parent_small'])&&trim($params['s_s_categories_parent_small'])!=''&&is_numeric(trim($params['s_s_categories_parent_small'])))?trim($params['s_s_categories_parent_small']):'0';
					$options['ex_items_taxonomies_small'] 	= (isset($params['ex_items_taxonomies_small'])&&trim($params['ex_items_taxonomies_small'])!='')?trim($params['ex_items_taxonomies_small']):'';
					$options['s_c_categories_small']		= (isset($params['s_c_categories_small'])&&trim($params['s_c_categories_small'])!=''&&is_numeric(trim($params['s_c_categories_small'])))?trim($params['s_c_categories_small']):'0';
					$options['s_ct_categories_small']		= (isset($params['s_ct_categories_small'])&&trim($params['s_ct_categories_small'])!='')?trim($params['s_ct_categories_small']):'';
					$options['s_cb_categories_small']		= (isset($params['s_cb_categories_small'])&&trim($params['s_cb_categories_small'])!='')?trim($params['s_cb_categories_small']):'';
					$options['s_categories_target_small']	= (isset($params['s_categories_target_small'])&&trim($params['s_categories_target_small'])!=''&&is_numeric(trim($params['s_categories_target_small'])))?trim($params['s_categories_target_small']):'0';
					//taxonomy options
					
					//Post Metas 1
					$options['s_metas_o_small']			= (isset($params['s_metas_o_small'])&&trim($params['s_metas_o_small'])!=''&&is_numeric(trim($params['s_metas_o_small'])))?trim($params['s_metas_o_small']):'1';
					$options['s_metas_o_author_small']	= (isset($params['s_metas_o_author_small'])&&trim($params['s_metas_o_author_small'])!=''&&is_numeric(trim($params['s_metas_o_author_small'])))?trim($params['s_metas_o_author_small']):'1';
					$options['s_metas_o_author_avatar_small']	= (isset($params['s_metas_o_author_avatar_small'])&&trim($params['s_metas_o_author_avatar_small'])!=''&&is_numeric(trim($params['s_metas_o_author_avatar_small'])))?trim($params['s_metas_o_author_avatar_small']):'0';
					$options['s_metas_o_time_small']	= (isset($params['s_metas_o_time_small'])&&trim($params['s_metas_o_time_small'])!=''&&is_numeric(trim($params['s_metas_o_time_small'])))?trim($params['s_metas_o_time_small']):'1';
					$options['time_format_small']		= (isset($params['time_format_small'])&&trim($params['time_format_small'])!='')?trim($params['time_format_small']):'F j, Y';
					$options['s_metas_o_comment_small']	= (isset($params['s_metas_o_comment_small'])&&trim($params['s_metas_o_comment_small'])!=''&&is_numeric(trim($params['s_metas_o_comment_small'])))?trim($params['s_metas_o_comment_small']):'1';
					$options['s_metas_o_like_small']	= (isset($params['s_metas_o_like_small'])&&trim($params['s_metas_o_like_small'])!=''&&is_numeric(trim($params['s_metas_o_like_small'])))?trim($params['s_metas_o_like_small']):'0';
					$options['s_metas_o_share_small']	= (isset($params['s_metas_o_share_small'])&&trim($params['s_metas_o_share_small'])!=''&&is_numeric(trim($params['s_metas_o_share_small'])))?trim($params['s_metas_o_share_small']):'0';
					$options['custom_meta_o_small']		= (isset($params['custom_meta_o_small'])&&trim($params['custom_meta_o_small'])!='')?trim($params['custom_meta_o_small']):'';
					//Post Metas 1	
				//small item content blocks
				
				//woo
					$options['woo_show_price']			= (isset($params['woo_show_price'])&&trim($params['woo_show_price'])!=''&&is_numeric(trim($params['woo_show_price'])))?trim($params['woo_show_price']):'0';
					$options['woo_show_rating']			= (isset($params['woo_show_rating'])&&trim($params['woo_show_rating'])!=''&&is_numeric(trim($params['woo_show_rating'])))?trim($params['woo_show_rating']):'0';
					$options['woo_show_cart']			= (isset($params['woo_show_cart'])&&trim($params['woo_show_cart'])!=''&&is_numeric(trim($params['woo_show_cart'])))?trim($params['woo_show_cart']):'0';
				//woo
				
				//quick view
					$options['qv_s_title']					= (isset($params['qv_s_title'])&&trim($params['qv_s_title'])!=''&&is_numeric(trim($params['qv_s_title'])))?trim($params['qv_s_title']):'1';
				
					//taxonomy options
					$options['qv_s_categories']			= (isset($params['qv_s_categories'])&&trim($params['qv_s_categories'])!=''&&is_numeric(trim($params['qv_s_categories'])))?trim($params['qv_s_categories']):'1';
					$options['qv_s_s_categories']		= (isset($params['qv_s_s_categories'])&&trim($params['qv_s_s_categories'])!=''&&is_numeric(trim($params['qv_s_s_categories'])))?trim($params['qv_s_s_categories']):'0';
					$options['qv_s_s_categories_parent']= (isset($params['qv_s_s_categories_parent'])&&trim($params['qv_s_s_categories_parent'])!=''&&is_numeric(trim($params['qv_s_s_categories_parent'])))?trim($params['qv_s_s_categories_parent']):'0';
					$options['qv_ex_items_taxonomies'] 	= (isset($params['qv_ex_items_taxonomies'])&&trim($params['qv_ex_items_taxonomies'])!='')?trim($params['qv_ex_items_taxonomies']):'';
					$options['qv_s_c_categories']		= (isset($params['qv_s_c_categories'])&&trim($params['qv_s_c_categories'])!=''&&is_numeric(trim($params['qv_s_c_categories'])))?trim($params['qv_s_c_categories']):'0';
					$options['qv_s_ct_categories']		= (isset($params['qv_s_ct_categories'])&&trim($params['qv_s_ct_categories'])!='')?trim($params['qv_s_ct_categories']):'';
					$options['qv_s_cb_categories']		= (isset($params['qv_s_cb_categories'])&&trim($params['qv_s_cb_categories'])!='')?trim($params['qv_s_cb_categories']):'';
					$options['qv_s_categories_target']	= (isset($params['qv_s_categories_target'])&&trim($params['qv_s_categories_target'])!=''&&is_numeric(trim($params['qv_s_categories_target'])))?trim($params['qv_s_categories_target']):'0';
					//taxonomy options
					
					//Post Metas 1
					$options['qv_s_metas_o']			= (isset($params['qv_s_metas_o'])&&trim($params['qv_s_metas_o'])!=''&&is_numeric(trim($params['qv_s_metas_o'])))?trim($params['qv_s_metas_o']):'1';
					$options['qv_s_metas_o_author']		= (isset($params['qv_s_metas_o_author'])&&trim($params['qv_s_metas_o_author'])!=''&&is_numeric(trim($params['qv_s_metas_o_author'])))?trim($params['qv_s_metas_o_author']):'1';
					$options['qv_s_metas_o_author_avatar']	= (isset($params['qv_s_metas_o_author_avatar'])&&trim($params['qv_s_metas_o_author_avatar'])!=''&&is_numeric(trim($params['qv_s_metas_o_author_avatar'])))?trim($params['qv_s_metas_o_author_avatar']):'0';
					$options['qv_s_metas_o_time']		= (isset($params['qv_s_metas_o_time'])&&trim($params['qv_s_metas_o_time'])!=''&&is_numeric(trim($params['qv_s_metas_o_time'])))?trim($params['qv_s_metas_o_time']):'1';
					$options['qv_time_format']			= (isset($params['qv_time_format'])&&trim($params['qv_time_format'])!='')?trim($params['qv_time_format']):'F j, Y';
					$options['qv_s_metas_o_comment']	= (isset($params['qv_s_metas_o_comment'])&&trim($params['qv_s_metas_o_comment'])!=''&&is_numeric(trim($params['qv_s_metas_o_comment'])))?trim($params['qv_s_metas_o_comment']):'1';
					$options['qv_s_metas_o_like']		= (isset($params['qv_s_metas_o_like'])&&trim($params['qv_s_metas_o_like'])!=''&&is_numeric(trim($params['qv_s_metas_o_like'])))?trim($params['qv_s_metas_o_like']):'1';
					$options['qv_custom_meta_o']		= (isset($params['qv_custom_meta_o'])&&trim($params['qv_custom_meta_o'])!='')?trim($params['qv_custom_meta_o']):'';
					//Post Metas 1
					
					$options['qv_show_content']			= (isset($params['qv_show_content'])&&trim($params['qv_show_content'])!=''&&is_numeric(trim($params['qv_show_content'])))?trim($params['qv_show_content']):'1';
					$options['qv_content_stripsc']		= (isset($params['qv_content_stripsc'])&&trim($params['qv_content_stripsc'])!=''&&is_numeric(trim($params['qv_content_stripsc'])))?trim($params['qv_content_stripsc']):'0';
					
					$options['qv_show_share']			= (isset($params['qv_show_share'])&&trim($params['qv_show_share'])!=''&&is_numeric(trim($params['qv_show_share'])))?trim($params['qv_show_share']):'1';
					$options['qv_woo_show_rating']		= (isset($params['qv_woo_show_rating'])&&trim($params['qv_woo_show_rating'])!=''&&is_numeric(trim($params['qv_woo_show_rating'])))?trim($params['qv_woo_show_rating']):'1';
					$options['qv_s_featured_image']		= (isset($params['qv_s_featured_image'])&&trim($params['qv_s_featured_image'])!=''&&is_numeric(trim($params['qv_s_featured_image'])))?trim($params['qv_s_featured_image']):'1';
				//quick view
				
				$options['goo_ads_client']			= (isset($params['goo_ads_client'])&&trim($params['goo_ads_client'])!='')?trim($params['goo_ads_client']):'';
				$options['goo_ads_id']				= (isset($params['goo_ads_id'])&&trim($params['goo_ads_id'])!='')?trim($params['goo_ads_id']):'';
				$options['goo_ads_offset']			= (isset($params['goo_ads_offset'])&&trim($params['goo_ads_offset'])!='')?trim($params['goo_ads_offset']):'1';
				
			
			//echo count($options);
			//End Build Options
			self::$add_script_core = true;
			self::$add_script_slick = true;
			
			if($options['grid_masonry']=='1' || $options['layout_style']=='5'){
				self::$add_script_masonry = true;
			}	
			if($options['pagination']=='1'){
				self::$add_script_pagination = true;
			}	
			
			if($options['quick_view']=='1'){
				self::$add_script_malihu = true;	
			}
			
			$options['css_class'] = '';
			if(function_exists('vc_shortcode_custom_css_class')){
				$options['css_class'] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), 'ult_layout', $params);
			}
			
			$inline_css = '';
			//if(!is_singular()){
				$params['custom_css_id'] = $options['rnd_id'];
				$custom_css_gen = ultimate_layouts_parse_custom_css($params);
				$custom_css_font = ultimate_layouts_custom_font($params);
				if($custom_css_gen!='' || $custom_css_font!=''){
					$inline_css = 	'<aside class="ul-custom-css-inline">										
										'.$custom_css_font.$custom_css_gen.'
										<h6>h6</h6>
									</aside>';
				}
			//}
									
			return $inline_css.my_ultimateLayouts_bete_html::html_builder($query_params, $filter, $order, $orderby, $sub_opt_query, $options, $contents);
		}
		
			/*filter container*/
			static function filter_container($params, $contents=''){
				extract(
					shortcode_atts(
						array(						
							'display_type'						=>'',
							'title'								=>'',
							'query_type'						=>'',
							'query_operator'					=>'',
							'query_relation'					=>'',
							'query_child_tax'					=>'',							
							'show_number'						=>'',
							'has_filters'						=>'',
							'extra_class'						=>'',												
						), 
						$params
					)				
				);				
				
				$display_type		= (isset($params['display_type'])&&trim($params['display_type'])!=''&&is_numeric(trim($params['display_type'])))?trim($params['display_type']):'0';
				$title 				= (isset($params['title'])&&trim($params['title'])!='')?trim($params['title']):'';
				$title_link			= (isset($params['title_link'])&&trim($params['title_link'])!='')?trim($params['title_link']):'';
				$query_type			= (isset($params['query_type'])&&trim($params['query_type'])!=''&&is_numeric(trim($params['query_type'])))?trim($params['query_type']):'0';	
				$query_operator		= (isset($params['query_operator'])&&trim($params['query_operator'])!=''&&is_numeric(trim($params['query_operator'])))?trim($params['query_operator']):'0';	
				$query_relation		= (isset($params['query_relation'])&&trim($params['query_relation'])!=''&&is_numeric(trim($params['query_relation'])))?trim($params['query_relation']):'0';	
				$query_child_tax	= (isset($params['query_child_tax'])&&trim($params['query_child_tax'])!=''&&is_numeric(trim($params['query_child_tax'])))?trim($params['query_child_tax']):'0';
				$secondary_cat 		= (isset($params['secondary_cat'])&&trim($params['secondary_cat'])!='')?trim($params['secondary_cat']):'';				
				$show_number		= (isset($params['show_number'])&&trim($params['show_number'])!=''&&is_numeric(trim($params['show_number'])))?trim($params['show_number']):'1';
				$has_filters		= (isset($params['has_filters'])&&trim($params['has_filters'])!=''&&is_numeric(trim($params['has_filters'])))?trim($params['has_filters']):'0';
				$extra_class		= (isset($params['extra_class'])&&trim($params['extra_class'])!='')?trim($params['extra_class']):'';
				
				if($display_type=='2'){
					self::$add_script_priority = true;
				}
				
				global $ultimate_layouts_show_number;
				$ultimate_layouts_show_number = $show_number;
				
				global $ul_filter_display_type;
				$ul_filter_display_type = $display_type;
								
				
				global $global_query_params;
				global $global_filter;
				global $global_order;
				global $global_orderby;
				global $global_sub_opt_query;
				
				ob_start();				
					$before_content_filter = '';
					$after_content_filter = '';
					$filter_title = '';
					
					if($title!=''){
						$before_title = '';
						$after_title = '';
						if($title_link!=''){
							$before_title = '<a href="'.$title_link.'" title="'.esc_attr($title).'" class="ultimate-layouts-tab-link">';
							$after_title = '</a>';
						}
						$filter_title = '<div class="ul-smart-tab-title-wrap"><div class="ul-smart-tab-title">'.$before_title.$title.$after_title.'</div></div>';
					}
					
					if($display_type=='1'){
						$before_content_filter 	= '<div class="ultimate-layouts-filter-container" data-query-type="'.$display_type.'">
														<div class="ul-s-dropdown-filter">																										
															<div class="ul-filter-elements-wrap">														
												  ';
						$after_content_filter 	= '
												  			</div>
														</div>	
												  </div>
												  ';
					}elseif($display_type=='2'){	
						$before_content_filter 	= '<div class="ultimate-layouts-filter-container" data-query-type="'.$display_type.'">
														<div class="ul-smart-tab-filter">
															'.$filter_title.'														
															<div class="ul-filter-elements-wrap">														
												  ';
						$after_content_filter 	= '
												  			</div>
														</div>	
												  </div>
												  ';
					}else{
						$before_content_filter 	= '<div class="ultimate-layouts-filter-container" data-query-type="'.$display_type.'">';
						$after_content_filter 	= '</div>';
					}
					
					echo $before_content_filter;
					?>
                    <div class="ultimate-layouts-sc-filter-container <?php echo esc_attr($extra_class);?>" data-display-type="<?php echo esc_attr($display_type);?>" data-query-type="<?php echo esc_attr($query_type);?>" data-query-operator="<?php echo esc_attr($query_operator);?>" data-query-relation="<?php echo esc_attr($query_relation);?>" data-query-child-tax="<?php echo esc_attr($query_child_tax);?>" data-secondary-cat="<?php echo esc_attr($secondary_cat);?>" data-hash-filters="<?php echo esc_attr($has_filters);?>">
                    	<?php echo do_shortcode($contents);?>
                    </div>
                    <?php
					echo $after_content_filter;
				$output_string = ob_get_contents();
				ob_end_clean();
				return $output_string;
			}
			//Filter Items
			static function filter_items($params){
				extract(
					shortcode_atts(
						array(						
							'filter_items'						=>'',	
							'show_all'							=>'',
							'show_all_text'						=>'',						
							'extra_class'						=>'',												
						), 
						$params
					)				
				);
					
				$filter_items		= (isset($params['filter_items'])&&trim($params['filter_items'])!='')?trim($params['filter_items']):'';	
				$show_all			= (isset($params['show_all'])&&trim($params['show_all'])!=''&&is_numeric(trim($params['show_all'])))?trim($params['show_all']):'1';
				$show_all_text		= (isset($params['show_all_text'])&&trim($params['show_all_text'])!='')?trim($params['show_all_text']):'';	
				$dd_title_text		= (isset($params['dd_title_text'])&&trim($params['dd_title_text'])!='')?trim($params['dd_title_text']):'';		
				$extra_class		= (isset($params['extra_class'])&&trim($params['extra_class'])!='')?trim($params['extra_class']):'';
				
				ob_start();					
					if($filter_items!=''){
						global $ultimate_layouts_tax_filter;	
						global $ultimate_layouts_show_number;
						global $ul_filter_display_type;												
						
						global $global_query_params;
						global $global_filter;
						global $global_order;
						global $global_orderby;
						global $global_sub_opt_query;
						
						$before_items 	= '';
						$after_items 	= '';
						
						$show_all_echo 		= 	($show_all_text!='')?$show_all_text:__('Show All', 'ultimate_layouts');
						$dd_title_text_echo	= 	($dd_title_text!='')?$dd_title_text:__('Filter', 'ultimate_layouts');
						$show_all_number 	= 	$ultimate_layouts_show_number=='1'
												?'<span class="tax-number">('.my_ultimateLayouts_bete_query::build_query($global_query_params, '', $global_order, $global_orderby, $global_sub_opt_query, true).')</span>'
												:'';	
						
						
						if($ul_filter_display_type=='1'){
							$before_items 	= 	'
												<div class="filter-dropdown-wrapper">
													<div class="ultimate-layouts-filter-item ul-default-dd-filter">
														<span class="tax-name">
															'.$dd_title_text_echo.'
														</span>
														<i class="fa fa-angle-down ul-arrow-angle" aria-hidden="true"></i>
														<span class="ul-number-filter"></span>
													</div>		
													<div class="filter-dropdown-wrapper-list">
												';
							$after_items 	= 	'
													</div>
												</div>
												';
						}elseif($ul_filter_display_type=='2'){
							$before_items 	= 	'
												<div class="filter-tab-wrapper">
													<div class="filter-tab-wrapper-list">
												';
							$after_items 	= 	'
													</div>
												</div>
												';
						}
						
						echo $before_items;
						
						if($show_all=='1'){?>
                            <div class="ultimate-layouts-filter-item ul-filter-action ul-show-all-action active-elm" data-filter="" data-item-hf="all">
                                <span class="tax-name">
                                    <?php echo $show_all_echo;?>
                                </span>
                                <?php echo $show_all_number;?>
                                
                                <div class="ul-loading-item-filter-container">
                                    <div class="la-ball-scale-multiple la-2x ul-loading-item-filter">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>                            
                        <?php }
										
						$param_ids = explode(',', $filter_items);				
						foreach($param_ids as $filter_item){	
							if(is_numeric(trim($filter_item))){																							
								$get_terms_filter = 	get_terms(
															$ultimate_layouts_tax_filter, 
															array(
																'fields'	=> 'all', 
																'include' 	=> array(trim($filter_item)),
															)
														);								
								if(!is_wp_error($get_terms_filter) && !empty($get_terms_filter)){
									$total_children = 0;									
									$tax_item_name 	= '';
									$tax_item_taxo 	= '';
									$get_chidrens 	= array();
									foreach($get_terms_filter as $get_terms_filter_item){
										$tax_item_name = esc_html($get_terms_filter_item->name);		
										$tax_item_taxo = $get_terms_filter_item->taxonomy;	
										$get_chidrens = get_term_children(trim($filter_item), $tax_item_taxo);																
									}
									if(isset($get_chidrens) && !is_wp_error($get_chidrens) && !empty($get_chidrens)){
										$total_children = count($get_chidrens);
									}
								?>
                                    <div class="ultimate-layouts-filter-item ul-filter-action <?php echo esc_attr($extra_class);?>" data-filter="<?php echo trim($filter_item);?>" data-total-children="<?php echo $total_children;?>" data-taxonomy="<?php echo $tax_item_taxo;?>" data-show-number-post="<?php echo $ultimate_layouts_show_number;?>" data-item-hf="<?php echo sanitize_title($tax_item_name);?>">
                                        <span class="tax-name">
											<?php echo $tax_item_name;?>
                                        </span>
                                        <?php if($ultimate_layouts_show_number=='1'){?>
                                        	<span class="tax-number">
                                            	(<?php echo my_ultimateLayouts_bete_query::build_query($global_query_params, trim($filter_item), $global_order, $global_orderby, $global_sub_opt_query, true);?>)
                                            </span>
                                        <?php }?>
                                        
                                        <span class="close-filter"></span>
                                        <div class="ul-loading-item-filter-container">
                                            <div class="la-ball-scale-multiple la-2x ul-loading-item-filter">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
								}
							}
						}
						
						echo $after_items;		
					}
				$output_string = ob_get_contents();
				ob_end_clean();
				return $output_string;
			}			
			//Order By
			static function order_by($params){
				extract(
					shortcode_atts(
						array(		
							'sbn_text'							=>'',
							'sortb_date'						=>'',
							'sortb_id'							=>'',
							'sortb_title'						=>'',
							'sortb_comment'						=>'',
							'sortb_author'						=>'',
							'sortb_price'						=>'',		
							'extra_class'						=>'',												
						), 
						$params
					)				
				);
				$sbn_text			= (isset($params['sbn_text'])&&trim($params['sbn_text'])!='')?trim($params['sbn_text']):'';
				$sortb_date			= (isset($params['sortb_date'])&&trim($params['sortb_date'])!=''&&is_numeric(trim($params['sortb_date'])))?trim($params['sortb_date']):'1';
				$sortb_id			= (isset($params['sortb_id'])&&trim($params['sortb_id'])!=''&&is_numeric(trim($params['sortb_id'])))?trim($params['sortb_id']):'1';
				$sortb_title		= (isset($params['sortb_title'])&&trim($params['sortb_title'])!=''&&is_numeric(trim($params['sortb_title'])))?trim($params['sortb_title']):'1';
				$sortb_comment		= (isset($params['sortb_comment'])&&trim($params['sortb_comment'])!=''&&is_numeric(trim($params['sortb_comment'])))?trim($params['sortb_comment']):'1';
				$sortb_author		= (isset($params['sortb_author'])&&trim($params['sortb_author'])!=''&&is_numeric(trim($params['sortb_author'])))?trim($params['sortb_author']):'1';
				$sortb_price		= (isset($params['sortb_price'])&&trim($params['sortb_price'])!=''&&is_numeric(trim($params['sortb_price'])))?trim($params['sortb_price']):'0';
				$sortb_sales		= (isset($params['sortb_sales'])&&trim($params['sortb_sales'])!=''&&is_numeric(trim($params['sortb_sales'])))?trim($params['sortb_sales']):'0';
				$sortb_rating		= (isset($params['sortb_rating'])&&trim($params['sortb_rating'])!=''&&is_numeric(trim($params['sortb_rating'])))?trim($params['sortb_rating']):'0';
				$extra_class		= (isset($params['extra_class'])&&trim($params['extra_class'])!='')?trim($params['extra_class']):'';
				
				ob_start();
				?>
                <div class="ultimate-layouts-filter-item ul-order-by-action <?php echo esc_attr($extra_class);?>">
                    <span class="order-by-default" data-order-by="none">
                        <span class="ul-text-order-by"><?php echo ($sbn_text!='')?esc_html($sbn_text):__('Sort By None', 'ultimate_layouts');?></span>
                        <i class="fa fa-angle-down ul-arrow-angle" aria-hidden="true"></i>
                    </span>                     
                    
                    <span class="order-by-dropdown">
                    	<?php if($sortb_date=='1'){?>
                    		<span class="order-by-dropdown-item" data-order-by="date"><?php echo __('Sort By Date', 'ultimate_layouts')?></span>
                        <?php }
						if($sortb_id=='1'){
						?>
                        	<span class="order-by-dropdown-item" data-order-by="ID"><?php echo __('Sort By ID', 'ultimate_layouts')?></span>
                        <?php }
						if($sortb_title=='1'){
						?>
                        	<span class="order-by-dropdown-item" data-order-by="title"><?php echo __('Sort By Title', 'ultimate_layouts')?></span>
                        <?php }
						if($sortb_comment=='1'){
						?>
                       	 <span class="order-by-dropdown-item" data-order-by="comment_count"><?php echo __('Sort By Comment', 'ultimate_layouts')?></span>
                        <?php }
						if($sortb_author=='1'){
						?>
                        	<span class="order-by-dropdown-item" data-order-by="author"><?php echo __('Sort By Author', 'ultimate_layouts')?></span>
                        <?php }
						if($sortb_price=='1'){
						?>
                        	<span class="order-by-dropdown-item" data-order-by="_price"><?php echo __('Sort By Price', 'ultimate_layouts')?></span>
                        <?php }
						if($sortb_sales=='1'){
						?>
                        	<span class="order-by-dropdown-item" data-order-by="total_sales"><?php echo __('Sort By Sales', 'ultimate_layouts')?></span>
                        <?php }
						if($sortb_rating=='1'){
						?>
                        	<span class="order-by-dropdown-item" data-order-by="_wc_average_rating"><?php echo __('Sort By Rating', 'ultimate_layouts')?></span>
                        <?php }?>
                    </span>                   
                </div>
                <?php
				$output_string = ob_get_contents();
				ob_end_clean();
				return $output_string;
			}
			
			//Sort order
			static function sort_order($params){
				extract(
					shortcode_atts(
						array(	
							'extra_class'						=>'',												
						), 
						$params
					)				
				);
				ob_start();
				global $global_order;
				?>
                <div class="ultimate-layouts-filter-item ul-sort-order-action <?php echo esc_attr($extra_class);?>">                	
                    <span class="ul-sort-order-action-arrow" data-sort-order="<?php echo esc_attr($global_order)?>">  
                    	&nbsp;                  	
                        <span></span>
                    </span> 
                </div>
				<?php
				$output_string = ob_get_contents();
				ob_end_clean();
				return $output_string;
			}
		/*Shortcode*/
		
		/*html Ajax & Json*/
		static function ajax(){
			$query_params	= $_POST['query_params'];
			$filter			= $_POST['filter'];
			$order			= $_POST['order'];
			$orderby		= $_POST['orderby']; 	
			$sub_opt_query	= $_POST['sub_opt_query'];
			$options		= $_POST['options'];
			if(isset($query_params) || isset($filter) || isset($order) || isset($orderby) || isset($sub_opt_query) || isset($options)){
				if(class_exists('WPBMap')){
					WPBMap::addAllMappedShortcodes();
				}
				echo my_ultimateLayouts_bete_html::html_builder($query_params, $filter, $order, $orderby, $sub_opt_query, $options, '');
			}else{
				echo '';
			}
			exit;
		}
		/*html Ajax & Json*/
		
		/*html children taxonomy*/
		static function ajax_children(){
			$query_params	= $_POST['query_params'];
			$order			= $_POST['order'];
			$orderby		= $_POST['orderby']; 	
			$sub_opt_query	= $_POST['sub_opt_query'];
			$taxonomy_slug	= $_POST['taxonomy_slug'];
			$taxonomy_id	= $_POST['taxonomy_id'];
			if(isset($taxonomy_slug) && isset($taxonomy_id) && $taxonomy_slug!='' && is_numeric($taxonomy_id) && (isset($query_params) || isset($order) || isset($orderby) || isset($sub_opt_query))){
				$get_chidrens = get_term_children(trim($taxonomy_id), $taxonomy_slug);
				if(isset($get_chidrens) && !is_wp_error($get_chidrens) && !empty($get_chidrens) && count($get_chidrens)>0){					
					$arr_taxonomies = array();
					foreach($get_chidrens as $get_chidren){
						$get_terms_filter = 	get_terms(
													$taxonomy_slug, 
													array(
														'fields'	=> 'all', 
														'include' 	=> array(trim($get_chidren)),
													)
												);
						$arr_taxonomy = array();														
						if(isset($get_terms_filter) && !is_wp_error($get_terms_filter) && !empty($get_terms_filter) && count($get_terms_filter)>0){																
							$tax_item_name 	= '';							
							foreach($get_terms_filter as $get_terms_filter_item){
								$tax_item_name = esc_html($get_terms_filter_item->name);									
							}
							array_push($arr_taxonomy, $tax_item_name);
							array_push($arr_taxonomy, trim($get_chidren));
							array_push($arr_taxonomy, my_ultimateLayouts_bete_query::build_query($query_params, trim($get_chidren), $order, $orderby, $sub_opt_query, true));
						}
						array_push($arr_taxonomies, $arr_taxonomy);
					}
					echo json_encode($arr_taxonomies);					
				}else{
					echo json_encode(array());
				}
			}else{
				echo json_encode(array());
			}
			exit;
		}
		/*html children taxonomy*/
		
		/*html single quick view*/
		static function ajax_single(){
			$post_id		= trim($_POST['post_id']);
			$query_params	= $_POST['query_params'];
			$filter			= $_POST['filter'];
			$order			= $_POST['order'];
			$orderby		= $_POST['orderby']; 	
			$sub_opt_query	= $_POST['sub_opt_query'];
			$options		= $_POST['options'];
			if((isset($query_params) || isset($filter) || isset($order) || isset($orderby) || isset($sub_opt_query) || isset($options)) && isset($post_id) && $post_id!='' && is_numeric($post_id)){
				
				$post_types				= $query_params['post_types'];
				$taxonomies				= $query_params['taxonomies'];
				$multi_post_types		= $query_params['multi_post_types'];
				$multi_taxonomies		= $query_params['multi_taxonomies'];
				
				if($post_types=='multi_post_types' && $multi_post_types!=''){
					$post_types=$multi_post_types;
					$query_params['post_types'] = $post_types;
				}
				
				if($taxonomies=='multi_taxonomies' && $multi_taxonomies!=''){
					$taxonomies=$multi_taxonomies;					
				}
				
				$query = 	array(	
					'p'						=> $post_id,
					'post_status' 			=> 'publish',
					'posts_per_page'		=> 1,				
				);
				
				if(get_post_type($post_id)=='attachment'){
					$query['post_status'] = 'inherit';
					$query['post_mime_type'] = 'image/jpeg,image/gif,image/jpg,image/png';
				}
				
				//post types
				$query['post_type'] = 'post';
				$multi_post_types = array();
				$post_types_single = explode(',', $query_params['post_types']);			
				foreach($post_types_single as $post_type){	
					if(trim($post_type)!=''){					
						array_push($multi_post_types, trim($post_type));
					}
				}			
				if(is_array($multi_post_types) && !empty($multi_post_types) && count($multi_post_types)>0){
					$query['post_type'] = $multi_post_types;
				}//post types
				
				$newQuery = new WP_Query($query);
				if($newQuery->have_posts()):
					ob_start();
					while($newQuery->have_posts()):$newQuery->the_post();
						$c_post_type 	= get_post_type($post_id);
						
						$image_feature 	= '';
						if(has_post_thumbnail()){
							$image_attributes 	= wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
							$image_feature 		= $image_attributes[0];
						}
												
						$qv_s_title 				= ($options['qv_s_title']=='1')?true:false;
						
						//taxonomy options
						$qv_s_categories			= ($options['qv_s_categories']=='1')?true:false;
						$qv_s_s_categories			= $options['qv_s_s_categories'];
						$qv_s_s_categories_parent	= ($options['qv_s_s_categories_parent']=='1')?true:false;	
						$qv_ex_items_taxonomies		= $options['qv_ex_items_taxonomies'];
						$qv_s_c_categories			= $options['qv_s_c_categories'];	
						$qv_s_ct_categories 		= ($options['qv_s_ct_categories']!='')?$options['qv_s_ct_categories']:'';	
						$qv_s_cb_categories 		= ($options['qv_s_cb_categories']!='')?$options['qv_s_cb_categories']:'';	
						$qv_s_categories_target		= ($options['qv_s_categories_target']=='1')?true:false;
						//taxonomy options
						
						//Post Metas 1
						$qv_s_metas_o				= ($options['qv_s_metas_o']=='1')?true:false;
						$qv_s_metas_o_author		= ($options['qv_s_metas_o_author']=='1')?true:false;
						$qv_s_metas_o_author_avatar	= ($options['qv_s_metas_o_author_avatar']=='1')?true:false;
						$qv_s_metas_o_time			= ($options['qv_s_metas_o_time']=='1')?true:false;
						$qv_time_format				= $options['qv_time_format'];	
						$qv_s_metas_o_comment		= ($options['qv_s_metas_o_comment']=='1')?true:false;
						$qv_s_metas_o_like			= ($options['qv_s_metas_o_like']=='1')?true:false;						
						$qv_custom_meta_o			= $options['qv_custom_meta_o'];
						//Post Metas 1
						
						$qv_show_content			= ($options['qv_show_content']=='1')?true:false;	
						$qv_content_stripsc			= ($options['qv_content_stripsc']=='1')?true:false;	
						
						$qv_show_share				= ($options['qv_show_share']=='1')?true:false;	
						$qv_woo_show_rating			= ($options['qv_woo_show_rating']=='1')?true:false;	
						$qv_s_featured_image		= ($options['qv_s_featured_image']=='1')?true:false;	
						
						$post_title				= my_ultimateLayouts_elements::ultimateLayouts_title($post_id, $qv_s_title, false, false, false, false, false, 'font-size-24');
						$post_metas_1			= my_ultimateLayouts_elements::ultimateLayouts_metas_1(
													$post_id, $qv_s_metas_o, $qv_s_metas_o_author, $qv_s_metas_o_author_avatar,
													array($qv_s_metas_o_time, $qv_time_format), $qv_s_metas_o_comment, $qv_s_metas_o_like, false, $qv_custom_meta_o, '', $before_author_text, ''
												  );
						$post_taxonomy			= my_ultimateLayouts_elements::ultimateLayouts_taxonomy(
													$post_id, $qv_s_categories, $taxonomies, $qv_s_categories_target, $qv_s_s_categories, $qv_s_s_categories_parent, $qv_ex_items_taxonomies, $qv_s_c_categories, $qv_s_ct_categories, $qv_s_cb_categories, ''
												  );						  
																	
						if($c_post_type=='product' && class_exists('WooCommerce')){
							include('single_woo.php');
						}else{
							include('single_post.php');
						}
					endwhile;
					$output_string = ob_get_contents();
					ob_end_clean();
					echo $output_string;	
				else:
					echo '0';
				endif;
				wp_reset_postdata();	
			}else{
				echo '';
			};			
			exit;
		}
		/*html single quick view*/
		
		/*CSS Library*/
		static function front_enqueue_scripts(){
			//wp_enqueue_style('beeteam_google_fonts', 				'https://fonts.googleapis.com/css?family=Dosis:400,500,600,700|Roboto', array(), UL_BETE_VER);
			wp_enqueue_style('beeteam_front_fontawsome_css', 		UL_BETE_PLUGIN_URL.'assets/front-end/fontawesome/css/font-awesome.min.css', array(), UL_BETE_VER);
			wp_enqueue_style('beeteam_front_animate_css', 			UL_BETE_PLUGIN_URL.'assets/front-end/animate.css', array(), UL_BETE_VER);			
			wp_enqueue_style('beeteam_front_slick_css', 			UL_BETE_PLUGIN_URL.'assets/front-end/slick/slick.css', array(), UL_BETE_VER);
			wp_enqueue_style('beeteam_front_loadawsome_css', 		UL_BETE_PLUGIN_URL.'assets/front-end/loaders.css', array(), UL_BETE_VER);
			wp_enqueue_style('beeteam_front_priority_css', 			UL_BETE_PLUGIN_URL.'assets/front-end/priority-navigation/priority-nav-core.css', array(), UL_BETE_VER);		
			wp_enqueue_style('beeteam_front_hover_css', 			UL_BETE_PLUGIN_URL.'assets/front-end/hover-css/hover.css', array(), UL_BETE_VER);
			wp_enqueue_style('beeteam_front_pagination_css', 		UL_BETE_PLUGIN_URL.'assets/front-end/pagination/pagination.css', array(), UL_BETE_VER);
			wp_enqueue_style('beeteam_front_malihu_css', 			UL_BETE_PLUGIN_URL.'assets/front-end/malihuscroll/jquery.mCustomScrollbar.min.css', array(), UL_BETE_VER);
			
			wp_enqueue_script('beeteam_front_lazysizes_js', 		UL_BETE_PLUGIN_URL.'assets/front-end/lazysizes.js', array(), UL_BETE_VER, false);	
		}
		
		//CSS Core
		static function core_enqueue_scripts(){		
			wp_enqueue_style('ul_bete_front_css', 					UL_BETE_PLUGIN_URL.'assets/front-end/core.css', array(), UL_BETE_VER);
			if(trim(get_option('ultimate_layouts_rtl_mode'))=='1'){
				wp_enqueue_style('ul_bete_front_rtl_css', 				UL_BETE_PLUGIN_URL.'assets/front-end/rtl.css', array(), UL_BETE_VER);
			}
		}
		/*CSS Library*/
			
		/*Register Script*/
		static function register_scripts(){//Change in function	
			//languages
			load_plugin_textdomain('ultimate_layouts', false, basename(UL_BETE_PLUGIN_PATH).'/languages');
		
			//CSS Library
			self::front_enqueue_scripts();
			
			//JS Library				
			wp_register_script('beeteam_front_slick_js', 			UL_BETE_PLUGIN_URL.'assets/front-end/slick/slick.clones.min.js', array('jquery'), UL_BETE_VER, true);
			wp_register_script('beeteam_front_masonry', 			UL_BETE_PLUGIN_URL.'assets/front-end/masonry.pkgd.min.js', array('jquery'), UL_BETE_VER, true);
			wp_register_script('beeteam_front_imagesloaded', 		UL_BETE_PLUGIN_URL.'assets/front-end/imagesloaded.pkgd.min.js', array('jquery'), UL_BETE_VER, true);
			wp_register_script('beeteam_front_priority', 			UL_BETE_PLUGIN_URL.'assets/front-end/priority-navigation/priority-nav.min.js', array('jquery'), UL_BETE_VER, true);
			wp_register_script('beeteam_front_pagination', 			UL_BETE_PLUGIN_URL.'assets/front-end/pagination/pagination.min.js', array('jquery'), UL_BETE_VER, true);
			wp_register_script('beeteam_front_malihu_js', 			UL_BETE_PLUGIN_URL.'assets/front-end/malihuscroll/jquery.mCustomScrollbar.concat.min.js', array('jquery'), UL_BETE_VER, true);
					
			//JS Core
			//wp_register_script('ul_bete_front_js', 					UL_BETE_PLUGIN_URL.'assets/front-end/core.js', array('jquery'), UL_BETE_VER, true);			
			wp_register_script('ul_bete_front_js', 						UL_BETE_PLUGIN_URL.'assets/front-end/core-min.js', array('jquery'), UL_BETE_VER, true);
		}	
		/*Register Script*/		
				
		/*Print Script*/
		static function print_script(){//Change in function
			$js_libraries = array();
			if(self::$add_script_slick){
				array_push($js_libraries, 'beeteam_front_slick_js');				
			}	
			if(self::$add_script_masonry){
				array_push($js_libraries, 'beeteam_front_masonry');
				array_push($js_libraries, 'beeteam_front_imagesloaded');				
			}
			if(self::$add_script_priority){
				array_push($js_libraries, 'beeteam_front_priority');
			}	
			if(self::$add_script_pagination){
				array_push($js_libraries, 'beeteam_front_pagination');
			}
			if(self::$add_script_malihu){
				array_push($js_libraries, 'beeteam_front_malihu_js');
			}
			wp_print_scripts($js_libraries);		
		}
		
		static function print_script_core(){//Change in function
			$js_libraries = array();			
			if(self::$add_script_core){
				array_push($js_libraries, 'ul_bete_front_js');
			}
			wp_print_scripts($js_libraries);		
		}
		/*Print Script*/		
	}
	my_ultimateLayouts_bete_sc::init();
}