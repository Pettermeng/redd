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
	if(class_exists('WPBMap')){
		WPBMap::addAllMappedShortcodes();
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