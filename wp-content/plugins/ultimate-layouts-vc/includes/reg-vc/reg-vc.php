<?php
if(!class_exists('bt_ultimateLayouts_builder')) {
	class bt_ultimateLayouts_builder{		
		/*start bt_ultimateLayouts_vc*/
		public function bt_ultimateLayouts_vc(){
			if(function_exists('vc_map')){
				$group_category				=	__('BeeTeam368', 'ultimate_layouts');
				$group_layout_settings		=	__('Layout', 'ultimate_layouts');
				$group_query_settings		=   __('Query Builder', 'ultimate_layouts');				
				$group_woo_settings			= 	__('WOO', 'ultimate_layouts');
				$group_color_settings		= 	__('Color', 'ultimate_layouts');
				$group_typo_settings		= 	__('Typography', 'ultimate_layouts');
				$group_small_settings		= 	__('Small Item Settings', 'ultimate_layouts');
				$group_quickview_settings	= 	__('Quick View Settings', 'ultimate_layouts');
				$group_googleads_settings	= 	__('Google Adsense', 'ultimate_layouts');
				
				$array_font_weight			= 	array(	
													__('Default', 'ultimate_layouts') 	=> '',
													__('Normal', 'ultimate_layouts')	=> 'normal',																		
													__('Bold', 'ultimate_layouts') 		=> 'bold',																			
													__('300', 'ultimate_layouts') 		=> '300',
													__('400', 'ultimate_layouts') 		=> '400',	
													__('500', 'ultimate_layouts') 		=> '500',	
													__('600', 'ultimate_layouts') 		=> '600',																		
													__('700', 'ultimate_layouts') 		=> '700',
													__('800', 'ultimate_layouts') 		=> '800',
													__('900', 'ultimate_layouts') 		=> '900',																																				
												);
				$array_font_style			=	array(	
													__('Default', 'ultimate_layouts') 	=> '',
													__('Normal', 'ultimate_layouts') 	=> 'normal',																		
													__('Italic', 'ultimate_layouts') 	=> 'italic',																			
													__('Oblique', 'ultimate_layouts') 	=> 'oblique',																																																								
												);
				
				$array_text_transform		=	array(	
													__('Default', 'ultimate_layouts') 		=> '',
													__('Uppercase', 'ultimate_layouts') 	=> 'uppercase',																		
													__('Lowercase', 'ultimate_layouts') 	=> 'lowercase',																			
													__('Capitalize', 'ultimate_layouts') 	=> 'capitalize',
													__('None', 'ultimate_layouts') 			=> 'none',																																																								
												);	
												
				$array_grid_styles			=	array(
													__('AFRICAN LILY', 'ultimate_layouts') 			=> '0',																		
													__('ALPINE THISTLE', 'ultimate_layouts') 		=> '1',
													__('AMARYLLIS', 'ultimate_layouts') 			=> '2',
													__('AMAZON LILY', 'ultimate_layouts') 			=> '3',
													__('ARUM LILY', 'ultimate_layouts') 			=> '4',
													__('BABY’S BREATH', 'ultimate_layouts') 		=> '5',
													__('BARBERTON', 'ultimate_layouts') 			=> '6',
													__('CHRISTMAS ROSE', 'ultimate_layouts') 		=> '7',
													__('GRID & LIST TOOGLE', 'ultimate_layouts') 	=> '8',																																
												);
				$array_carousel_t_styles	=	array(
													__('BIRD OF PARADISE', 'ultimate_layouts') 		=> '0',																		
													__('BLEEDING HEART', 'ultimate_layouts') 		=> '1',
													__('BLOOM', 'ultimate_layouts') 				=> '2',
													__('BLUE THROATWORT', 'ultimate_layouts') 		=> '3',
													__('BROOM', 'ultimate_layouts') 				=> '4',
													__('BUSY LIZZIE', 'ultimate_layouts') 			=> '5',	
													//__('COCKSCOMB', 'ultimate_layouts') 			=> '6',
													//__('COLUMBINE', 'ultimate_layouts') 			=> '7',																																							
												);
				$array_carousel_f_styles		=	array(
													__('CALLA LILY', 'ultimate_layouts') 			=> '0',																		
													//__('CARNATION', 'ultimate_layouts') 			=> '1',
													//__('CHINCERINCHEE', 'ultimate_layouts') 		=> '2',
													//__('CHRISTMAS ROSE', 'ultimate_layouts') 		=> '3',																																																			
											);
				$array_block_content_styles	=	array(
													__('CONEFLOWER', 'ultimate_layouts') 			=> '0',																		
													__('DAFFODIL', 'ultimate_layouts') 				=> '1',
													__('EVENING PRIMROSE', 'ultimate_layouts') 		=> '2',
													__('FEVERFEW', 'ultimate_layouts') 				=> '3',
													__('FLAME TIP', 'ultimate_layouts') 			=> '4',
													__('FLAMINGO FLOWER', 'ultimate_layouts') 		=> '5',
													__('FORGET ME NOT', 'ultimate_layouts') 		=> '6',
													__('FOXGLOVE', 'ultimate_layouts') 				=> '7',
													__('GAY FEATHER', 'ultimate_layouts') 			=> '8',
													__('GLOBE THISTLE', 'ultimate_layouts') 		=> '9',
													__('GOLDEN ROD', 'ultimate_layouts') 			=> '10',
													__('GRAPE HYACINTH', 'ultimate_layouts') 		=> '11',
													__('GUERNSEY LILY', 'ultimate_layouts') 		=> '12',
													__('HYACINTH', 'ultimate_layouts') 				=> '13',
													__('IRIS', 'ultimate_layouts') 					=> '14',
													__('JERSEY LILY', 'ultimate_layouts') 			=> '15',
													__('LADY’S MANTLE', 'ultimate_layouts') 		=> '16',
													__('LARKSPUR', 'ultimate_layouts') 				=> '17',
													__('LAVENDER', 'ultimate_layouts') 				=> '18',
													__('LILAC', 'ultimate_layouts') 				=> '19',
													__('LILY', 'ultimate_layouts') 					=> '20',
													__('LISIANTHUS', 'ultimate_layouts') 			=> '21',
													__('LOBSTER CLAW', 'ultimate_layouts') 			=> '22',
													__('LOVE IN A MIST', 'ultimate_layouts') 		=> '23',
													__('SEA LAVENDER', 'ultimate_layouts')			=> '24',
													__('SEPTEMBER FLOWER', 'ultimate_layouts')		=> '25',
													__('SNAPDRAGON', 'ultimate_layouts')			=> '26',
													__('TRANSVAAL DAISY', 'ultimate_layouts') 		=> '27',																																																				
												);
				$array_list_styles		=	array(
													__('CORNFLOWER', 'ultimate_layouts') 			=> '0',	
													__('MIMOSA', 'ultimate_layouts') 				=> '1',	
													__('MOTH ORCHID', 'ultimate_layouts') 			=> '2',	
													__('MUMS', 'ultimate_layouts') 					=> '3',	
													__('PEONY', 'ultimate_layouts') 				=> '4',	
													__('PERUVIAN LILY', 'ultimate_layouts') 		=> '5',	
													__('CANTERBURY BELLS', 'ultimate_layouts') 		=> '6',
													__('BELLS OF IRELAND', 'ultimate_layouts') 		=> '7',
													__('MARIGOLD', 'ultimate_layouts') 				=> '8',
													__('MICHAELMAS DAISY', 'ultimate_layouts') 		=> '9',																									
												);
				$array_creative_styles		=	array(
													__('PRAIRIE GENTIAN', 'ultimate_layouts') 		=> '0',	
													__('ROSE', 'ultimate_layouts') 					=> '1',	
													__('SCABIOUS', 'ultimate_layouts') 				=> '2',	
													/*__('SEA LAVENDER', 'ultimate_layouts') 		=> '3',	
													__('SEPTEMBER FLOWER', 'ultimate_layouts') 		=> '4',	
													__('SNAPDRAGON', 'ultimate_layouts') 			=> '5',*/																									
												);
				$array_dreams_styles		=	array(
													__('SPRAY CARNATION', 'ultimate_layouts') 		=> '0',	
													__('STATICE', 'ultimate_layouts') 				=> '1',	
													//__('SUNFLOWER', 'ultimate_layouts') 			=> '2',	
													//__('SWEET WILLIAM', 'ultimate_layouts') 		=> '3',	
													//__('SWORD LILY', 'ultimate_layouts') 			=> '4',	
													//__('TRANSVAAL DAISY', 'ultimate_layouts') 	=> '5',																																						
												);
				$array_charming_styles		=	array(
													__('TULIP', 'ultimate_layouts') 				=> '0',	
													__('WAXFLOWER', 'ultimate_layouts') 			=> '1',	
													__('WINDFLOWER', 'ultimate_layouts') 			=> '2',	
													__('YARROW', 'ultimate_layouts') 				=> '3',	
													__('MELASTOMA', 'ultimate_layouts') 			=> '4',	
													__('HENNA', 'ultimate_layouts') 				=> '5',																																					
												);
				$array_gallery_styles		=	array(
													__('MYRTLE', 'ultimate_layouts') 				=> '0',	
													__('SWEET PEA', 'ultimate_layouts') 			=> '1',	
													__('MADONNA LILY', 'ultimate_layouts') 			=> '2',	
													__('AMARYLLIS', 'ultimate_layouts') 			=> '3',	
													__('FREESIA', 'ultimate_layouts') 				=> '4',	
													__('GORSE', 'ultimate_layouts') 				=> '5',																																						
												);
				$array_timeline_styles		=	array(
													__('CLIMBING ROSE', 'ultimate_layouts') 		=> '0',	
													__('MILK FLOWER', 'ultimate_layouts') 			=> '1',
													//__('WHITE-DOTTED', 'ultimate_layouts') 		=> '2',
													//__('PEONY FLOWER', 'ultimate_layouts') 		=> '3',
													//__('APRICOT BLOSSOM', 'ultimate_layouts') 	=> '4',
													//__('HONEYSUCKLE', 'ultimate_layouts') 		=> '5',	
													//__('HORTICULTURE', 'ultimate_layouts') 		=> '6',
													//__('JASMINE', 'ultimate_layouts') 			=> '7',																																	
												);								
				$array_social_feed_styles	=	array(
													__('MAGNOLIA', 'ultimate_layouts') 				=> '0',	
													__('MORNING GLORY', 'ultimate_layouts') 		=> '1',
												);	
												
				$array_sync_slider_styles	=	array(
													__('MYRTLE', 'ultimate_layouts') 				=> '0',	
													__('SWEET PEA', 'ultimate_layouts') 			=> '1',	
													__('MADONNA LILY', 'ultimate_layouts') 			=> '2',																																																		
												);								
				
				$array_custom_columns		= 	array(
													__('Disabled', 'ultimate_layouts') 		=> '0',
													__('1 Column', 'ultimate_layouts') 		=> '1',																		
													__('2 Columns', 'ultimate_layouts') 	=> '2',
													__('3 Columns', 'ultimate_layouts') 	=> '3',
													__('4 Columns', 'ultimate_layouts') 	=> '4',
													__('5 Columns', 'ultimate_layouts') 	=> '5',
													__('6 Columns', 'ultimate_layouts') 	=> '6',
													__('7 Columns', 'ultimate_layouts') 	=> '7',
													__('8 Columns', 'ultimate_layouts') 	=> '8',
													__('9 Columns', 'ultimate_layouts') 	=> '9',
													__('10 Columns', 'ultimate_layouts') 	=> '10',
													__('11 Columns', 'ultimate_layouts') 	=> '11',
													__('12 Columns', 'ultimate_layouts') 	=> '12',																				
												);	
				
				$image_sizes 				= 	get_intermediate_image_sizes();									
					
				$array_image_size[__('thumbnail', 'ultimate_layouts')] = 'thumbnail';
				$array_image_size[__('full', 'ultimate_layouts')] = 'full'; 
				foreach ($image_sizes as $size_name):
					if($size_name!='thumbnail'){
						$array_image_size[__($size_name, 'ultimate_layouts')] = $size_name;
					}
				endforeach;	
				
				/*Post types*/				
				$bt_post_types_list = array();	
				$bt_post_types = get_post_types(array());
				$bt_post_types_string = '';
				if (is_array($bt_post_types) && !empty($bt_post_types)){
					foreach($bt_post_types as $bt_post_type){				
						if($bt_post_type !== 'revision' && $bt_post_type !== 'nav_menu_item' /*&& $bt_post_type !== 'attachment'*/) {
							$bt_label = ucfirst($bt_post_type);
							$bt_post_types_list['['.$bt_post_type.'] - '.($bt_label)] = $bt_post_type;
							$bt_post_types_string.='<code>'.$bt_post_type.'</code>, ';
						}
					}				
				}	
				$bt_post_types_list[__('Multiple Post Types', 'ultimate_layouts')] = 'multi_post_types';
				/*Post types*/	
				
				/*taxonomies*/
				$taxonomies_list = array(); 	
				$taxonomies_types = get_taxonomies(array('public' => true), 'objects');
				$taxonomies_string = '';
				if(is_array($taxonomies_types) && ! empty($taxonomies_types)) {
					foreach($taxonomies_types as $t => $data){
						if ($t!=='post_format' && is_object($data)) {
							$taxonomies_list['['.$t.'] - '.($data->labels->name)] = $t;
							$taxonomies_string.='<code>'.$t.'</code>, ';
						}
					}
				};				
				$taxonomies_list[__('Multiple Taxonomies', 'ultimate_layouts')] = 'multi_taxonomies'; 	
				/*taxonomies*/																																
				
				/*start VC Map*/
				vc_map(
					array(
						'name' 				=> 	__('Ultimate Layouts - High Perfomance Content Blocks', 'ultimate_layouts'),
						'base' 				=> 	'ult_layout',
						'category' 			=> 	$group_category,
						'icon'				=> 	UL_BETE_PLUGIN_URL.'assets/back-end/images/ul-layout-shortcode.png',
						'is_container' 		=> 	false,					
						'js_view' 			=> 	'VcColumnView',
						'as_parent' 		=> 	array('only' => 'ult_layout_filter'),
						'params'			=> 	array(
													//Layout Settings
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('Layout Style', 'ultimate_layouts'),
															'param_name' 	=> 'layout_style', //Done
															'value' 		=> array(
																				__('GRID', 'ultimate_layouts') 					=> '0',																		
																				__('CAROUSEL-TRADITIONAL', 'ultimate_layouts')	=> '1',
																				__('CAROUSEL-FREE', 'ultimate_layouts') 		=> '2',
																				__('CONTENT BLOCKS', 'ultimate_layouts') 		=> '3',
																				__('LIST', 'ultimate_layouts') 					=> '4',
																				__('CREATIVE', 'ultimate_layouts') 				=> '5',
																				//__('DREAMS', 'ultimate_layouts') 				=> '6',
																				//__('CHARMING', 'ultimate_layouts') 			=> '7',
																				//__('GALLERY', 'ultimate_layouts') 			=> '8',
																				__('TIMELINE', 'ultimate_layouts') 				=> '9',
																				//__('SOCIAL FEED', 'ultimate_layouts') 		=> '10',
																				__('GALLERY BUTTON', 'ultimate_layouts') 		=> '11',
																				__('SYNC SLIDER', 'ultimate_layouts') 			=> '12',
																			   ),
															'group'			=> $group_layout_settings,																		
														),
														
														array(
															'type' 				=> 'textfield',
															'heading' 			=> __('Button Gallery Name', 'ultimate_layouts'), 
															'param_name' 		=> 'button_gallery_name', //Done														
															'dependency' 		=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('11'),
																				   ),	
															'group'				=> $group_layout_settings,												 
														),
														
														//Options For GRID														
															array( // work with GRID
																'type' 			=> 'dropdown',
																'heading' 		=> __('GRID', 'ultimate_layouts'),
																'param_name' 	=> 'grid_style', //Done
																'value' 		=> $array_grid_styles,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('0'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),															
															array( // work with GRID
																'type' 			=> 'dropdown',
																'heading' 		=> __('GRID Masonry Mode', 'ultimate_layouts'),
																'param_name' 	=> 'grid_masonry', //Done
																'value' 		=> array(
																					__('No', 'ultimate_layouts') 		=> '0',																		
																					__('Yes', 'ultimate_layouts') 		=> '1',																																							
																				   ),
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('0'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
														//Options For GRID
														
														//Options For SYNC Slider														
															array( // work with GRID
																'type' 			=> 'dropdown',
																'heading' 		=> __('SYNC SLIDER', 'ultimate_layouts'),
																'param_name' 	=> 'sync_slider_style', //Done
																'value' 		=> $array_sync_slider_styles,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('12'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
															array(
																'type' 			=> 'textfield',
																'heading' 		=> __('[SYNC SLIDER] - Height of Big Slider - Desktop', 'ultimate_layouts'), 
																'param_name' 	=> 'sync_slider_height_d', //Done
																'description' 	=> __('Example: <code>500px</code>, <code>600px</code>, <code>100vh</code>...', 'ultimate_layouts'), 
																'value'			=> '',	
																'dependency' 	=> array(
																						'element' 					=> 'layout_style',
																						'value' 					=> array('12'),
																					),	
																'group'			=> $group_layout_settings,																		 
															),
															array(
																'type' 			=> 'textfield',
																'heading' 		=> __('[SYNC SLIDER] - Height of Big Slider - Tablet', 'ultimate_layouts'), 
																'param_name' 	=> 'sync_slider_height_t', //Done
																'description' 	=> __('Example: <code>500px</code>, <code>600px</code>, <code>100vh</code>...', 'ultimate_layouts'), 
																'value'			=> '',	
																'dependency' 	=> array(
																						'element' 					=> 'layout_style',
																						'value' 					=> array('12'),
																					),	
																'group'			=> $group_layout_settings,																		 
															),
															array(
																'type' 			=> 'textfield',
																'heading' 		=> __('[SYNC SLIDER] - Height of Big Slider - Mobile', 'ultimate_layouts'), 
																'param_name' 	=> 'sync_slider_height_m', //Done
																'description' 	=> __('Example: <code>500px</code>, <code>600px</code>, <code>100vh</code>...', 'ultimate_layouts'), 
																'value'			=> '',	
																'dependency' 	=> array(
																						'element' 					=> 'layout_style',
																						'value' 					=> array('12'),
																					),	
																'group'			=> $group_layout_settings,																		 
															),
															
															array(
																'type' 			=> 'textfield',
																'heading' 		=> __('[SYNC SLIDER] - Width of Small Slider - Desktop', 'ultimate_layouts'), 
																'param_name' 	=> 'sync_slider_width_d', //Done
																'description' 	=> __('Example: <code>500px</code>, <code>600px</code>, <code>100vw</code>...', 'ultimate_layouts'), 
																'value'			=> '',	
																'dependency' 	=> array(
																						'element' 					=> 'layout_style',
																						'value' 					=> array('12'),
																					),	
																'group'			=> $group_layout_settings,																		 
															),
															array(
																'type' 			=> 'textfield',
																'heading' 		=> __('[SYNC SLIDER] - Width of Small Slider - Tablet', 'ultimate_layouts'), 
																'param_name' 	=> 'sync_slider_width_t', //Done
																'description' 	=> __('Example: <code>500px</code>, <code>600px</code>, <code>100vw</code>...', 'ultimate_layouts'), 
																'value'			=> '',	
																'dependency' 	=> array(
																						'element' 					=> 'layout_style',
																						'value' 					=> array('12'),
																					),	
																'group'			=> $group_layout_settings,																		 
															),
															array(
																'type' 			=> 'textfield',
																'heading' 		=> __('[SYNC SLIDER] - Width of Small Slider - Mobile', 'ultimate_layouts'), 
																'param_name' 	=> 'sync_slider_width_m', //Done
																'description' 	=> __('Example: <code>500px</code>, <code>600px</code>, <code>100vw</code>...', 'ultimate_layouts'), 
																'value'			=> '',	
																'dependency' 	=> array(
																						'element' 					=> 'layout_style',
																						'value' 					=> array('12'),
																					),	
																'group'			=> $group_layout_settings,																		 
															),
														//Options For SYNC Slider
														
														//Options For CAROUSEL TRADITIONAL
															array( // work with CAROUSEL TRADITIONAL
																'type' 			=> 'dropdown',
																'heading' 		=> __('CAROUSEL TRADITIONAL', 'ultimate_layouts'),
																'param_name' 	=> 'carousel_t_style', //Done
																'value' 		=> $array_carousel_t_styles,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('1'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),	
														//Options For CAROUSEL TRADITIONAL
														
														//Options For CAROUSEL FREE
															array( // work with CAROUSEL FREE
																'type' 			=> 'dropdown',
																'heading' 		=> __('CAROUSEL FREE', 'ultimate_layouts'),
																'param_name' 	=> 'carousel_f_style', //Done
																'value' 		=> $array_carousel_f_styles,
																'dependency' 	=> array(
																						'element'			 			=> 'layout_style',
																						'value' 						=> array('2'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),	
														//Options For CAROUSEL FREE
														
															array( // work with CAROUSEL
																'type' 			=> 'dropdown',
																'heading' 		=> __('[CAROUSEL] Prev/Next Arrows', 'ultimate_layouts'),
																'param_name' 	=> 'show_arrows', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),
																'dependency' 	=> array(
																						'element'			 			=> 'layout_style',
																						'value' 						=> array('1', '2'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[CAROUSEL] Arrows OutSide', 'ultimate_layouts'),
																	'param_name' 	=> 'arrows_outside', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),
																	'dependency' 	=> array(
																							'element'			 			=> 'show_arrows',
																							'value' 						=> array('1'),
																					   ),				   
																	'group'			=> $group_layout_settings,																		
																),	
															array( // work with CAROUSEL
																'type' 			=> 'dropdown',
																'heading' 		=> __('[CAROUSEL] Show Dot Indicators', 'ultimate_layouts'),
																'param_name' 	=> 'show_dots', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),
																'dependency' 	=> array(
																						'element'			 			=> 'layout_style',
																						'value' 						=> array('1'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
															array( // work with CAROUSEL
																'type' 			=> 'dropdown',
																'heading' 		=> __('[CAROUSEL] Infinite Loop Sliding', 'ultimate_layouts'),
																'param_name' 	=> 'infinite', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('1', '2'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
															array( // work with CAROUSEL
																'type' 			=> 'dropdown',
																'heading' 		=> __('[CAROUSEL - SLIDER] Enables Autoplay', 'ultimate_layouts'),
																'param_name' 	=> 'autoplay', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),
																'dependency' 	=> array(
																						'element'			 			=> 'layout_style',
																						'value' 						=> array('1', '2', '12'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
															array(
																'type' 			=> 'textfield',
																'heading' 		=> __('[CAROUSEL - SLIDER] AutoplaySpeed', 'ultimate_layouts'), 
																'param_name' 	=> 'autoplayspeed', //Done														
																'value'			=> '',	
																'description' 	=> __('Autoplay Speed in milliseconds. If blank, defaults to: <code>5000</code>', 'ultimate_layouts'),
																'dependency' 	=> array(
																						'element'			 			=> 'autoplay',
																						'value' 						=> array('1'),
																				   ),
																'group'			=> $group_layout_settings,												 
															),
															array( // work with CAROUSEL
																'type' 			=> 'dropdown',
																'heading' 		=> __('[CAROUSEL] Scroll Per Page', 'ultimate_layouts'),
																'param_name' 	=> 'scrollperpage', //Done
																'description' 	=> __('Scroll per page not per item. This affect next/prev buttons and mouse/touch dragging.', 'ultimate_layouts'),
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),
																'dependency' 	=> array(
																						'element'			 			=> 'layout_style',
																						'value' 						=> array('1'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),	
															array(
																'type' 			=> 'textfield',
																'heading' 		=> __('[CAROUSEL - SLIDER] Animation Speed', 'ultimate_layouts'), 
																'param_name' 	=> 'speed', //Done														
																'value'			=> '',	
																'description' 	=> __('If blank, defaults to: <code>500</code>', 'ultimate_layouts'),
																'dependency' 	=> array(
																						'element'			 			=> 'layout_style',
																						'value' 						=> array('1', '2', '12'),
																				   ),
																'group'			=> $group_layout_settings,												 
															),
															array( // work with CAROUSEL
																'type' 			=> 'dropdown',
																'heading' 		=> __('[CAROUSEL - SLIDER] Center Mode', 'ultimate_layouts'),
																'param_name' 	=> 'centermode', //Done
																'description' 	=> __('Enables centered view with partial prev/next slides.', 'ultimate_layouts'),
																'value' 		=> array(	
																						__('No', 'ultimate_layouts') 	=> '0',																		
																						__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																					),
																'dependency' 	=> array(
																						'element'			 			=> 'layout_style',
																						'value' 						=> array('1', '2', '12'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),	
														
														//Options For CONTENT BLOCKS
															array( // work with CONTENT BLOCKS
																'type' 			=> 'dropdown',
																'heading' 		=> __('CONTENT BLOCKS', 'ultimate_layouts'),
																'param_name' 	=> 'block_content_style',
																'value' 		=> $array_block_content_styles,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('3'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Title', 'ultimate_layouts'),
																'param_name' 	=> 's_title_small', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),
																'dependency' 	=> array(
																						'element'			 			=> 'layout_style',
																						'value' 						=> array('3', '12'),
																					   ),																									   
																'group'			=> $group_small_settings,																	
															),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Title] Limit Element To 01 Line', 'ultimate_layouts'),
																	'param_name' 	=> 's_title_limit_small', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_title_small',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_small_settings,																	
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Title] Link', 'ultimate_layouts'),
																	'param_name' 	=> 's_title_link_small', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_title_small',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_small_settings,																	
																),
																	array(
																		'type' 			=> 'dropdown',
																		'heading' 		=> __('[Title] Open Link In New Tab', 'ultimate_layouts'),
																		'param_name' 	=> 's_title_link_target_small', //Done
																		'value' 		=> array(	
																								__('No', 'ultimate_layouts') 	=> '0',																		
																								__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																							),	
																		'dependency' 	=> array(
																							'element'			 			=> 's_title_link_small',
																							'value' 						=> array('1'),
																						   ),																								   
																		'group'			=> $group_small_settings,																	
																	),
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Categories, Taxonomies, Tags ...', 'ultimate_layouts'),
																'param_name' 	=> 's_categories_small', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),
																'dependency' 	=> array(
																						'element'			 			=> 'layout_style',
																						'value' 						=> array('3', '12'),
																					   ),																									   
																'group'			=> $group_small_settings,																	
															),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Categories, Taxonomies, Tags ...] Style', 'ultimate_layouts'),
																	'param_name' 	=> 's_s_categories_small', //Done
																	'value' 		=> array(	
																							__('Inline Block', 'ultimate_layouts') 		=> '0',																		
																							__('Inline Text', 'ultimate_layouts') 		=> '1',																																																							
																						),		
																	'dependency' 	=> array(
																						'element'			 			=> 's_categories_small',
																						'value' 						=> array('1'),
																					   ),																							   
																	'group'			=> $group_small_settings,																	
																),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Categories, Taxonomies, Tags ...] Get Only Parent', 'ultimate_layouts'),
																	'param_name' 	=> 's_s_categories_parent_small', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 		=> '0',																		
																							__('Yes', 'ultimate_layouts') 		=> '1',																																																							
																						),		
																	'dependency' 	=> array(
																						'element'			 			=> 's_categories_small',
																						'value' 						=> array('1'),
																					   ),																							   
																	'group'			=> $group_small_settings,																	
																),
																array(
																	'type' 				=> 'textfield', //Done
																	'heading' 			=> __('[Categories, Taxonomies, Tags ...] HIDE taxonomies...', 'ultimate_layouts'),			
																	'param_name' 		=> 'ex_items_taxonomies_small',
																	'dependency' 		=> array(
																								'element' 	=> 	's_categories_small',
																								'value' 	=> 	array('1'),
																							),		
																	'description' 		=> __('List of "Taxonomies" do not want to display on layout, separated by a comma. 
																							  Example: <code>category</code>, <code>post_tag</code>, <code>product_cat</code>... 
																							  <br><br> Full List: '.$taxonomies_string, 'ultimate_layouts'),	
																	'group'				=> $group_small_settings,								
																),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Categories, Taxonomies, Tags ...] Color Settings', 'ultimate_layouts'),
																	'param_name' 	=> 's_c_categories_small', //Done
																	'value' 		=> array(	
																							__('TERM/CATEGORY BACKGROUND & COLOR', 'ultimate_layouts') 		=> '0',																		
																							__('Static Color', 'ultimate_layouts') 							=> '1',																																																							
																						),		
																	'dependency' 	=> array(
																						'element'			 			=> 's_categories_small',
																						'value' 						=> array('1'),
																					   ),																							   
																	'group'			=> $group_small_settings,																	
																),
																array(
																	'type'			=> 'colorpicker',
																	'heading' 		=> __('[Categories, Taxonomies, Tags] Text Color', 'ultimate_layouts'),
																	'param_name' 	=> 's_ct_categories_small', //Done
																	'dependency' 	=> array(
																						'element'			 			=> 's_c_categories_small',
																						'value' 						=> array('1'),
																					   ),	
																	'group'			=> $group_small_settings,
																	
																),
																array(
																	'type'			=> 'colorpicker',
																	'heading' 		=> __('[Categories, Taxonomies, Tags] Background Color', 'ultimate_layouts'),
																	'param_name' 	=> 's_cb_categories_small', //Done
																	'description' 	=> __('Work with [Categories, Taxonomies, Tags ...] Style: Inline Block', 'ultimate_layouts'),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_c_categories_small',
																						'value' 						=> array('1'),
																					   ),	
																	'group'			=> $group_small_settings,
																	
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Categories, Taxonomies, Tags ...] Open Link In New Tab', 'ultimate_layouts'),
																	'param_name' 	=> 's_categories_target_small', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_categories_small',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_small_settings,																	
																),
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Post Meta 1', 'ultimate_layouts'),
																'param_name' 	=> 's_metas_o_small', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),		
																'dependency' 	=> array(
																						'element'			 			=> 'layout_style',
																						'value' 						=> array('3', '12'),
																					   ),																							   
																'group'			=> $group_small_settings,																	
															),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 1] Show Author', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_o_author_small', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_o_small',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_small_settings,																	
																),
																	array( 
																		'type' 			=> 'dropdown',
																		'heading' 		=> __('[Post Meta 1] Show Author Avatar', 'ultimate_layouts'),
																		'param_name' 	=> 's_metas_o_author_avatar_small', //Done
																		'value' 		=> array(	
																								__('No', 'ultimate_layouts') 	=> '0',																		
																								__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																							),	
																		'dependency' 	=> array(
																							'element'			 			=> 's_metas_o_author_small',
																							'value' 						=> array('1'),
																						   ),																								   
																		'group'			=> $group_small_settings,																	
																	),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 1] Show Date/Time', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_o_time_small', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_o_small',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_small_settings,																	
																),
																	array(
																		'type' 			=> 'textfield',
																		'heading' 		=> __('[Post Meta 1] - [Date/Time] Format', 'ultimate_layouts'), 
																		'param_name' 	=> 'time_format_small', //Done
																		'description' 	=> __('Enter date/time format - <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Tutorial</a>. 
																						   If blank, defaults to: <code>F j, Y</code>', 'ultimate_layouts'), 
																		'value'			=> '',	
																		'dependency' 	=> array(
																								'element' 					=> 's_metas_o_time_small',
																								'value' 					=> array('1'),
																							),	
																		'group'			=> $group_small_settings,																		 
																	),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 1] Show Comment Count', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_o_comment_small', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_o_small',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_small_settings,																	
																),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 1] Show Like', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_o_like_small', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_o_small',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_small_settings,																	
																),																
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 1] Show Share', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_o_share_small', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_o_small',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_small_settings,																	
																),
																array(
																	'type' 			=> 'textarea',
																	'heading' 		=> __('[Post Meta 1] - Custom Post Meta', 'ultimate_layouts'), 
																	'param_name' 	=> 'custom_meta_o_small', //Done
																	'description' 	=> __('Enter custom post meta - Example: <br><code>[fontAwesome Icon]|[Your Post Meta Key]</code> 
																					   <br><code>fa fa-eye|beteplug_post_views_count,fa fa-calendar-check-o|MipTheme_Post_Views</code>', 'ultimate_layouts'), 
																	'value'			=> '',	
																	'dependency' 	=> array(
																							'element' 					=> 's_metas_o_small',
																							'value' 					=> array('1'),
																						),	
																	'group'			=> $group_small_settings,																		 
																),
															array( // Title color
																'type'			=> 'colorpicker',
																'heading' 		=> __('Title Color', 'ultimate_layouts'),
																'param_name' 	=> 'title_color_small',
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('3', '12'),
																				   ),
																'group'			=> $group_small_settings,
																'description' 	=> __('If blank, defaults to <code>#222222</code>', 'ultimate_layouts'),	
															),
															array(
																'type'			=> 'colorpicker',
																'heading' 		=> __('Title [Hover] Color', 'ultimate_layouts'),
																'param_name' 	=> 'title_hover_color_small',
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('3', '12'),
																				   ),
																'group'			=> $group_small_settings,
																'description' 	=> __('If blank, defaults to <code>#666666</code>', 'ultimate_layouts'),	
															),
															
															array( // Metas Color
																'type'			=> 'colorpicker',
																'heading' 		=> __('Metas 1 Color', 'ultimate_layouts'),
																'param_name' 	=> 'metas_o_color_small',
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('3', '12'),
																				   ),
																'group'			=> $group_small_settings,
																'description' 	=> __('If blank, defaults to <code>#999999</code>', 'ultimate_layouts'),	
															),
															array(
																'type'			=> 'colorpicker',
																'heading' 		=> __('Metas 1 [Hover] Color', 'ultimate_layouts'),
																'param_name' 	=> 'metas_o_hover_color_small',
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('3', '12'),
																				   ),
																'group'			=> $group_small_settings,
																'description' 	=> __('If blank, defaults to <code>#3c3c3c</code>', 'ultimate_layouts'),	
															),	
														//Options For CONTENT BLOCKS
														
														//Options For LIST
															array( // work with LIST
																'type' 			=> 'dropdown',
																'heading' 		=> __('LIST', 'ultimate_layouts'),
																'param_name' 	=> 'list_style', //Done
																'value' 		=> $array_list_styles,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('4'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),	
															/*
															array(																
																'type' 			=> 'textfield',
																'heading' 		=> __('Minimum width to switch view on mobile devices', 'ultimate_layouts'),
																'param_name' 	=> 'list_mobile_mode',
																'description'	=> __('If blank, defaults to <code>767</code>, unit: px', 'ultimate_layouts'),														
																'group'			=> $group_layout_settings,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('4'),
																				),									
															),	
															*/
														//Options For LIST
														
														//Options For CREATIVE
															array( // work with CREATIVE
																'type' 			=> 'dropdown',
																'heading' 		=> __('CREATIVE', 'ultimate_layouts'),
																'param_name' 	=> 'creative_style', //Done
																'value' 		=> $array_creative_styles,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('5'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
																array( // work with CREATIVE
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('CREATIVE [Show Elements]', 'ultimate_layouts'),
																	'param_name' 	=> 'show_elements', //Done
																	'value' 		=> array(	
																						__('Content', 'ultimate_layouts') 				=> '0',																		
																						__('Icon (lightbox)', 'ultimate_layouts') 		=> '1',
																						__('Both (icon + content)', 'ultimate_layouts') 	=> '2',																																																							
																					),	
																	'dependency' 	=> array(
																						'element'			 			=> 'layout_style',
																						'value' 						=> array('5'),
																					   ),				   
																	'group'			=> $group_layout_settings,																		
																),	
																array( // work with CREATIVE
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('CREATIVE [Always Visible Content]', 'ultimate_layouts'),
																	'param_name' 	=> 'av_content', //Done
																	'value' 		=> array(	
																						__('No', 'ultimate_layouts') 		=> '0',																		
																						__('Yes', 'ultimate_layouts') 		=> '1',																																																				
																					),	
																	'dependency' 	=> array(
																						'element'			 			=> 'show_elements',
																						'value' 						=> array('0', '2'),
																					   ),				   
																	'group'			=> $group_layout_settings,																		
																),	
														//Options For CREATIVE
														
														//Options For DREAMS
															array( // work with DREAMS
																'type' 			=> 'dropdown',
																'heading' 		=> __('DREAMS', 'ultimate_layouts'),
																'param_name' 	=> 'dreams_style',
																'value' 		=> $array_dreams_styles,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('6'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),	
														//Options For DREAMS
														
														//Options For CHARMING
															array( // work with CHARMING
																'type' 			=> 'dropdown',
																'heading' 		=> __('CHARMING', 'ultimate_layouts'),
																'param_name' 	=> 'charming_style',
																'value' 		=> $array_charming_styles,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('7'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),	
														//Options For CHARMING
														
														//Options For GALLERY
															array( // work with GALLERY
																'type' 			=> 'dropdown',
																'heading' 		=> __('GALLERY', 'ultimate_layouts'),
																'param_name' 	=> 'gallery_style',
																'value' 		=> $array_gallery_styles,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('8'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),	
														//Options For GALLERY
														
														//Options For TIMELINE
															array( // work with TIMELINE
																'type' 			=> 'dropdown',
																'heading' 		=> __('TIMELINE', 'ultimate_layouts'),
																'param_name' 	=> 'timeline_style', //done
																'value' 		=> $array_timeline_styles,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('9'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),	
														//Options For TIMELINE
														
														//Options For SOCIAL
															array( // work with SOCIAL
																'type' 			=> 'dropdown',
																'heading' 		=> __('SOCIAL FEED', 'ultimate_layouts'),
																'param_name' 	=> 'social_feed',
																'value' 		=> $array_social_feed_styles,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('10'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),	
														//Options For SOCIAL
														
														//Google Adsense
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('AdSense Ads Client ID', 'ultimate_layouts'), 
															'param_name' 	=> 'goo_ads_client', //Done
															'description' 	=> __( 'If you want to display Adsense in Layouts (Put Adsense Ads Between Post), enter Google AdSense Ad Client ID here.<br>
																					<img src="'.UL_BETE_PLUGIN_URL.'assets/back-end/images/googleClient.png">', 'ultimate_layouts'), 
															'value'			=> '',	
															'dependency' 	=> array(
																					'element' 					=> 'layout_style',
																					'value' 					=> array('0', '4'),
																				),	
															'group'			=> $group_googleads_settings,																		 
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('AdSense Ads Slot ID', 'ultimate_layouts'), 
															'param_name' 	=> 'goo_ads_id', //Done
															'description' 	=> __(	'If you want to display Adsense in Layouts (Put Adsense Ads Between Post), enter Google AdSense Ad Slot ID here.<br>
																					<img src="'.UL_BETE_PLUGIN_URL.'assets/back-end/images/googleSlot.png">', 'ultimate_layouts'), 
															'value'			=> '',	
															'dependency' 	=> array(
																					'element' 					=> 'layout_style',
																					'value' 					=> array('0', '4'),
																				),	
															'group'			=> $group_googleads_settings,																		 
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('Offset', 'ultimate_layouts'), 
															'param_name' 	=> 'goo_ads_offset', //Done
															'description' 	=> __('Ads appear position, Ex: <code>1</code>, <code>3</code>, <code>5</code>...', 'ultimate_layouts'), 
															'value'			=> '',	
															'dependency' 	=> array(
																					'element' 					=> 'layout_style',
																					'value' 					=> array('0', '4'),
																				),	
															'group'			=> $group_googleads_settings,																		 
														),
														//Google Adsense
														
														//Image Size
															array( // work with GRID, SLIDER, CAROUSEL, CONTENT BLOCKS, LIST, GALLERY, TIMELINE
																'type' 			=> 'dropdown',
																'heading' 		=> __('Image Size', 'ultimate_layouts'),
																'param_name' 	=> 'image_size', //Done
																'description' 	=> __('Work with Layout Styles: GRID, SLIDER, CAROUSEL, CONTENT BLOCKS, LIST, GALLERY, TIMELINE.', 'ultimate_layouts'),
																'value' 		=> $array_image_size,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('0', '1', '2', '3', '4', '8', '9', '12'),
																				   ),				   
																'group'			=> $group_layout_settings,																	
															),
															array( // work with GRID, SLIDER, CAROUSEL, CONTENT BLOCKS, LIST, GALLERY, TIMELINE
																'type' 			=> 'dropdown',
																'heading' 		=> __('Image Size (small item)', 'ultimate_layouts'),
																'param_name' 	=> 'image_size_s', //Done
																'description' 	=> __('Work with Layout Styles: CONTENT BLOCKS (small item).', 'ultimate_layouts'),
																'value' 		=> $array_image_size,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('3', '12'),
																				   ),				   
																'group'			=> $group_layout_settings,																	
															),
														//Image Size
														
														//options for show elements
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show [Image]', 'ultimate_layouts'),
																'param_name' 	=> 's_image', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),																				   
																'group'			=> $group_layout_settings,																	
															),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Image] Link', 'ultimate_layouts'),
																	'param_name' 	=> 's_image_link', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_image',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																	array(
																		'type' 			=> 'dropdown',
																		'heading' 		=> __('[Image] Open Link In New Tab', 'ultimate_layouts'),
																		'param_name' 	=> 's_image_link_target', //Done
																		'value' 		=> array(	
																								__('No', 'ultimate_layouts') 	=> '0',																		
																								__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																							),	
																		'dependency' 	=> array(
																							'element'			 			=> 's_image_link',
																							'value' 						=> array('1'),
																						   ),																								   
																		'group'			=> $group_layout_settings,																	
																	),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Image] Show Icon Video Lightbox', 'ultimate_layouts'),
																	'param_name' 	=> 's_icon_lightbox_video', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_image',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																	array(
																		'type' 			=> 'dropdown',
																		'heading' 		=> __('[Video] URL - Post Meta', 'ultimate_layouts'),
																		'param_name' 	=> 'video_url_meta', //Done
																		'value' 		=> array(	
																								__('Using Post Meta (create by: Beeteam368)', 'ultimate_layouts') 	=> '0',																		
																								__('Enter Your Post Meta (Key)', 'ultimate_layouts') 				=> '1',																																																							
																							),	
																		'dependency' 	=> array(
																							'element'			 			=> 's_icon_lightbox_video',
																							'value' 						=> array('1'),
																						   ),																								   
																		'group'			=> $group_layout_settings,																	
																	),
																	array(
																		'type' 			=> 'textarea',
																		'heading' 		=> __('[Video] URL - Your Post Meta (Key)', 'ultimate_layouts'), 
																		'param_name' 	=> 'video_url_meta_key', //Done
																		'description' 	=> __('Information which contains a link to the video will be opened on lightbox. Example: 
																							  <code>_ultimate_layouts_video_link</code>', 'ultimate_layouts'), 
																		'value'			=> '',	
																		'dependency' 	=> array(
																								'element' 					=> 'video_url_meta',
																								'value' 					=> array('1'),
																							),	
																		'group'			=> $group_layout_settings,																		 
																	),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Image] Show Icon Image Lightbox', 'ultimate_layouts'),
																	'param_name' 	=> 's_icon_lightbox_image', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_image',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Image] Show Icon Link', 'ultimate_layouts'),
																	'param_name' 	=> 's_icon_link', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),
																	'dependency' 	=> array(
																						'element'			 			=> 's_image',
																						'value' 						=> array('1'),
																					   ),																									   
																	'group'			=> $group_layout_settings,																	
																),
																	array(
																		'type' 			=> 'dropdown',
																		'heading' 		=> __('[Icon Link] Open Link In New Tab', 'ultimate_layouts'),
																		'param_name' 	=> 's_icon_link_target', //Done
																		'value' 		=> array(	
																								__('No', 'ultimate_layouts') 	=> '0',																		
																								__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																							),	
																		'dependency' 	=> array(
																							'element'			 			=> 's_icon_link',
																							'value' 						=> array('1'),
																						   ),																								   
																		'group'			=> $group_layout_settings,																	
																	),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Image] Hover Effect', 'ultimate_layouts'),
																	'param_name' 	=> 's_image_hover_effect', //Done
																	'value' 		=> array(	
																							__('Disabled', 'ultimate_layouts') 		=> '0',																		
																							__('Zoom Out', 'ultimate_layouts') 		=> '1',
																							__('Zoom Out Slow', 'ultimate_layouts') 	=> '2',
																							__('Zoom In', 'ultimate_layouts') 		=> '3',
																							__('Zoom In Slow', 'ultimate_layouts') 	=> '4',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_image',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Image] Overlay Hover Effect', 'ultimate_layouts'),
																	'param_name' 	=> 's_overlay_hover_effect', //Done
																	'value' 		=> array(	
																							__('Disabled', 'ultimate_layouts') 					=> '',																		
																							__('Fade', 'ultimate_layouts') 						=> 'ultimate-layouts-hover-css-fade',
																							__('Sweep To Right', 'ultimate_layouts') 			=> 'ultimate-layouts-hover-css-sweep-to-right',
																							__('Sweep To Left', 'ultimate_layouts') 				=> 'ultimate-layouts-hover-css-sweep-to-left',
																							__('Sweep To Bottom', 'ultimate_layouts') 			=> 'ultimate-layouts-hover-css-sweep-to-bottom',
																							__('Sweep To Top', 'ultimate_layouts') 				=> 'ultimate-layouts-hover-css-sweep-to-top',
																							__('Bounce To Right', 'ultimate_layouts') 			=> 'ultimate-layouts-hover-css-bounce-to-right',
																							__('Bounce To Left', 'ultimate_layouts') 			=> 'ultimate-layouts-hover-css-bounce-to-left',
																							__('Bounce To Bottom', 'ultimate_layouts') 			=> 'ultimate-layouts-hover-css-bounce-to-bottom',
																							__('Bounce To Top', 'ultimate_layouts') 				=> 'ultimate-layouts-hover-css-bounce-to-top',
																							__('Radial Out', 'ultimate_layouts') 				=> 'ultimate-layouts-hover-css-radial-out',
																							__('Radial In', 'ultimate_layouts') 					=> 'ultimate-layouts-hover-css-radial-in',
																							__('Rectangle In', 'ultimate_layouts') 				=> 'ultimate-layouts-hover-css-rectangle-in',
																							__('Rectangle Out', 'ultimate_layouts') 				=> 'ultimate-layouts-hover-css-rectangle-out',
																							__('Shutter In Horizontal', 'ultimate_layouts') 		=> 'ultimate-layouts-hover-css-shutter-in-horizontal',
																							__('Shutter Out Horizontal', 'ultimate_layouts') 	=> 'ultimate-layouts-hover-css-shutter-out-horizontal',
																							__('Shutter In Vertical', 'ultimate_layouts') 		=> 'ultimate-layouts-hover-css-shutter-in-vertical',
																							__('Shutter Out Vertical', 'ultimate_layouts') 		=> 'ultimate-layouts-hover-css-shutter-out-vertical',																																																							
																						),
																	'dependency' 	=> array(
																						'element'			 			=> 's_image',
																						'value' 						=> array('1'),
																					   ),																									   
																	'group'			=> $group_layout_settings,																	
																),
																	array(
																		'type' 			=> 'dropdown',
																		'heading' 		=> __('[Overlay] Settings', 'ultimate_layouts'),
																		'param_name' 	=> 's_overlay_settings', //Done
																		'value' 		=> array(	
																								__('Background - Static Color', 'ultimate_layouts') 						=> '0',																		
																								__('Background - TERM/CATEGORY BACKGROUND COLOR', 'ultimate_layouts') 	=> '1',																																																							
																							),	
																		'dependency' 	=> array(
																							'element'			 			=> 's_overlay_hover_effect',
																							'value_not_equal_to' 			=> array(''),
																						   ),																								   
																		'group'			=> $group_layout_settings,																	
																	),
																array(
																	'type'			=> 'colorpicker',
																	'heading' 		=> __('[Image] Overlay Color', 'ultimate_layouts'),
																	'param_name' 	=> 's_overlay_color', //Done
																	'description' 	=> __('If blank, defaults to <code>rgba(255,255,255,0.38)</code>', 'ultimate_layouts'),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_overlay_settings',
																						'value' 						=> array('0'),
																					   ),	
																	'group'			=> $group_layout_settings,
																	
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('Post Format Icon', 'ultimate_layouts'),
																	'param_name' 	=> 's_image_post_format', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_image',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																	array(
																		'type' 			=> 'dropdown',
																		'heading' 		=> __('Format Icon Position', 'ultimate_layouts'),
																		'param_name' 	=> 's_image_post_format_pos', //Done
																		'value' 		=> array(	
																								__('Bottom - Right', 'ultimate_layouts') 	=> 'ul-bottom-right',																		
																								__('Bottom - Left', 'ultimate_layouts') 	=> 'ul-bottom-left',
																								__('Top - Right', 'ultimate_layouts') 		=> 'ul-top-right',
																								__('Top - Left', 'ultimate_layouts') 		=> 'ul-top-left',
																								__('Center - Center', 'ultimate_layouts') 	=> 'ul-center-center',																																																						
																							),	
																		'dependency' 	=> array(
																							'element'			 			=> 's_image_post_format',
																							'value' 						=> array('1'),
																						   ),																								   
																		'group'			=> $group_layout_settings,																	
																	),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Image] Author Avatar', 'ultimate_layouts'),
																	'param_name' 	=> 's_image_avatar', //Done
																	'value' 		=> array(
																							__('No', 'ultimate_layouts') 	=> '0',	
																							__('Yes', 'ultimate_layouts') 	=> '1',																																													
																						),	
																	'description' 	=> __('Support Grid Layouts: AFRICAN LILY, ALPINE THISTLE, AMARYLLIS, AMAZON LILY, ARUM LILY', 'ultimate_layouts'),					
																	'dependency' 	=> array(
																						'element'			 			=> 's_image',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),																	
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Title', 'ultimate_layouts'),
																'param_name' 	=> 's_title', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),																				   
																'group'			=> $group_layout_settings,																	
															),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Title] Limit Element To 01 Line', 'ultimate_layouts'),
																	'param_name' 	=> 's_title_limit', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_title',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Title] Link', 'ultimate_layouts'),
																	'param_name' 	=> 's_title_link', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_title',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																	array(
																		'type' 			=> 'dropdown',
																		'heading' 		=> __('[Title] Open Link In New Tab', 'ultimate_layouts'),
																		'param_name' 	=> 's_title_link_target', //Done
																		'value' 		=> array(	
																								__('No', 'ultimate_layouts') 	=> '0',																		
																								__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																							),	
																		'dependency' 	=> array(
																							'element'			 			=> 's_title_link',
																							'value' 						=> array('1'),
																						   ),																								   
																		'group'			=> $group_layout_settings,																	
																	),
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Excerpt', 'ultimate_layouts'),
																'param_name' 	=> 's_excerpt', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),	
																'dependency' 	=> 	array(
																					'element'			 	=> 'layout_style',
																					'value_not_equal_to' 	=> array('2', '5'),
																				),																								   
																'group'			=> $group_layout_settings,																	
															),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Excerpt] Readmore Button', 'ultimate_layouts'),
																	'param_name' 	=> 's_excerpt_rbtn', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',
																							__('Yes', 'ultimate_layouts') 	=> '1',																																															
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_excerpt',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Excerpt] Wordpress Function', 'ultimate_layouts'),
																	'param_name' 	=> 's_excerpt_f', //Done
																	'value' 		=> array(	
																							__('get_the_excerpt()', 'ultimate_layouts') 	=> 'get_the_excerpt',																		
																							__('the_excerpt()', 'ultimate_layouts') 		=> 'the_excerpt',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_excerpt',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Excerpt] Strip Shortcodes', 'ultimate_layouts'),
																	'param_name' 	=> 's_excerpt_sc', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_excerpt',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Excerpt] Strip HTML Tags', 'ultimate_layouts'),
																	'param_name' 	=> 's_excerpt_sh', //Done
																	'description' 	=> __('If you disable this option, you\'ll probably have to custom CSS to match your theme.', 'ultimate_layouts'),
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_excerpt',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																	array(
																		'type' 			=> 'textfield',
																		'heading' 		=> __('[Excerpt] Length', 'ultimate_layouts'), 
																		'param_name' 	=> 's_excerpt_length', //Done
																		'description' 	=> __('Enter excerpt length. Example: <code>100</code>, <code>150</code>, <code>55</code>... - Default = blank', 'ultimate_layouts'), 
																		'value'			=> '',	
																		'dependency' 	=> array(
																								'element' 					=> 's_excerpt_sh',
																								'value' 					=> array('1'),
																							),	
																		'group'			=> $group_layout_settings,																		 
																	),
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Categories, Taxonomies, Tags ...', 'ultimate_layouts'),
																'param_name' 	=> 's_categories', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),																				   
																'group'			=> $group_layout_settings,																	
															),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Categories, Taxonomies, Tags ...] Style', 'ultimate_layouts'),
																	'param_name' 	=> 's_s_categories', //Done
																	'value' 		=> array(	
																							__('Inline Block', 'ultimate_layouts') 		=> '0',																		
																							__('Inline Text', 'ultimate_layouts') 		=> '1',																																																							
																						),		
																	'dependency' 	=> array(
																						'element'			 			=> 's_categories',
																						'value' 						=> array('1'),
																					   ),																							   
																	'group'			=> $group_layout_settings,																	
																),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Categories, Taxonomies, Tags ...] Get Only Parent', 'ultimate_layouts'),
																	'param_name' 	=> 's_s_categories_parent', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 		=> '0',																		
																							__('Yes', 'ultimate_layouts') 		=> '1',																																																							
																						),		
																	'dependency' 	=> array(
																						'element'			 			=> 's_categories',
																						'value' 						=> array('1'),
																					   ),																							   
																	'group'			=> $group_layout_settings,																	
																),
																array(
																	'type' 				=> 'textfield', //Done
																	'heading' 			=> __('[Categories, Taxonomies, Tags ...] HIDE taxonomies...', 'ultimate_layouts'),			
																	'param_name' 		=> 'ex_items_taxonomies',
																	'dependency' 		=> array(
																								'element' 	=> 	's_categories',
																								'value' 	=> 	array('1'),
																							),		
																	'description' 		=> __('List of "Taxonomies" do not want to display on layout, separated by a comma. 
																							  Example: <code>category</code>, <code>post_tag</code>, <code>product_cat</code>... 
																							  <br><br> Full List: '.$taxonomies_string, 'ultimate_layouts'),	
																	'group'				=> $group_layout_settings,								
																),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Categories, Taxonomies, Tags ...] Color Settings', 'ultimate_layouts'),
																	'param_name' 	=> 's_c_categories', //Done
																	'value' 		=> array(	
																							__('TERM/CATEGORY BACKGROUND & COLOR', 'ultimate_layouts') 		=> '0',																		
																							__('Static Color', 'ultimate_layouts') 							=> '1',																																																							
																						),		
																	'dependency' 	=> array(
																						'element'			 			=> 's_categories',
																						'value' 						=> array('1'),
																					   ),																							   
																	'group'			=> $group_layout_settings,																	
																),
																array(
																	'type'			=> 'colorpicker',
																	'heading' 		=> __('[Categories, Taxonomies, Tags] Text Color', 'ultimate_layouts'),
																	'param_name' 	=> 's_ct_categories', //Done
																	'dependency' 	=> array(
																						'element'			 			=> 's_c_categories',
																						'value' 						=> array('1'),
																					   ),	
																	'group'			=> $group_layout_settings,
																	
																),
																array(
																	'type'			=> 'colorpicker',
																	'heading' 		=> __('[Categories, Taxonomies, Tags] Background Color', 'ultimate_layouts'),
																	'param_name' 	=> 's_cb_categories', //Done
																	'description' 	=> __('Work with [Categories, Taxonomies, Tags ...] Style: Inline Block', 'ultimate_layouts'),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_c_categories',
																						'value' 						=> array('1'),
																					   ),	
																	'group'			=> $group_layout_settings,
																	
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Categories, Taxonomies, Tags ...] Open Link In New Tab', 'ultimate_layouts'),
																	'param_name' 	=> 's_categories_target', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_categories',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Post Meta 1', 'ultimate_layouts'),
																'param_name' 	=> 's_metas_o', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),																				   
																'group'			=> $group_layout_settings,																	
															),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 1] Show Author', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_o_author', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_o',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																	array( 
																		'type' 			=> 'dropdown',
																		'heading' 		=> __('[Post Meta 1] Show Author Avatar', 'ultimate_layouts'),
																		'param_name' 	=> 's_metas_o_author_avatar', //Done
																		'value' 		=> array(	
																								__('No', 'ultimate_layouts') 	=> '0',																		
																								__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																							),	
																		'dependency' 	=> array(
																							'element'			 			=> 's_metas_o_author',
																							'value' 						=> array('1'),
																						   ),																								   
																		'group'			=> $group_layout_settings,																	
																	),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 1] Show Date/Time', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_o_time', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_o',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																	array(
																		'type' 			=> 'textfield',
																		'heading' 		=> __('[Post Meta 1] - [Date/Time] Format', 'ultimate_layouts'), 
																		'param_name' 	=> 'time_format', //Done
																		'description' 	=> __('Enter date/time format - <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Tutorial</a>. 
																						   If blank, defaults to: <code>F j, Y</code>', 'ultimate_layouts'), 
																		'value'			=> '',	
																		'dependency' 	=> array(
																								'element' 					=> 's_metas_o_time',
																								'value' 					=> array('1'),
																							),	
																		'group'			=> $group_layout_settings,																		 
																	),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 1] Show Comment Count', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_o_comment', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_o',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 1] Show Like', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_o_like', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_o',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),																
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 1] Show Share', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_o_share', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_o',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																array(
																	'type' 			=> 'textarea',
																	'heading' 		=> __('[Post Meta 1] - Custom Post Meta', 'ultimate_layouts'), 
																	'param_name' 	=> 'custom_meta_o', //Done
																	'description' 	=> __('Enter custom post meta - Example: <br><code>[fontAwesome Icon]|[Your Post Meta Key]</code> 
																					   <br><code>fa fa-eye|beteplug_post_views_count,fa fa-calendar-check-o|MipTheme_Post_Views</code>', 'ultimate_layouts'), 
																	'value'			=> '',	
																	'dependency' 	=> array(
																							'element' 					=> 's_metas_o',
																							'value' 					=> array('1'),
																						),	
																	'group'			=> $group_layout_settings,																		 
																),
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Post Meta 2', 'ultimate_layouts'),
																'param_name' 	=> 's_metas_t', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),	
																'dependency' 	=> 	array(
																					'element'			 	=> 'layout_style',
																					'value_not_equal_to' 	=> array('1', '2', '5'),
																				),																								   
																'group'			=> $group_layout_settings,																	
															),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 2] Show Author', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_t_author', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_t',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																	array( 
																		'type' 			=> 'dropdown',
																		'heading' 		=> __('[Post Meta 2] Show Author Avatar', 'ultimate_layouts'),
																		'param_name' 	=> 's_metas_t_author_avatar', //Done
																		'value' 		=> array(	
																								__('No', 'ultimate_layouts') 	=> '0',																		
																								__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																							),	
																		'dependency' 	=> array(
																							'element'			 			=> 's_metas_t_author',
																							'value' 						=> array('1'),
																						   ),																								   
																		'group'			=> $group_layout_settings,																	
																	),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 2] Show Date/Time', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_t_time', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_t',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																	array(
																		'type' 			=> 'textfield',
																		'heading' 		=> __('[Post Meta 2] - [Date/Time] Format', 'ultimate_layouts'), 
																		'param_name' 	=> 'time_format_t', //Done
																		'description' 	=> __('Enter date/time format - <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Tutorial</a>. 
																						   If blank, defaults to: <code>F j, Y</code>', 'ultimate_layouts'), 
																		'value'			=> '',	
																		'dependency' 	=> array(
																								'element' 					=> 's_metas_t_time',
																								'value' 					=> array('1'),
																							),	
																		'group'			=> $group_layout_settings,																		 
																	),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 2] Show Comment Count', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_t_comment', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_t',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 2] Show Like', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_t_like', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																						
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_t',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),																
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 2] Show Share', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_t_share', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_t',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																array(
																	'type' 			=> 'textarea',
																	'heading' 		=> __('[Post Meta 2] - Custom Post Meta', 'ultimate_layouts'), 
																	'param_name' 	=> 'custom_meta_t', //Done
																	'description' 	=> __('Enter custom post meta - Example: <br><code>[fontAwesome Icon]|[Your Post Meta Key]</code> 
																					   <br><code>fa fa-eye|beteplug_post_views_count,fa fa-calendar-check-o|MipTheme_Post_Views</code>', 'ultimate_layouts'), 
																	'value'			=> '',	
																	'dependency' 	=> array(
																							'element' 					=> 's_metas_t',
																							'value' 					=> array('1'),
																						),	
																	'group'			=> $group_layout_settings,																		 
																),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta 2] Read More Button', 'ultimate_layouts'),
																	'param_name' 	=> 's_metas_t_readmore', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 's_metas_t',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_layout_settings,																	
																),
																	array(
																		'type' 			=> 'dropdown',
																		'heading' 		=> __('[Post Meta 2] [Read More Button] Open Link In New Tab', 'ultimate_layouts'),
																		'param_name' 	=> 's_metas_t_readmore_link_target', //Done
																		'value' 		=> array(	
																								__('No', 'ultimate_layouts') 	=> '0',																		
																								__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																							),	
																		'dependency' 	=> array(
																							'element'			 			=> 's_metas_t_readmore',
																							'value' 						=> array('1'),
																						   ),																								   
																		'group'			=> $group_layout_settings,																	
																	),
																	
															array(
																'type' 				=> 'textfield',
																'heading' 			=> __('Share Text', 'ultimate_layouts'), 
																'param_name' 		=> 'share_text', //Done														
																'value'				=> '',	
																'group'				=> $group_layout_settings,
															),
															array(
																'type' 				=> 'textfield',
																'heading' 			=> __('Read More Text', 'ultimate_layouts'), 
																'param_name' 		=> 'read_more_text', //Done														
																'value'				=> '',	
																'group'				=> $group_layout_settings,
															),	
															array(
																'type' 				=> 'textfield',
																'heading' 			=> __('The Text Before The author\'s name', 'ultimate_layouts'), 
																'param_name' 		=> 'before_author_text', //Done														
																'value'				=> '',	
																'group'				=> $group_layout_settings,
															),	
														//options for show elements
														
														//Custom Column																													
															array( // work with GRID, CAROUSEL, GALLERY, SOCIAL FEED
																'type' 			=> 'dropdown',
																'heading' 		=> __('Custom Columns - Mobiles (=0px and up)', 'ultimate_layouts'),
																'param_name' 	=> 'cc_mobile', //Done
																'description' 	=> __('Work with Layout Styles: GRID, CAROUSEL, GALLERY, SOCIAL FEED.', 'ultimate_layouts'),
																'value' 		=> $array_custom_columns,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('0', '1', '8', '10', '12'),
																				   ),				   
																'group'			=> $group_layout_settings,																	
															),
															array( // work with GRID, CAROUSEL, GALLERY, SOCIAL FEED
																'type' 			=> 'dropdown',
																'heading' 		=> __('Custom Columns - Portrait Tablets  (=600px and up)', 'ultimate_layouts'),
																'param_name' 	=> 'cc_portrait_tablet', //Done
																'description' 	=> __('Work with Layout Styles: GRID, CAROUSEL, GALLERY, SOCIAL FEED.', 'ultimate_layouts'),
																'value' 		=> $array_custom_columns,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('0', '1', '8', '10', '12'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
															array( // work with GRID, CAROUSEL, GALLERY, SOCIAL FEED
																'type' 			=> 'dropdown',
																'heading' 		=> __('Custom Columns - Landscape Tablets  (=800px and up)', 'ultimate_layouts'),
																'param_name' 	=> 'cc_landscape_tablet', //Done
																'description' 	=> __('Work with Layout Styles: GRID, CAROUSEL, GALLERY, SOCIAL FEED.', 'ultimate_layouts'),
																'value' 		=> $array_custom_columns,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('0', '1', '8', '10', '12'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
															array( // work with GRID, CAROUSEL, GALLERY, SOCIAL FEED
																'type' 			=> 'dropdown',
																'heading' 		=> __('Custom Columns - Small - Desktops  (=1025px and up)', 'ultimate_layouts'),
																'param_name' 	=> 'cc_small_desktop', //Done
																'description' 	=> __('Work with Layout Styles: GRID, CAROUSEL, GALLERY, SOCIAL FEED.', 'ultimate_layouts'),
																'value' 		=> $array_custom_columns,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('0', '1', '8', '10', '12'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
															array( // work with GRID, CAROUSEL, GALLERY, SOCIAL FEED
																'type' 			=> 'dropdown',
																'heading' 		=> __('Custom Columns - Medium - Desktops  (=1366px and up)', 'ultimate_layouts'),
																'param_name' 	=> 'cc_medium_desktop', //Done
																'description' 	=> __('Work with Layout Styles: GRID, CAROUSEL, GALLERY, SOCIAL FEED.', 'ultimate_layouts'),
																'value' 		=> $array_custom_columns,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('0', '1', '8', '10', '12'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
															array( // work with GRID, CAROUSEL, GALLERY, SOCIAL FEED
																'type' 			=> 'dropdown',
																'heading' 		=> __('Custom Columns - Large - Desktops (=1600px and up)', 'ultimate_layouts'),
																'param_name' 	=> 'cc_large_desktop', //Done
																'description' 	=> __('Work with Layout Styles: GRID, CAROUSEL, GALLERY, SOCIAL FEED.', 'ultimate_layouts'),
																'value' 		=> $array_custom_columns,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('0', '1', '8', '10', '12'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),
															array( // work with GRID, CAROUSEL, GALLERY, SOCIAL FEED
																'type' 			=> 'dropdown',
																'heading' 		=> __('Custom Columns - Extra Large - Desktops (=1920px and up)', 'ultimate_layouts'),
																'param_name' 	=> 'cc_extra_large_desktop', //Done
																'description' 	=> __('Work with Layout Styles: GRID, CAROUSEL, GALLERY, SOCIAL FEED.', 'ultimate_layouts'),
																'value' 		=> $array_custom_columns,
																'dependency' 	=> array(
																					'element'			 			=> 'layout_style',
																					'value' 						=> array('0', '1', '8', '10', '12'),
																				   ),				   
																'group'			=> $group_layout_settings,																		
															),	
														//Custom Column
														
														//Custom Margin
															array( // work with GRID, CAROUSEL, GALLERY, SOCIAL FEED
																'type' 			=> 'textfield',
																'heading' 		=> __('Gap (Horizontal)', 'ultimate_layouts'), 
																'param_name' 	=> 'gap_hor',
																'description' 	=> __('Enter gap between grid elements. 
																				   Example: <code>5px</code>, <code>10px</code>, <code>15px</code>... - Default = blank', 'ultimate_layouts'), 
																'value'			=> '',	
																'dependency' 	=> array(
																						'element' 					=> 'layout_style',
																						'value' 					=> array('0', '1', '2', '5', '8', '10'),
																					),	
																'group'			=> $group_layout_settings,																		 
															),
															array( // work with GRID, GALLERY, SOCIAL FEED
																'type' 			=> 'textfield',
																'heading' 		=> __('Gap (Vertical)', 'ultimate_layouts'), 
																'param_name' 	=> 'gap_ver',
																'description' 	=> __('Enter gap between grid elements.
																				   Example: <code>5px</code>, <code>10px</code>, <code>15px</code>... - Default = blank', 'ultimate_layouts'), 
																'value'			=> '',	
																'dependency' 	=> array(
																						'element' 					=> 'layout_style',
																						'value' 					=> array('0', '4', '8', '10'),
																					),	
																'group'			=> $group_layout_settings,																		 
															),
														//Custom Margin
														
														//Pagination 
														array( 
															'type' 			=> 'dropdown',
															'heading' 		=> __('Pagination Settings', 'ultimate_layouts'),
															'param_name' 	=> 'pagination', //Done
															'value' 		=> array(	
																					__('Load More Button', 'ultimate_layouts') 	=> '0',																		
																					__('Page Numbers', 'ultimate_layouts') 		=> '1',	
																					//__('Prev/Next Button', 'ultimate_layouts') => '2',
																					__('Infinite Scroll', 'ultimate_layouts') 	=> '3',																																																							
																				),
															'dependency' 	=> 	array(
																					'element'			 	=> 'layout_style',
																					'value_not_equal_to' 	=> array('1', '2', '3', '11'),
																				),					
															'group'			=> $group_layout_settings,																	
														),														
															array(
																'type' 				=> 'textfield',
																'heading' 			=> __('Load More Button Text', 'ultimate_layouts'), 
																'param_name' 		=> 'loadmore_text', //Done														
																'value'				=> '',	
																'group'				=> $group_layout_settings,	
																'dependency' 		=> array(
																						'element'			 			=> 'pagination',
																						'value' 						=> array('0'),
																				    ),											 
															),
															array(
																'type'			=> 'colorpicker',
																'heading' 		=> __('[Infinite Scroll] Color', 'ultimate_layouts'),
																'param_name' 	=> 'inf_scr_color',
																'group'			=> $group_layout_settings,
																'dependency' 	=> array(
																						'element'			 			=> 'pagination',
																						'value' 						=> array('3'),
																				    ),
																),
															/*
															array(
																'type' 				=> 'textfield',
																'heading' 			=> __('Prev Button Text', 'ultimate_layouts'), 
																'param_name' 		=> 'prev_text', //Done														
																'value'				=> '',	
																'group'				=> $group_layout_settings,		
																'dependency' 		=> array(
																						'element'			 			=> 'pagination',
																						'value' 						=> array('2'),
																				    ),											 
															),
															array(
																'type' 				=> 'textfield',
																'heading' 			=> __('Next Button Text', 'ultimate_layouts'), 
																'param_name' 		=> 'next_text', //Done														
																'value'				=> '',	
																'group'				=> $group_layout_settings,	
																'dependency' 		=> array(
																						'element'			 			=> 'pagination',
																						'value' 						=> array('2'),
																				    ),												 
															),
															*/
														//Pagination
														
														//LazyLoad
														array( 
															'type' 			=> 'dropdown',
															'heading' 		=> __('Lazyload Images', 'ultimate_layouts'),
															'param_name' 	=> 'lazyload', //Done
															'description' 	=> __('Lazyload does not support "Carousel Styles"', 'ultimate_layouts'),
															'value' 		=> array(	
																					__('No', 'ultimate_layouts') 				=> '0',																		
																					__('Yes', 'ultimate_layouts') 				=> '1',																																																						
																				),
															'dependency' 	=> 	array(
																					'element'			 	=> 'layout_style',
																					'value_not_equal_to' 	=> array('1', '2'),
																				),					
															'group'			=> $group_layout_settings,																	
														),														
															array(
																'type'			=> 'colorpicker',
																'heading' 		=> __('[Lazyload] - Placeholder Background', 'ultimate_layouts'),
																'param_name' 	=> 'lazyload_p', //Done
																'dependency' 	=> array(
																					'element'			 			=> 'lazyload',
																					'value' 						=> array('1'),
																				   ),	
																'group'			=> $group_layout_settings,
																
															),
														//LazyLoad
														
														//Animation
														array(
																'type' 				=> 'dropdown',
																'heading' 			=> __('Post Animation Effects', 'ultimate_layouts'), 
																'param_name'		=> 'animate',
																'value' 			=> array(
																							__('Default', 'ultimate_layouts') 				=> 'default', 
																							__('Random', 'ultimate_layouts') 				=> 'rand', 
																							__('Random Asynchronous', 'ultimate_layouts') 	=> 'randsync', 	 
																							
																							__('bounce', 'ultimate_layouts') 				=> '0', 
																							__('flash', 'ultimate_layouts') 					=> '1', 
																							__('pulse', 'ultimate_layouts') 					=> '2', 
																							__('rubberBand', 'ultimate_layouts') 			=> '3', 
																							__('shake', 'ultimate_layouts') 					=> '4', 
																							__('swing', 'ultimate_layouts') 					=> '5', 
																							__('tada', 'ultimate_layouts') 					=> '6', 
																							__('wobble', 'ultimate_layouts') 				=> '7', 
																							__('jello', 'ultimate_layouts') 					=> '8', 
																							__('bounceIn', 'ultimate_layouts') 				=> '9', 
																							__('bounceInDown', 'ultimate_layouts') 			=> '10', 
																							__('bounceInLeft', 'ultimate_layouts') 			=> '11', 
																							__('bounceInRight', 'ultimate_layouts') 			=> '12', 
																							__('bounceInUp', 'ultimate_layouts') 			=> '13', 
																							__('fadeIn', 'ultimate_layouts') 				=> '14', 
																							__('fadeInDown', 'ultimate_layouts') 			=> '15', 
																							__('fadeInDownBig', 'ultimate_layouts') 			=> '16', 
																							__('fadeInLeft', 'ultimate_layouts') 			=> '17', 
																							__('fadeInLeftBig', 'ultimate_layouts') 			=> '18', 
																							__('fadeInRight', 'ultimate_layouts') 			=> '19', 
																							__('fadeInRightBig', 'ultimate_layouts') 		=> '20', 
																							__('fadeInUp', 'ultimate_layouts') 				=> '21', 
																							__('fadeInUpBig', 'ultimate_layouts') 			=> '22', 
																							__('flipInX', 'ultimate_layouts') 				=> '23', 
																							__('flipInY', 'ultimate_layouts') 				=> '24', 
																							__('lightSpeedIn', 'ultimate_layouts') 			=> '25', 
																							__('rotateIn', 'ultimate_layouts') 				=> '26', 
																							__('rotateInDownLeft', 'ultimate_layouts') 		=> '27', 
																							__('rotateInDownRight', 'ultimate_layouts') 		=> '28', 
																							__('rotateInUpLeft', 'ultimate_layouts') 		=> '29', 
																							__('rotateInUpRight', 'ultimate_layouts') 		=> '30', 
																							__('rollIn', 'ultimate_layouts') 				=> '31', 
																							__('zoomIn', 'ultimate_layouts') 				=> '32', 
																							__('zoomInDown', 'ultimate_layouts') 			=> '33', 
																							__('zoomInLeft', 'ultimate_layouts') 			=> '34', 
																							__('zoomInRight', 'ultimate_layouts') 			=> '35', 
																							__('zoomInUp', 'ultimate_layouts') 				=> '36', 
																							__('slideInDown', 'ultimate_layouts') 			=> '37', 
																							__('slideInLeft', 'ultimate_layouts') 			=> '38', 
																							__('slideInRight', 'ultimate_layouts') 			=> '39', 
																							__('slideInUp', 'ultimate_layouts') 				=> '40',  														
																					),
																'description' 		=> __('The list posts appear, there will be more animated', 'ultimate_layouts'), 
																'dependency' 		=> 	array(
																						'element'			 	=> 'layout_style',
																						'value_not_equal_to' 	=> array('1', '2', '3'),
																					),
																'group'				=> $group_layout_settings,															
														),
														//Animation
														
														//GeoDirectory
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('GeoDirectory Rating', 'ultimate_layouts'),
															'param_name' 	=> 'geodirectory_rating',
															'value' 		=> array(	
																				__('Disabled', 'ultimate_layouts') 	=> '0',		
																				__('Enabled', 'ultimate_layouts') 	=> '1',																																	
																			),
															'description' 	=> __('Work with plugin GeoDirectory: https://wordpress.org/plugins/geodirectory/', 'ultimate_layouts'),
															'dependency' 	=> array(
																				'element'			 			=> 'layout_style',
																				'value' 						=> array('0', '1', '2', '3', '4'),
																			   ),					
															'group'			=> $group_layout_settings,					
														),
														//GeoDirectory
														
														//quick view
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('Quick View', 'ultimate_layouts'),
															'param_name' 	=> 'quick_view',
															'value' 		=> array(			
																				__('Enabled', 'ultimate_layouts') 	=> '1',													
																				__('Disabled', 'ultimate_layouts') 	=> '0',																																												
																			),
															'group'			=> $group_layout_settings,					
														),
															array(
																'type' 			=> 'dropdown',
																'heading' 		=> __('[Quick View] Open Post By', 'ultimate_layouts'),
																'param_name' 	=> 'quick_view_mode',
																'description' 	=> __('Open by basic button (or) All links on layout.', 'ultimate_layouts'),
																'value' 		=> array(															
																					__('Basic Button', 'ultimate_layouts') 			=> '0',	
																					__('All Links on Layout', 'ultimate_layouts') 	=> '1',																																																							
																				),
																'dependency' 	=> array(
																					'element'			 			=> 'quick_view',
																					'value' 						=> array('1'),
																				   ),				
																'group'			=> $group_layout_settings,					
															),
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Title', 'ultimate_layouts'),
																'param_name' 	=> 'qv_s_title', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),
																'dependency' 	=> array(
																						'element'			 			=> 'quick_view',
																						'value' 						=> array('1'),
																					   ),																									   
																'group'			=> $group_quickview_settings,																	
															),
																array(
																	'type' 			=> 'textfield',
																	'heading' 		=> __('[Title] Font Size', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_title_font_size',
																	'description' 	=> __('<strong>Example:</strong> <code>14px</code>, <code>16px</code> ...', 'ultimate_layouts'),		
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_title',
																						'value' 						=> array('1'),
																					   ),														
																	'group'			=> $group_quickview_settings,					
																),
																array(
																	'type' 			=> 'textfield',
																	'heading' 		=> __('[Title] Font Letter Spacing', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_title_letter_spacing',
																	'description' 	=> __('<strong>Example:</strong> <code>1px</code>, <code>0.1em</code> ... If blank, defaults to <code>0.075em</code>', 'ultimate_layouts'),
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_title',
																						'value' 						=> array('1'),
																					   ),															
																	'group'			=> $group_quickview_settings,					
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Title] Font Weight', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_title_font_weight',
																	'value' 		=> $array_font_weight,
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_title',
																						'value' 						=> array('1'),
																					   ),
																	'group'			=> $group_quickview_settings,					
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Title] Font Style', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_title_font_style',
																	'value' 		=> $array_font_style,
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_title',
																						'value' 						=> array('1'),
																					   ),
																	'group'			=> $group_quickview_settings,					
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Title] Text Transform', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_title_text_transform',
																	'value' 		=> $array_text_transform,
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_title',
																						'value' 						=> array('1'),
																					   ),
																	'group'			=> $group_quickview_settings,					
																),
																array(
																	'type' 			=> 'textfield',
																	'heading' 		=> __('[Title] Line Height', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_title_line_height',
																	'description' 	=> __('<strong>Example:</strong> <code>15px</code>, <code>1.55em</code> ...', 'ultimate_layouts'),		
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_title',
																						'value' 						=> array('1'),
																					   ),													
																	'group'			=> $group_quickview_settings,					
																),
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Categories, Taxonomies, Tags ...', 'ultimate_layouts'),
																'param_name' 	=> 'qv_s_categories', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),		
																'dependency' 	=> array(
																						'element'			 			=> 'quick_view',
																						'value' 						=> array('1'),
																					   ),																							   
																'group'			=> $group_quickview_settings,																	
															),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Categories, Taxonomies, Tags ...] Style', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_s_s_categories', //Done
																	'value' 		=> array(	
																							__('Inline Block', 'ultimate_layouts') 		=> '0',																		
																							__('Inline Text', 'ultimate_layouts') 		=> '1',																																																							
																						),		
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_categories',
																						'value' 						=> array('1'),
																					   ),																							   
																	'group'			=> $group_quickview_settings,																	
																),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Categories, Taxonomies, Tags ...] Get Only Parent', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_s_s_categories_parent', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 		=> '0',																		
																							__('Yes', 'ultimate_layouts') 		=> '1',																																																							
																						),		
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_categories',
																						'value' 						=> array('1'),
																					   ),																							   
																	'group'			=> $group_quickview_settings,																	
																),
																array(
																	'type' 				=> 'textfield', //Done
																	'heading' 			=> __('[Categories, Taxonomies, Tags ...] HIDE taxonomies...', 'ultimate_layouts'),			
																	'param_name' 		=> 'qv_ex_items_taxonomies',
																	'dependency' 		=> array(
																								'element' 	=> 	'qv_s_categories',
																								'value' 	=> 	array('1'),
																							),		
																	'description' 		=> __('List of "Taxonomies" do not want to display on layout, separated by a comma. 
																							  Example: <code>category</code>, <code>post_tag</code>, <code>product_cat</code>... 
																							  <br><br> Full List: '.$taxonomies_string, 'ultimate_layouts'),	
																	'group'				=> $group_quickview_settings,								
																),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Categories, Taxonomies, Tags ...] Color Settings', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_s_c_categories', //Done
																	'value' 		=> array(	
																							__('TERM/CATEGORY BACKGROUND & COLOR', 'ultimate_layouts') 		=> '0',																		
																							__('Static Color', 'ultimate_layouts') 							=> '1',																																																							
																						),		
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_categories',
																						'value' 						=> array('1'),
																					   ),																							   
																	'group'			=> $group_quickview_settings,																	
																),
																array(
																	'type'			=> 'colorpicker',
																	'heading' 		=> __('[Categories, Taxonomies, Tags] Text Color', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_s_ct_categories', //Done
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_c_categories',
																						'value' 						=> array('1'),
																					   ),	
																	'group'			=> $group_quickview_settings,
																	
																),
																array(
																	'type'			=> 'colorpicker',
																	'heading' 		=> __('[Categories, Taxonomies, Tags] Background Color', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_s_cb_categories', //Done
																	'description' 	=> __('Work with [Categories, Taxonomies, Tags ...] Style: Inline Block', 'ultimate_layouts'),	
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_c_categories',
																						'value' 						=> array('1'),
																					   ),	
																	'group'			=> $group_quickview_settings,
																	
																),
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Categories, Taxonomies, Tags ...] Open Link In New Tab', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_s_categories_target', //Done
																	'value' 		=> array(	
																							__('No', 'ultimate_layouts') 	=> '0',																		
																							__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_categories',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_quickview_settings,																	
																),
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Post Meta\'s', 'ultimate_layouts'),
																'param_name' 	=> 'qv_s_metas_o', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),	
																'dependency' 	=> array(
																						'element'			 			=> 'quick_view',
																						'value' 						=> array('1'),
																					   ),																								   
																'group'			=> $group_quickview_settings,																	
															),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta\'s] Show Author', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_s_metas_o_author', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_metas_o',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_quickview_settings,																	
																),
																	array( 
																		'type' 			=> 'dropdown',
																		'heading' 		=> __('[Post Meta\'s] Show Author Avatar', 'ultimate_layouts'),
																		'param_name' 	=> 'qv_s_metas_o_author_avatar', //Done
																		'value' 		=> array(	
																								__('No', 'ultimate_layouts') 	=> '0',																		
																								__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																							),	
																		'dependency' 	=> array(
																							'element'			 			=> 'qv_s_metas_o_author',
																							'value' 						=> array('1'),
																						   ),																								   
																		'group'			=> $group_quickview_settings,																	
																	),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta\'s] Show Date/Time', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_s_metas_o_time', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_metas_o',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_quickview_settings,																	
																),
																	array(
																		'type' 			=> 'textfield',
																		'heading' 		=> __('[Post Meta\'s] - [Date/Time] Format', 'ultimate_layouts'), 
																		'param_name' 	=> 'qv_time_format', //Done
																		'description' 	=> __('Enter date/time format - <a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">Tutorial</a>. 
																						   If blank, defaults to: <code>F j, Y</code>', 'ultimate_layouts'), 
																		'value'			=> '',	
																		'dependency' 	=> array(
																								'element' 					=> 'qv_s_metas_o_time',
																								'value' 					=> array('1'),
																							),	
																		'group'			=> $group_quickview_settings,																		 
																	),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta\'s] Show Comment Count', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_s_metas_o_comment', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',																		
																							__('No', 'ultimate_layouts') 	=> '0',																																																							
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_metas_o',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_quickview_settings,																	
																),
																array( 
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Post Meta\'s] Show Like', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_s_metas_o_like', //Done
																	'value' 		=> array(	
																							__('Yes', 'ultimate_layouts') 	=> '1',	
																							__('No', 'ultimate_layouts') 	=> '0',																																														
																						),	
																	'dependency' 	=> array(
																						'element'			 			=> 'qv_s_metas_o',
																						'value' 						=> array('1'),
																					   ),																								   
																	'group'			=> $group_quickview_settings,																	
																),
																array(
																	'type' 			=> 'textarea',
																	'heading' 		=> __('[Post Meta 1] - Custom Post Meta', 'ultimate_layouts'), 
																	'param_name' 	=> 'qv_custom_meta_o', //Done
																	'description' 	=> __('Enter custom post meta - Example: <br><code>[fontAwesome Icon]|[Your Post Meta Key]</code> 
																					   <br><code>fa fa-eye|beteplug_post_views_count,fa fa-calendar-check-o|MipTheme_Post_Views</code>', 'ultimate_layouts'), 
																	'value'			=> '',	
																	'dependency' 	=> array(
																							'element' 					=> 'qv_s_metas_o',
																							'value' 					=> array('1'),
																						),	
																	'group'			=> $group_quickview_settings,																		 
																),
															array(
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Content', 'ultimate_layouts'),
																'param_name' 	=> 'qv_show_content',
																'value' 		=> array(	
																					__('Yes', 'ultimate_layouts') 	=> '1',															
																					__('No', 'ultimate_layouts') 	=> '0',	
																																																																											
																				),
																'dependency' 	=> array(
																						'element'			 			=> 'quick_view',
																						'value' 						=> array('1'),
																					   ),				
																'group'			=> $group_quickview_settings,					
															),	
																array(
																	'type' 			=> 'dropdown',
																	'heading' 		=> __('[Content] Strip Shortcodes', 'ultimate_layouts'),
																	'param_name' 	=> 'qv_content_stripsc',
																	'value' 		=> array(	
																						__('No', 'ultimate_layouts') 	=> '0',
																						__('Yes', 'ultimate_layouts') 	=> '1',																																																																												
																					),
																	'dependency' 	=> array(
																							'element'			 			=> 'qv_show_content',
																							'value' 						=> array('1'),
																						   ),				
																	'group'			=> $group_quickview_settings,					
																),		
															array(
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Social Share', 'ultimate_layouts'),
																'param_name' 	=> 'qv_show_share',
																'value' 		=> array(	
																					__('Yes', 'ultimate_layouts') 	=> '1',															
																					__('No', 'ultimate_layouts') 	=> '0',	
																																																																											
																				),
																'dependency' 	=> array(
																						'element'			 			=> 'quick_view',
																						'value' 						=> array('1'),
																					   ),				
																'group'			=> $group_quickview_settings,					
															),				
															array(
																'type' 			=> 'dropdown',
																'heading' 		=> __('[wooCommerce] Show Rating', 'ultimate_layouts'),
																'param_name' 	=> 'qv_woo_show_rating',
																'value' 		=> array(	
																					__('Yes', 'ultimate_layouts') 	=> '1',																
																					__('No', 'ultimate_layouts') 	=> '0',																																												
																				),
																'dependency' 	=> array(
																						'element'			 			=> 'quick_view',
																						'value' 						=> array('1'),
																					   ),				
																'group'			=> $group_quickview_settings,					
															),
															
															array( 
																'type' 			=> 'dropdown',
																'heading' 		=> __('Show Featured Image', 'ultimate_layouts'),
																'param_name' 	=> 'qv_s_featured_image', //Done
																'value' 		=> array(	
																						__('Yes', 'ultimate_layouts') 	=> '1',																		
																						__('No', 'ultimate_layouts') 	=> '0',																																																							
																					),
																'dependency' 	=> array(
																						'element'			 			=> 'quick_view',
																						'value' 						=> array('1'),
																					   ),																									   
																'group'			=> $group_quickview_settings,																	
															),
														//quick view
														
														array(
															'type' 				=> 'textfield',
															'heading' 			=> __('Extra Class Name', 'ultimate_layouts'), 
															'param_name' 		=> 'extra_class', //Done														
															'value'				=> '',	
															'group'				=> $group_layout_settings,												 
														),
													//Layout Settings
													
													//Custom Query														
														array(
															'type' 				=> 'dropdown', //Done
															'heading' 			=> __('Post types', 'ultimate_layouts'),			
															'param_name' 		=> 'post_types',
															'value' 			=> $bt_post_types_list,
															'description' 		=> __('Select content type for your layout. If you select the "attachment", you will not be able to use the filter. It\'s just a slideshow function available images in your media library.', 'ultimate_layouts'),	
															'group'				=> $group_query_settings,
														),
														array(
															'type' 				=> 'attach_images', //Done
															'heading' 			=> __('INCLUDE Attachment', 'ultimate_layouts'),			
															'param_name' 		=> 'i_attachment',
															'group'				=> $group_query_settings,
															'dependency' 		=> array(
																						'element' 	=> 	'post_types',
																						'value' 	=> 	array('attachment'),
																					),
														),															
														array(
															'type' 				=> 'textfield', //Done
															'heading' 			=> __('Use Multiple "Post Types"', 'ultimate_layouts'),			
															'param_name' 		=> 'multi_post_types',
															'dependency' 		=> array(
																						'element' 	=> 	'post_types',
																						'value' 	=> 	array('multi_post_types'),
																					),		
															'description' 		=> __('List of "Post Types" to query items from, separated by a comma. 
																					  Example: <code>post</code>, <code>page</code>, <code>product</code>... 
																					  <br><br> Full List: '.$bt_post_types_string, 'ultimate_layouts'),	
															'group'				=> $group_query_settings,								
														),
														array(
															'type' 				=> 'dropdown', //Done
															'heading' 			=> __('Taxonomies', 'ultimate_layouts'),			
															'param_name' 		=> 'taxonomies',
															'value' 			=> $taxonomies_list,
															'description' 		=> __('Works in conjunction with selected "Post types"', 'ultimate_layouts'),	
															'group'				=> $group_query_settings,
														),	
														array(
															'type' 				=> 'textfield', //Done
															'heading' 			=> __('Use Multiple "Taxonomies"', 'ultimate_layouts'),			
															'param_name' 		=> 'multi_taxonomies',
															'dependency' 		=> array(
																						'element' 	=> 	'taxonomies',
																						'value' 	=> 	array('multi_taxonomies'),
																					),		
															'description' 		=> __('List of "Taxonomies" to query items from, separated by a comma. 
																					  Example: <code>category</code>, <code>post_tag</code>, <code>product_cat</code>... 
																					  <br><br> Full List: '.$taxonomies_string, 'ultimate_layouts'),	
															'group'				=> $group_query_settings,								
														),	
														array(
															'type' 				=> 'dropdown', //Done
															'heading' 			=> __('Query Types', 'ultimate_layouts'),			
															'param_name' 		=> 'query_types',
															'value' 			=> array(	
																					__('Query Type 1: INCLUDE categories, tags, taxonomies...', 'ultimate_layouts') 				=> '0',																		
																					__('Query Type 2: EXCLUDE categories, tags, taxonomies...', 'ultimate_layouts') 				=> '1',	
																					__('Query Type 3: INCLUDE Posts/Pages/Custom Post Types...', 'ultimate_layouts') 				=> '2',
																					__('Query Type 4: INCLUDE and EXCLUDE categories, tags, taxonomies...', 'ultimate_layouts')		=> '3',																																																																										
																				),
															'description' 		=> __('Select the type of query.', 'ultimate_layouts'),	
															'group'				=> $group_query_settings,
														),													
														array(
															'type' 				=> 'autocomplete', //Done
															'heading' 			=> __('INCLUDE categories, tags, taxonomies...', 'ultimate_layouts'),		
															'param_name' 		=> 'i_taxonomies',
															'description' 		=> __('Enter categories, tags, taxonomies... be shown posts in the layout.', 'ultimate_layouts'), 
															'settings' 			=> array(
																						'multiple' 					=> true,																					
																						'min_length' 				=> 1,
																						'groups' 					=> true,
																						'unique_values' 			=> true,
																						'display_inline' 			=> true,
																						'delay' 					=> 500,
																						'auto_focus' 				=> true,
																				   ),
															'group'				=> $group_query_settings,	
															'dependency' 		=> array(
																						'element' 	=> 	'query_types',
																						'value' 	=> 	array('0', '3'),
																					),													
														),
															array(
																'type' 				=> 'dropdown', //Done
																'heading' 			=> __('Operator', 'ultimate_layouts'),			
																'param_name' 		=> 'cq_operator',
																'value' 			=> array(	
																						__('IN', 'ultimate_layouts') 				=> '0',																		
																						__('AND', 'ultimate_layouts') 				=> '1',																																														
																					),
																'description' 		=> __('Operator to test. Possible values are IN, AND - This option will not work if you use a filter and only works when you use a single taxonomy.', 'ultimate_layouts'),	
																'dependency' 		=> array(
																						'element' 	=> 	'query_types',
																						'value' 	=> 	array('0'),
																					),
																'group'				=> $group_query_settings,
															),
														array(
															'type' 				=> 'autocomplete', //Done
															'heading' 			=> __('EXCLUDE categories, tags, taxonomies...', 'ultimate_layouts'),		
															'param_name' 		=> 'e_taxonomies',
															'description' 		=> __('Enter categories, tags, taxonomies... won\'t be shown posts in the layout. 
																					  These taxonomies are removed will not be added to the list of filters.', 'ultimate_layouts'), 
															'settings' 			=> array(
																						'multiple' 					=> true,																					
																						'min_length' 				=> 1,
																						'groups' 					=> true,
																						'unique_values' 			=> true,
																						'display_inline' 			=> true,
																						'delay' 					=> 500,
																						'auto_focus' 				=> true,
																				   ),
															'group'				=> $group_query_settings,	
															'dependency' 		=> array(
																						'element' 	=> 	'query_types',
																						'value' 	=> 	array('1', '3'),
																					),													
														),
														array(
															'type' 				=> 'autocomplete', //Done
															'heading' 			=> __('EXCLUDE Posts/Pages/Custom Post Types', 'ultimate_layouts'), 
															'param_name' 		=> 'e_ids',
															'description' 		=> __('Only entered posts/pages will be "EXCLUDED" in the output. Note: Works in conjunction with selected "Post types".', 'ultimate_layouts'),   
															'settings' 			=> array(
																						'multiple' 					=> true,																					
																						'min_length' 				=> 2,
																						'groups' 					=> true,
																						'unique_values' 			=> true,
																						'display_inline' 			=> true,
																						'delay' 					=> 500,
																						'auto_focus' 				=> true,
																				   ),
															'group'				=> $group_query_settings,
															'dependency' 		=> array(
																						'element' 	=> 	'query_types',
																						'value' 	=> 	array('0', '1'),
																					),						   
														),	
														array(
															'type' 				=> 'autocomplete', //Done
															'heading' 			=> __('INCLUDE Posts/Pages/Custom Post Types', 'ultimate_layouts'), 
															'param_name' 		=> 'i_ids',
															'description' 		=> __('Only entered posts/pages will be "INCLUDED" in the output. Note: Works in conjunction with selected "Post types".', 'ultimate_layouts'),   
															'settings' 			=> array(
																						'multiple' 					=> true,																					
																						'min_length' 				=> 2,
																						'groups' 					=> true,
																						'unique_values' 			=> true,
																						'display_inline' 			=> true,
																						'delay' 					=> 500,
																						'auto_focus' 				=> true,
																				   ),
															'group'				=> $group_query_settings,	
															'dependency' 		=> array(
																						'element' 	=> 	'query_types',
																						'value' 	=> 	array('2'),
																					),					   
														),
														array(
															'type' 				=> 'dropdown', //Done
															'heading' 			=> __('Order By', 'ultimate_layouts'),			
															'param_name' 		=> 'order_by',
															'value' 			=> array(	
																					__('Date', 'ultimate_layouts') 					=> 'date',																		
																					__('Order by post ID', 'ultimate_layouts') 		=> 'ID',
																					__('Author', 'ultimate_layouts') 				=> 'author',
																					__('Title', 'ultimate_layouts') 					=> 'title',
																					__('Last modified date', 'ultimate_layouts') 	=> 'modified',
																					__('Post/page parent ID', 'ultimate_layouts') 	=> 'parent',
																					__('Number of comments', 'ultimate_layouts') 	=> 'comment_count',
																					__('Menu order/Page Order', 'ultimate_layouts') 	=> 'menu_order',
																					__('Random order', 'ultimate_layouts') 			=> 'rand',
																					__('Meta Value', 'ultimate_layouts') 			=> 'meta_value',
																					__('Meta Value Number', 'ultimate_layouts') 		=> 'meta_value_num',
																					__('Preserve post ID order', 'ultimate_layouts') => 'post__in',																																																							
																				),
															'description' 		=> __('Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'ultimate_layouts'),	
															'group'				=> $group_query_settings,
														),	
														array(															
															'type' 				=> 'textfield', //Done
															'heading' 			=> __('Meta Key', 'ultimate_layouts'),
															'param_name' 		=> 'meta_key_query',
															'description' 		=> __('Input meta key for grid ordering.', 'ultimate_layouts'),															
															'group'				=> $group_query_settings,	
															'dependency' 		=> array(
																						'element' 	=> 	'order_by',
																						'value' 	=> 	array('meta_value', 'meta_value_num'),
																					),					
														),
														array(
															'type' 				=> 'dropdown', //Done
															'heading' 			=> __('Sort Order', 'ultimate_layouts'),			
															'param_name' 		=> 'order',
															'value' 			=> array(	
																					__('Descending', 'ultimate_layouts') 			=> 'DESC',																		
																					__('Ascending', 'ultimate_layouts') 				=> 'ASC',																																																																											
																				),
															'description' 		=> __('Select sorting order.', 'ultimate_layouts'),	
															'group'				=> $group_query_settings,
														),
														array(															
															'type' 				=> 'textfield', //Done
															'heading' 			=> __('Author', 'ultimate_layouts'),
															'param_name' 		=> 'query_author',
															'description' 		=> __(	'Use author id, separated by a comma, ex: <code>1,2,3</code>. 
																						[use minus (-) to exclude authors by ID ex: <code>-1,-2,-3</code>]', 'ultimate_layouts'),															
															'group'				=> $group_query_settings,
														),
														array(
															'type' 				=> 'dropdown', //Done
															'heading' 			=> __('Include Children', 'ultimate_layouts'),			
															'param_name' 		=> 'query_include_children',
															'value' 			=> array(	
																					__('YES', 'ultimate_layouts') 			=> '1',																		
																					__('NO', 'ultimate_layouts') 			=> '0',																																																																											
																				),
															'description' 		=> __('Whether or not to include children for hierarchical taxonomies. Defaults to YES.', 'ultimate_layouts'),	
															'group'				=> $group_query_settings,
														),
														array(
															'type' 				=> 'dropdown', //Done
															'heading' 			=> __('Query Date', 'ultimate_layouts'),			
															'param_name' 		=> 'today_post',
															'value' 			=> array(
																					__('NO', 'ultimate_layouts') 							=> '0',
																					__('Only return today\'s post', 'ultimate_layouts') 	=> '1',
																					__('From today onwards', 'ultimate_layouts') 			=> '2',
																					__('Within 36 hours', 'ultimate_layouts') 				=> '3',
																					__('Within 48 hours', 'ultimate_layouts') 				=> '4',
																					__('Within 60 hours', 'ultimate_layouts') 				=> '5',
																					__('Within 72 hours', 'ultimate_layouts') 				=> '6',
																				),
															'description' 		=> __('If you want to return today\'s post then you select YES.', 'ultimate_layouts'),	
															'group'				=> $group_query_settings,
														),
														array(															
															'type' 				=> 'textfield', //Done
															'heading' 			=> __('DateTime Meta Key', 'ultimate_layouts'),
															'param_name' 		=> 'datetime_meta',		
															'dependency' 		=> array(
																					'element'			 			=> 'today_post',
																					'value' 						=> array('1', '2', '3', '4', '5', '6'),
																				   ),	
															'description' 		=> __('Support Date Format: YYYY-MM-DD.', 'ultimate_layouts'),						   																											
															'group'				=> $group_query_settings,																				
														),
														array(
															'type' 				=> 'dropdown', //Done
															'heading' 			=> __('WooCommerce Query', 'ultimate_layouts'),			
															'param_name' 		=> 'woo_query',
															'value' 			=> array(
																					__('NONE', 'ultimate_layouts') 							=> '0',
																					__('Sale Products', 'ultimate_layouts') 				=> '1',
																					/*__('Best-Selling Products', 'ultimate_layouts') 		=> '2',
																					__('Top Rated Products', 'ultimate_layouts') 			=> '3',*/
																				),	
															'dependency' 		=> array(
																					'element'			 			=> 'today_post',
																					'value' 						=> array('0'),
																				   ),																			
															'group'				=> $group_query_settings,
														),
														array(															
															'type' 				=> 'textfield', //Done
															'heading' 			=> __('Offset', 'ultimate_layouts'),
															'param_name' 		=> 'query_offset',
															'description' 		=> __(	'Number of post to displace or pass over.<br>
																						Warning: Setting the offset parameter overrides/ignores the paged parameter and breaks pagination. 
																						For a workaround see: http://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination.<br>
																						The \'offset\' parameter is ignored when \'posts_per_page\'=>-1 (show all posts) is used.', 'ultimate_layouts'),															
															'group'				=> $group_query_settings,																				
														),
														array(															
															'type' 				=> 'textfield', //Done
															'heading' 			=> __('Post Count', 'ultimate_layouts'),
															'param_name' 		=> 'post_count',
															'description' 		=> __('Set max limit for items in grid or enter -1 to display all. If blank, defaults to: 50', 'ultimate_layouts'),															
															'group'				=> $group_query_settings,																				
														),	
														array(															
															'type' 				=> 'textfield', //Done
															'heading' 			=> __('Items per page', 'ultimate_layouts'),
															'param_name' 		=> 'posts_per_page',
															'description' 		=> __('Number of items to show per page. If blank, defaults to: 10', 'ultimate_layouts'),
															'dependency' 		=> 	array(
																					'element'			 	=> 'layout_style',
																					'value_not_equal_to' 	=> array('1', '2', '11'),
																				),															
															'group'				=> $group_query_settings,																				
														),																																				
													//Custom Query
													
													//Woo Settings
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('Show Price', 'ultimate_layouts'),
															'param_name' 	=> 'woo_show_price',
															'value' 		=> array(	
																				__('No', 'ultimate_layouts') 	=> '0',
																				__('Yes', 'ultimate_layouts') 	=> '1',																																														
																			),
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('Show Rating', 'ultimate_layouts'),
															'param_name' 	=> 'woo_show_rating',
															'value' 		=> array(																
																				__('No', 'ultimate_layouts') 	=> '0',	
																				__('Yes', 'ultimate_layouts') 	=> '1',																																																						
																			),
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('Show Add To Cart', 'ultimate_layouts'),
															'param_name' 	=> 'woo_show_cart',
															'value' 		=> array(															
																				__('No', 'ultimate_layouts') 	=> '0',	
																				__('Yes', 'ultimate_layouts') 	=> '1',																																																							
																			),
															'group'			=> $group_woo_settings,					
														),
														
														//font
														array( // woo price															
															'type' 			=> 'textfield',
															'heading' 		=> __('PRICE Font (Support Google font)', 'ultimate_layouts'),
															'param_name' 	=> 'price_font',
															'description' 	=> __('	Enter font-family name here. Google Fonts are supported. 
																					For example, if you choose "Open Sans" <a href="http://www.google.com/fonts/" target="_blank">Google Font</a> 
																					with font-weight 400,500,600, enter <code>Open Sans:400,500,600</code>', 'ultimate_layouts'),															
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[PRICE] Font Size', 'ultimate_layouts'),
															'param_name' 	=> 'price_font_size',
															'description' 	=> __('<strong>Example:</strong> <code>14px</code>, <code>16px</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[PRICE] Font Letter Spacing', 'ultimate_layouts'),
															'param_name' 	=> 'price_letter_spacing',
															'description' 	=> __('<strong>Example:</strong> <code>1px</code>, <code>0.1em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[PRICE] Font Weight', 'ultimate_layouts'),
															'param_name' 	=> 'price_font_weight',
															'value' 		=> $array_font_weight,
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[PRICE] Font Style', 'ultimate_layouts'),
															'param_name' 	=> 'price_font_style',
															'value' 		=> $array_font_style,
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[PRICE] Text Transform', 'ultimate_layouts'),
															'param_name' 	=> 'price_text_transform',
															'value' 		=> $array_text_transform,
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[PRICE] Text Line Height', 'ultimate_layouts'),
															'param_name' 	=> 'price_line_height',
															'description' 	=> __('<strong>Example:</strong> <code>15px</code>, <code>1.55em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_woo_settings,					
														),
														array( // woo cart															
															'type' 			=> 'textfield',
															'heading' 		=> __('ADD TO CART BUTTON Font (Support Google font)', 'ultimate_layouts'),
															'param_name' 	=> 'atcb_font',
															'description' 	=> __('	Enter font-family name here. Google Fonts are supported. 
																					For example, if you choose "Open Sans" <a href="http://www.google.com/fonts/" target="_blank">Google Font</a> 
																					with font-weight 400,500,600, enter <code>Open Sans:400,500,600</code>', 'ultimate_layouts'),															
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[ADD TO CART BUTTON] Font Size', 'ultimate_layouts'),
															'param_name' 	=> 'atcb_font_size',
															'description' 	=> __('<strong>Example:</strong> <code>14px</code>, <code>16px</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[ADD TO CART BUTTON] Font Letter Spacing', 'ultimate_layouts'),
															'param_name' 	=> 'atcb_letter_spacing',
															'description' 	=> __('<strong>Example:</strong> <code>1px</code>, <code>0.1em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[ADD TO CART BUTTON] Font Weight', 'ultimate_layouts'),
															'param_name' 	=> 'atcb_font_weight',
															'value' 		=> $array_font_weight,
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[ADD TO CART BUTTON] Font Style', 'ultimate_layouts'),
															'param_name' 	=> 'atcb_font_style',
															'value' 		=> $array_font_style,
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[ADD TO CART BUTTON] Text Transform', 'ultimate_layouts'),
															'param_name' 	=> 'atcb_text_transform',
															'value' 		=> $array_text_transform,
															'group'			=> $group_woo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[ADD TO CART BUTTON] Text Line Height', 'ultimate_layouts'),
															'param_name' 	=> 'atcb_line_height',
															'description' 	=> __('<strong>Example:</strong> <code>15px</code>, <code>1.55em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_woo_settings,					
														),
														//font
														
														//color
														array( //price
															'type'			=> 'colorpicker',
															'heading' 		=> __('Price Color', 'ultimate_layouts'),
															'param_name' 	=> 'price_color',
															'group'			=> $group_woo_settings,
															),
														array(
															'type'			=> 'colorpicker',
															'heading' 		=> __('Price Discount Color', 'ultimate_layouts'),
															'param_name' 	=> 'price_d_color',
															'group'			=> $group_woo_settings,
															),
														array( //rating
															'type'			=> 'colorpicker',
															'heading' 		=> __('Star Rating Background Color', 'ultimate_layouts'),
															'param_name' 	=> 'star_bg_color',
															'group'			=> $group_woo_settings,
															),
														array(
															'type'			=> 'colorpicker',
															'heading' 		=> __('Star Rating Color', 'ultimate_layouts'),
															'param_name' 	=> 'star_color',
															'group'			=> $group_woo_settings,
															),
														array( //button cart
															'type'			=> 'colorpicker',
															'heading' 		=> __('Add To Cart Button Color', 'ultimate_layouts'),
															'param_name' 	=> 'btn_cart_color',
															'group'			=> $group_woo_settings,
															),
														array(
															'type'			=> 'colorpicker',
															'heading' 		=> __('Add To Cart Button Hover Color', 'ultimate_layouts'),
															'param_name' 	=> 'btn_cart_hover_color',
															'group'			=> $group_woo_settings,
															),
														array(
															'type'			=> 'colorpicker',
															'heading' 		=> __('Add To Cart Button Background Color', 'ultimate_layouts'),
															'param_name' 	=> 'btn_cart_bg_color',
															'group'			=> $group_woo_settings,
															),
														array(
															'type'			=> 'colorpicker',
															'heading' 		=> __('Add To Cart Button Background Hover Color', 'ultimate_layouts'),
															'param_name' 	=> 'btn_cart_bg_hover_color',
															'group'			=> $group_woo_settings,
															),
														//color
													//Woo Settings
																										
													//Color Settings
														array( // Title color
															'type'			=> 'colorpicker',
															'heading' 		=> __('Title Color', 'ultimate_layouts'),
															'param_name' 	=> 'title_color',
															'group'			=> $group_color_settings,
															'description' 	=> __('If blank, defaults to <code>#222222</code>', 'ultimate_layouts'),	
														),
														array(
															'type'			=> 'colorpicker',
															'heading' 		=> __('Title [Hover] Color', 'ultimate_layouts'),
															'param_name' 	=> 'title_hover_color',
															'group'			=> $group_color_settings,
															'description' 	=> __('If blank, defaults to <code>#666666</code>', 'ultimate_layouts'),	
														),
														
														array( // Metas Color
															'type'			=> 'colorpicker',
															'heading' 		=> __('Metas 1 Color', 'ultimate_layouts'),
															'param_name' 	=> 'metas_o_color',
															'group'			=> $group_color_settings,
															'description' 	=> __('If blank, defaults to <code>#999999</code>', 'ultimate_layouts'),	
														),
														array(
															'type'			=> 'colorpicker',
															'heading' 		=> __('Metas 1 [Hover] Color', 'ultimate_layouts'),
															'param_name' 	=> 'metas_o_hover_color',
															'group'			=> $group_color_settings,
															'description' 	=> __('If blank, defaults to <code>#3c3c3c</code>', 'ultimate_layouts'),	
														),
														
														array( // Metas Color
															'type'			=> 'colorpicker',
															'heading' 		=> __('Metas 2 Color', 'ultimate_layouts'),
															'param_name' 	=> 'metas_t_color',
															'group'			=> $group_color_settings,
															'description' 	=> __('If blank, defaults to <code>#FFFFFF</code>', 'ultimate_layouts'),	
														),
														array(
															'type'			=> 'colorpicker',
															'heading' 		=> __('Metas 2 [Hover] Color', 'ultimate_layouts'),
															'param_name' 	=> 'metas_t_hover_color',
															'group'			=> $group_color_settings,
															'description' 	=> __('If blank, defaults to <code>rgba(255, 255, 255, 0.85)</code>', 'ultimate_layouts'),	
														),
														array(
															'type'			=> 'colorpicker',
															'heading' 		=> __('Metas 2 [Background] Color', 'ultimate_layouts'),
															'param_name' 	=> 'metas_t_background_color',
															'group'			=> $group_color_settings,
															'description' 	=> __('If blank, defaults to <code>#fb4c35</code>', 'ultimate_layouts'),	
														),
														
														array( // Excerpt Color
															'type'			=> 'colorpicker',
															'heading' 		=> __('Text Color', 'ultimate_layouts'),
															'param_name' 	=> 'text_color',
															'group'			=> $group_color_settings,
															'description' 	=> __('If blank, defaults to <code>#999999</code>', 'ultimate_layouts'),	
														),
																												
														array( // Background color
															'type'			=> 'colorpicker',
															'heading' 		=> __('Content Background Color', 'ultimate_layouts'),
															'param_name' 	=> 'background_color',
															'group'			=> $group_color_settings,
															'description' 	=> __(	'Compatible with: List: <code>MIMOSA</code>, <code>MUMS</code>, <code>BELLS OF IRELAND</code> - Grid: <code>ALPINE THISTLE</code>, 
																					<code>AMARYLLIS</code>, <code>AMAZON LILY</code>, <code>BABY’S BREATH</code>, <code>BARBERTON</code> - Carousel Traditional: 
																					<code>BLEEDING HEART</code>, <code>BLOOM</code>, <code>BLUE THROATWORT</code> - Carousel Free: <code>Calla Lily</code>
																					- Timeline: <code>CLIMBING ROSE</code>, <code>MILK FLOWER</code>', 'ultimate_layouts'),																
															'dependency' 	=> array(
																					'element' 	=> 	'layout_style',
																					'value' 	=> 	array('0', '1', '2', '4', '9'),
																				),
														),
																												
														array( // Border Color
															'type'			=> 'colorpicker',
															'heading' 		=> __('Item Border Color', 'ultimate_layouts'),
															'param_name' 	=> 'border_color',
															'group'			=> $group_color_settings,
															'description' 	=> __('Apply with the layout has "Border"', 'ultimate_layouts'),	
														),
														
														array( // Shadow Color
															'type'			=> 'colorpicker',
															'heading' 		=> __('Item Shadow Color', 'ultimate_layouts'),
															'param_name' 	=> 'shadow_color',
															'group'			=> $group_color_settings,
															'description' 	=> __('Apply with the layout has "shadow"', 'ultimate_layouts'),	
														),	
														
														array( // Shadow Color
															'type'			=> 'colorpicker',
															'heading' 		=> __('Filter Overlay Color', 'ultimate_layouts'),
															'param_name' 	=> 'filter_overlay_color',
															'group'			=> $group_color_settings,
															),	
														
														array( // Main color 1
															'type'			=> 'colorpicker',
															'heading' 		=> __('Main Color 1', 'ultimate_layouts'),
															'param_name' 	=> 'main_color_1',
															'group'			=> $group_color_settings,
															'description' 	=> __('If blank, defaults to <code>#fB4C35</code>', 'ultimate_layouts'),	
														),
														array( // Main color 2
															'type'			=> 'colorpicker',
															'heading' 		=> __('Main Color 2', 'ultimate_layouts'),
															'param_name' 	=> 'main_color_2',
															'group'			=> $group_color_settings,
															'description' 	=> __('If blank, defaults to <code>#987666</code>', 'ultimate_layouts'),	
														),	
														
														array( // tab color
															'type'			=> 'colorpicker',
															'heading' 		=> __('[Smart Tab] Color', 'ultimate_layouts'),
															'param_name' 	=> 'stab_color',
															'group'			=> $group_color_settings,
															'description' 	=> __('If blank, defaults to <code>#FFFFFF</code>', 'ultimate_layouts'),	
														),
														array( // tab bg color
															'type'			=> 'colorpicker',
															'heading' 		=> __('[Smart Tab] Background Color', 'ultimate_layouts'),
															'param_name' 	=> 'stab_bg_color',
															'group'			=> $group_color_settings,
															'description' 	=> __('If blank, defaults to <code>#FB4C35</code>', 'ultimate_layouts'),	
														),													
													//Color Settings
													
													//Typography Settings
														array( // Title font															
															'type' 			=> 'textfield',
															'heading' 		=> __('Title Font (Support Google font)', 'ultimate_layouts'),
															'param_name' 	=> 'title_font',
															'description' 	=> __('	Enter font-family name here. Google Fonts are supported. 
																					For example, if you choose "Open Sans" <a href="http://www.google.com/fonts/" target="_blank">Google Font</a> 
																					with font-weight 400,500,600, enter <code>Open Sans:400,500,600</code>', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Title] Font Size', 'ultimate_layouts'),
															'param_name' 	=> 'title_font_size',
															'description' 	=> __('<strong>Example:</strong> <code>14px</code>, <code>16px</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Title] Font Letter Spacing', 'ultimate_layouts'),
															'param_name' 	=> 'title_letter_spacing',
															'description' 	=> __('<strong>Example:</strong> <code>1px</code>, <code>0.1em</code> ... If blank, defaults to <code>0.075em</code>', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Title] Font Weight', 'ultimate_layouts'),
															'param_name' 	=> 'title_font_weight',
															'value' 		=> $array_font_weight,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Title] Font Style', 'ultimate_layouts'),
															'param_name' 	=> 'title_font_style',
															'value' 		=> $array_font_style,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Title] Text Transform', 'ultimate_layouts'),
															'param_name' 	=> 'title_text_transform',
															'value' 		=> $array_text_transform,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Title] Line Height', 'ultimate_layouts'),
															'param_name' 	=> 'title_line_height',
															'description' 	=> __('<strong>Example:</strong> <code>15px</code>, <code>1.55em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														
														array( // Metas font															
															'type' 			=> 'textfield',
															'heading' 		=> __('Metas Font (Support Google font)', 'ultimate_layouts'),
															'param_name' 	=> 'metas_font',
															'description' 	=> __('	Enter font-family name here. Google Fonts are supported. 
																					For example, if you choose "Open Sans" <a href="http://www.google.com/fonts/" target="_blank">Google Font</a> 
																					with font-weight 400,500,600, enter <code>Open Sans:400,500,600</code>', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Metas] Font Size', 'ultimate_layouts'),
															'param_name' 	=> 'metas_font_size',
															'description' 	=> __('<strong>Example:</strong> <code>14px</code>, <code>16px</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Metas] Font Letter Spacing', 'ultimate_layouts'),
															'param_name' 	=> 'metas_letter_spacing',
															'description' 	=> __('<strong>Example:</strong> <code>1px</code>, <code>0.1em</code> ... If blank, defaults to <code>0.1em</code>', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Metas] Font Weight', 'ultimate_layouts'),
															'param_name' 	=> 'metas_font_weight',
															'value' 		=> $array_font_weight,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Metas] Font Style', 'ultimate_layouts'),
															'param_name' 	=> 'metas_font_style',
															'value' 		=> $array_font_style,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Metas] Text Transform', 'ultimate_layouts'),
															'param_name' 	=> 'metas_text_transform',
															'value' 		=> $array_text_transform,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Metas] Line Height', 'ultimate_layouts'),
															'param_name' 	=> 'metas_line_height',
															'description' 	=> __('<strong>Example:</strong> <code>15px</code>, <code>1.55em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														
														array( // Excerpt font															
															'type' 			=> 'textfield',
															'heading' 		=> __('Main Font (Support Google font)', 'ultimate_layouts'),
															'param_name' 	=> 'excerpt_font',
															'description' 	=> __('	Enter font-family name here. Google Fonts are supported. 
																					For example, if you choose "Open Sans" <a href="http://www.google.com/fonts/" target="_blank">Google Font</a> 
																					with font-weight 400,500,600, enter <code>Open Sans:400,500,600</code>', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Main] Font Size', 'ultimate_layouts'),
															'param_name' 	=> 'excerpt_font_size',
															'description' 	=> __('<strong>Example:</strong> <code>14px</code>, <code>16px</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Main] Font Letter Spacing', 'ultimate_layouts'),
															'param_name' 	=> 'excerpt_letter_spacing',
															'description' 	=> __('<strong>Example:</strong> <code>1px</code>, <code>0.1em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Main] Font Weight', 'ultimate_layouts'),
															'param_name' 	=> 'excerpt_font_weight',
															'value' 		=> $array_font_weight,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Main] Font Style', 'ultimate_layouts'),
															'param_name' 	=> 'excerpt_font_style',
															'value' 		=> $array_font_style,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Main] Text Transform', 'ultimate_layouts'),
															'param_name' 	=> 'excerpt_text_transform',
															'value' 		=> $array_text_transform,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Main] Text Line Height', 'ultimate_layouts'),
															'param_name' 	=> 'excerpt_line_height',
															'description' 	=> __('<strong>Example:</strong> <code>15px</code>, <code>1.55em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														
														array( // Filter font															
															'type' 			=> 'textfield',
															'heading' 		=> __('Filter Font (Support Google font)', 'ultimate_layouts'),
															'param_name' 	=> 'filter_font',
															'description' 	=> __('	Enter font-family name here. Google Fonts are supported. 
																					For example, if you choose "Open Sans" <a href="http://www.google.com/fonts/" target="_blank">Google Font</a> 
																					with font-weight 400,500,600, enter <code>Open Sans:400,500,600</code>', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Filter] Font Size', 'ultimate_layouts'),
															'param_name' 	=> 'filter_font_size',
															'description' 	=> __('<strong>Example:</strong> <code>14px</code>, <code>16px</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Filter] Letter Spacing', 'ultimate_layouts'),
															'param_name' 	=> 'filter_letter_spacing',
															'description' 	=> __('<strong>Example:</strong> <code>1px</code>, <code>0.1em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Filter] Font Weight', 'ultimate_layouts'),
															'param_name' 	=> 'filter_font_weight',
															'value' 		=> $array_font_weight,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Filter] Font Style', 'ultimate_layouts'),
															'param_name' 	=> 'filter_font_style',
															'value' 		=> $array_font_style,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Filter] Text Transform', 'ultimate_layouts'),
															'param_name' 	=> 'filter_text_transform',
															'value' 		=> $array_text_transform,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Filter] Text Line Height', 'ultimate_layouts'),
															'param_name' 	=> 'filter_line_height',
															'description' 	=> __('<strong>Example:</strong> <code>15px</code>, <code>1.55em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														
														array( // smart tab title font															
															'type' 			=> 'textfield',
															'heading' 		=> __('[Tab Title] Font (Support Google font)', 'ultimate_layouts'),
															'param_name' 	=> 'tab_font',
															'description' 	=> __('	Enter font-family name here. Google Fonts are supported. 
																					For example, if you choose "Open Sans" <a href="http://www.google.com/fonts/" target="_blank">Google Font</a> 
																					with font-weight 400,500,600, enter <code>Open Sans:400,500,600</code>', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Tab Title] Font Size', 'ultimate_layouts'),
															'param_name' 	=> 'tab_font_size',
															'description' 	=> __('<strong>Example:</strong> <code>14px</code>, <code>16px</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Tab Title] Letter Spacing', 'ultimate_layouts'),
															'param_name' 	=> 'tab_letter_spacing',
															'description' 	=> __('<strong>Example:</strong> <code>1px</code>, <code>0.1em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Tab Title] Font Weight', 'ultimate_layouts'),
															'param_name' 	=> 'tab_font_weight',
															'value' 		=> $array_font_weight,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Tab Title] Font Style', 'ultimate_layouts'),
															'param_name' 	=> 'tab_font_style',
															'value' 		=> $array_font_style,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Tab Title] Text Transform', 'ultimate_layouts'),
															'param_name' 	=> 'tab_text_transform',
															'value' 		=> $array_text_transform,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Tab Title] Text Line Height', 'ultimate_layouts'),
															'param_name' 	=> 'tab_line_height',
															'description' 	=> __('<strong>Example:</strong> <code>15px</code>, <code>1.55em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														
														array( // pagination															
															'type' 			=> 'textfield',
															'heading' 		=> __('[Pagination] Font (Support Google font)', 'ultimate_layouts'),
															'param_name' 	=> 'pagination_font',
															'description' 	=> __('	Enter font-family name here. Google Fonts are supported. 
																					For example, if you choose "Open Sans" <a href="http://www.google.com/fonts/" target="_blank">Google Font</a> 
																					with font-weight 400,500,600, enter <code>Open Sans:400,500,600</code>', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Pagination] Font Size', 'ultimate_layouts'),
															'param_name' 	=> 'pagination_font_size',
															'description' 	=> __('<strong>Example:</strong> <code>14px</code>, <code>16px</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Pagination] Letter Spacing', 'ultimate_layouts'),
															'param_name' 	=> 'pagination_letter_spacing',
															'description' 	=> __('<strong>Example:</strong> <code>1px</code>, <code>0.1em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Pagination] Font Weight', 'ultimate_layouts'),
															'param_name' 	=> 'pagination_font_weight',
															'value' 		=> $array_font_weight,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Pagination] Font Style', 'ultimate_layouts'),
															'param_name' 	=> 'pagination_font_style',
															'value' 		=> $array_font_style,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'dropdown',
															'heading' 		=> __('[Pagination] Text Transform', 'ultimate_layouts'),
															'param_name' 	=> 'pagination_text_transform',
															'value' 		=> $array_text_transform,
															'group'			=> $group_typo_settings,					
														),
														array(
															'type' 			=> 'textfield',
															'heading' 		=> __('[Pagination] Text Line Height', 'ultimate_layouts'),
															'param_name' 	=> 'pagination_line_height',
															'description' 	=> __('<strong>Example:</strong> <code>15px</code>, <code>1.55em</code> ...', 'ultimate_layouts'),															
															'group'			=> $group_typo_settings,					
														),
														
													//Typography Settings
													
													array(
														'type' 			=> 'css_editor',
														'heading' 		=> __( 'Css', 'ultimate_layouts'),
														'param_name' 	=> 'css',
														'group' 		=> __( 'Design options', 'ultimate_layouts'),
													),
						),
					)
				);
				
				//Filter Container
				vc_map(
					array(
						'name' 				=> 	__('Ultimate Layouts Filter Container', 'ultimate_layouts'),
						'base' 				=> 	'ult_layout_filter',
						'is_container' 		=> 	false,					
						'js_view' 			=> 'VcColumnView',
						'as_child' 			=> 	array('only' => 'ult_layout'),
						'as_parent' 		=> 	array('only' => 'ult_layout_filter_items, ult_layout_order_by, ult_layout_sort_order'),
						'category' 			=>	$group_category,
						'icon'				=> 	UL_BETE_PLUGIN_URL.'assets/back-end/images/ul-layout-filter.png',
						'params'			=> 	array(
														array(
															'type' 				=> 'dropdown',
															'heading' 			=> __('Display Type', 'ultimate_layouts'),			
															'param_name' 		=> 'display_type',  //Done
															'value' 			=> array(	
																					__('Classic', 'ultimate_layouts') 				=> '0',																		
																					__('Dropdown', 'ultimate_layouts') 				=> '1',
																					__('Smart Tab', 'ultimate_layouts') 			=> '2',																																																																							
																				),
															),
														array(
															'type' 				=> 'textfield',
															'heading' 			=> __('Tab Title', 'ultimate_layouts'), 
															'param_name' 		=> 'title',	 //Done												
															'value'				=> '',
															'description' 		=> __('Enter section title (Note: you can leave it empty).', 'ultimate_layouts'),
															'dependency' 		=> array(
																						'element' 	=> 	'display_type',
																						'value' 	=> 	array('2'),
																					),	 
														),
														array(
															'type' 				=> 'textfield',
															'heading' 			=> __('Tab Custom Link', 'ultimate_layouts'), 
															'param_name' 		=> 'title_link',	 //Done												
															'value'				=> '',
															'description' 		=> __('Enter title link (Note: you can leave it empty).', 'ultimate_layouts'),
															'dependency' 		=> array(
																						'element' 	=> 	'display_type',
																						'value' 	=> 	array('2'),
																					),	 
														),
														array(
															'type' 				=> 'dropdown',
															'heading' 			=> __('Display Child Categories, Taxonomies, Tags...', 'ultimate_layouts'),			
															'param_name' 		=> 'query_child_tax',  //Done
															'value' 			=> array(	
																					__('NO', 'ultimate_layouts') 				=> '0',																		
																					__('YES', 'ultimate_layouts') 				=> '1',																																																																						
																				),
															'dependency' 		=> array(
																						'element' 	=> 	'display_type',
																						'value' 	=> 	array('1'),
																					),					
														),	
															array(
																'type' 				=> 'textfield',
																'heading' 			=> __('Group Names For Secondary Categories', 'ultimate_layouts'), 
																'param_name' 		=> 'secondary_cat',	 //Done												
																'value'				=> '',
																'description' 		=> __('Enter name ( optional ).', 'ultimate_layouts'),
																'dependency' 		=> array(
																							'element' 	=> 	'query_child_tax',
																							'value' 	=> 	array('1'),
																						),	 
															),		
														array(
															'type' 				=> 'dropdown',
															'heading' 			=> __('Query Type', 'ultimate_layouts'),			
															'param_name' 		=> 'query_type',  //Done
															'value' 			=> array(	
																					__('AND', 'ultimate_layouts') 				=> '0',																		
																					__('OR', 'ultimate_layouts') 				=> '1',																																																																						
																				),
															'description' 		=> __('This option does not work with style: CONTENT BLOCKS', 'ultimate_layouts'),																
														),
														array(
															'type' 				=> 'dropdown',
															'heading' 			=> __('[Taxonomy Query] Relation', 'ultimate_layouts'),			
															'param_name' 		=> 'query_relation',  //Done
															'value' 			=> array(	
																					__('OR', 'ultimate_layouts') 				=> '0',																		
																					__('AND', 'ultimate_layouts') 				=> '1',																																																																						
																				),
															'description' 		=> __(	'Possible values are \'AND\' or \'OR\' and is the equivalent of running a JOIN for each taxonomy.<br>
																						This option does not work with style: CONTENT BLOCKS', 'ultimate_layouts'),																
														),														
														array(
															'type' 				=> 'dropdown',
															'heading' 			=> __('[Taxonomy Query] Operator', 'ultimate_layouts'),			
															'param_name' 		=> 'query_operator',  //Done
															'value' 			=> array(	
																					__('IN', 'ultimate_layouts') 				=> '0',																		
																					__('AND', 'ultimate_layouts') 				=> '1',																																																																						
																				),
															'description' 		=> __('Operator to test. This option does not work with style: CONTENT BLOCKS', 'ultimate_layouts'),																
														),		
														array(
															'type' 				=> 'dropdown', //Done
															'heading' 			=> __('Show number of posts', 'ultimate_layouts'),			
															'param_name' 		=> 'show_number',
															'value' 			=> array(	
																					__('Yes', 'ultimate_layouts') 				=> '1',																		
																					__('No', 'ultimate_layouts') 				=> '0',																																																																						
																				),
														),
														array(
															'type' 				=> 'dropdown', //Done
															'heading' 			=> __('Hash Filters', 'ultimate_layouts'),			
															'param_name' 		=> 'has_filters',
															'description' 		=> __( 'Hash Tag Filter. This option does not work with: 
																						Display Type [(Dropdown) > Display Child Categories, Taxonomies, Tags...]', 'ultimate_layouts'),
															'value' 			=> array(	
																					__('No', 'ultimate_layouts') 				=> '0',																		
																					__('Yes', 'ultimate_layouts') 				=> '1',																																																																						
																				),
														),	
														array(
															'type' 				=> 'textfield',
															'heading' 			=> __('Extra Class Name', 'ultimate_layouts'), 
															'param_name' 		=> 'extra_class', //Done														
															'value'				=> '',	 
														),								
												)
					)
				);
				
				//Filter Items
				vc_map(
					array(
						'name' 				=> 	__('Ultimate Layouts Filter Item', 'ultimate_layouts'),
						'base' 				=> 	'ult_layout_filter_items',						
						'as_child' 			=> 	array('only' => 'ult_layout_filter'),
						'category' 			=>	$group_category,
						'icon'				=> 	UL_BETE_PLUGIN_URL.'assets/back-end/images/ul-layout-filter-item.png',
						'params'			=> 	array(
														array(
															'type' 				=> 'autocomplete', //Done
															'heading' 			=> __('Filter Items', 'ultimate_layouts'),		
															'param_name' 		=> 'filter_items',
															'description' 		=> __('Enter categories, tags, taxonomies... be shown in the filters list.', 'ultimate_layouts'), 
															'settings' 			=> array(
																						'multiple' 					=> true,																					
																						'min_length' 				=> 1,
																						'groups' 					=> true,
																						'unique_values' 			=> true,
																						'display_inline' 			=> true,
																						'delay' 					=> 500,
																						'auto_focus' 				=> true,
																				   ),													
														),
														array(
															'type' 				=> 'dropdown',  //Done
															'heading' 			=> __('Enabled "Show All" Button', 'ultimate_layouts'),			
															'param_name' 		=> 'show_all',
															'value' 			=> array(	
																					__('Yes', 'ultimate_layouts') 				=> '1',																		
																					__('No', 'ultimate_layouts') 				=> '0',																																																																						
																				),
															),
														array(
															'type' 				=> 'textfield',  //Done
															'heading' 			=> __('"Show All" Button - Translate Text', 'ultimate_layouts'), 
															'param_name' 		=> 'show_all_text',														
															'value'				=> '',
															'dependency' 		=> array(
																						'element' 	=> 	'show_all',
																						'value' 	=> 	array('1'),
																					),																										 
														),
														array(
															'type' 				=> 'textfield',  //Done
															'heading' 			=> __('"Dropdown Filter" Text', 'ultimate_layouts'), 
															'param_name' 		=> 'dd_title_text',														
															'value'				=> '',
															'description' 		=> __('Enter Dropdown Filter title (Note: work with Filter Display Type = Dropdown). if blank, defaults to: Filter', 'ultimate_layouts'), 
														),																
														array(
															'type' 				=> 'textfield',
															'heading' 			=> __('Extra Class Name', 'ultimate_layouts'), 
															'param_name' 		=> 'extra_class', //Done														
															'value'				=> '',	 
														),									
												)
					)
				);
				
				//Order By
				vc_map(
					array(
						'name' 				=> 	__('Order - Sort retrieved posts by parameter', 'ultimate_layouts'),
						'base' 				=> 	'ult_layout_order_by',						
						'as_child' 			=> 	array('only' => 'ult_layout_filter'),
						'category' 			=>	$group_category,
						'icon'				=> 	UL_BETE_PLUGIN_URL.'assets/back-end/images/ul-layout-order.png',
						'params'			=> 	array(
														array(
															'type' 				=> 'textfield',  //Done
															'heading' 			=> __('"Sort By None" - Translate Text', 'ultimate_layouts'), 
															'param_name' 		=> 'sbn_text',														
															'value'				=> '',
															'description' 		=> __('This option does not work with style: CONTENT BLOCKS', 'ultimate_layouts'),
														),														
														array(
															'type' 				=> 'dropdown',  //Done
															'heading' 			=> __('Sort By Date', 'ultimate_layouts'),			
															'param_name' 		=> 'sortb_date',
															'value' 			=> array(	
																					__('Enabled', 'ultimate_layouts') 			=> '1',																		
																					__('Disabled', 'ultimate_layouts') 			=> '0',																																																																						
																				),
															),
														array(
															'type' 				=> 'dropdown',  //Done
															'heading' 			=> __('Sort By ID', 'ultimate_layouts'),			
															'param_name' 		=> 'sortb_id',
															'value' 			=> array(	
																					__('Enabled', 'ultimate_layouts') 			=> '1',																		
																					__('Disabled', 'ultimate_layouts') 			=> '0',																																																																						
																				),
															),
														array(
															'type' 				=> 'dropdown',  //Done
															'heading' 			=> __('Sort By Title', 'ultimate_layouts'),			
															'param_name' 		=> 'sortb_title',
															'value' 			=> array(	
																					__('Enabled', 'ultimate_layouts') 			=> '1',																		
																					__('Disabled', 'ultimate_layouts') 			=> '0',																																																																						
																				),
															),
														array(
															'type' 				=> 'dropdown',  //Done
															'heading' 			=> __('Sort By Comment', 'ultimate_layouts'),			
															'param_name' 		=> 'sortb_comment',
															'value' 			=> array(	
																					__('Enabled', 'ultimate_layouts') 			=> '1',																		
																					__('Disabled', 'ultimate_layouts') 			=> '0',																																																																						
																				),
															),
														array(
															'type' 				=> 'dropdown',  //Done
															'heading' 			=> __('Sort By Author', 'ultimate_layouts'),			
															'param_name' 		=> 'sortb_author',
															'value' 			=> array(	
																					__('Enabled', 'ultimate_layouts') 			=> '1',																		
																					__('Disabled', 'ultimate_layouts') 			=> '0',																																																																						
																				),
															),
														array(
															'type' 				=> 'dropdown',  //Done
															'heading' 			=> __('Sort By Price', 'ultimate_layouts'),			
															'param_name' 		=> 'sortb_price',
															'value' 			=> array(	
																					__('Disabled', 'ultimate_layouts') 			=> '0',																		
																					__('Enabled', 'ultimate_layouts') 			=> '1',																																																																						
																				),
															'description' 		=> __('Work with woocommerce layouts', 'ultimate_layouts'),																
														),
														array(
															'type' 				=> 'dropdown',  //Done
															'heading' 			=> __('Sort By Sales', 'ultimate_layouts'),			
															'param_name' 		=> 'sortb_sales',
															'value' 			=> array(	
																					__('Disabled', 'ultimate_layouts') 			=> '0',																		
																					__('Enabled', 'ultimate_layouts') 			=> '1',																																																																						
																				),
															'description' 		=> __('Work with woocommerce layouts', 'ultimate_layouts'),																
														),
														array(
															'type' 				=> 'dropdown',  //Done
															'heading' 			=> __('Sort By Rating', 'ultimate_layouts'),			
															'param_name' 		=> 'sortb_rating',
															'value' 			=> array(	
																					__('Disabled', 'ultimate_layouts') 			=> '0',																		
																					__('Enabled', 'ultimate_layouts') 			=> '1',																																																																						
																				),
															'description' 		=> __('Work with woocommerce layouts', 'ultimate_layouts'),																
														),
														array(
															'type' 				=> 'textfield',
															'heading' 			=> __('Extra Class Name', 'ultimate_layouts'), 
															'param_name' 		=> 'extra_class', //Done														
															'value'				=> '',																 
														),									
												)
					)
				);
				
				//Sort Order
				vc_map(
					array(
						'name' 				=> 	__('Sort Order - Designates the ascending or descending order of the "orderby" parameter', 'ultimate_layouts'),
						'base' 				=> 	'ult_layout_sort_order',						
						'as_child' 			=> 	array('only' => 'ult_layout_filter'),
						'category' 			=>	$group_category,
						'icon'				=> 	UL_BETE_PLUGIN_URL.'assets/back-end/images/ul-layout-sort.png',
						'params'			=> 	array(
														array(
															'type' 				=> 'textfield',
															'heading' 			=> __('Extra Class Name', 'ultimate_layouts'), 
															'param_name' 		=> 'extra_class', //Done														
															'value'				=> '',	
															'description' 		=> __('This option does not work with style: CONTENT BLOCKS', 'ultimate_layouts'), 
														),									
												)
					)
				);
				/*end VC Map*/
			}
		}
		/*end bt_ultimateLayouts_vc*/
		
		public function init(){
			$this->bt_ultimateLayouts_vc();
			
			add_filter('vc_autocomplete_ult_layout_i_taxonomies_callback', 'vc_autocomplete_taxonomies_field_search', 10, 1);
			add_filter('vc_autocomplete_ult_layout_i_taxonomies_render', 'vc_autocomplete_taxonomies_field_render', 10, 1);
			
			add_filter('vc_autocomplete_ult_layout_e_taxonomies_callback', 'vc_autocomplete_taxonomies_field_search', 11, 1);
			add_filter('vc_autocomplete_ult_layout_e_taxonomies_render', 'vc_autocomplete_taxonomies_field_render', 11, 1);
			
			add_filter('vc_autocomplete_ult_layout_filter_items_filter_items_callback', 'vc_autocomplete_taxonomies_field_search', 11, 1);
			add_filter('vc_autocomplete_ult_layout_filter_items_filter_items_render', 'vc_autocomplete_taxonomies_field_render', 11, 1);
			
			add_filter('vc_autocomplete_ult_layout_i_ids_callback', 'vc_include_field_search', 10, 1);
			add_filter('vc_autocomplete_ult_layout_i_ids_render', 'vc_include_field_render', 10, 1);
			
			add_filter('vc_autocomplete_ult_layout_e_ids_callback', 'vc_include_field_search', 10, 1);
			add_filter('vc_autocomplete_ult_layout_e_ids_render', 'vc_include_field_render', 10, 1);
						
			if(is_admin()){
				wp_enqueue_style('ul_bete_admin_css', 				UL_BETE_PLUGIN_URL.'assets/back-end/core.css', array(), UL_BETE_VER);
				wp_enqueue_script('ul_bete_jscolor_js', 			UL_BETE_PLUGIN_URL.'assets/back-end/jscolor.min.js', array(), UL_BETE_VER, true);
				wp_enqueue_script('ul_bete_admin_js', 				UL_BETE_PLUGIN_URL.'assets/back-end/core.js', array(), UL_BETE_VER, true);
			}
		}
		
		public function __construct() {				
			add_action('init', array($this, 'init'), 9998, 1);
		}
	}
	
	global $bt_ultimateLayouts_builder;
	if(!$bt_ultimateLayouts_builder){
		$bt_ultimateLayouts_builder = new bt_ultimateLayouts_builder();
	}
	
	if(!function_exists('bt_ultimateLayouts_vc_extends')){
		function bt_ultimateLayouts_vc_extends(){
			if(class_exists('WPBakeryShortCode') && class_exists('WPBakeryShortCodesContainer') && class_exists('WPBakeryShortCode')){				
				class WPBakeryShortCode_ult_layout extends WPBakeryShortCodesContainer{} //container
				class WPBakeryShortCode_ult_layout_filter extends WPBakeryShortCodesContainer{} //container
				class WPBakeryShortCode_ult_layout_filter_items extends WPBakeryShortCode{} //only shortcode
				class WPBakeryShortCode_ult_layout_order_by extends WPBakeryShortCode{} //only shortcode
				class WPBakeryShortCode_ult_layout_sort_order extends WPBakeryShortCode{} //only shortcode
			}
		}	
		add_action('init', 'bt_ultimateLayouts_vc_extends', 9999, 1);
	}	
}