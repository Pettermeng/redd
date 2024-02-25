<?php
/**
* The Template for displaying post.
* This template can be overridden by copying it to ' yourtheme/ul-templates/12-sync-slider/1.php '.
*
* HOWEVER, on occasion Ultimate Layouts will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*/

$sync_slider_bc.=	'<article class="ultimate-layouts-item hentry"> 
						<div class="ultimate-layouts-entry-wrapper entry-content">
							<div class="ultimate-layouts-picture">              
								<div class="ultimate-layouts-picture-wrap ultimate-layouts-get-pic">
									'.$post_image_background.$post_overlay.$post_icon.'              
									<div class="ultimate-layouts-absolute-content">                
									'.$post_taxonomy_absolute.$post_title_white_f24.$post_metas_1_silver.$ul_geodir_get_rating_stars.$post_metas_2.'
									</div>                 
								</div>                                                   
							</div>
						</div>        
					</article>';
$sync_slider_sc.=	'<article class="ultimate-layouts-item hentry">
						<div class="ultimate-layouts-img-ab">'.$post_image_small_cb_bg.'</div>
						<div class="ultimate-layouts-entry-wrapper entry-content">
							<div class="ultimate-layouts-content entry">    
								'.$post_taxonomy_small.$post_title_small.$post_metas_1_small.$ul_geodir_get_rating_stars.'                           
							</div>
						</div>           
					</article>';

if($i==$allItemsPerPage || ($sub_opt_query['paged']==$paged_calculator && $i==$percentItems)){
	?>
    	<div class="ul-big-slider-wrapper">
        
        	<div class="pagination-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
            <div class="pagination-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
            
        	<div class="ul-big-slider-content">
            	<?php echo $sync_slider_bc;?>
			</div>
        </div>
    	
		<div class="ul-small-slider-wrapper <?php echo $cc_mobile.$cc_portrait_tablet.$cc_landscape_tablet.$cc_small_desktop.$cc_medium_desktop.$cc_large_desktop.$cc_extra_large_desktop?>">
        	
            <div class="pagination-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
            <div class="pagination-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
            
        	<div class="ul-small-slider-content">
            	<?php echo $sync_slider_sc;?>
			</div>
        </div>
	<?php
}
