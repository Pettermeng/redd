<?php
/**
* The Template for displaying post.
* This template can be overridden by copying it to ' yourtheme/ul-templates/01-carousel-f/0.php '.
*
* HOWEVER, on occasion Ultimate Layouts will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*/
?>
<?php if($i==1 || ($i-1)%7==0){?>
	<?php if($i!=1){?>
		</div>
	<?php }?>  
	<div class="ul-sub-colum-large ul-column-items <?php echo 'step-elms-'.$i;?>">
<?php }elseif($i==2 || ($i-2)%7==0){?>
	</div>
	<div class="ul-sub-colum-small ul-column-items <?php echo 'step-elms-'.$i;?>">
<?php }elseif($i==4 || ($i-4)%7==0){?>
	</div>
	<div class="ul-sub-colum-small ul-column-items <?php echo 'step-elms-'.$i;?>">
<?php }elseif($i==6 || ($i+1)%7==0){?>
	</div>
	<div class="ul-sub-colum-small ul-column-items <?php echo 'step-elms-'.$i;?>">
<?php }?>
    <!--post item--> 
    <article class="ultimate-layouts-item hentry" data-server-index="<?php echo $i;?>">
        <!--entry content-->
        <div class="ultimate-layouts-entry-wrapper entry-content">    
            <!--picture-->
            <?php if($post_image!='' && $s_image==true){?>
                <div class="ultimate-layouts-picture">              
                    <div class="ultimate-layouts-picture-wrap ultimate-layouts-get-pic">
                        <?php echo $post_image;?>                
                        <?php echo $post_overlay;?>
                        <?php echo $post_icon;?>                
                        <div class="ultimate-layouts-absolute-content">                
                            <?php echo $post_taxonomy_absolute;?>                
                            <?php echo $post_title_white_f16;?>                    
                            <?php echo $post_metas_1_silver;?>
                            <?php echo $ul_geodir_get_rating_stars;?> 
                        </div>                 
                    </div>                                                   
                </div>
            <?php }?>  
            <!--picture-->      
            <!--content-->  
            <?php if($post_image=='' || $s_image==false){?>      
                <div class="ultimate-layouts-content entry">
                    <?php
                        echo $post_taxonomy;
                        echo $post_title_f16;
                        echo $post_metas_1;
						echo $ul_geodir_get_rating_stars; 
                    ?>                   
                </div><!--content-->    
            <?php }?>                             
        </div><!--entry content-->            
    </article><!--post item-->
<?php if($i==$countPosts){?>
	</div>
<?php }?>  