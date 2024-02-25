<?php
/**
* The Template for displaying post.
* This template can be overridden by copying it to ' yourtheme/ul-templates/05-creative/1.php '.
*
* HOWEVER, on occasion Ultimate Layouts will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*/
?>
<?php 
$class_item_creative = '';
if($i%2!=0){
	$post_image	= my_ultimateLayouts_elements::ultimateLayouts_thumbnail($post_id, '400x600_ul_grid_2_3_1x', $img_tag_link, $s_image_link_target, $quick_view, $quick_view_mode, false, '', $lazyloadParams, $postFormatParams);
	$class_item_creative = ' ul-padding-top-large';
}else{
	$post_image	= my_ultimateLayouts_elements::ultimateLayouts_thumbnail($post_id, '400x300_ul_grid_4_3_1x', $img_tag_link, $s_image_link_target, $quick_view, $quick_view_mode, false, '', $lazyloadParams, $postFormatParams);
}
?>
<!--post item--> 
<article class="ultimate-layouts-item hentry">
    <!--entry content-->
    <div class="ultimate-layouts-entry-wrapper entry-content">    
        <!--picture-->        
        <div class="ultimate-layouts-picture">               
            <div class="ultimate-layouts-picture-wrap ultimate-layouts-get-pic <?php echo $class_item_creative.$class_item_position.$class_visible_content;?>">
                <?php if($post_image!='' && $s_image==true){?>
                    <?php echo $post_image;?> 
                <?php }?>
                <?php echo $post_overlay;?>                                  
                <?php
				if($show_elements=='1' || $show_elements=='2'){ 
					echo $post_icon;
				}				
				if($show_elements=='0' || $show_elements=='2'){
				?>                            
                    <div class="ultimate-layouts-absolute-content">                
                        <?php echo $post_taxonomy;?>                
                        <?php echo $post_title;?>
                        <?php echo $post_metas_1;?>             
                    </div> 
                <?php }?>                
            </div>                                                   
        </div>            
        <!--picture-->                                        
    </div><!--entry content-->            
</article><!--post item-->