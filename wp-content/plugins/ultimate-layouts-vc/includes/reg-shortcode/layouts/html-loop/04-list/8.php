<?php
/**
* The Template for displaying post.
* This template can be overridden by copying it to ' yourtheme/ul-templates/04-list/8.php '.
*
* HOWEVER, on occasion Ultimate Layouts will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*/
?>
<!--post item--> 
<article class="ultimate-layouts-item hentry">
    <!--entry content-->
    <div class="ultimate-layouts-entry-wrapper entry-content">    
        <!--picture-->
        <?php if($post_image!='' && $s_image==true){?>
            <div class="ultimate-layouts-picture">               
                <div class="ultimate-layouts-picture-wrap ultimate-layouts-get-pic">
                    <?php echo $post_image_background;?>                
                    <?php echo $post_overlay;?>
                    <?php echo $post_icon;?>
                </div>            
                <?php echo $post_taxonomy_absolute;?>                            
            </div>
        <?php }?>
        <!--picture-->        
        <!--content-->
        <div class="ultimate-layouts-content entry">
            <?php if($post_image=='' || $s_image==false){
				echo $post_taxonomy;
			}?>            
            <?php echo $post_title_f24;?>            
            <?php echo $post_metas_1;?>    
            <?php echo $ul_geodir_get_rating_stars;?>        
            <?php echo $post_excerpt;?>
            <?php echo $wooBasicElmBlock;?>                                        
            <?php echo $post_metas_2;?>             
        </div><!--content-->               
    </div><!--entry content-->            
</article><!--post item-->