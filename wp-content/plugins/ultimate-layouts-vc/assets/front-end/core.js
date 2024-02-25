/*
Plugin Name: Ultimate Layouts - High Perfomance Content Blocks
Plugin URI: http://beeteam368.com/ultimate-layouts/
Description: Json, Ajax, Carousel, Masonry, Grid, List, Timeline, Content Blocks, Creative ... Best Choice For Building Your Website.
Author: BeeTeam368
Author URI: http://beeteam368.com/ultimate-layouts/
Version: 2.0.2
License: Commercial
*/
;(function($, $w, $d, _w, _d){
	
	'use strict';
	
	function isNumber(n){
		return !isNaN(parseFloat(n)) && isFinite(n);
	};
	
	function ul_replaceAll(str, find, replace){
		return str.replace(new RegExp(find, 'g'), replace);
	};
	
	function randomidgen(){
		var rnd_id = (new Date().getTime())+(Math.floor(Math.random() * 10000) + 368);			
		return rnd_id;
	};
	
	function removeA(arr) {
		var what, a = arguments, L = a.length, ax;
		while(L > 1 && arr.length){
			what = a[--L];
			while((ax= arr.indexOf(what)) !== -1) {
				arr.splice(ax, 1);
			};
		};
		return arr;
	};
	
	function addHashFilters(values){
		var val_split = values.split(',');
		if(val_split.length > 1){
			values = removeA(val_split, 'all');
			values = removeA(val_split, 'all-1');
			values = removeA(val_split, 'all-2');
			values = removeA(val_split, 'all-3');
			values = removeA(val_split, 'all-5');
			values = removeA(val_split, 'all-6');
			values = removeA(val_split, 'all-7');
			values = removeA(val_split, 'all-8');
			values = removeA(val_split, 'all-9');
			values = removeA(val_split, 'all-10');
			
			values = values.toString();			
		};
		
		if(values=='' || values=='all'){
			values = 'df';
		};
		
		if(history.pushState){
			_w.history.pushState(null, null, '#hash_filters='+values);
		}else{
			_w.location.hash = '#hash_filters='+values;
		};
	};
	
	function getParameterByName(name, url){
		if(!url){
			url = window.location.href;
		};
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
		if(!results){
			return null;
		};
		if (!results[2]){
			return '';
		};
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	};
	
	//Lightbox function
	$.ultimateLayoutsLightBox = function(options){
		
		var _element_live 		= options.element_live,
			_element_control 	= options.element_control,
			_element_wrap 		= options.element_wrap,
			_alias_name 		= options.alias_name,
			_element_get_pic	= options.element_get_pic,
			_element_pic		= options.element_pic,
			_element_icon		= options.element_icon;
					
		$(_element_wrap).each(function(index, element){
			var wrap_id 		= _alias_name+'_ul-lightbox-ctl-'+index,
				$wrap_element 	= $('#'+wrap_id),
				html 			= '';
				
			if($wrap_element.length==0){	
				$(this).attr('data-control-id', wrap_id);				
				html+='<div class="ultimate-layouts-lightbox ultimate-layouts-container" id="'+wrap_id+'">';	
				
				html+=		'<div class="ultimate-layouts-loader">';
				html+=			'<div class="la-line-spin-clockwise-fade-rotating la-dark la-1x">';
				html+=				'<div></div>';
				html+=				'<div></div>';
				html+=				'<div></div>';
				html+=				'<div></div>';
				html+=				'<div></div>';
				html+=				'<div></div>';
				html+=				'<div></div>';
				html+=				'<div></div>';
				html+=			'</div>';
				html+=		'</div>';
				
				html+=		'<div class="ultimate-layouts-close-lightbox"><svg viewbox="0 0 40 40"><path class="close-btn" d="M 10,10 L 30,30 M 30,10 L 10,30"/></svg></div>';	
				
				html+=		'<div class="ultimate-layouts-lightbox-content"><div class="ultimate-layouts-lightbox-vertical">';
				html+=			'<div class="ultimate-layouts-lightbox-source"></div>';
				html+=			'<div class="ultimate-layouts-lightbox-caption"></div>';
				html+=		'</div></div>';
							
				html+=		'<div class="ultimate-layouts-lightbox-slider">';
				
				html+=			'<div class="ultimate-layouts-prev-slider ultimate-layouts-btn-slider"><i class="fa fa-angle-left" aria-hidden="true"></i></div>';
				html+=			'<div class="ultimate-layouts-next-slider ultimate-layouts-btn-slider"><i class="fa fa-angle-right" aria-hidden="true"></i></div>';
				
				html+=			'<div class="ultimate-layouts-count-slider"></div>';
				
				html+=			'<div class="ultimate-layouts-lightbox-data"></div>';
				
				html+=			'<div class="ull-slider-content"><div class="ull-slider-wrapper"></div></div>';
				
				html+=		'</div>';	
				
				html+='</div>';
				$('body').append(html);
			};							
		});	
		
		$(_element_live).off('.ultimateLightBoxOpen').on('click.ultimateLightBoxOpen', _element_control, function(){
			var	$this 				= $(this),
				$_wrap 				= $this.parents(_element_wrap);
				
			var _fill_elm_control	= '.ultimate-layouts-item:not(.slick-cloned) '+_element_control;
			if($_wrap.find('.ultimate-layouts-carousel-f-1').length > 0){
				_fill_elm_control	= '.ul-column-items:not(.slick-cloned) .ultimate-layouts-item '+_element_control;
			};	
				
			var	$_all_items 		= $(_fill_elm_control+'[data-lightbox-id]', $_wrap), //available id
				$_all_items_not_id 	= $(_fill_elm_control+':not([data-lightbox-id])', $_wrap), //not available id
				$_lightbox_id		= $('#'+$_wrap.attr('data-control-id')),
				$_lightbox_slider	= $('.ull-slider-wrapper', $_lightbox_id),
				$_lightbox_prev		= $('.ultimate-layouts-prev-slider', $_lightbox_id),
				$_lightbox_next		= $('.ultimate-layouts-next-slider', $_lightbox_id),
				$_lightbox_count	= $('.ultimate-layouts-count-slider', $_lightbox_id),
				$_lightbox_close	= $('.ultimate-layouts-close-lightbox', $_lightbox_id),
				$_lightbox_content 	= $('.ultimate-layouts-lightbox-content', $_lightbox_id),
				$_lightbox_source 	= $('.ultimate-layouts-lightbox-source', $_lightbox_id),
				$_lightbox_caption 	= $('.ultimate-layouts-lightbox-caption', $_lightbox_id),
				$_lightbox_loading 	= $('.ultimate-layouts-loader', $_lightbox_id),
				totalItems 			= $_all_items.length;
			
			$_lightbox_id.addClass('active-elm');	
			
			if($_lightbox_slider.hasClass('slick-slider') && $_all_items.length==0){
				$_lightbox_slider.slick('removeSlide', null, null, true); //remove all slider
			};		
			
			$_all_items_not_id.each(function(index, element){                
				$(this).attr('data-lightbox-id', (totalItems+index+1));
				
				if($_wrap.hasClass('ultimate-layouts-global-carousel-settings')){
					var server_index = $(this).parents('.ultimate-layouts-item').attr('data-server-index');
					$('.slick-cloned.ultimate-layouts-item[data-server-index="'+(server_index)+'"] '+_element_control).attr('data-lightbox-id', (totalItems+index+1));
					$('.ul-column-items.slick-cloned .ultimate-layouts-item[data-server-index="'+(server_index)+'"] '+_element_control).attr('data-lightbox-id', (totalItems+index+1));
				};
				
				var itemHTML = ul_replaceAll($(this).parents(_element_get_pic).find(_element_pic).clone().wrap('<div/>').parent().html(), 'ul-lazysizes-loading', 'ul-lazysizes-loaded');
				itemHTML+=$(this).parents(_element_get_pic).find(_element_icon).clone().wrap('<div/>').parent().html();
				
				if($_lightbox_slider.hasClass('slick-slider')){
					$_lightbox_slider.slick('slickAdd', '<div class="ull-slider-item"><div class="ull-item-control">'+itemHTML+'</div></div>');					
				}else{
					$_lightbox_slider.append('<div class="ull-slider-item"><div class="ull-item-control">'+itemHTML+'</div></div>');
				};
			});
			$('.ultimate-layouts-icon-lightbox, .ultimate-layouts-icon-link', $_lightbox_slider).remove();	
			
			$_all_items 		= $(_fill_elm_control+'[data-lightbox-id]', $_wrap);//reset Element Objectjn
			totalItems 			= $_all_items.length;//total items available id	
			
			var	item_id 			= parseFloat($this.attr('data-lightbox-id')),
				item_data_source 	= $this.attr('data-source'),
				item_data_type		= $this.attr('data-type'),
				item_data_caption	= $this.attr('data-caption');
				
			function setDataSource(){
				$_lightbox_source.html('');
				$_lightbox_caption.html('');
				$_lightbox_content.removeClass('active-elm').attr('data-active-id', item_id);
				$_lightbox_loading.removeClass('hidden-elm');
				
				$_lightbox_caption.html(item_data_caption);
				switch(item_data_type){						
					case 'image':
						$_lightbox_source.html('<img src="'+item_data_source+'">');							
						$('<img src="'+item_data_source+'">').load(function(){								
							setTimeout(function(){
								if(item_id!=parseFloat($_lightbox_content.attr('data-active-id'))){
									return;
								};
								$_lightbox_content.addClass('active-elm');
								$_lightbox_loading.addClass('hidden-elm');									
							},50);								
						});
						break;
					case 'video':
						if(item_data_source!='' && typeof(ultimate_layouts_video_source)!='undefined' && typeof(ultimate_layouts_video_source[item_data_source])=='object'){
							$_lightbox_source.html(ultimate_layouts_video_source[item_data_source][0]);
							
							if(ultimate_layouts_video_source[item_data_source][0].indexOf('class="fb-video"')>0){
								(function(d, s, id) {
									var js, fjs = d.getElementsByTagName(s)[0];
									if (d.getElementById(id)) return;
									js = d.createElement(s); js.id = id;
									js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
									fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));
								
								if(typeof(FB)!='undefined'){
									FB.XFBML.parse();
								};
							};	
													
							setTimeout(function(){
								if(item_id!=parseFloat($_lightbox_content.attr('data-active-id'))){
									return;
								};
								$_lightbox_content.addClass('active-elm');
								//$_lightbox_loading.addClass('hidden-elm');
							},200);								
						};
						break;
					default:
						break;									
				};
			};	
			
			if($_lightbox_slider.hasClass('slick-slider')){
				
				$('.ull-slider-item', $_lightbox_id).removeClass('active-elm');				
				$('.ull-slider-item[data-slick-index="'+(item_id-1)+'"]', $_lightbox_id).addClass('active-elm');					
				$_lightbox_count.text((item_id)+'/'+(totalItems));
				$_lightbox_slider.slick('slickGoTo', item_id-1);
				$_lightbox_slider.addClass('active-elm');						
				setDataSource();
			}else{
					
				$_lightbox_slider.on('init', function(event, slick_elm){
					
					$('.ull-slider-item', $_lightbox_id).removeClass('active-elm');
					$('.ull-slider-item[data-slick-index="'+(item_id-1)+'"]', $_lightbox_id).addClass('active-elm');					
					$_lightbox_count.text((item_id)+'/'+(totalItems));
					slick_elm.slickGoTo(item_id-1);
					$_lightbox_slider.addClass('active-elm');
					
					$_lightbox_prev.on('click', function(event){
						slick_elm.slickPrev();
						event.stopPropagation();
					});	
					$_lightbox_next.on('click', function(event){
						slick_elm.slickNext();
						event.stopPropagation();
					});				
					
					$_lightbox_id.on('click', '.ull-slider-item', function(event){
						slick_elm.slickGoTo(parseFloat($(this).attr('data-slick-index')));
						event.stopPropagation();
					});	
					
					$_lightbox_source.on('click', function(event){
						event.stopPropagation();
					});	
					
					$_lightbox_caption.on('click', function(event){
						event.stopPropagation();
					});	
					
					$_lightbox_id.on('click', function(){
						$_lightbox_id.removeClass('active-elm');	
						$_lightbox_slider.removeClass('active-elm');
						$_lightbox_content.removeClass('active-elm').attr('data-active-id', '');
						$_lightbox_source.html('');
					});	
					
					$_lightbox_close.on('click', function(){
						$_lightbox_id.removeClass('active-elm');	
						$_lightbox_slider.removeClass('active-elm');
						$_lightbox_content.removeClass('active-elm').attr('data-active-id', '');
						$_lightbox_source.html('');
					});	
					
					setDataSource();
				});
				
				$_lightbox_slider.slick({
					dots			: false,
					arrows			: false,
					infinite		: false,
					speed			: 500,
					slidesToShow	: 1,
					variableWidth	: true,
					focusOnSelect	: false,
					swipeToSlide	: true,
					touchThreshold	: 15,
					centerMode		: true,
					rtl				: $_lightbox_slider.css('direction')=='rtl'?true:false,
				});
				
				$_lightbox_slider.on('beforeChange', function(event, slick_elm, currentSlide, nextSlide){
					$_all_items 		= $(_fill_elm_control+'[data-lightbox-id]', $_wrap);//reset Element Objectjn
					totalItems 			= $_all_items.length;//total items available id	
					
					$('.ull-slider-item', $_lightbox_id).removeClass('active-elm');
					$('.ull-slider-item[data-slick-index="'+(nextSlide)+'"]', $_lightbox_id).addClass('active-elm');
					$_lightbox_count.text((nextSlide+1)+'/'+(totalItems));
					
					var $_next_control = $(_fill_elm_control+'[data-lightbox-id="'+(nextSlide+1)+'"]', $_wrap);
					
					item_id 			= (nextSlide+1);
					item_data_source 	= $_next_control.attr('data-source');
					item_data_type		= $_next_control.attr('data-type');
					item_data_caption	= $_next_control.attr('data-caption');
					
					setDataSource();
				});
			};			
		});
	};//Lightbox function

	/*Grid list masonry function*/
	$.ultimate_layouts_gridListAjax = function(options){		
		$('.ul-filter-gridlist-normal').each(function(index, element){
			var $this 					= $(this),
				$this_parents 			= $this,
				id						= $.trim($this.attr('id')),
				html_loading			= '<div class="ultimate-layouts-filter-overlay"></div><div class="ultimate-layouts-filter-loading la-ball-clip-rotate"><div></div></div>',
				$ajax_container 		= $('.ultimate-layouts-listing-wrap', $this),
				$filter_sc_container 	= $('.ultimate-layouts-sc-filter-container', $this),
				$default_order_by		= $('.ul-order-by-action .order-by-default', $this),
				$default_order			= $('.ul-sort-order-action .ul-sort-order-action-arrow', $this),
				masonry_mode			= $this.hasClass('ultimate-layouts-masonry-mode'),
				masonry_layout			= null,
				$masonry_check_load		= $('.ul-container-img-load', $this),
				order_by_default		= ultimate_layouts_orderby[id],
				order_default			= ultimate_layouts_order[id],				
				$loadmore 				= $('.ul-loadmore-action', $this),
				$infinite				= $('.ul-infinite-action', $this),
				$page_numbers			= $('.ul-page-numbers', $this),
				infinite_status 		= 0,
				go_top_filter_page 		= 0,
				is_hash_filters			= $filter_sc_container.attr('data-hash-filters'),
				is_child_tax			= $filter_sc_container.attr('data-query-child-tax'),
				is_click_filters		= 0;
			
			//create query params
			var filter_params = '',
				paramsRequest = {},
				hash_filters = '';
				
			var check_params_query = function(page_request, first_query_request){
				filter_params = '';
				hash_filters = '';
				$('.ul-filter-action.active-elm', $this).each(function(index, element){
					var push_param = $.trim($(this).attr('data-filter'));
					if(typeof(push_param)!='undefined' && push_param!=''){
                    	filter_params += $(this).attr('data-filter')+',';
					};
					
					var hash_param = $(this).attr('data-item-hf');
					if(typeof(hash_param)!='undefined' && hash_param!=''){
						if($('.ul-filter-action.active-elm', $this).length-1 == index){
                    		hash_filters += $(this).attr('data-item-hf');
						}else{
							hash_filters += $(this).attr('data-item-hf')+',';
						}
					};
                });
				
				if(is_hash_filters=='1' && is_child_tax!='1' && is_click_filters == 0){
					addHashFilters(hash_filters);
				};
				
				ultimate_layouts_filter[id] 							= filter_params;
				ultimate_layouts_sub_opt_query[id]['paged'] 			= page_request;
				ultimate_layouts_sub_opt_query[id]['first_query'] 		= first_query_request;
				ultimate_layouts_sub_opt_query[id]['query_operator'] 	= $.trim($filter_sc_container.attr('data-query-operator'));
				ultimate_layouts_sub_opt_query[id]['query_relation'] 	= $.trim($filter_sc_container.attr('data-query-relation'));				
				
				if($default_order_by.length > 0){
					var order_by_param = $default_order_by.attr('data-order-by');
					if(typeof(order_by_param)!='undefined' && order_by_param!='' && (order_by_param.toLowerCase())!='none'){
						ultimate_layouts_orderby[id] = order_by_param;
					}else{
						ultimate_layouts_orderby[id] = order_by_default;
					};
				};
				
				if($default_order.length > 0){
					var order_param = $default_order.attr('data-sort-order');
					if(typeof(order_param)!='undefined' && order_param!='' && (order_param=='DESC' || order_param=='ASC')){
						ultimate_layouts_order[id] = order_param;
					}else{
						ultimate_layouts_order[id] = order_default;
					}
				};
				
				paramsRequest = {
									'query_params':		ultimate_layouts_query_params[id],
									'filter':			ultimate_layouts_filter[id],
									'order':			ultimate_layouts_order[id],
									'orderby':			ultimate_layouts_orderby[id],
									'sub_opt_query':	ultimate_layouts_sub_opt_query[id],
									'options':			ultimate_layouts_options[id],
									'random_id':		id,
									'action':			'ultimatelayoutsajaxaction',
								};
			};//create query params			
			
			//Ajax Filter
			var ajax_action = function(){
				
				if($ajax_container.find('.ultimate-layouts-filter-overlay').length == 0){
					$ajax_container.addClass('ul-elm-filter-loading').append(html_loading);
				};
				$filter_sc_container.addClass('loading-filter-status');	
				
				check_params_query(1, 'json');
				
				$.ajax({
					url:		ultimate_layouts_ajax_url[id],						
					type: 		'POST',
					data:		paramsRequest,
					dataType: 	'json',
					cache:		false,
					success: 	function(data){
						if(typeof(data) =='undefined' || data=='0' || data=='' || data==null){
							$ajax_container.html('');
							if(masonry_mode){
								masonry_layout
								.masonry('reloadItems')
								.masonry('layout');	
								
								setTimeout(function(){
									masonry_layout.masonry('layout');
								}, 100);			
							}
							ultimate_layouts_sub_opt_query[id]['total_pages'] = 1;
							fn_ajax();
						}else{
							ultimate_layouts_sub_opt_query[id]['first_query'] 		= 'off';
							ultimate_layouts_sub_opt_query[id]['total_pages'] 		= data.total_pages;
							ultimate_layouts_sub_opt_query[id]['items_last_page'] 	= data.items_last_page;			
							
							createPagination();
													
							$.ajax({
								url:		ultimate_layouts_ajax_url[id],						
								type: 		'POST',
								data:		paramsRequest,
								dataType: 	'html',
								cache:		false,
								success: 	function(data){
									if(filter_params!=ultimate_layouts_filter[id] || data=='0' || data=='' || data==null){										
										fn_ajax();
										return;
									};
									
									if(masonry_mode){										
										var f_masonry_finish = function masonry_finish(){
											$ajax_container.html(data);
											$masonry_check_load.html('');								
											masonry_layout
											.masonry('reloadItems')
											.masonry('layout');	
											
											setTimeout(function(){
												masonry_layout.masonry('layout');
											}, 100);																					
										};
										
										$masonry_check_load
										.html(data)
										.imagesLoaded()
										.done(function(instance){
											f_masonry_finish();
										})
										.fail(function(){
											f_masonry_finish();
										});	
									}else{						
										$ajax_container.html(data);
										fn_ajax();
									}
								},
								error:		function(){
									fn_ajax();	
								},
							});
						};
					},
					error:		function(){
						fn_ajax();
					}
				});
				
			};//Ajax Filter
			
			//Ajax Next Page
			var ajax_page_action = function(page_request){
				
				if(page_request>ultimate_layouts_sub_opt_query[id]['total_pages']){
					fn_ajax();
					return;
				};
								
				check_params_query(page_request, 'off');
				
				$.ajax({
					url:		ultimate_layouts_ajax_url[id],						
					type: 		'POST',
					data:		paramsRequest,
					dataType: 	'html',
					cache:		false,
					success: 	function(data){
						if(filter_params!=ultimate_layouts_filter[id] || data=='0' || data=='' || data==null){							
							fn_ajax();
							return;
						};
						
						if(masonry_mode){							
							var f_masonry_finish = function masonry_finish(){								
								var fn_html = $masonry_check_load.html();
								
								if(ultimate_layouts_options[id]['pagination']=='1'){
									masonry_layout.masonry( 'remove', masonry_layout.find('.ultimate-layouts-item'));
								};
																
								masonry_layout
								.append(fn_html)
								.masonry('appended', fn_html)
								.masonry('reloadItems')
								.masonry('layout');
								$masonry_check_load.html('');
								
								setTimeout(function(){
									masonry_layout.masonry('layout');																
								}, 100);																					
							};
							
							$masonry_check_load
							.html(data)
							.imagesLoaded()
							.done(function(instance){
								f_masonry_finish();
							})
							.fail(function(){
								f_masonry_finish();
							});	
						}else{
							if(ultimate_layouts_options[id]['pagination']=='1'){						
								$ajax_container.html(data);
							}else{
								$ajax_container.append(data);
							};
							fn_ajax();
						}
					},
					error:		function(){
						fn_ajax();	
					},
				});
			};
			
			var infinite_scroll = function(){
				var $infinite_offset = $('.ul-pagination-wrap', $this);
				
				if(infinite_status==1 || $infinite.hasClass('hidden-elm') || $infinite_offset.length==0){
					return;
				};				
				
				var	ajaxVisible = $infinite_offset.offset().top,
					ajaxScrollTop = $(window).scrollTop()+$(window).height();
					
				if(ajaxVisible <= (ajaxScrollTop) && (ajaxVisible + $(window).height()) > ajaxScrollTop){
					infinite_status = 1; //stop inifite scroll
					$infinite.addClass('active-elm');
					$filter_sc_container.addClass('loading-filter-status');
					ajax_page_action(ultimate_layouts_sub_opt_query[id]['paged']+1);
				};
			};//Ajax Next Page
			
			var fn_ajax = function(){
				$ajax_container.removeClass('ul-elm-filter-loading');
				$('.ul-filter-action', $this).removeClass('loading-filter-status');	
				$filter_sc_container.removeClass('loading-filter-status');
				$loadmore.removeClass('ul-lm-loading');	
				$page_numbers.removeClass('ul-lm-loading');
				
				if(ultimate_layouts_sub_opt_query[id]['total_pages']==ultimate_layouts_sub_opt_query[id]['paged']){
					$loadmore.addClass('hidden-elm');
					$infinite.addClass('hidden-elm');								
					infinite_status = 1; //stop inifite scroll
				}else{
					infinite_status = 0;
					$loadmore.removeClass('hidden-elm');
					$infinite.removeClass('hidden-elm');					
				};	
				
				if(ultimate_layouts_sub_opt_query[id]['total_pages']==1){
					$page_numbers.addClass('hidden-elm');		
				}else{
					$page_numbers.removeClass('hidden-elm');
				};

				$infinite.removeClass('active-elm');
				if($('.paginationjs-pages .paginationjs-page', $page_numbers).length > 0){
					$page_numbers.pagination('enable');
				};
				
				if(ultimate_layouts_options[id]['pagination']=='1' && go_top_filter_page==1){
					go_top_filter_page = 0;
					window.scrollTo(0, $this.offset().top-$('#wpadminbar').height()-30);
				};
				
				animate();
				
				is_click_filters		= 0;
			};
			
			//Filter Click	
			$('#'+id).on('click', '.ul-filter-action', function(event){
				
				infinite_status 	= 1; //stop inifite scroll
				$loadmore.addClass('ul-lm-loading');  //stop button click loadmore
				$page_numbers.addClass('ul-lm-loading');
				
				var $this_item 		= $(this);
				var $__parent 		= $this_item.parents('.ultimate-layouts-sc-filter-container');
				var query_type 		= $__parent.attr('data-query-type');				
				
				if(typeof(query_type)=='undefined'){
					query_type = '0';
				};
				
				if($this_item.parents('.ul-s-dropdown-filter').length>0){
					$this_parents = $this_item.parents('.filter-dropdown-wrapper');			
				};	
				
				if(query_type=='0'){
					if($this_item.hasClass('ul-show-all-action')){
						$('.ul-filter-action', $this_parents).removeClass('active-elm loading-filter-status');
						$('.ul-filter-action.ul-show-all-action', $this_parents).addClass('active-elm loading-filter-status');											
					}else if($this_item.hasClass('active-elm')){
						$this_item.removeClass('active-elm loading-filter-status');	
						if($('.ul-filter-action.active-elm', $this_parents).length==0){
							$('.ul-filter-action.ul-show-all-action', $this_parents).addClass('active-elm loading-filter-status');							
						}					
					}else{
						$this_item.addClass('active-elm loading-filter-status');
						$('.ul-filter-action.ul-show-all-action', $this_parents).removeClass('active-elm loading-filter-status');
					}
				}else{
					if($this_item.hasClass('ul-show-all-action')){
						$('.ul-filter-action', $this_parents).removeClass('active-elm loading-filter-status');
						$('.ul-filter-action.ul-show-all-action', $this_parents).addClass('active-elm loading-filter-status');
					}else if($this_item.hasClass('active-elm')){
						$this_item.removeClass('active-elm loading-filter-status');
						if($('.ul-filter-action.active-elm', $this_parents).length==0){
							$('.ul-filter-action.ul-show-all-action', $this_parents).addClass('active-elm loading-filter-status');
						};	
					}else{
						$('.ul-filter-action', $this_parents).removeClass('active-elm loading-filter-status');
						$this_item.addClass('active-elm loading-filter-status');
					};
				};	
				
				if($this_item.parents('.ul-s-dropdown-filter').length>0){
					var lengthFilterCount = $('.ul-filter-action.active-elm:not(.ul-show-all-action)', $this_parents).length;
					if(lengthFilterCount>0){
						$this_parents.find('.ul-number-filter').text(lengthFilterCount).addClass('active-elm');
						
						var list_filter_dd = '';
						$('.ul-filter-action.active-elm:not(.ul-show-all-action)', $this_parents).each(function(index, element) {
                            if(index+1==lengthFilterCount){
								list_filter_dd+=$(this).find('.tax-name').text();
							}else{
								list_filter_dd+=$(this).find('.tax-name').text()+', ';
							};							
                        });
						if($('.ul-default-dd-filter', $this_parents).find('.ul-filter-show-lt').length>0){
							$('.ul-default-dd-filter .ul-filter-show-lt', $this_parents).text(list_filter_dd);
						}else{
							$('.ul-default-dd-filter', $this_parents).addClass('ul-filter-show-lt-wrap').prepend('<span class="tax-name ul-filter-show-lt">'+list_filter_dd+'</span>');
						}
					}else{
						$this_parents.find('.ul-number-filter').removeClass('active-elm');
						$('.ul-default-dd-filter', $this_parents).removeClass('ul-filter-show-lt-wrap').find('.ul-filter-show-lt').remove();
					}					
					
					var getChildTax 	= $.trim($filter_sc_container.attr('data-query-child-tax')),						
						secondaryCat	= $.trim($filter_sc_container.attr('data-secondary-cat')),
						$parent_index = $this_item.parents('.filter-dropdown-wrapper');
						
					if(!$parent_index.hasClass('ul-children-taxs')){
						$('.ul-children-taxs', $__parent).addClass('hidden-sub-filter').find('.ul-filter-action').removeClass('active-elm loading-filter-status');
						$('.ul-children-taxs', $__parent).find('.ul-number-filter').removeClass('active-elm');
						ultimate_layouts_sub_opt_query[id]['query_children_taxs'] = 'no';
					}else{
						if($('.ul-filter-action.active-elm', $parent_index).length==0){
							ultimate_layouts_sub_opt_query[id]['query_children_taxs'] = 'no';
						}else{
							ultimate_layouts_sub_opt_query[id]['query_children_taxs'] = 'yes';
						}
					};
						
					if(getChildTax=='1'){
						var str_randomidgen = randomidgen();						
						if(typeof($parent_index.attr('data-rnd-child-id'))=='undefined' || $parent_index.attr('data-rnd-child-id')==''){								
							$parent_index.attr('data-rnd-child-id', str_randomidgen);
						}else{
							str_randomidgen = $.trim($parent_index.attr('data-rnd-child-id'));
						};
						
						var $taxonomy_id 		= $.trim($this_item.attr('data-filter')),
							$taxonomy_slug 		= $.trim($this_item.attr('data-taxonomy')),
							$taxonomy_child		= $.trim($this_item.attr('data-total-children')),
							$taxonomy_show_np	= $.trim($this_item.attr('data-show-number-post')),
							$subElms = $('.ul-children-taxs[data-rnd-child-id="sub-i-'+str_randomidgen+'-'+$taxonomy_id+'"]', $__parent);
							
						if(isNumber($taxonomy_child) && typeof($taxonomy_slug)!='undefined' && $taxonomy_slug!=''){
							if(parseInt($taxonomy_child)>0 && $subElms.length==0){
								var $__parent_wrapper = $this_item.parents('.filter-dropdown-wrapper');
									$filter_sc_container.addClass('ul-loading-children-tax');
								
								paramsRequest = {
									'query_params':		ultimate_layouts_query_params[id],
									'order':			ultimate_layouts_order[id],
									'orderby':			ultimate_layouts_orderby[id],
									'sub_opt_query':	ultimate_layouts_sub_opt_query[id],
									'taxonomy_slug':	$taxonomy_slug, 
									'taxonomy_id':		$taxonomy_id,
									'action':			'ultimatelayoutsgetchildrentaxonomies',
								};
								
								$.ajax({
									url:		ultimate_layouts_ajax_url[id],						
									type: 		'POST',
									data:		paramsRequest,
									dataType: 	'json',
									cache:		false,
									success: 	function(data){											
										if(typeof(data) !='undefined' && data!='0' && data!='' && data!=null){
											if(data.length > 0){
												var html = '',
												groupNameSub = secondaryCat!=''?secondaryCat:$this_item.find('.tax-name').text();
												html+='<div class="filter-dropdown-wrapper ul-children-taxs hidden-sub-filter" data-rnd-child-id="sub-i-'+str_randomidgen+'-'+$taxonomy_id+'">';
												html+=	'<div class="ultimate-layouts-filter-item ul-default-dd-filter">';
												html+=		'<span class="tax-name">'+groupNameSub+'</span>';
												html+=		' <i class="fa fa-angle-down ul-arrow-angle" aria-hidden="true"></i><span class="ul-number-filter"></span>';													
												html+=	'</div>';
												html+=	'<div class="filter-dropdown-wrapper-list">'
												
												data.forEach(
													function(currentValue,index,arr){
														if(currentValue.length==3){
															html+='<div class="ultimate-layouts-filter-item ul-filter-action" data-filter="'+currentValue[1]+'" data-total-children="0" data-taxonomy="'+$taxonomy_slug+'">';
															html+=	'<span class="tax-name">'+currentValue[0]+'</span>';
															if($taxonomy_show_np=='1'){
																html+=	' <span class="tax-number">('+currentValue[2]+')</span>';
															}
															html+=	'<span class="close-filter"></span>';
															html+=	'<div class="ul-loading-item-filter-container">';
															html+=		'<div class="la-ball-scale-multiple la-2x ul-loading-item-filter">';
															html+=			'<div></div>';
															html+=			'<div></div>';
															html+=			'<div></div>';
															html+=		'</div>';
															html+=	'</div>';
															html+='</div>';
														}
													}
												);
												
												html+=	'</div>';
												html+='</div>';
												$__parent_wrapper.after(html);
												$subElms = $('.ul-children-taxs[data-rnd-child-id="sub-i-'+str_randomidgen+'-'+$taxonomy_id+'"]', $__parent);
												if($this_item.hasClass('active-elm')){
													$subElms.removeClass('hidden-sub-filter');
												};
											};
										};
										$filter_sc_container.removeClass('ul-loading-children-tax');
									},
									error:		function(){
										if($this_item.hasClass('active-elm')){
											$subElms.removeClass('hidden-sub-filter');
										};
										$filter_sc_container.removeClass('ul-loading-children-tax');												
									},
								});
							}else{									
								if($this_item.hasClass('active-elm')){
									$subElms.removeClass('hidden-sub-filter');
								};
								$filter_sc_container.removeClass('ul-loading-children-tax');
							};
						};	
					};
						
				};
				
				if($('.nav__dropdown.show', $this).length>0 || $('.nav__dropdown-toggle.is-open', $this).length>0){
					$('.nav__dropdown.show', $this).removeClass('show');
					$('.nav__dropdown-toggle.is-open', $this).removeClass('is-open');
				};
				
				ajax_action();				
			});//Filter Click
			
			//Order By
			$('#'+id).on('click', '.ul-order-by-action', function(event){
				var $this_item 	= $(this);				
				$this_item.toggleClass('active-dropdown');
				if($('.nav__dropdown.show', $this).length>0 || $('.nav__dropdown-toggle.is-open', $this).length>0){
					$('.nav__dropdown.show', $this).removeClass('show');
					$('.nav__dropdown-toggle.is-open', $this).removeClass('is-open');
				};
			});
			
			$('#'+id).on('click', '.order-by-dropdown-item', function(event){
				
				infinite_status 	= 1; //stop inifite scroll
				$loadmore.addClass('ul-lm-loading');  //stop button click loadmore
				$page_numbers.addClass('ul-lm-loading');
				
				var $this_item 	= $(this),				
				old_param		= $default_order_by.attr('data-order-by'),
				old_text		= $default_order_by.find('.ul-text-order-by').html();
				
				$default_order_by.attr('data-order-by', $this_item.attr('data-order-by'));
				$default_order_by.find('.ul-text-order-by').html($this_item.html());
				
				$this_item.attr('data-order-by', old_param);
				$this_item.html(old_text);

				$this_item.parents('.ul-order-by-action').toggleClass('active-dropdown');
				
				ajax_action();
			});//Order By
			
			//Sort Order
			$('#'+id).on('click', '.ul-sort-order-action', function(event){
				
				infinite_status 	= 1; //stop inifite scroll
				$loadmore.addClass('ul-lm-loading');  //stop button click loadmore
				$page_numbers.addClass('ul-lm-loading');
				
				var $this_item 			= $(this),				
					$sort_order_elm 	= $('.ul-sort-order-action-arrow', $this_item),
					sort_order_param	= $sort_order_elm.attr('data-sort-order');
				
				if(typeof(sort_order_param)!='undefined' && sort_order_param.toLowerCase()=='desc'){
					$default_order.attr('data-sort-order', 'ASC');
				}else{
					$default_order.attr('data-sort-order', 'DESC');
				};	
				
				ajax_action();
			});//Sort Order
			
			var generateData = function(number){
				var result = [];		
				for (var i=1; i<number+1; i++){
					result.push(i);
				};		
				return result;
			};
			
			var createPagination = function(){
				if($page_numbers.length > 0){
					$page_numbers.pagination({
						dataSource: generateData(parseFloat(ultimate_layouts_sub_opt_query[id]['total_pages'])*parseFloat(ultimate_layouts_query_params[id]['posts_per_page'])),
						pageSize: parseFloat(ultimate_layouts_query_params[id]['posts_per_page']),							
						autoHidePrevious: true,
						autoHideNext: true,
						prevText:'<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
						nextText:'<i class="fa fa-angle-double-right" aria-hidden="true"></i>',						
					});
					$page_numbers.addHook('beforePaging', function(pagination){
						infinite_status = 1; //stop inifite scroll
						go_top_filter_page = 1;
						$page_numbers.addClass('ul-lm-loading');
						$filter_sc_container.addClass('loading-filter-status');
						$page_numbers.pagination('disable');
						ajax_page_action(pagination);
					});	
				};
			};
			
			//Pagination
			switch(ultimate_layouts_options[id]['pagination']){
				case '0':
					$loadmore.on('click', function(){
						infinite_status = 1; //stop inifite scroll
						$(this).addClass('ul-lm-loading');
						$filter_sc_container.addClass('loading-filter-status');
						ajax_page_action(ultimate_layouts_sub_opt_query[id]['paged']+1);
					});					
					break;
				case '1':
					createPagination();
					break;
				case '2':
					break;	
				case '3':
					$w.on('scroll load', function(){
						infinite_scroll();
					});
					break;		
			};//Pagination
			
			$('#'+id).on('click', '.filter-dropdown-wrapper', function(event){
				var $this_item 	= $(this);				
				$this_item.toggleClass('active-dropdown');
			});
			
			var offsetFunction = function(event, elms){
				var $elms = elms;
				
				if($elms.length>0){
					var $ddwidth 	= $elms.outerWidth();
					var $ddheight 	= $elms.outerHeight();					
					if(event.pageX < $elms.offset().left || event.pageX > $elms.offset().left+$ddwidth || event.pageY < $elms.offset().top || event.pageY > $elms.offset().top + $ddheight){
						return true;
					};
				};
								
				return false;
			};
			
			$d.on('click', function(event){
				$('.ul-order-by-action.active-dropdown, .filter-dropdown-wrapper.active-dropdown', $this).each(function(index, element){
                    if(offsetFunction(event, $(this))){
						$(this).removeClass('active-dropdown');
					};
                });				
			});
			
			$('.ultimate-layouts-item', $this).addClass('ul-ready-animation');
			var animate = function(){
				var c_animate = ultimate_layouts_options[id]['animate'];
				if(c_animate=='' || c_animate=='default'){
					return;
				};
											
				var arrayAnimate = 	[	'bounce', 
										'flash', 
										'pulse', 
										'rubberBand', 
										'shake', 
										'swing', 
										'tada', 
										'wobble', 
										'jello', 
										'bounceIn', 
										'bounceInDown', 
										'bounceInLeft', 
										'bounceInRight', 
										'bounceInUp', 
										'fadeIn', 
										'fadeInDown', 
										'fadeInDownBig', 
										'fadeInLeft', 
										'fadeInLeftBig', 
										'fadeInRight', 
										'fadeInRightBig', 
										'fadeInUp',
										'fadeInUpBig',
										'flipInX',
										'flipInY',
										'lightSpeedIn',
										'rotateIn',
										'rotateInDownLeft',
										'rotateInDownRight',
										'rotateInUpLeft',
										'rotateInUpRight',
										'rollIn',
										'zoomIn',
										'zoomInDown',
										'zoomInLeft',
										'zoomInRight',
										'zoomInUp',
										'slideInDown',
										'slideInLeft',
										'slideInRight',
										'slideInUp'
									];
				var randAnimate1 	= arrayAnimate[Math.floor(Math.random() * arrayAnimate.length)],
					randAnimate2	= arrayAnimate[Math.floor(Math.random() * arrayAnimate.length)],
					$postItem		= $('.ultimate-layouts-item:not(.ul-ready-animation)', $this),
					$postItemOdd	= $('.ultimate-layouts-item:not(.ul-ready-animation):nth-child(odd)', $this),
					$postItemEven	= $('.ultimate-layouts-item:not(.ul-ready-animation):nth-child(even)', $this);				
				
				
				if(c_animate=='rand'){
					$postItemOdd.addClass('ul-ready-animation animated '+randAnimate1);
					$postItemEven.addClass('ul-ready-animation animated '+randAnimate2);
				}else if(c_animate=='randsync'){
					$postItem.addClass('ul-ready-animation animated '+randAnimate1);
				}else if(isNumber(c_animate)){
					$postItem.addClass('ul-ready-animation animated '+arrayAnimate[c_animate]);
				};
			};
			
			var action_hash_filter = function(){
				if(window.location.hash && is_hash_filters=='1' && is_child_tax!='1') {
					var hash_values = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
					if(hash_values!='' && hash_values!=null && typeof(hash_values)!='undefined' && hash_values.toString().split('=').length == 2){
						var hash_elm = hash_values.toString().split("=")[1];					
						if(hash_elm!=''){
							var hash_elm_split 	= hash_elm.split(',');
							var query_type 		= $filter_sc_container.attr('data-query-type');
							var default_f_length = 1;
							
							if($filter_sc_container.parents('.ul-s-dropdown-filter').find('.filter-dropdown-wrapper').length>0){
								default_f_length = $filter_sc_container.parents('.ul-s-dropdown-filter').find('.filter-dropdown-wrapper').length;
							};
							
							if(query_type=='1' && hash_elm_split.length > default_f_length){
								return;
							};
							
							infinite_status 	= 1; //stop inifite scroll
							$loadmore.addClass('ul-lm-loading'); //stop button click loadmore
							$page_numbers.addClass('ul-lm-loading');
														
							$('.ul-filter-action', $filter_sc_container).removeClass('active-elm loading-filter-status');							
							
							for(var i = 0; i < hash_elm_split.length; i++){							
								if(hash_elm_split[i]!=''){								
									$('.ul-filter-action[data-item-hf="'+(hash_elm_split[i])+'"]', $filter_sc_container).addClass('active-elm loading-filter-status');
								};
							};
							is_click_filters = 1;
							ajax_action();
							
							if($filter_sc_container.parents('.ul-s-dropdown-filter').length>0){
								$filter_sc_container.parents('.ul-s-dropdown-filter').find('.filter-dropdown-wrapper').each(function(index, element){
									var lengthFilterCount = $('.ul-filter-action.active-elm:not(.ul-show-all-action)', $(this)).length;
									if(lengthFilterCount>0){
										$(this).find('.ul-number-filter').text(lengthFilterCount).addClass('active-elm');
									}else{
										$(this).find('.ul-number-filter').removeClass('active-elm');
									};
								});	
							};
							
						};
					};			
				};
			};
			
			//Check Masonry Mode	
			if(masonry_mode){
				infinite_status = 1;  //stop inifite scroll				
				var f_masonryCreate = function masonryCreate(){
					masonry_layout = 	$ajax_container.masonry({
											itemSelector		: '.ultimate-layouts-item',
											//columnWidth			: '.ultimate-layouts-item',
											transitionDuration	: '0s',
											percentPosition		: true,
											//originLeft			: true,
										});										
					masonry_layout.on('layoutComplete', function(event, items){
						$this.addClass('ul-masonry-mode-finish');		
						infinite_status = 0;				
						fn_ajax();						
					});		
									
					masonry_layout.masonry('layout');
					setTimeout(function(){
						masonry_layout.masonry('layout');
						action_hash_filter();
					}, 100);
				};
				
				$ajax_container
				.imagesLoaded()
				.done( function(instance){
					f_masonryCreate();
				})
				.fail( function(){
					f_masonryCreate();
				});	
			}else{
				action_hash_filter();
			};//Check Masonry Mode
			
			var oldClass = [];
			$('.switch-control', $this).on('click', function(){
				var $this_panel	= $(this),
					$parent 	= $this_panel.parents('.ultimate-layouts-wrapper-control'),
					id			= $parent.attr('id');
								
				$parent.find('.switch-control').removeClass('active-elm');
				$this_panel.addClass('active-elm');
				
				if($this_panel.hasClass('switch-grid')){
					$parent.find('.ultimate-layouts-listing-wrap').removeClass('ultimate-layouts-listing-list-1 switch-style');
					
					if(typeof(oldClass[id])!=='undefined'){
						$parent.find('.ultimate-layouts-listing-wrap').addClass(oldClass[id]);
					}				
				}else if($this_panel.hasClass('switch-list')){
					$parent.find('.ultimate-layouts-listing-wrap')
					.addClass('ultimate-layouts-listing-list-1 switch-style')
					.removeClass(function(index, className){
						if(typeof(oldClass[id])==='undefined'){
							oldClass[id] = (className.match (/\bultimate-layouts-col-\S+/g) || []).join(' ');
						}
						return oldClass[id];
					});					
				}
				
				if(masonry_mode && masonry_layout!=null){
					masonry_layout.masonry('layout');
				}				
			});	
						
		});
	};/*Grid list masonry function*/
	
	$.ultimate_layouts_carousel = function(options){
		$('.ultimate-layouts-global-carousel-settings').each(function(index, element){             
			var	$this 					= $(this),
				$carousel				= $('.ultimate-layouts-carousel-t', $this),
				$prev_btn				= $('.pagination-prev', $this),
				$next_btn				= $('.pagination-next', $this),				
				id						= $.trim($this.attr('id')),
				defaultShow				= 1,
				breakPoint				= [],
				scrollPerPage			= ultimate_layouts_options[id]['scrollperpage'],	
				cc_extra_large_desktop	= ultimate_layouts_options[id]['cc_extra_large_desktop'],		
				cc_large_desktop		= ultimate_layouts_options[id]['cc_large_desktop'],				
				cc_medium_desktop		= ultimate_layouts_options[id]['cc_medium_desktop'],				
				cc_small_desktop		= ultimate_layouts_options[id]['cc_small_desktop'],				
				cc_landscape_tablet		= ultimate_layouts_options[id]['cc_landscape_tablet'],				
				cc_portrait_tablet		= ultimate_layouts_options[id]['cc_portrait_tablet'],				
				cc_mobile				= ultimate_layouts_options[id]['cc_mobile'],
				show_dots				= ultimate_layouts_options[id]['show_dots'],
				infinite				= ultimate_layouts_options[id]['infinite'],
				speed					= ultimate_layouts_options[id]['speed'],
				autoplay				= ultimate_layouts_options[id]['autoplay'],
				autoplayspeed			= ultimate_layouts_options[id]['autoplayspeed'],
				centermode				= ultimate_layouts_options[id]['centermode'],
				show_arrows				= ultimate_layouts_options[id]['show_arrows'];
				
			if(cc_large_desktop!='' && cc_large_desktop!='0' && isNumber(cc_large_desktop)){
				breakPoint.push({ //1600 and up
									breakpoint: 1920,
									settings: {
										slidesToShow	: parseFloat(cc_large_desktop),
										slidesToScroll	: parseFloat((scrollPerPage=='1'?cc_large_desktop:1)),
									}
								});
			};
			
			if(cc_medium_desktop!='' && cc_medium_desktop!='0' && isNumber(cc_medium_desktop)){
				breakPoint.push({ //1366 and up
									breakpoint: 1600,
									settings: {
										slidesToShow	: parseFloat(cc_medium_desktop),
										slidesToScroll	: parseFloat((scrollPerPage=='1'?cc_medium_desktop:1)),
									}
								});
			};
			
			if(cc_small_desktop!='' && cc_small_desktop!='0' && isNumber(cc_small_desktop)){
				breakPoint.push({ //1025 and up
									breakpoint: 1366,
									settings: {
										slidesToShow	: parseFloat(cc_small_desktop),
										slidesToScroll	: parseFloat((scrollPerPage=='1'?cc_small_desktop:1)),
									}
								});
			};
			
			if(cc_landscape_tablet!='' && cc_landscape_tablet!='0' && isNumber(cc_landscape_tablet)){
				breakPoint.push({ //800 and up
									breakpoint: 1025,
									settings: {
										slidesToShow	: parseFloat(cc_landscape_tablet),
										slidesToScroll	: parseFloat((scrollPerPage=='1'?cc_landscape_tablet:1)),
									}
								});
			};
			
			if(cc_portrait_tablet!='' && cc_portrait_tablet!='0' && isNumber(cc_portrait_tablet)){
				breakPoint.push({ //600 and up
									breakpoint: 800,
									settings: {
										slidesToShow	: parseFloat(cc_portrait_tablet),
										slidesToScroll	: parseFloat((scrollPerPage=='1'?cc_portrait_tablet:1)),
									}
								});
			};
			
			if(cc_mobile!='' && cc_mobile!='0' && isNumber(cc_mobile)){
				breakPoint.push({ //0 and up
									breakpoint: 600,
									settings: {
										slidesToShow	: parseFloat(cc_mobile),
										slidesToScroll	: parseFloat((scrollPerPage=='1'?cc_mobile:1)),
									}
								});
			};
			
			if(breakPoint.length > 0){
				defaultShow = breakPoint[0].settings.slidesToShow;
			};
			
			if(cc_extra_large_desktop!='' && cc_extra_large_desktop!='0' && isNumber(cc_extra_large_desktop)){
				defaultShow = cc_extra_large_desktop;
			};
			
			$carousel.on('init', function(event, slick_elm){
				if(show_arrows=='1'){
					$prev_btn.on('click', function(event){
						slick_elm.slickPrev();
					});	
					$next_btn.on('click', function(event){
						slick_elm.slickNext();
					});	
				};
			}); 
			
			if(!$carousel.hasClass('ultimate-layouts-carousel-variableWidth')){			
				$carousel.slick({
					arrows:						true,	
					dots: 						(show_dots=='1'?true:false),
					infinite: 					(infinite=='1'?true:false),
					speed: 						parseFloat((isNumber(speed)?speed:500)),
					slidesToShow: 				parseFloat(defaultShow),
					slidesToScroll:				parseFloat((scrollPerPage=='1'?defaultShow:1)),
					adaptiveHeight: 			true,
					autoplay:					(autoplay=='1'?true:false),
					autoplaySpeed:				parseFloat((isNumber(autoplayspeed)?autoplayspeed:5000)),
					accessibility:				false,
					pauseOnHover:				true,
					touchThreshold:				15,
					draggable:					true,
					responsive:					breakPoint,	
					waitForAnimate:				true,
					centerMode:					(centermode=='1'?true:false),
					//swipeToSlide:				true,
					rtl: 						$this.css('direction')=='rtl'?true:false,		  	
				});
			}else{
				var otp_df = {
					arrows:						true,	
					dots: 						false,
					infinite: 					(infinite=='1'?true:false),
					speed: 						parseFloat((isNumber(speed)?speed:500)),
					slidesToShow: 				parseFloat(defaultShow),
					slidesToScroll:				1,
					adaptiveHeight: 			true,
					autoplay:					(autoplay=='1'?true:false),
					autoplaySpeed:				parseFloat((isNumber(autoplayspeed)?autoplayspeed:5000)),
					accessibility:				false,
					pauseOnHover:				true,
					touchThreshold:				15,
					draggable:					true,
					waitForAnimate:				true,
					centerMode:					(centermode=='1'?true:false),
					variableWidth: 				true,									
					//swipeToSlide:				true,	
					rtl: 						$this.css('direction')=='rtl'?true:false,	  	
				};
				
				if($carousel.hasClass('ultimate-layouts-carousel-f-1')){
					otp_df.slidesToShow			= 5;
					if(infinite=='1'){
						otp_df.clones			= 5;
						otp_df.initialSlide		= 5;	
					};
				};
				
				$carousel.slick(otp_df);
			}
							
			if(show_arrows=='1'){	
				var position_arrow = function(){
					var css = {/*'margin-top':-($prev_btn.height()/2+$('.slick-dots', $this).height()/2+5)+'px'*/};
					if($this.find('.slick-arrow').length==0) {
						$prev_btn.hide();
						$next_btn.hide();
					}else{
						$prev_btn.css(css).show();
						$next_btn.css(css).show();						
					};
				};		
				$carousel.on('setPosition', function(slick){
					position_arrow();
				});
				position_arrow();
			};
        });
	};
	
	$.ultimate_layouts_slider = function(options){
		$('.ultimate-layouts-sync-slider-settings').each(function(index, element){
			var	$this 					= $(this),
				$big_slider				= $('.ul-big-slider-content', $this),
				$small_slider			= $('.ul-small-slider-content', $this),
				$prev_btn				= $('.pagination-prev', $this),
				$next_btn				= $('.pagination-next', $this),				
				id						= $.trim($this.attr('id')),
				defaultShow				= 1,
				breakPoint				= [],					
				cc_extra_large_desktop	= ultimate_layouts_options[id]['cc_extra_large_desktop'],		
				cc_large_desktop		= ultimate_layouts_options[id]['cc_large_desktop'],				
				cc_medium_desktop		= ultimate_layouts_options[id]['cc_medium_desktop'],				
				cc_small_desktop		= ultimate_layouts_options[id]['cc_small_desktop'],				
				cc_landscape_tablet		= ultimate_layouts_options[id]['cc_landscape_tablet'],				
				cc_portrait_tablet		= ultimate_layouts_options[id]['cc_portrait_tablet'],				
				cc_mobile				= ultimate_layouts_options[id]['cc_mobile'],				
				speed					= ultimate_layouts_options[id]['speed'],
				autoplay				= ultimate_layouts_options[id]['autoplay'],
				autoplayspeed			= ultimate_layouts_options[id]['autoplayspeed'],
				centermode				= ultimate_layouts_options[id]['centermode'];
				
			if(cc_large_desktop!='' && cc_large_desktop!='0' && isNumber(cc_large_desktop)){
				breakPoint.push({ //1600 and up
									breakpoint: 1920,
									settings: {
										slidesToShow	: parseFloat(cc_large_desktop),
										slidesToScroll	: 1,
									}
								});
			};
			
			if(cc_medium_desktop!='' && cc_medium_desktop!='0' && isNumber(cc_medium_desktop)){
				breakPoint.push({ //1366 and up
									breakpoint: 1600,
									settings: {
										slidesToShow	: parseFloat(cc_medium_desktop),
										slidesToScroll	: 1,
									}
								});
			};
			
			if(cc_small_desktop!='' && cc_small_desktop!='0' && isNumber(cc_small_desktop)){
				breakPoint.push({ //1025 and up
									breakpoint: 1366,
									settings: {
										slidesToShow	: parseFloat(cc_small_desktop),
										slidesToScroll	: 1,
									}
								});
			};
			
			if(cc_landscape_tablet!='' && cc_landscape_tablet!='0' && isNumber(cc_landscape_tablet)){
				breakPoint.push({ //800 and up
									breakpoint: 1025,
									settings: {
										slidesToShow	: parseFloat(cc_landscape_tablet),
										slidesToScroll	: 1,
									}
								});
			};
			
			if(cc_portrait_tablet!='' && cc_portrait_tablet!='0' && isNumber(cc_portrait_tablet)){
				breakPoint.push({ //600 and up
									breakpoint: 800,
									settings: {
										slidesToShow	: parseFloat(cc_portrait_tablet),
										slidesToScroll	: 1,
									}
								});
			};
			
			if(cc_mobile!='' && cc_mobile!='0' && isNumber(cc_mobile)){
				breakPoint.push({ //0 and up
									breakpoint: 600,
									settings: {
										slidesToShow	: parseFloat(cc_mobile),
										slidesToScroll	: 1,
									}
								});
			};
			
			if(breakPoint.length > 0){
				defaultShow = breakPoint[0].settings.slidesToShow;
			};
			
			if(cc_extra_large_desktop!='' && cc_extra_large_desktop!='0' && isNumber(cc_extra_large_desktop)){
				defaultShow = cc_extra_large_desktop;
			};	
			
			$big_slider.on('init', function(event, slick_elm){
				
				$this.find('.ul-big-slider-wrapper .pagination-prev').on('click', function(event){
					slick_elm.slickPrev();
				});	
				$this.find('.ul-big-slider-wrapper .pagination-next').on('click', function(event){
					slick_elm.slickNext();
				});	
				
			}); 
			
			$small_slider.on('init', function(event, slick_elm){
				
				$this.find('.ul-small-slider-wrapper .pagination-prev').on('click', function(event){
					slick_elm.slickPrev();
				});	
				$this.find('.ul-small-slider-wrapper .pagination-next').on('click', function(event){
					slick_elm.slickNext();
				});	
				
			});
				
			$big_slider.slick({
				arrows:						true,	
				dots: 						false,
				speed: 						parseFloat((isNumber(speed)?speed:500)),
				slidesToShow: 				1,
				slidesToScroll:				1,
				autoplay:					(autoplay=='1'?true:false),
				autoplaySpeed:				parseFloat((isNumber(autoplayspeed)?autoplayspeed:5000)),
				accessibility:				false,
				pauseOnHover:				true,
				touchThreshold:				15,
				draggable:					true,
				waitForAnimate:				true,
				centerMode:					false,
				//rtl: 						$this.css('direction')=='rtl'?true:false,
				rtl: 						false,	
				asNavFor: 					'#'+(id)+' .ul-small-slider-content',
				fade: 						true,	
				//infinite:					false,  	
			});
			
			$small_slider.slick({
				arrows:						true,	
				dots: 						false,
				speed: 						parseFloat((isNumber(speed)?speed:500)),
				slidesToShow: 				parseFloat(defaultShow),
				slidesToScroll:				1,				
				accessibility:				false,
				pauseOnHover:				true,
				touchThreshold:				15,
				draggable:					true,
				responsive:					breakPoint,	
				waitForAnimate:				true,
				centerMode:					(centermode=='1'?true:false),
				//rtl: 						$this.css('direction')=='rtl'?true:false,	
				rtl: 						false,
				asNavFor: 					'#'+(id)+' .ul-big-slider-content',
				focusOnSelect: 				true,	
				//infinite:					false,				  	
			});
			
			$small_slider.on('beforeChange', function(event, slick_elm, currentSlide, nextSlide){
				$this.find('.ultimate-layouts-img-ab').removeClass('active-elm').height(0);
			});
			
			$('.ul-small-slider-wrapper .ultimate-layouts-item', $this)
			.on('mouseenter', function(){
				$(this).find('.ultimate-layouts-img-ab').addClass('active-elm').height($('.ul-big-slider-wrapper .ultimate-layouts-item.slick-active.slick-current .ultimate-layouts-absolute-content', $this).outerHeight(true));
			})
			.on('mouseleave', function(){
				$(this).find('.ultimate-layouts-img-ab').removeClass('active-elm').height(0);
			});
		});
	};
	
	$.ultimate_layouts_contentBlock = function(options){
		var index_params_query = [];
		$('.ul-filter-block-content').each(function(index, element) {
			var $this 					= $(this),
				id						= $.trim($this.attr('id')),
				html_loading			= '<div class="ultimate-layouts-filter-overlay"></div><div class="ultimate-layouts-filter-loading la-ball-clip-rotate"><div></div></div>',
				$ajax_container 		= $('.ultimate-layouts-listing-wrap', $this),
				$filter_sc_container 	= $('.ultimate-layouts-sc-filter-container', $this),
				$btn_wrap				= $('.ul-cb-page-prev-next', $this),
				$btn_prev				= $('.ul-cb-prev-btn', $this),
				$btn_next				= $('.ul-cb-next-btn', $this),
				load_status				= 0,
				is_hash_filters			= $filter_sc_container.attr('data-hash-filters'),
				is_child_tax			= $filter_sc_container.attr('data-query-child-tax'),
				is_click_filters		= 0;
				
			index_params_query[(index)+(id)+(ultimate_layouts_filter[id])] = [ultimate_layouts_sub_opt_query[id]['total_pages'], ultimate_layouts_sub_opt_query[id]['items_last_page']];	
				
			if(ultimate_layouts_sub_opt_query[id]['total_pages']>1){
				$btn_wrap.show();
			};	
				
			//create query params
			var filter_params = '',
				paramsRequest = {},
				hash_filters = '';
				
			var check_params_query = function(page_request, first_query_request){
				
				filter_params = '';	
				hash_filters = '';			
				var push_param = $.trim($('.ul-filter-action.active-elm', $this).attr('data-filter'));
				if(typeof(push_param)!='undefined' && push_param!=''){
					filter_params = push_param;
				};
				
				var hash_param = $.trim($('.ul-filter-action.active-elm', $this).attr('data-item-hf'));
				if(typeof(hash_param)!='undefined' && hash_param!=''){
					hash_filters = hash_param;
				};		
				
				if(is_hash_filters=='1' && is_child_tax!='1' && is_click_filters == 0){
					addHashFilters(hash_filters);
				};		
				
				ultimate_layouts_filter[id] 						= filter_params;
				ultimate_layouts_sub_opt_query[id]['paged'] 		= page_request;
				ultimate_layouts_sub_opt_query[id]['first_query'] 	= first_query_request;
				
				paramsRequest = {
									'query_params':		ultimate_layouts_query_params[id],
									'filter':			ultimate_layouts_filter[id],
									'order':			ultimate_layouts_order[id],
									'orderby':			ultimate_layouts_orderby[id],
									'sub_opt_query':	ultimate_layouts_sub_opt_query[id],
									'options':			ultimate_layouts_options[id],
									'random_id':		id,
									'action':			'ultimatelayoutsajaxaction',
								};
			};//create query params	
			
			var disabled_action = function(){
				if($ajax_container.find('.ultimate-layouts-filter-overlay').length == 0){
					$ajax_container.addClass('ul-elm-filter-loading').append(html_loading);								
				}else{
					$ajax_container.addClass('ul-elm-filter-loading');
				};
				$ajax_container.css({'min-height':($('.ul-block-content-item.active-elm', $this).height())+'px'});
				$filter_sc_container.addClass('loading-filter-status');	
			}	
				
			//Ajax Filter
			var ajax_action = function(){	
				if(load_status==1){
					return;
				};
				
				disabled_action();
						
				check_params_query(1, 'json');	
							
				if($('.ul-block-content-item[data-item="'+(ultimate_layouts_filter[id])+'"]', $this).length>0){					
					setTimeout(function(){
						ultimate_layouts_sub_opt_query[id]['total_pages'] 		= index_params_query[(index)+(id)+(ultimate_layouts_filter[id])][0];
						ultimate_layouts_sub_opt_query[id]['items_last_page'] 	= index_params_query[(index)+(id)+(ultimate_layouts_filter[id])][1];
						fn_ajax();
					},400);									
					return;
				};
								
				$.ajax({
					url:		ultimate_layouts_ajax_url[id],						
					type: 		'POST',
					data:		paramsRequest,
					dataType: 	'json',
					cache:		false,
					success: 	function(data){
						if(typeof(data) =='undefined' || data=='0' || data=='' || data==null){												
							ultimate_layouts_sub_opt_query[id]['total_pages'] = 1;
							fn_ajax();
						}else{
							ultimate_layouts_sub_opt_query[id]['first_query'] 		= 'off';
							ultimate_layouts_sub_opt_query[id]['total_pages'] 		= data.total_pages;
							ultimate_layouts_sub_opt_query[id]['items_last_page'] 	= data.items_last_page;
							
							index_params_query[(index)+(id)+(ultimate_layouts_filter[id])] = [ultimate_layouts_sub_opt_query[id]['total_pages'], ultimate_layouts_sub_opt_query[id]['items_last_page']];
													
							$.ajax({
								url:		ultimate_layouts_ajax_url[id],						
								type: 		'POST',
								data:		paramsRequest,
								dataType: 	'html',
								cache:		false,
								success: 	function(data){
									if(filter_params!=ultimate_layouts_filter[id] || data=='0' || data=='' || data==null){										
										fn_ajax();
										return;
									};									
									var new_data = '<div class="ul-block-content-item" data-item="'+(ultimate_layouts_filter[id])+'" data-paged="1"><div class="ul-block-content-item-layout">'+(data)+'</div></div>';				
									$ajax_container.append(new_data);									
									fn_ajax();
									
								},
								error:		function(){
									fn_ajax();	
								},
							});
						};
					},
					error:		function(){
						fn_ajax();
					}
				});
				
			};//Ajax Filter	
			
			//Next page
			var ajax_page_action = function(page_request){
				if(load_status==1){
					return;
				};
				
				if(page_request>ultimate_layouts_sub_opt_query[id]['total_pages']){
					fn_ajax();
					return;
				};
				
				disabled_action();	
								
				check_params_query(page_request, 'off');				
				
				if($('.ul-block-content-item[data-item="'+(ultimate_layouts_filter[id])+'"][data-paged="'+(page_request)+'"]', $this).length>0){					
					setTimeout(function(){
						fn_ajax();
					},400);									
					return;
				};
				
				$.ajax({
					url:		ultimate_layouts_ajax_url[id],						
					type: 		'POST',
					data:		paramsRequest,
					dataType: 	'html',
					cache:		false,
					success: 	function(data){
						if(filter_params!=ultimate_layouts_filter[id] || data=='0' || data=='' || data==null){							
							fn_ajax();
							return;
						};						
						var new_data = '<div class="ul-block-content-item" data-item="'+(ultimate_layouts_filter[id])+'" data-paged="'+(page_request)+'"><div class="ul-block-content-item-layout">'+(data)+'</div></div>';					
						$ajax_container.append(new_data);
						fn_ajax();						
					},
					error:		function(){
						fn_ajax();	
					},
				});
			};//Next page
			
			var fn_ajax = function(){
				$ajax_container.removeClass('ul-elm-filter-loading');				
				$('.ul-filter-action', $this).removeClass('loading-filter-status');	
				$filter_sc_container.removeClass('loading-filter-status');				
				
				$('.ul-block-content-item', $this).removeClass('active-elm').hide();
				$('.ul-block-content-item[data-item="'+(ultimate_layouts_filter[id])+'"]', $this).removeClass('active-elm-tabs');
				$('.ul-block-content-item[data-item="'+(ultimate_layouts_filter[id])+'"][data-paged="'+(ultimate_layouts_sub_opt_query[id]['paged'])+'"]', $this).addClass('active-elm active-elm-tabs').show();
				$ajax_container.removeAttr('style');
				
				if(ultimate_layouts_sub_opt_query[id]['total_pages']>1){
					$btn_wrap.show();
				}else{
					$btn_wrap.hide();
				};
								
				if(ultimate_layouts_sub_opt_query[id]['total_pages']==ultimate_layouts_sub_opt_query[id]['paged']){
					$btn_next.addClass('ul-disabled-query');
				}else{
					$btn_next.removeClass('ul-disabled-query');
				};
				
				if(ultimate_layouts_sub_opt_query[id]['paged']=='1'){
					$btn_prev.addClass('ul-disabled-query');
				}else{
					$btn_prev.removeClass('ul-disabled-query');
				};
				
				load_status = 0;
				is_click_filters = 0;				
			};
			
			$('#'+id).on('click', '.ul-filter-action', function(event){
				if(load_status==1){
					return;
				};
				
				var $this_item 		= $(this);
				if($this_item.hasClass('ul-show-all-action')){
					$('.ul-filter-action', $this).removeClass('active-elm loading-filter-status');
					$('.ul-filter-action.ul-show-all-action', $this).addClass('active-elm loading-filter-status');
				}else if($this_item.hasClass('active-elm')){
					$this_item.removeClass('active-elm loading-filter-status');
					if($('.ul-filter-action.active-elm', $this).length==0){
						$('.ul-filter-action.ul-show-all-action', $this).addClass('active-elm loading-filter-status');
					};	
				}else{
					$('.ul-filter-action', $this).removeClass('active-elm loading-filter-status');
					$this_item.addClass('active-elm loading-filter-status');
				};
				
				if($this_item.parents('.ul-s-dropdown-filter').length>0){					
					var $this_parents = $this_item.parents('.filter-dropdown-wrapper');
					var lengthFilterCount = $('.ul-filter-action.active-elm:not(.ul-show-all-action)', $this).length;					
					$this.find('.ul-number-filter').removeClass('active-elm');
					if(lengthFilterCount>0){
						$this_parents.find('.ul-number-filter').text(lengthFilterCount).addClass('active-elm');
					};
				};
				
				if($('.nav__dropdown.show', $this).length>0 || $('.nav__dropdown-toggle.is-open', $this).length>0){
					$('.nav__dropdown.show', $this).removeClass('show');
					$('.nav__dropdown-toggle.is-open', $this).removeClass('is-open');
				};
				
				ajax_action();
				load_status	= 1;
			});	
			
			$('#'+id).on('click', '.ul-cb-prev-btn', function(event){
				if(load_status==1){
					return;
				};
				ajax_page_action(ultimate_layouts_sub_opt_query[id]['paged']-1);
				load_status	= 1;
			});
			$('#'+id).on('click', '.ul-cb-next-btn', function(event){
				if(load_status==1){
					return;
				};
				ajax_page_action(ultimate_layouts_sub_opt_query[id]['paged']+1);
				load_status	= 1;
			});	
			
			$('#'+id).on('click', '.filter-dropdown-wrapper', function(event){
				var $this_item 	= $(this);				
				$this_item.toggleClass('active-dropdown');
			});
			
			var offsetFunction = function(event, elms){
				var $elms = elms;
				
				if($elms.length>0){
					var $ddwidth 	= $elms.outerWidth();
					var $ddheight 	= $elms.outerHeight();					
					if(event.pageX < $elms.offset().left || event.pageX > $elms.offset().left+$ddwidth || event.pageY < $elms.offset().top || event.pageY > $elms.offset().top + $ddheight){
						return true;
					};
				};
								
				return false;
			};
			
			$d.on('click', function(event){
				$('.ul-order-by-action.active-dropdown, .filter-dropdown-wrapper.active-dropdown', $this).each(function(index, element){
                    if(offsetFunction(event, $(this))){
						$(this).removeClass('active-dropdown');
					};
                });				
			});
			
			var action_hash_filter = function(){
				if(window.location.hash && is_hash_filters=='1' && is_child_tax!='1') {
					var hash_values = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
					if(hash_values!='' && hash_values!=null && typeof(hash_values)!='undefined' && hash_values.toString().split('=').length == 2){
						var hash_elm = hash_values.toString().split("=")[1];					
						if(hash_elm!=''){							
							$('.ul-filter-action', $filter_sc_container).removeClass('active-elm loading-filter-status');
							var hash_elm_split = hash_elm.split(',');
							
							for(var i = 0; i < hash_elm_split.length; i++){							
								if(hash_elm_split[i]!=''){								
									$('.ul-filter-action[data-item-hf="'+(hash_elm_split[i])+'"]', $filter_sc_container).addClass('active-elm loading-filter-status');
								};
							};
							is_click_filters = 1;
							ajax_action();
							load_status	= 1;
						};
					};			
				};
			};
			
			action_hash_filter();
			
		});
	};
	
	/*$.ultimate_layouts_switch_view = function(){
		var oldClass = [];
		$('.ultimate-layouts-wrapper-control .switch-control').on('click', function(){
			var $this 		= $(this),
				$parent 	= $this.parents('.ultimate-layouts-wrapper-control'),
				id			= $parent.attr('id');
							
			$parent.find('.switch-control').removeClass('active-elm');
			$this.addClass('active-elm');
			
			if($this.hasClass('switch-grid')){
				$parent.find('.ultimate-layouts-listing-wrap').removeClass('ultimate-layouts-listing-list-1 switch-style');
				
				if(typeof(oldClass[id])!=='undefined'){
					$parent.find('.ultimate-layouts-listing-wrap').addClass(oldClass[id]);
				}				
			}else if($this.hasClass('switch-list')){
				$parent.find('.ultimate-layouts-listing-wrap')
				.addClass('ultimate-layouts-listing-list-1 switch-style')
				.removeClass(function(index, className){
					if(typeof(oldClass[id])==='undefined'){
						oldClass[id] = (className.match (/\bultimate-layouts-col-\S+/g) || []).join(' ');
					}
					return oldClass[id];
				});
			}
		});
	};*/
	
	$d.ready(function(e){
		$('.ultimate-layouts-filter-container').each(function(index, element){
			$(this).find('.ul-filter-action[data-item-hf="all"]').each(function(index, element) {
                if(index>0){
					var $old_item_name = $(this).attr('data-item-hf');
					$(this).attr('data-item-hf', ($old_item_name)+'-'+(index));
				};
            });            
        });
		
		/*smart tab*/
		$('.ul-smart-tab-filter').each(function(index, element) {
            var $this 		= $(this),
				elm_index 	= 'ul-tab-wrapper-index-'+index,
				$elm_index	= $('#'+elm_index),
				title_width	= $('.ul-smart-tab-title-wrap', $this).width(),
				order_width = $('.ul-order-by-action', $this).outerWidth(true) + $('.ul-sort-order-action', $this).outerWidth(true),
				css			= '',
				length_wrap = $('.filter-tab-wrapper', $this).length;
				
			$this.attr('id', elm_index);			
			$('<style id="css-'+elm_index+'" type="text/css"></style>').appendTo('head');
			
			var css_tab_action = function(){
				title_width	= $('.ul-smart-tab-title-wrap', $this).outerWidth(true),
				order_width = $('.ul-order-by-action', $this).outerWidth(true) + $('.ul-sort-order-action', $this).outerWidth(true);
				
				if(title_width>0 && title_width!=null && window.innerWidth > 767){
					title_width = title_width + 10;
				}else{
					title_width = 0;
				};
				
				if(order_width>0 && order_width!=null){
					order_width = order_width + 30;
				}else{
					order_width = 0;	
				};
				
				css = '#'+elm_index+' .ul-filter-elements-wrap{min-width:calc(100% - '+title_width+'px); min-width:-webkit-calc(100% - '+title_width+'px); min-width:-ms-calc(100% - '+title_width+'px); min-width:-moz-calc(100% - '+title_width+'px);}#'+elm_index+' .ul-filter-elements-wrap .filter-tab-wrapper{min-width:calc((100% - '+order_width+'px) / '+length_wrap+'); min-width:-webkit-calc((100% - '+order_width+'px) / '+length_wrap+'); min-width:-ms-calc((100% - '+order_width+'px) / '+length_wrap+'); min-width:-moz-calc((100% - '+order_width+'px) / '+length_wrap+');}';				
				$('#css-'+elm_index).html(css);				
			};				
			
			css_tab_action();			
			$w.on('resize', css_tab_action);
					
			var nav = priorityNav.init({
				mainNavWrapper				: '#'+elm_index+' .filter-tab-wrapper',
				mainNav						: '.filter-tab-wrapper-list',
				navDropdownLabel			: '<span class="ul-responsive-button"><span></span><span></span><span></span>&nbsp;</span>',
				navDropdownBreakpointLabel	: '<span class="ul-responsive-button"><span></span><span></span><span></span>&nbsp;</span>',
				navDropdownClassName		: 'nav__dropdown',
				navDropdownToggleClassName	: 'nav__dropdown-toggle',	
				breakPoint					: 767,				
			});
        });/*smart tab*/
		
		/*social popup*/
		$(this).off('.clickSocialShareButton').on('click.clickSocialShareButton', '.ultimate-layouts-social-share-btn', function(event){			
			var $active_class = $(this).next('.ultimate-layouts-social-share');
			if($active_class.hasClass('active-elm')){
				$active_class.removeClass('active-elm');				
			}else{
				$('.ultimate-layouts-social-share').removeClass('active-elm');
				$active_class.addClass('active-elm');
			};
			event.stopPropagation();		
		});
		
		$(this).on('click.clickSocialShareButton', '.ultimate-layouts-social-share', function(event){
			event.stopPropagation();		
		});		
		
		$(this).on('click', function(){
			$('.ultimate-layouts-social-share.active-elm').removeClass('active-elm');
		});/*social popup*/
		
		$.ultimate_layouts_gridListAjax({});
		$.ultimate_layouts_contentBlock({});
		
		$.ultimate_layouts_carousel({});		
		$.ultimate_layouts_slider({});
		
		$.ultimateLayoutsLightBox({
			element_live		: document,
			element_control		: '.ultimate-layouts-control-lightbox-oc',
			element_wrap		: '.ultimate-layouts-wrapper-control',
			element_get_pic		: '.ultimate-layouts-get-pic',
			element_pic			: '.ultimate-layouts-img',
			element_icon		: '.ultimate-layouts-control-pop',
			alias_name			: '',
		});
		
		$(this).off('.clickOpenPostQuickView').on('click.clickOpenPostQuickView', '[data-open-post="ultimate-layouts-quick-view"]', function(event){
			var $this 			= $(this),
				$this_parent	= $this.parents('.ultimate-layouts-wrapper-control'),
				id				= $.trim($this_parent.attr('id')),
				post_id			= $.trim($this.attr('data-post-id')),
				quickview_class	= 'ul_quickview_p_'+(id),			
				paramsRequest 	= {
									'post_id':			post_id,
									'query_params':		ultimate_layouts_query_params[id],
									'filter':			ultimate_layouts_filter[id],
									'order':			ultimate_layouts_order[id],
									'orderby':			ultimate_layouts_orderby[id],
									'sub_opt_query':	ultimate_layouts_sub_opt_query[id],
									'options':			ultimate_layouts_options[id],
									'random_id':		id,
									'action':			'ultimatelayoutsajaxsingleaction',
								  };
				
				if($('.'+quickview_class).length==0){
					var html = '';
					html+='<div class="ultimate-layouts-container ul-quick-view-style '+(quickview_class)+'">';
					
					html+=	'<div class="ultimate-layouts-close-quickview"><svg viewbox="0 0 40 40"><path class="close-btn" d="M 10,10 L 30,30 M 30,10 L 10,30"/></svg></div>';
					html+=	'<div class="ultimate-layouts-overlay-quickview"></div>';
					html+=	'<div class="ultimate-layouts-loader">';
					html+=		'<div class="la-line-spin-clockwise-fade-rotating la-dark la-1x">';
					html+=			'<div></div>';
					html+=			'<div></div>';
					html+=			'<div></div>';
					html+=			'<div></div>';
					html+=			'<div></div>';
					html+=			'<div></div>';
					html+=			'<div></div>';
					html+=			'<div></div>';
					html+=		'</div>';
					html+=	'</div>';
					
					html+=	'<div class="ul-quick-view-content">';
					html+=		'<div class="ul-quick-view-body">';
					html+=		'</div>';
					html+=	'</div>';
					html+='</div>';
					$('body').append(html);
				};
				
				var $quickview_class 	= $('.'+quickview_class),
					active_id			= ((id)+(post_id)),
					$quickview_content 	= $('.ul-quick-view-content', $quickview_class);
					
				$quickview_class.addClass('active-elm').attr('data-active-id', active_id);
				
				if(!$quickview_content.hasClass('mCustomScrollbar')){
					$quickview_content.mCustomScrollbar({
						theme:"dark",
						autoHideScrollbar:true,
						mouseWheel:{scrollAmount:200},
						scrollInertia:300,					
					});	
				}else{
					$quickview_content.mCustomScrollbar("scrollTo", '0px');
				};
				$('html, body').on('scroll.stopScrollBody touchmove.stopScrollBody mousewheel.stopScrollBody', function(event){
					event.preventDefault();
					event.stopPropagation();
					return false;
				}); 
				$('.ultimate-layouts-overlay-quickview, .ultimate-layouts-close-quickview', $quickview_class).off('.ulRemoveQuickViewItem').on('click.ulRemoveQuickViewItem', function(event){					
					$quickview_class.removeClass('active-elm').attr('data-active-id', '');
					$quickview_content.removeClass('active-elm');
					$('html, body').off('.stopScrollBody');
				});
				$.ajax({
					url:		ultimate_layouts_ajax_url[id],						
					type: 		'POST',
					data:		paramsRequest,
					dataType: 	'html',
					cache:		false,
					success: 	function(data){												
						if(data!='' && data!='0'){
							if(active_id!=$quickview_class.attr('data-active-id')){
								return;
							};						
							$('.ul-quick-view-body', $quickview_class).html(data);
							$quickview_content.addClass('active-elm');							
						}else{							
						};
					},
					error:		function(){
					},
				});	
		});	
		
		$(this).on('mouseenter', '.ul-action-get-big-post', function(){
			var $this = $(this);
			var $elm_parent = $this.parents('.ul-block-content-item');
			var $elm_big = $('.ul-cb-style-large', $elm_parent);
			$elm_parent.find('.ul-action-get-big-post').removeClass('ul-active-big-post-class');
			$this.addClass('ul-active-big-post-class');
			$elm_big.find('.ultimate-layouts-item').hide();
			$elm_big.find('.ultimate-layouts-item').eq($this.index()).show();
		});
		
		$(this).on('click', '.ultimate-layouts-btn-gallery', function(event){
			var	$this 				= $(this),
				$_wrap 				= $this.parents('.ultimate-layouts-wrapper-control');				
			$_wrap.find('.ultimate-layouts-item:first-child .ultimate-layouts-control-lightbox-oc').trigger('click');
		});
		
		/*$.ultimate_layouts_switch_view();*/
	});
	
}(jQuery, jQuery(window), jQuery(document), window, document));