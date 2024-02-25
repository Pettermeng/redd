<?php
//Function Generate Pagination
	function gen_pagination($tblName,$page,$per_page,$where='', $groupby){
		global $wpdb;
		//include("pagination_css.php");
		//$page = $_POST['page'];
		if($page=='') $page=1;
		if($page!='')
		{   
			$cur_page = $page;
			$page -= 1;
			$per_page = 20;
			$previous_btn = true;
			$next_btn = true;
			$first_btn = true;
			$last_btn = true;
			$start = $page * $per_page;
			$i=$start;
			//$pros = $wpdb->get_results("SELECT * FROM tblprovince ORDER BY id limit ".$start.",".$per_page);
			
			$limit_val = $start.",".$per_page;
			
			//echo "SELECT count(*) FROM ".$tblName." ".$where." GROUP BY p.ID;";
			if($groupby !=''){
				$wpdb->get_results("SELECT COUNT(*) FROM ".$tblName." ".$where." ".$groupby.";");//echo $per_page;
				$numrow = $wpdb->num_rows;
			}else{
				$numrow=$wpdb->get_var("SELECT COUNT(*) FROM ".$tblName." ".$where.";");//echo $per_page;
			}
			
			#$wpdb->get_results("SELECT COUNT(*) FROM ".$tblName." ".$where.";");//echo $per_page;
			
			#$numrow = $wpdb->num_rows;
			
			if($numrow<=0) return;
			$no_of_paginations = ceil($numrow / $per_page);
			if ($cur_page >= 3) {
				$start_loop = $cur_page - 1;
				if ($no_of_paginations > $cur_page + 1)
					$end_loop = $cur_page + 1;
				else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 2) {
					$start_loop = $no_of_paginations - 2;
					$end_loop = $no_of_paginations;
				} else {
					$end_loop = $no_of_paginations;
				}
			} else {
				$start_loop = 1;
				if ($no_of_paginations > 3)
					$end_loop = 3;
				else
					$end_loop = $no_of_paginations;
			}
			$msg .="<div class='pull-right pagination'>";
			$msg .= "<div class='pagination_num'>";
			$msg .= "<ul class='pagination'>";
			
			// FOR ENABLING THE FIRST BUTTON
			if ($first_btn && $cur_page > 1) {
				$msg .= "<li p='1' class='page-number inactive' title='First'><a href='javascript:void(0)'>&laquo;</a></li>";
			} else if ($first_btn) {
				$msg .= "<li p='1' class='page-number' title='First'><a href='javascript:void(0)'>&laquo;</a></li>";
			}
			
			// FOR ENABLING THE PREVIOUS BUTTON
			if ($previous_btn && $cur_page > 1) {
				$pre = $cur_page - 1;
				$msg .= "<li p='$pre' class='page-number inactive' title='Previous'><a href='javascript:void(0)'>&lsaquo;</a></li>";
			} else if ($previous_btn) {
				$msg .= "<li class='page-number' title='Previous'><a href='javascript:void(0)'>&lsaquo;</a></li>";
			}
			for ($z = $start_loop; $z <= $end_loop; $z++) {
			
				if ($cur_page == $z)
					$msg .= "<li p='$z' class='page-number active'><a href='javascript:void(0)'>{$z}</a></li>";
				else
					$msg .= "<li p='$z' class='page-number inactive'><a href='javascript:void(0)'>{$z}</a></li>";
			}
			
			// TO ENABLE THE NEXT BUTTON
			if ($next_btn && $cur_page < $no_of_paginations) {
				$nex = $cur_page + 1;
				$msg .= "<li p='$nex' class='page-number inactive' title='Previous'><a href='javascript:void(0)'>&rsaquo;</a></li>";
			} else if ($next_btn) {
				$msg .= "<li class='page-number' title='Previous'><a href='javascript:void(0)'>&rsaquo;</a></li>";
			}
			
			// TO ENABLE THE END BUTTON
			if ($last_btn && $cur_page < $no_of_paginations) {
				$msg .= "<li p='$no_of_paginations' class='page-number inactive' title='Last'><a href='javascript:void(0)'>&raquo;</a></li>";
			} else if ($last_btn) {
				$msg .= "<li p='$no_of_paginations' class='page-number' title='Last'><a href='javascript:void(0)'>&raquo;</a></li>";
			}
			//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button button-secondary' value='Go'/>";
			$msg .="</ul>";
			$msg .= "</div>";// Content for pagination
			$msg .= "</div>";//END PAGINATION
			
			$msg .= "<div class='pull-right pagination-detail'>";
			//$total_string = "<span class='total' a='$no_of_paginations'>បង្ហាញ <b>" . ($start + 1) ." - ".($start+$per_page)."</b> នៃ <b>$numrow</b></span>";
			$total_string = "<span class='total pagination-info' a='$no_of_paginations'>( Total: ".$numrow." ) Page <b>".$cur_page."</b> Of <b>$no_of_paginations</b></span>";
			$msg = $msg . $goto . $total_string."&nbsp;&nbsp;";
			//$msg .= "<div id=\"curPage\" style=\"display:none;\">".$cur_page."</div>";
			$msg .= "</div>";
		}//End If $page!=''
		
		echo $msg;
		return $limit_val;
	} //End Function gen_pagination
	?>