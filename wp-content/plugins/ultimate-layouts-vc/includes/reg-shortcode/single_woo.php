<?php
if($post_taxonomy!=''){
?>
	<div class="ul-single-taxonomies">
		<?php echo $post_taxonomy;?>
	</div>
<?php 
}
if($post_title!=''){?>
    <div class="ul-single-post-title">
        <?php echo $post_title;?>
    </div>
<?php 
}
if($post_metas_1!=''){
?>
    <div class="ul-single-post-metas">
        <?php echo $post_metas_1;?>
    </div>
<?php	
}

	echo '<div class="ul-single-woocommerce">';
		//woo elm
		$_get_post			= $query->post;						
		$product 			= function_exists('wc_get_product')?wc_get_product($post_id):get_product($post_id);		
		echo my_ultimateLayouts_elements::woo_elm_basic($product, $_get_post, true, $qv_woo_show_rating, true);	
		//woo elm
	echo '</div>';
	
if($image_feature!='' && $qv_s_featured_image){
	echo '<div class="ul-single-feature-img"><img src="'.$image_feature.'" alt="'.strip_tags(get_the_title()).'"></div>';
}
if($qv_show_content){
?>
<div class="ul-single-post-content">
	<?php 
	if($qv_content_stripsc){
		add_filter('the_content', 'strip_shortcodes');		
	}
	the_content();		
	?>
</div>
<?php
}
 if($qv_show_share){?>
    <div class="ul-single-post-share">
        <?php echo my_ultimateLayouts_elements::get_social_share($post_id, array('facebook'=>true, 'twitter'=>true, 'google'=>true, 'linkedIn'=>true, 'tumblr'=>true, 'pinterest'=>true, 'vk'=>true, 'email'=>true,));?>
    </div>
<?php
}