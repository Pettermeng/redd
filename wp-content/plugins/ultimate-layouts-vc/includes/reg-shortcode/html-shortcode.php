<?php
if(!class_exists('my_ultimateLayouts_bete_html')){
	class my_ultimateLayouts_bete_html{
		static function html_builder($query_params=array(), $filter = '', $order = 'DESC', $orderby='date', $sub_opt_query = array(), $options = array(), $contents = ''){
			
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
				$query_params['taxonomies'] = $taxonomies;
			}
			
			$layout_style = $options['layout_style'];
			
			$grid_style				= $options['grid_style'];
			$list_style				= $options['list_style'];
			$carousel_t_style		= $options['carousel_t_style'];
			$carousel_f_style		= $options['carousel_f_style'];
			$creative_style			= $options['creative_style'];
			$timeline_style			= $options['timeline_style'];
			$block_content_style	= $options['block_content_style'];
			$sync_slider_style		= $options['sync_slider_style'];
			
			if($layout_style=='1' || $layout_style=='2'){
				$query_params['posts_per_page'] = $query_params['post_count'];
			}elseif($layout_style=='5' && $creative_style=='2'){
				$query_params['posts_per_page'] = 9;
			}
			
			$query 			= my_ultimateLayouts_bete_query::build_query($query_params, $filter, $order, $orderby, $sub_opt_query);
			
			/*page calculator*/
			$total_posts = $query_params['post_count'];
			$totalCountPosts = 	($query->found_posts);
			if(is_numeric($total_posts) && $total_posts!=-1) {
				if($totalCountPosts > (int)($total_posts)) {
					$totalCountPosts = $total_posts;
				}else{
					$totalCountPosts = ($query->found_posts);
				};
			};
			
			$countPosts = $query->post_count;
			
			$allItems			= (int)$totalCountPosts;
			
			$allItemsPerPage	= (int)$query_params['posts_per_page'];
			if($allItemsPerPage > (int)($total_posts) && $total_posts!=-1){
				$allItemsPerPage = (int)($total_posts);
			}
			if($allItemsPerPage > $allItems){
				$allItemsPerPage = $allItems;
			}
			
			$paged_calculator	= 1;
			$percentItems		= 0;
			
			if($allItems > $allItemsPerPage) {
				$percentItems = ($allItems % $allItemsPerPage);		
				if($percentItems!=0){
					$paged_calculator=(($allItems-$percentItems) / $allItemsPerPage) + 1;
				}else{
					$paged_calculator=($allItems / $allItemsPerPage);
				}
			}
			$sub_opt_query['total_pages']			= $paged_calculator;
			$sub_opt_query['items_last_page']		= $percentItems;
			/*page calculator*/
			
			/*Global query, options... params*/
				global $global_query_params;
				$global_query_params = $query_params;
				
				global $global_filter;
				$global_filter = $filter; //string
				
				global $ultimate_layouts_tax_filter;
				$ultimate_layouts_tax_filter = array();
				$explode_filter = explode(',', $taxonomies);
				foreach($explode_filter as $i_explode_filter){	
					if(trim($i_explode_filter)!=''){					
						array_push($ultimate_layouts_tax_filter, trim($i_explode_filter));
					}
				}
				
				global $global_order;
				$global_order = $order; 
				
				global $global_orderby;
				$global_orderby = $orderby;
				
				global $global_sub_opt_query;
				$global_sub_opt_query = $sub_opt_query;
			/*Global query, options... params*/
			
			//wrapper control
			$before_wrap='';
			$after_wrap='';	
			
			//masonry mode for grid
			$grid_masonry			= ($options['grid_masonry']=='1')?true:false;
			//masonry mode for grid
			
			//Carousel Options
			$show_arrows 			= ($options['show_arrows']=='1')?true:false;
			$arrows_outside 		= ($options['arrows_outside']=='1')?true:false;
			$show_dots 				= ($options['show_dots']=='1')?true:false;
			$infinite 				= ($options['infinite']=='1')?true:false;
			$autoplay 				= ($options['autoplay']=='1')?true:false;
			$autoplayspeed			= $options['autoplayspeed'];
			$scrollperpage			= ($options['scrollperpage']=='1')?true:false;
			$speed					= $options['speed'];
			$centermode				= ($options['centermode']=='1')?true:false;
			//Carousel Options
			
			//Creative Options
			$show_elements			= $options['show_elements'];
			$av_content				= ($options['av_content']=='1')?true:false;
			//Creative Options
			
			//custom columns
			$cc_mobile 				= ($options['cc_mobile']!=''&&$options['cc_mobile']!='0')?' ultimate-layouts-col-'.$options['cc_mobile']:'';
			$cc_portrait_tablet 	= ($options['cc_portrait_tablet']!=''&&$options['cc_portrait_tablet']!='0')?' ultimate-layouts-col-pt-'.$options['cc_portrait_tablet']:'';
			$cc_landscape_tablet 	= ($options['cc_landscape_tablet']!=''&&$options['cc_landscape_tablet']!='0')?' ultimate-layouts-col-lt-'.$options['cc_landscape_tablet']:'';
			$cc_small_desktop 		= ($options['cc_small_desktop']!=''&&$options['cc_small_desktop']!='0')?' ultimate-layouts-col-sm-'.$options['cc_small_desktop']:'';
			$cc_medium_desktop 		= ($options['cc_medium_desktop']!=''&&$options['cc_medium_desktop']!='0')?' ultimate-layouts-col-md-'.$options['cc_medium_desktop']:'';
			$cc_large_desktop 		= ($options['cc_large_desktop']!=''&&$options['cc_large_desktop']!='0')?' ultimate-layouts-col-lg-'.$options['cc_large_desktop']:'';
			$cc_extra_large_desktop = ($options['cc_extra_large_desktop']!=''&&$options['cc_extra_large_desktop']!='0')?' ultimate-layouts-col-el-'.$options['cc_extra_large_desktop']:'';
			//custom columns
			
			//image size
			$image_size				= $options['image_size'];				
			$image_size_s			= $options['image_size_s'];			
			//image size
			
			//image options
			$s_image					= ($options['s_image']=='1')?true:false;
			$s_image_link 				= ($options['s_image_link']=='1')?'':' ultimate-layouts-picture-no-link';
			$s_image_link_target		= ($options['s_image_link_target']=='1')?true:false;
			$s_icon_lightbox_video		= ($options['s_icon_lightbox_video']=='1')?true:false;
			$video_url_meta				= ($options['video_url_meta']=='1')?true:false;
			$video_url_meta_key			= $options['video_url_meta_key'];
			$s_icon_lightbox_image		= ($options['s_icon_lightbox_image']=='1')?true:false;
			$s_icon_link				= ($options['s_icon_link']=='1')?true:false;
			$s_icon_link_target			= ($options['s_icon_link_target']=='1')?true:false;
			$s_image_hover_effect 		= ($options['s_image_hover_effect']!='' && $options['s_image_hover_effect']!='0')?' ultimate-layouts-effect-'.$options['s_image_hover_effect']:'';
			$s_overlay_hover_effect 	= ($options['s_overlay_hover_effect']!='')? ' '.$options['s_overlay_hover_effect']:'';
			$s_overlay_hover_boolean	= ($options['s_overlay_hover_effect']!='')?true:false;
			$s_overlay_settings			= ($options['s_overlay_settings']=='1')?true:false;
			$s_overlay_color 			= ($options['s_overlay_color']!='')?$options['s_overlay_color']:'';
			
			$s_image_post_format		= ($options['s_image_post_format']=='1')?true:false;
			$s_image_post_format_pos 	= ($options['s_image_post_format_pos']!='')?$options['s_image_post_format_pos']:'ul-bottom-right';	
			
			$s_image_avatar				= ($options['s_image_avatar']=='1')?true:false;	
			//image options
			
			//title options
			$s_title 					= ($options['s_title']=='1')?true:false;
			$s_title_limit				= ($options['s_title_limit']=='1')?true:false;
			$s_title_link 				= ($options['s_title_link']=='1')?true:false;
			$s_title_link_target		= ($options['s_title_link_target']=='1')?true:false;
			//title options
			
			//excerpt options
			$s_excerpt					= ($options['s_excerpt']=='1')?true:false;
			$s_excerpt_rbtn				= ($options['s_excerpt_rbtn']=='1')?true:false;
			$s_excerpt_f				= $options['s_excerpt_f'];
			$s_excerpt_sc				= ($options['s_excerpt_sc']=='1')?true:false;
			$s_excerpt_sh				= ($options['s_excerpt_sh']=='1')?true:false;
			$s_excerpt_length			= $options['s_excerpt_length'];
			//excerpt options
			
			//taxonomy options
			$s_categories				= ($options['s_categories']=='1')?true:false;
			$s_s_categories				= $options['s_s_categories'];
			$s_s_categories_parent		= ($options['s_s_categories_parent']=='1')?true:false;	
			$ex_items_taxonomies		= $options['ex_items_taxonomies'];	
			$s_c_categories				= $options['s_c_categories'];	
			$s_ct_categories 			= ($options['s_ct_categories']!='')?$options['s_ct_categories']:'';	
			$s_cb_categories 			= ($options['s_cb_categories']!='')?$options['s_cb_categories']:'';	
			$s_categories_target		= ($options['s_categories_target']=='1')?true:false;
			//taxonomy options
			
			//Post Metas 1
			$s_metas_o					= ($options['s_metas_o']=='1')?true:false;
			$s_metas_o_author			= ($options['s_metas_o_author']=='1')?true:false;
			$s_metas_o_author_avatar	= ($options['s_metas_o_author_avatar']=='1')?true:false;
			$s_metas_o_time				= ($options['s_metas_o_time']=='1')?true:false;
			$time_format				= $options['time_format'];	
			$s_metas_o_comment			= ($options['s_metas_o_comment']=='1')?true:false;
			$s_metas_o_like				= ($options['s_metas_o_like']=='1')?true:false;
			$s_metas_o_share			= ($options['s_metas_o_share']=='1')?true:false;
			$custom_meta_o				= $options['custom_meta_o'];
			//Post Metas 1
			
			//Post Metas 2
			$s_metas_t						= ($options['s_metas_t']=='1')?true:false;
			$s_metas_t_author				= ($options['s_metas_t_author']=='1')?true:false;
			$s_metas_t_author_avatar		= ($options['s_metas_t_author_avatar']=='1')?true:false;
			$s_metas_t_time					= ($options['s_metas_t_time']=='1')?true:false;
			$time_format_t					= $options['time_format_t'];	
			$s_metas_t_comment				= ($options['s_metas_t_comment']=='1')?true:false;
			$s_metas_t_like					= ($options['s_metas_t_like']=='1')?true:false;
			$s_metas_t_share				= ($options['s_metas_t_share']=='1')?true:false;
			$custom_meta_t					= $options['custom_meta_t'];
			$s_metas_t_readmore				= ($options['s_metas_t_readmore']=='1')?true:false;
			$s_metas_t_readmore_link_target	= ($options['s_metas_t_readmore_link_target']=='1')?true:false;
			//Post Metas 2
			
			$share_text						= $options['share_text'];
			$read_more_text					= $options['read_more_text'];
			$before_author_text				= $options['before_author_text'];
			
			//Pagination
			$pagination						= $options['pagination'];
			$loadmore_text					= $options['loadmore_text'];
			$prev_text						= $options['prev_text'];
			$next_text						= $options['next_text'];
			//Pagination
			
			//lazyload
			$lazyload						= ($options['lazyload']=='1')?true:false;
			$lazyload_p						= $options['lazyload_p'];
			//lazyload
			
			$geodirectory_rating			= ($options['geodirectory_rating']=='1')?true:false;
			
			$quick_view						= ($options['quick_view']=='1')?true:false;
			$quick_view_mode				= ($options['quick_view_mode']=='1')?true:false;
			
			//extra class
			$extra_class					= $options['extra_class'];
			$rnd_id							= $options['rnd_id'];
			//extra class
			
			$css_class						= $options['css_class'];
			
			//small item content block
				//title options
				$s_title_small 					= ($options['s_title_small']=='1')?true:false;
				$s_title_limit_small			= ($options['s_title_limit_small']=='1')?true:false;
				$s_title_link_small 			= ($options['s_title_link_small']=='1')?true:false;
				$s_title_link_target_small		= ($options['s_title_link_target_small']=='1')?true:false;
				//title options
				
				//taxonomy options
				$s_categories_small				= ($options['s_categories_small']=='1')?true:false;
				$s_s_categories_small			= $options['s_s_categories_small'];	
				$s_s_categories_parent_small	= ($options['s_s_categories_parent_small']=='1')?true:false;	
				$ex_items_taxonomies_small		= $options['ex_items_taxonomies_small'];	
				$s_c_categories_small			= $options['s_c_categories_small'];	
				$s_ct_categories_small 			= ($options['s_ct_categories_small']!='')?$options['s_ct_categories_small']:'';	
				$s_cb_categories_small 			= ($options['s_cb_categories_small']!='')?$options['s_cb_categories_small']:'';	
				$s_categories_target_small		= ($options['s_categories_target_small']=='1')?true:false;
				//taxonomy options
				
				//Post Metas 1
				$s_metas_o_small				= ($options['s_metas_o_small']=='1')?true:false;
				$s_metas_o_author_small			= ($options['s_metas_o_author_small']=='1')?true:false;
				$s_metas_o_author_avatar_small	= ($options['s_metas_o_author_avatar_small']=='1')?true:false;
				$s_metas_o_time_small			= ($options['s_metas_o_time_small']=='1')?true:false;
				$time_format_small				= $options['time_format_small'];	
				$s_metas_o_comment_small		= ($options['s_metas_o_comment_small']=='1')?true:false;
				$s_metas_o_like_small			= ($options['s_metas_o_like_small']=='1')?true:false;
				$s_metas_o_share_small			= ($options['s_metas_o_share_small']=='1')?true:false;
				$custom_meta_o_small			= $options['custom_meta_o_small'];
				//Post Metas 1
			//small item content block
			
			//woo
			$woo_show_price					= ($options['woo_show_price']=='1')?true:false;
			$woo_show_rating				= ($options['woo_show_rating']=='1')?true:false;
			$woo_show_cart					= ($options['woo_show_cart']=='1')?true:false;
			//woo
			
			$goo_ads_client					= $options['goo_ads_client'];
			$goo_ads_id						= $options['goo_ads_id'];
			$goo_ads_offset					= $options['goo_ads_offset'];
			
			//json Options, query
			$options_vs_query = '';
			$options_vs_query .='<script>';
			$options_vs_query .=	'if(typeof(ultimate_layouts_ajax_url)=="undefined"){var ultimate_layouts_ajax_url=[]};ultimate_layouts_ajax_url["'.$rnd_id.'"]="'.admin_url('admin-ajax.php').'";';
			$options_vs_query .=	'if(typeof(ultimate_layouts_query_params)=="undefined"){var ultimate_layouts_query_params=[]};ultimate_layouts_query_params["'.$rnd_id.'"]='.json_encode($query_params).';';
			$options_vs_query .=	'if(typeof(ultimate_layouts_filter)=="undefined"){var ultimate_layouts_filter=[]};ultimate_layouts_filter["'.$rnd_id.'"]="'.$filter.'";';
			$options_vs_query .=	'if(typeof(ultimate_layouts_order)=="undefined"){var ultimate_layouts_order=[]};ultimate_layouts_order["'.$rnd_id.'"]="'.$order.'";';
			$options_vs_query .=	'if(typeof(ultimate_layouts_orderby)=="undefined"){var ultimate_layouts_orderby=[]};ultimate_layouts_orderby["'.$rnd_id.'"]="'.$orderby.'";';
			$options_vs_query .=	'if(typeof(ultimate_layouts_sub_opt_query)=="undefined"){var ultimate_layouts_sub_opt_query=[]};ultimate_layouts_sub_opt_query["'.$rnd_id.'"]='.json_encode($sub_opt_query).';';
			$options_vs_query .=	'if(typeof(ultimate_layouts_options)=="undefined"){var ultimate_layouts_options=[]};ultimate_layouts_options["'.$rnd_id.'"]='.json_encode($options).';';
			$options_vs_query .='</script>';
			//json Options, query
			
			//Content Shortcode
			$html_contents = '';
			if($contents!=''){
				$html_contents .= do_shortcode($contents);
			}
			
			//pagination code
			$html_pagination = '';
			if($paged_calculator>1){
				switch($pagination){
					case '0':
						$loadmore_text_echo = ($loadmore_text!='')?$loadmore_text:__('Load More', 'ultimate_layouts');
						$html_pagination.=	'<div class="ul-pagination-wrap">
												<div class="ultimate-layouts-readmore-btn ul-loadmore-style ul-loadmore-action">
													<span class="ul-loadmore-text">'.$loadmore_text_echo.'</span>													
													<div class="ul-loadmore-loading la-ball-scale-multiple la-2x">
														<div></div>
														<div></div>
														<div></div>
													</div>
												</div>
											</div>';
						break;
					case '1':
						$html_pagination.=	'<div class="ul-pagination-wrap">
												<div class="ul-page-numbers">
												</div>
											</div>';
						break;	
					case '2':
						break;	
					case '3':
						$html_pagination.=	'<div class="ul-pagination-wrap">
												<div class="ul-infinite-action">	
													<div class="ul-infinite-loading la-fire la-2x">
														<div></div>
														<div></div>
														<div></div>
													</div>
												</div>
											</div>';
						break;	
				}
			}
			
			$html_pagination_cb = '';			
			$html_pagination_cb.=	'
									<div class="ul-cb-page-prev-next">
										<span class="ul-cb-prev-btn ul-disabled-query"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
										<span class="ul-cb-next-btn"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
									</div>
									';
			
			//pagination code
			
			
			$lazyloadParams = array($lazyload, $lazyload_p);
			$postFormatParams = array($s_image_post_format, $s_image_post_format_pos);			
			
			switch($layout_style){
				case '0': //grid
				
					$class_grid_style = '';
					$switch_view_mode = '';
					switch($grid_style){
						case '0':
							$class_grid_style = 'ultimate-layouts-listing-grid-1';
							break;
						case '1':
							$class_grid_style = 'ultimate-layouts-listing-grid-2';
							break;
						case '2':
							$class_grid_style = 'ultimate-layouts-listing-grid-3';
							break;
						case '3':
							$class_grid_style = 'ultimate-layouts-listing-grid-4';
							break;
						case '4':
							$class_grid_style = 'ultimate-layouts-listing-grid-5';
							break;
						case '5':
							$class_grid_style = 'ultimate-layouts-listing-grid-6';
							break;
						case '6':
							$class_grid_style = 'ultimate-layouts-listing-grid-7';
							break;
						case '7':
							$class_grid_style = 'ultimate-layouts-listing-grid-8';
							break;
						case '8':
							$class_grid_style = 'ultimate-layouts-listing-grid-9 ul-switch-mode-control';
							$switch_view_mode ='<div class="ul-switch-panel"><span class="switch-control switch-grid active-elm"><i class="fa fa-th" aria-hidden="true"></i></span><span class="switch-control switch-list"><i class="fa fa-list" aria-hidden="true"></i></span></div>';
							break;		
						default:	
							$class_grid_style = 'ultimate-layouts-listing-grid-1';						
					}	
					
					$masonry_mode 		= '';
					$masonry_loading 	= '';
					if($grid_masonry){
						//$lazyloadParams 	= array(false, '');
						$masonry_mode 		= 'ultimate-layouts-masonry-mode';
						$masonry_loading 	= '<div class="ul-masonry-mode-loading"><div class="ultimate-layouts-masonry-loading la-ball-clip-rotate"><div></div></div></div><div class="ul-container-img-load"></div>';
					}
													
					$before_wrap 	.= '<div id="'.$rnd_id.'" class="ultimate-layouts-container ul-filter-gridlist-normal ultimate-layouts-wrapper-control '.$masonry_mode.' '.$extra_class.' '.$css_class.'">'
									   .$html_contents
									   .$switch_view_mode
									   .$masonry_loading;
					$before_wrap 	.=		'<div class="
												ultimate-layouts-listing-wrap												
												'.$class_grid_style.'
												'.$s_image_link.$s_image_hover_effect.'
												ultimate-layouts-effect-icon												
												'.$cc_mobile.$cc_portrait_tablet.$cc_landscape_tablet.$cc_small_desktop.$cc_medium_desktop.$cc_large_desktop.$cc_extra_large_desktop.'
											">';
											
					$after_wrap 	.=		'</div>'
											.$html_pagination;							
					$after_wrap 	.='</div>';				
					break;
				case '1': //carousel t
					$class_carousel_t_style = '';					
					$carousel_arrows 		= '';
					$class_arrows_pos 		= '';
					$class_pos_arrows		= '';
					
					switch($carousel_t_style){
						case '0':
							$class_carousel_t_style = 'ultimate-layouts-carousel-t-1';
							break;
						case '1':
							$class_carousel_t_style = 'ultimate-layouts-carousel-t-2';
							break;
						case '2':
							$class_carousel_t_style = 'ultimate-layouts-carousel-t-3';
							break;
						case '3':
							$class_carousel_t_style = 'ultimate-layouts-carousel-t-4';
							break;
						case '4':
							$class_carousel_t_style = 'ultimate-layouts-carousel-t-5';
							break;	
						case '5':
							$class_carousel_t_style = 'ultimate-layouts-carousel-t-6';
							break;							
						default:	
							$class_carousel_t_style = 'ultimate-layouts-carousel-t-1';						
					}
					
					if($show_arrows==true){
						$carousel_arrows = '<div class="pagination-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div><div class="pagination-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>';
					}
					
					if($arrows_outside==true){
						$class_pos_arrows = 'ul-carousel-arrows-outside';
					}
					
					$before_wrap 	.= '<div id="'.$rnd_id.'" class="ultimate-layouts-container ultimate-layouts-wrapper-control ultimate-layouts-global-carousel-settings '.$extra_class.' '.$class_arrows_pos.' '.$css_class.' '.$class_pos_arrows.'">';
					$before_wrap 	.= 		$carousel_arrows;
					$before_wrap 	.= 		'<div class="carousel-wrapper-control">';
					$before_wrap 	.=			'<div class="
													ultimate-layouts-listing-wrap 
													ultimate-layouts-carousel-t
													'.$class_carousel_t_style.'
													'.$s_image_link.$s_image_hover_effect.'
													ultimate-layouts-effect-icon												
													'.$cc_mobile.$cc_portrait_tablet.$cc_landscape_tablet.$cc_small_desktop.$cc_medium_desktop.$cc_large_desktop.$cc_extra_large_desktop.'
												">';
					
					$after_wrap 	.=			'</div>';						
					$after_wrap 	.=		'</div>';							
					$after_wrap 	.='</div>';
					break;
				case '2': //carousel f
					$class_carousel_f_style = '';
					$carousel_arrows 		= '';
					$class_arrows_pos 		= '';
					$class_pos_arrows		= '';
					
					switch($carousel_f_style){
						case '0':
							$class_carousel_f_style = 'ultimate-layouts-carousel-f-1';
							break;
						case '1':
							$class_carousel_f_style = 'ultimate-layouts-carousel-f-2';
							break;
						case '2':
							$class_carousel_f_style = 'ultimate-layouts-carousel-f-3';
							break;
						case '3':
							$class_carousel_f_style = 'ultimate-layouts-carousel-f-4';
							break;											
						default:	
							$class_carousel_f_style = 'ultimate-layouts-carousel-f-1';						
					}
					
					if($show_arrows==true){
						$carousel_arrows = '<div class="pagination-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div><div class="pagination-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>';
					}
					
					if($arrows_outside==true){
						$class_pos_arrows = 'ul-carousel-arrows-outside';
					}
					
					$before_wrap 	.= '<div id="'.$rnd_id.'" class="ultimate-layouts-container ultimate-layouts-wrapper-control ultimate-layouts-global-carousel-settings '.$extra_class.' '.$class_arrows_pos.' '.$css_class.' '.$class_pos_arrows.'">';
					$before_wrap 	.= 		$carousel_arrows;
					$before_wrap 	.= 		'<div class="carousel-wrapper-control">';
					$before_wrap 	.=			'<div class="
													ultimate-layouts-listing-wrap 
													ultimate-layouts-carousel-t
													ultimate-layouts-carousel-variableWidth
													'.$class_carousel_f_style.'
													'.$s_image_link.$s_image_hover_effect.'
													ultimate-layouts-effect-icon												
													'.$cc_mobile.$cc_portrait_tablet.$cc_landscape_tablet.$cc_small_desktop.$cc_medium_desktop.$cc_large_desktop.$cc_extra_large_desktop.'
												">';
											
					$after_wrap 	.=			'</div>';						
					$after_wrap 	.=		'</div>';								
					$after_wrap 	.='</div>';
					break;
				case '3': //content blocks
					$class_block_content_style = '';
					switch($block_content_style){
						case '0':
							$class_block_content_style = 'ultimate-layouts-block-content-1';
							break;
						case '1':
							$class_block_content_style = 'ultimate-layouts-block-content-2';
							break;
						case '2':
							$class_block_content_style = 'ultimate-layouts-block-content-3';
							break;
						case '3':
							$class_block_content_style = 'ultimate-layouts-block-content-4';
							break;
						case '4':
							$class_block_content_style = 'ultimate-layouts-block-content-5';
							break;
						case '5':
							$class_block_content_style = 'ultimate-layouts-block-content-6';
							break;
						case '6':
							$class_block_content_style = 'ultimate-layouts-block-content-7';
							break;
						case '7':
							$class_block_content_style = 'ultimate-layouts-block-content-8';
							break;
						case '8':
							$class_block_content_style = 'ultimate-layouts-block-content-9';
							break;
						case '9':
							$class_block_content_style = 'ultimate-layouts-block-content-10';
							break;
						case '10':
							$class_block_content_style = 'ultimate-layouts-block-content-11';
							break;
						case '11':
							$class_block_content_style = 'ultimate-layouts-block-content-12';
							break;
						case '12':
							$class_block_content_style = 'ultimate-layouts-block-content-13';
							break;
						case '13':
							$class_block_content_style = 'ultimate-layouts-block-content-14';
							break;
						case '14':
							$class_block_content_style = 'ultimate-layouts-block-content-15';
							break;
						case '15':
							$class_block_content_style = 'ultimate-layouts-block-content-16';
							break;
						case '16':
							$class_block_content_style = 'ultimate-layouts-block-content-17';
							break;
						case '17':
							$class_block_content_style = 'ultimate-layouts-block-content-18';
							break;
						case '18':
							$class_block_content_style = 'ultimate-layouts-block-content-19';
							break;
						case '19':
							$class_block_content_style = 'ultimate-layouts-block-content-20';
							break;
						case '20':
							$class_block_content_style = 'ultimate-layouts-block-content-21';
							break;
						case '21':
							$class_block_content_style = 'ultimate-layouts-block-content-22';
							break;	
						case '22':
							$class_block_content_style = 'ultimate-layouts-block-content-23';
							break;	
						case '23':
							$class_block_content_style = 'ultimate-layouts-block-content-24';
							break;	
						case '24':
							$class_block_content_style = 'ultimate-layouts-block-content-25';
							break;	
						case '25':
							$class_block_content_style = 'ultimate-layouts-block-content-26';
							break;		
						case '26':
							$class_block_content_style = 'ultimate-layouts-block-content-27';
							break;	
						case '27':
							$class_block_content_style = 'ultimate-layouts-block-content-28';
							break;																														
						default:	
							$class_block_content_style = 'ultimate-layouts-block-content-1';						
					}
					
					$before_wrap 	.= '<div id="'.$rnd_id.'" class="ultimate-layouts-container ul-filter-block-content ultimate-layouts-wrapper-control '.$extra_class.' '.$css_class.'">'
									   .$html_contents;
					$before_wrap 	.=		'<div class="
												ultimate-layouts-listing-wrap	
												ultimate-layouts-block-content-basic											
												'.$class_block_content_style.'
												'.$s_image_link.$s_image_hover_effect.'
												ultimate-layouts-effect-icon
											">';
					$before_wrap	.=			'<div class="ul-block-content-item active-elm" data-item="" data-paged="1">';
					$before_wrap	.=				'<div class="ul-block-content-item-layout">';	
					
					$after_wrap 	.=				'</div>';					
					$after_wrap 	.=			'</div>';							
					$after_wrap 	.=		'</div>';
					$after_wrap 	.=		$html_pagination_cb;							
					$after_wrap 	.='</div>';	
					
					break;
				case '4': //list
					$class_list_style = '';
					switch($list_style){
						case '0':
							$class_list_style = 'ultimate-layouts-listing-list-1';
							break;
						case '1':
							$class_list_style = 'ultimate-layouts-listing-list-2';
							break;
						case '2':
							$class_list_style = 'ultimate-layouts-listing-list-3';
							break;
						case '3':
							$class_list_style = 'ultimate-layouts-listing-list-4';
							break;
						case '4':
							$class_list_style = 'ultimate-layouts-listing-list-5';
							break;
						case '5':
							$class_list_style = 'ultimate-layouts-listing-list-6';
							break;
						case '6':
							$class_list_style = 'ultimate-layouts-listing-list-7';
							break;
						case '7':
							$class_list_style = 'ultimate-layouts-listing-list-8';
							break;
						case '8':
							$class_list_style = 'ultimate-layouts-listing-list-9';
							break;
						case '9':
							$class_list_style = 'ultimate-layouts-listing-list-10';
							break;			
						default:	
							$class_list_style = 'ultimate-layouts-listing-list-1';						
					}	
					
					$before_wrap 	.= '<div id="'.$rnd_id.'" class="ultimate-layouts-container ul-filter-gridlist-normal ultimate-layouts-wrapper-control '.$extra_class.' '.$css_class.'">'.$html_contents;
					$before_wrap 	.=		'<div class="
												ultimate-layouts-listing-wrap 
												'.$class_list_style.'
												'.$s_image_link.$s_image_hover_effect.'
												ultimate-layouts-effect-icon
											">';
											
					$after_wrap 	.=		'</div>'
											.$html_pagination;							
					$after_wrap 	.='</div>';
					break;
				case '5': //creative
					$masonry_mode 		= 'ultimate-layouts-masonry-mode';
					$masonry_loading 	= '<div class="ul-masonry-mode-loading"><div class="ultimate-layouts-masonry-loading la-ball-clip-rotate"><div></div></div></div><div class="ul-container-img-load"></div>';
				
					$class_creative_style = '';	
					switch($creative_style){
						case '0':
							$class_creative_style = 'ultimate-layouts-creative-1';
							break;
						case '1':
							$class_creative_style = 'ultimate-layouts-creative-2';
							break;
						case '2':
							$class_creative_style = 'ultimate-layouts-creative-3';
							$masonry_mode 		= '';
							$masonry_loading 	= '';
							break;
						/*case '3':
							$class_creative_style = 'ultimate-layouts-creative-4';
							break;
						case '4':
							$class_creative_style = 'ultimate-layouts-creative-5';
							break;*/					
						default:	
							$class_creative_style = 'ultimate-layouts-creative-1';						
					}
					
					$class_item_position = '';
					if($show_elements=='2'){
						$class_item_position = ' ul-icon-pop-change';
					}
					
					$class_visible_content = '';
					if($av_content==true){
						$class_visible_content = ' ul-always_visible-content';
					}				
													
					$before_wrap 	.= '<div id="'.$rnd_id.'" class="ultimate-layouts-container ul-filter-gridlist-normal ultimate-layouts-wrapper-control '.$masonry_mode.' '.$extra_class.' '.$css_class.'">'
									   .$html_contents
									   .$masonry_loading;
					$before_wrap 	.=		'<div class="
												ultimate-layouts-listing-wrap
												ultimate-layouts-creative-basic												
												'.$class_creative_style.'
												'.$s_image_link.$s_image_hover_effect.'
												ultimate-layouts-effect-icon
											">';
											
					$after_wrap 	.=		'</div>'
											.$html_pagination;							
					$after_wrap 	.='</div>';				
					break;
				case '6':
					
					break;
				case '7':
					
					break;
				case '8':
					
					break;
				case '9': //timeline
					$class_timeline_style = '';	
					switch($timeline_style){
						case '0':
							$class_timeline_style = 'ultimate-layouts-timeline-1';
							break;
						case '1':
							$class_timeline_style = 'ultimate-layouts-timeline-2';
							break;
						/*case '2':
							$class_timeline_style = 'ultimate-layouts-timeline-3';
							break;
						case '3':
							$class_timeline_style = 'ultimate-layouts-timeline-4';
							break;
						case '4':
							$class_timeline_style = 'ultimate-layouts-timeline-5';
							break;*/					
						default:	
							$class_timeline_style = 'ultimate-layouts-timeline-1';						
					}
					
					$before_wrap 	.= '<div id="'.$rnd_id.'" class="ultimate-layouts-container ul-filter-gridlist-normal ultimate-layouts-wrapper-control '.$extra_class.' '.$css_class.'">'
									   .$html_contents;
					$before_wrap 	.=		'<div class="
												ultimate-layouts-listing-wrap	
												ultimate-layouts-timeline-basic											
												'.$class_timeline_style.'
												'.$s_image_link.$s_image_hover_effect.'
												ultimate-layouts-effect-icon
											">';
											
					$after_wrap 	.=		'</div>'
											.$html_pagination;							
					$after_wrap 	.='</div>';			
					break;
				case '10':
					
					break;
					
				case '11': //Button Gallery
													
					$before_wrap 	.= '<div id="'.$rnd_id.'" class="ultimate-layouts-container ul-filter-gridlist-normal ultimate-layouts-wrapper-control '.$extra_class.' '.$css_class.'" style="display:inline-block !important; width:auto !important;">';
					$before_wrap 	.= 		'<a href="javascript:;" title="" class="ultimate-layouts-readmore-btn ultimate-layouts-btn-gallery"><span>'.$options['button_gallery_name'].'</span></a>';
					$before_wrap	.= 		'<div style="display:none !important;">';	
					
					$after_wrap 	.=		'</div>';			
					$after_wrap 	.='</div>';				
					break;	
				
				case '12': //sync slider
					$class_sync_slider_style = '';					
					
					switch($sync_slider_style){
						case '0':
							$class_sync_slider_style = 'ultimate-layouts-sync-s-1';
							break;
						case '1':
							$class_sync_slider_style = 'ultimate-layouts-sync-s-2';
							break;
						case '2':
							$class_sync_slider_style = 'ultimate-layouts-sync-s-3';
							break;								
						default:	
							$class_sync_slider_style = 'ultimate-layouts-sync-s-1';						
					}
										
					$before_wrap 	.= '<div id="'.$rnd_id.'" class="ultimate-layouts-container ultimate-layouts-wrapper-control ultimate-layouts-sync-slider-settings '.$extra_class.' '.$css_class.'">';
					$before_wrap 	.= 		'<div class="sync-slider-wrapper-control">';
					$before_wrap 	.=			'<div class="
													ultimate-layouts-listing-wrap 
													ultimate-layouts-sync-s
													'.$class_sync_slider_style.'
													'.$s_image_link.$s_image_hover_effect.'
													ultimate-layouts-effect-icon
												">';
					
					$after_wrap 	.=			'</div>';						
					$after_wrap 	.=		'</div>';							
					$after_wrap 	.='</div>';
					break;	
				default:
									
			}//end wrapper control
			
			//start query
			$img_tag_link = true;
			
			if($query->have_posts()):
				ob_start();					
					if($sub_opt_query['paged']==1 && $sub_opt_query['first_query']=='on'){
						//start wrap layout
						echo $options_vs_query;
						echo $before_wrap;
					}elseif($sub_opt_query['paged']==1 && $sub_opt_query['first_query']=='json'){
						my_ultimateLayouts_bete_query::reset_data(); //reset query
						return json_encode($sub_opt_query);
					}
					$i=1;
					$spe_style = '';
					$sync_slider_bc = '';
					$sync_slider_sc = '';
					while($query->have_posts()):$query->the_post();
						$post_id 				= get_the_ID();
						$post_type 				= get_post_type($post_id);
						
						$wooBasicElmBlock 		= '';
						if($post_type=='product' && class_exists('WooCommerce')){
							$_get_post			= $query->post;						
							$product 			= function_exists('wc_get_product')?wc_get_product($post_id):get_product($post_id);
							$wooBasicElmBlock 	= my_ultimateLayouts_elements::woo_elm_basic($product, $_get_post, $woo_show_price, $woo_show_rating, $woo_show_cart);
						};						
						
						$post_title				= my_ultimateLayouts_elements::ultimateLayouts_title($post_id, $s_title, $s_title_link, $s_title_link_target, $quick_view, $quick_view_mode, $s_title_limit, '');
						$post_title_white		= str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title white-style ', $post_title);
						$post_title_bg			= str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title background-style ', $post_title);
						$post_title_f14			= str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title font-size-14 ', $post_title);
						$post_title_f16			= str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title font-size-16 ', $post_title);
						$post_title_white_f16	= str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title white-style font-size-16 ', $post_title);
						$post_title_bg_f16		= str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title font-size-16 background-style ', $post_title);
						$post_title_f24			= str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title font-size-24 ', $post_title);
						$post_title_white_f24	= str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title white-style font-size-24 ', $post_title);	
						$post_title_f30			= str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title font-size-30 ', $post_title);
						$post_title_f48			= str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title font-size-48 ', $post_title);
						$post_title_white_f48	= str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title white-style font-size-48 ', $post_title);					
						
						$post_image				= my_ultimateLayouts_elements::ultimateLayouts_thumbnail($post_id, $image_size, $img_tag_link, $s_image_link_target, $quick_view, $quick_view_mode, false, '', $lazyloadParams, $postFormatParams);						
						$post_image_background	= my_ultimateLayouts_elements::ultimateLayouts_thumbnail($post_id, $image_size, $img_tag_link, $s_image_link_target, $quick_view, $quick_view_mode, true, '', $lazyloadParams, $postFormatParams);						
						
						$post_icon				= my_ultimateLayouts_elements::ultimateLayouts_hover_icon(
													$post_id, $s_icon_lightbox_video, array($video_url_meta, $video_url_meta_key), '', $s_icon_lightbox_image, $s_icon_link, $s_icon_link_target, $quick_view, $quick_view_mode, $rnd_id, ''
												  );
						
						$post_overlay			= my_ultimateLayouts_elements::ultimateLayouts_overlay($post_id, $s_overlay_hover_boolean, $taxonomies, $s_overlay_settings, $s_overlay_color, $s_overlay_hover_effect);
						
						$post_excerpt			= my_ultimateLayouts_elements::ultimateLayouts_excerpt($post_id, $s_excerpt, $s_excerpt_f, $s_excerpt_sc, $s_excerpt_sh, $s_excerpt_length, array($s_excerpt_rbtn, $read_more_text), '');
						$post_excerpt_white		= str_replace('"ultimate-layouts-excerpt ', '"ultimate-layouts-excerpt white-style ', $post_excerpt);
						
						$post_timeline			= my_ultimateLayouts_elements::ultimateLayouts_post_time($post_id, $time_format);
						
						$post_metas_1			= my_ultimateLayouts_elements::ultimateLayouts_metas_1(
													$post_id, $s_metas_o, $s_metas_o_author, $s_metas_o_author_avatar, array($s_metas_o_time, $time_format), $s_metas_o_comment, 
													$s_metas_o_like, $s_metas_o_share, $custom_meta_o, $share_text, $before_author_text, ''
												  );
						$post_metas_1_silver	= str_replace('"ultimate-layouts-metas ', '"ultimate-layouts-metas silver-style ', $post_metas_1);
						
						$post_metas_2			= my_ultimateLayouts_elements::ultimateLayouts_metas_2(
													$post_id, $s_metas_t, $s_metas_t_author, $s_metas_t_author_avatar, array($s_metas_t_time, $time_format_t), $s_metas_t_comment, 
													$s_metas_t_like, $s_metas_t_share, $s_metas_t_readmore, $s_metas_t_readmore_link_target, $quick_view, $quick_view_mode, $custom_meta_t, true, $share_text, $read_more_text, $before_author_text, ''
												  );
						$post_metas_2_white		= str_replace('"ultimate-layouts-metas-st2 ', '"ultimate-layouts-metas-st2 white-style ', $post_metas_2);
						$post_metas_2_style_1	= str_replace('"ultimate-layouts-metas-st2 ', '"ultimate-layouts-metas ', $post_metas_2);
						
						$post_taxonomy					= my_ultimateLayouts_elements::ultimateLayouts_taxonomy($post_id, $s_categories, $taxonomies, $s_categories_target, $s_s_categories, $s_s_categories_parent, $ex_items_taxonomies, $s_c_categories, $s_ct_categories, $s_cb_categories, '');
						$post_taxonomy_white			= str_replace('"ultimate-layouts-categories ', '"ultimate-layouts-categories white-style ', $post_taxonomy);
						$post_taxonomy_absolute			= str_replace('"ultimate-layouts-categories ', '"ultimate-layouts-categories absolute-item ', $post_taxonomy);
						$post_taxonomy_absolute_white	= str_replace('"ultimate-layouts-categories ', '"ultimate-layouts-categories absolute-item white-style ', $post_taxonomy);
						
						$post_big_avatar = my_ultimateLayouts_elements::ultimateLayouts_big_avatar($post_id, $s_image_avatar, true);
						
						if($layout_style=='3' || $layout_style=='12'){
							$post_title_small			= 	my_ultimateLayouts_elements::ultimateLayouts_title($post_id, $s_title_small, $s_title_link_small, $s_title_link_target_small, $quick_view, $quick_view_mode, $s_title_limit_small, '');
							$post_title_white_small		= 	str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title white-style ', $post_title_small);
							$post_title_f14_small		= 	str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title font-size-14 ', $post_title_small);
							$post_title_f14_white_small =	str_replace('"ultimate-layouts-title ', '"ultimate-layouts-title white-style font-size-14 ', $post_title_small);
							
							$post_image_small_cb		= 	my_ultimateLayouts_elements::ultimateLayouts_thumbnail($post_id, $image_size_s, $img_tag_link, $s_image_link_target, $quick_view, $quick_view_mode, false, '', $lazyloadParams, $postFormatParams);
							$post_image_small_cb_bg		= 	my_ultimateLayouts_elements::ultimateLayouts_thumbnail($post_id, $image_size_s, $img_tag_link, $s_image_link_target, $quick_view, $quick_view_mode, true, '', $lazyloadParams, $postFormatParams);
							
							$post_metas_1_small			= 	my_ultimateLayouts_elements::ultimateLayouts_metas_1(
																$post_id, $s_metas_o_small, $s_metas_o_author_small, $s_metas_o_author_avatar_small, array($s_metas_o_time_small, $time_format_small), 
																$s_metas_o_comment_small, $s_metas_o_like_small, $s_metas_o_share_small, $custom_meta_o_small, $share_text, $before_author_text, ''
														  	);
							$post_metas_1_silver_small	= str_replace('"ultimate-layouts-metas ', '"ultimate-layouts-metas silver-style ', $post_metas_1_small);									
							$post_taxonomy_small		= 	my_ultimateLayouts_elements::ultimateLayouts_taxonomy(
																$post_id, $s_categories_small, $taxonomies, $s_categories_target_small, $s_s_categories_small, $s_s_categories_parent_small, $ex_items_taxonomies_small, $s_c_categories_small, 
																$s_ct_categories_small, $s_cb_categories_small, ''
															);							  
						}
						
						$ul_geodir_get_rating_stars = my_ultimateLayouts_elements::ul_geodir_get_rating_stars($post_id, $geodirectory_rating);
						
						if($sub_opt_query['paged']==1 && ($layout_style=='0' || $layout_style=='4')){
							echo my_ultimateLayouts_elements::google_adsense($goo_ads_client, $goo_ads_id, $goo_ads_offset, $i);
						}
						
						switch($layout_style){
							case '0':								
								include('layouts/00-grid.php');								
								break;
							case '1':
								include('layouts/01-carousel-t.php');
								break;
							case '2':
								include('layouts/02-carousel-f.php');
								break;
							case '3':
								include('layouts/03-block-content.php');
								break;
							case '4':
								include('layouts/04-list.php');
								break;
							case '5':
								include('layouts/05-creative.php');
								break;
							case '6':
								include('layouts/06-dreams.php');
								break;
							case '7':
								include('layouts/07-charming.php');
								break;
							case '8':
								include('layouts/08-gallery.php');
								break;
							case '9':
								include('layouts/09-timeline.php');
								break;
							case '10':
								include('layouts/10-social-feed.php');
								break;
							case '11':
								include('layouts/11-button-gallery.php');
								break;
							case '12':
								include('layouts/12-sync-slider.php');
								break;		
							default:
								include('layouts/00-grid.php');					
						}
						if($sub_opt_query['paged']==$paged_calculator && $i==$percentItems){
							break;
						}
						$i++;
					endwhile;
					if($sub_opt_query['paged']==1 && $sub_opt_query['first_query']=='on'){
						echo $after_wrap;//end wrap layout
					}
					
				$output_string = ob_get_contents();
				ob_end_clean();
				my_ultimateLayouts_bete_query::reset_data(); //reset query
				return $output_string;
				
			endif; //end query
			my_ultimateLayouts_bete_query::reset_data(); //reset query
		}
	}
}