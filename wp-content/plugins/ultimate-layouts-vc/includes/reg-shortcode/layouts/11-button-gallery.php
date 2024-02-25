<?php
$post_image = my_ultimateLayouts_elements::ultimateLayouts_thumbnail($post_id, 'medium', $img_tag_link, $s_image_link_target, $quick_view, $quick_view_mode, false, '', $lazyloadParams, $postFormatParams)
?>
<!--post item--> 
<article class="ultimate-layouts-item hentry">
    <!--entry content-->
    <div class="ultimate-layouts-entry-wrapper entry-content">
        <!--picture-->
        <?php if($post_image!='' && $s_image==true){?>
            <div class="ultimate-layouts-picture">
                <div class="ultimate-layouts-picture-wrap ultimate-layouts-get-pic">                	                    
                    <?php echo $post_image;?>
                    <?php echo $post_icon;?>                    
                </div>                
            </div>
        <?php }?>    
        <!--picture-->
    </div><!--entry content-->            
</article> <!--post item-->