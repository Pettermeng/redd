<?php
if(!class_exists('my_ultimateLayouts_bete_query')){
	class my_ultimateLayouts_bete_query{
		static function build_query($query_params=array(), $filter = '', $order = 'DESC', $orderby='date', $sub_opt_query = array(), $return_tt_post = false){
			$query_filter = array();
			if($filter!=''){
				$filter = explode(',', $filter);
				foreach($filter as $i_filter){	
					if(is_numeric(trim($i_filter))){					
						array_push($query_filter, trim($i_filter));
					}
				}
			}
			
			$query = 	array(	
							'post_status' 			=> 'publish',
							'ignore_sticky_posts'	=> 1,						
						);
			
			//post types
			$query['post_type'] = 'post';
			$multi_post_types = array();
			$post_types = explode(',', $query_params['post_types']);			
			foreach($post_types as $post_type){	
				if(trim($post_type)!=''){					
					array_push($multi_post_types, trim($post_type));
				}
			}			
			if(is_array($multi_post_types) && !empty($multi_post_types) && count($multi_post_types)>0){
				$query['post_type'] = $multi_post_types;
			}
			
			if($query_params['post_types']=='attachment'){
				$query['post_status'] = 'inherit';
				$query['post_mime_type'] = 'image/jpeg,image/gif,image/jpg,image/png';				
				
				//Post In
				$attachment_to_array=array();
				if(isset($query_params['i_attachment']) && trim($query_params['i_attachment'])!=''){
					$param_attachment = explode(',', trim($query_params['i_attachment']));				
					foreach($param_attachment as $attachment_item_arr){	
						if(is_numeric(trim($attachment_item_arr))){			
							array_push($attachment_to_array, trim($attachment_item_arr));
						}
					}			
					if(is_array($attachment_to_array) && !empty($attachment_to_array) && count($attachment_to_array)>0){							
						$query['post__in'] = $attachment_to_array;			
					}		
				}//Post In
				
			}			
			//post types
			
			//posts per page
			if((int)$query_params['posts_per_page'] > (int)$query_params['post_count'] && $query_params['post_count']!=-1){
				$query['posts_per_page'] = $query_params['post_count'];
			}else{
				$query['posts_per_page'] = $query_params['posts_per_page'];
			};
			//posts per page
			
			$include_children = (isset($query_params['query_include_children']) && $query_params['query_include_children']=='0')?false:true;
			if(isset($sub_opt_query['query_children_taxs']) && $sub_opt_query['query_children_taxs']=='yes'){
				$include_children = false;
			}
			$taxonomies = explode(',', $query_params['taxonomies']);
			
			//Included
			$i_taxonomies_arr = array();
			$i_taxonomies = explode(',', $query_params['i_taxonomies']);			
			foreach($i_taxonomies as $i_taxonomy){	
				if(is_numeric(trim($i_taxonomy))){					
					array_push($i_taxonomies_arr, trim($i_taxonomy));
				}
			}
			
			//EXCLUDE
			$e_taxonomies_arr = array();
			$e_taxonomies = explode(',', $query_params['e_taxonomies']);			
			foreach($e_taxonomies as $e_taxonomy) {		
				if(is_numeric(trim($e_taxonomy))){					
					array_push($e_taxonomies_arr, trim($e_taxonomy));
				}
			}
			
			//Taxonomies
			if(($query_params['i_taxonomies']!='' || $query_params['e_taxonomies']!='') && count($query_filter)==0){
				if($query_params['query_types']=='0'){	
					$def = array(
						'field' => 'id',
						'operator' => 'IN',					
						'include_children' => $include_children,
					);
					
					//Included					
					if(is_array($i_taxonomies_arr) && !empty($i_taxonomies_arr) && count($i_taxonomies_arr)>0){
						if(count($taxonomies)==1 && $query_params['cq_operator']==1){
							$args = array('relation' => 'AND');	
							foreach($i_taxonomies_arr as $cq_and_taxonomy){
								if(trim($cq_and_taxonomy)!=''){
									$args[] = wp_parse_args(
										array(
											'taxonomy'	=>trim($taxonomies[0]),
											'terms'		=>trim($cq_and_taxonomy),
										),
										$def
									);
								}
							}											
						}else{
							$args = array('relation' => 'OR');	
							foreach($taxonomies as $taxonomy){
								if(trim($taxonomy)!=''){
									$args[] = wp_parse_args(
										array(
											'taxonomy'	=>trim($taxonomy),
											'terms'		=>$i_taxonomies_arr,
										),
										$def
									);
								}
							}
						}
					}//Included
				}elseif($query_params['query_types']=='1'){	
					$def = array(
						'field' => 'id',
						'operator' => 'NOT IN',					
						'include_children' => $include_children,
					);	
					$args = array('relation' => 'AND');	
							
					//EXCLUDE					
					if(is_array($e_taxonomies_arr) && !empty($e_taxonomies_arr) && count($e_taxonomies_arr)>0){
						foreach($taxonomies as $taxonomy){
							if(trim($taxonomy)!=''){
								$args[] = wp_parse_args(
									array(
										'taxonomy'	=>trim($taxonomy),
										'terms'		=>$e_taxonomies_arr,
									),
									$def
								);
							}
						}
					}//EXCLUDE
				}elseif($query_params['query_types']=='3'){	
					
					$def_iq = array(
						'field' => 'id',
						'operator' => 'IN',					
						'include_children' => $include_children,
					);
					
					$def_niq = array(
						'field' => 'id',
						'operator' => 'NOT IN',					
						'include_children' => $include_children,
					);
						
					$args = array('relation' => 'AND');	
							
					foreach($taxonomies as $taxonomy){
						
						$df_include = array();
						$df_exclude = array();
						
						if(trim($taxonomy)!=''){							
							
							/*default include*/
							foreach($i_taxonomies_arr as $id){
								$term = get_term_by('id', $id, trim($taxonomy));
								
								if(!is_wp_error($term) && !empty($term) && isset($term->taxonomy) && $term->taxonomy==trim($taxonomy)){								
									array_push($df_include, $term->term_id);								
								}
							}
							
							if(sizeof($df_include)>0){
								$args[] = wp_parse_args(
									array(
										'taxonomy'	=>trim($taxonomy),
										'terms'		=>$df_include,
									),
									$def_iq
								);
							}/*default include*/
							
							/*default exclude*/
							foreach($e_taxonomies_arr as $id){
								$term = get_term_by('id', $id, trim($taxonomy));
								
								if(!is_wp_error($term) && !empty($term) && isset($term->taxonomy) && $term->taxonomy==trim($taxonomy)){								
									array_push($df_exclude, $term->term_id);								
								}
							}
							
							if(sizeof($df_exclude)>0){
								$args[] = wp_parse_args(
									array(
										'taxonomy'	=>trim($taxonomy),
										'terms'		=>$df_exclude,
									),
									$def_niq
								);
							}/*default exclude*/
						}
					}
				}
				
				$query['tax_query']=$args;	
			}			
			//Taxonomies
			
			//Filter
			$query_operator = '0';
			if(isset($sub_opt_query['query_operator']) && $sub_opt_query['query_operator']=='1'){
				//echo $sub_opt_query['query_relation'];die;
				$query_operator = '1';
			}
			$default_operator = 'IN';
			if(count($query_filter)>1 && $query_operator == '1'){
				$default_operator = 'AND';
			}
			
			$query_relation = '0';
			if(isset($sub_opt_query['query_relation']) && $sub_opt_query['query_relation']=='1'){
				//echo $sub_opt_query['query_relation'];die;
				$query_relation = '1';
			}
			$default_relation = 'OR';
			if((count($query_filter)>1 && $query_relation == '1') || (count($query_filter)>=1 && $query_relation == '1' && count($e_taxonomies_arr)>0) || (count($query_filter)>=1 && $query_relation == '1' && count($i_taxonomies_arr)>0)){
				$default_relation = 'AND';
			}
			
			if(count($query_filter)>0){
				$def = array(
					'field' => 'id',
					'operator' => $default_operator,					
					'include_children' => $include_children,
				);
				
				$def_i = array(
					'field' => 'id',
					'operator' => 'IN',					
					'include_children' => $include_children,
				);
				
				$def_ni = array(
					'field' => 'id',
					'operator' => 'NOT IN',					
					'include_children' => $include_children,
				);
					
				$args = array('relation' => $default_relation);				
							
				foreach($taxonomies as $taxonomy){
					$tax_filter = array();
					$df_include = array();
					$df_exclude = array();
					
					if(trim($taxonomy)!=''){						
						
						foreach($query_filter as $id){
							$term = get_term_by('id', $id, trim($taxonomy));
							
							if(!is_wp_error($term) && !empty($term) && isset($term->taxonomy) && $term->taxonomy==trim($taxonomy)){								
								array_push($tax_filter, $term->term_id);								
							}
						}
						
						if(sizeof($tax_filter)>0){
							$args[] = wp_parse_args(
								array(
									'taxonomy'	=>trim($taxonomy),
									'terms'		=>$tax_filter,
								),
								$def
							);
						}
						
						/*default include*/
						foreach($i_taxonomies_arr as $id){
							$term = get_term_by('id', $id, trim($taxonomy));
							
							if(!is_wp_error($term) && !empty($term) && isset($term->taxonomy) && $term->taxonomy==trim($taxonomy)){								
								array_push($df_include, $term->term_id);								
							}
						}
						
						if(sizeof($df_include)>0 && sizeof(array_intersect($tax_filter, $df_include))==0){
							$args[] = wp_parse_args(
								array(
									'taxonomy'	=>trim($taxonomy),
									'terms'		=>$df_include,
								),
								$def_i
							);
						}/*default include*/
						
						/*default exclude*/
						foreach($e_taxonomies_arr as $id){
							$term = get_term_by('id', $id, trim($taxonomy));
							
							if(!is_wp_error($term) && !empty($term) && isset($term->taxonomy) && $term->taxonomy==trim($taxonomy)){								
								array_push($df_exclude, $term->term_id);								
							}
						}
						
						if(sizeof($df_exclude)>0){
							$args[] = wp_parse_args(
								array(
									'taxonomy'	=>trim($taxonomy),
									'terms'		=>$df_exclude,
								),
								$def_ni
							);
						}/*default exclude*/
					}
				}
				
				$query['tax_query']=$args;
			}
			//Filter
			
			if($query_params['query_types']=='0' || $query_params['query_types']=='1'){
				//Post Not In
				$excludeids_to_array=array();
				if(isset($query_params['e_ids']) && trim($query_params['e_ids'])!=''){
					$param_excludeids = explode(',', trim($query_params['e_ids']));				
					foreach($param_excludeids as $excludeids_item_arr){	
						if(is_numeric(trim($excludeids_item_arr))){			
							array_push($excludeids_to_array, trim($excludeids_item_arr));
						}
					}				
					if(is_array($excludeids_to_array) && !empty($excludeids_to_array) && count($excludeids_to_array)>0){											
						$query['post__not_in'] = $excludeids_to_array;				
					}		
				}//Post Not In
			}
			
			if($query_params['query_types']=='2'){
				//Post In
				$ids_to_array=array();
				if(isset($query_params['i_ids']) && trim($query_params['i_ids'])!=''){
					$param_ids = explode(',', trim($query_params['i_ids']));				
					foreach($param_ids as $id_item_arr){	
						if(is_numeric(trim($id_item_arr))){			
							array_push($ids_to_array, trim($id_item_arr));
						}
					}			
					if(is_array($ids_to_array) && !empty($ids_to_array) && count($ids_to_array)>0){							
						$query['post__in'] = $ids_to_array;			
					}		
				}//Post In
			}
			
			//Author
			if(isset($query_params['query_author']) && trim($query_params['query_author'])!=''){
				$query['author'] 	= trim($query_params['query_author']);
			}
			
			//Order	
			$query['orderby'] 	= $orderby;
			if($orderby!='date' && $orderby!='_price' && $orderby!='total_sales' && $orderby!='_wc_average_rating'){
				$query['orderby'] 	= $orderby.' date';
			}elseif($orderby=='_price'){
				$query['meta_key'] = '_price';
				$query['orderby']  = 'meta_value_num';
			}
			elseif($orderby=='total_sales'){
				$query['meta_key'] = 'total_sales';
				$query['orderby']  = 'meta_value_num';
			}
			elseif($orderby=='_wc_average_rating'){
				$query['meta_key'] = '_wc_average_rating';
				$query['orderby']  = 'meta_value_num';
			}
			if(($orderby=='meta_value' || 'meta_value_num') && $sub_opt_query['meta_key_query']!=''){
				$query['meta_key'] 	= $sub_opt_query['meta_key_query'];
			}
			$query['order'] 		= $order;
			
			//offset
			if($query_params['query_offset']!='' && $query_params['query_offset']>0){
				$query['offset'] = $query_params['query_offset'];
			}
			
			//today
			if($query_params['today_post']=='1' && $query_params['datetime_meta']==''){
				$today = getdate();
				$query['date_query'] = array(
					array(
						'year'  => $today['year'],
						'month' => $today['mon'],
						'day'   => $today['mday'],
					),
				);
			}
			
			if($query_params['today_post']=='2' && $query_params['datetime_meta']==''){
				$yesterday = date("Y-m-d", strtotime("yesterday"));
				$query['date_query'] = array(
					'after' => $yesterday,
				);
			}
			
			if(($query_params['today_post']=='1' || $query_params['today_post']=='2') && $query_params['datetime_meta']!=''){
				$today = getdate();
				$compare = '=';
				$fn_day = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
				if($query_params['today_post']=='2'){
					$compare = '>=';					
				}
				$query['meta_query'] = array(
					'relation' => 'AND',
					array(
						'key' 			=> $query_params['datetime_meta'],
						'value' 		=> $fn_day,
						'compare' 		=> $compare,
						'type' 			=> 'datetime'
					),
				);
			}
			
			$withinTime = '-36 hours';
			switch($query_params['today_post']){
				case '3':
					$withinTime = '-36 hours';
					break;
				case '4':
					$withinTime = '-48 hours';
					break;
				case '5':
					$withinTime = '-60 hours';
					break;
				case '6':
					$withinTime = '-72 hours';
					break;
			}
			
			$basicDate = date("Y-m-d H:i:s", strtotime($withinTime));
			
			if(($query_params['today_post']=='3' || $query_params['today_post']=='4' || $query_params['today_post']=='5' || $query_params['today_post']=='6') && $query_params['datetime_meta']==''){				
				$query['date_query'] = array(
					'after' => $basicDate,
				);
			}
			
			if(($query_params['today_post']=='3' || $query_params['today_post']=='4' || $query_params['today_post']=='5' || $query_params['today_post']=='6') && $query_params['datetime_meta']!=''){				
				$query['meta_query'] = array(
					'relation' => 'AND',
					array(
						'key' 			=> $query_params['datetime_meta'],
						'value' 		=> $basicDate,
						'compare' 		=> '>=',
						'type' 			=> 'datetime'
					),
				);
			}
			
			if($query_params['today_post']=='0' && $query_params['woo_query']=='1'){	
				$query['meta_query'] = array(
					'relation' => 'OR',
					array( // Simple products type
						'key'           => '_sale_price',
						'value'         => 0,
						'compare'       => '>',
						'type'          => 'numeric'
					),
					array( // Variable products type
						'key'           => '_min_variation_sale_price',
						'value'         => 0,
						'compare'       => '>',
						'type'          => 'numeric'
					)
				);
			}
			
			//Pages
			$query['paged'] 		= $sub_opt_query['paged'];
						
			$newQuery = new WP_Query($query);
			//print_r($query);die;
			//echo('<pre>'.$newQuery->request.'</pre>');die;
			
			if($return_tt_post==true){
				$totalCountPosts = 	($newQuery->found_posts);
				if(isset($query_params['post_count']) && is_numeric($query_params['post_count']) && $query_params['post_count']!=-1) {
					if($totalCountPosts > (int)($query_params['post_count'])) {
						$totalCountPosts = $query_params['post_count'];
					};
				};
				wp_reset_postdata();
				return $totalCountPosts;
			}else{
				return $newQuery;	
			}
		}
		
		static function reset_data(){
			wp_reset_postdata();
		}	
	}
}