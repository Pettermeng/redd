<?php
/*
Plugin Name: List Sub Category
Description: List Sub Category in Widget
Author: Cam Info Services
Version: 1.0
Author URI: http://www.caminfoservices.com
*/
?>
<?php 
add_action('widgets_init', 'subcat_widget_class');
function subcat_widget_class(){register_widget('subcat_Class');}

class subcat_Class extends WP_Widget {
	function subcat_Class() {
		$widget_ops = array( 'classname' => 'subcat_widget','description' => __('For Widget only', 'archives_widget') );
		$this->WP_Widget( 'subcat_widget', __('List Sub Category', 'subcat_widget'), $widget_ops);
	}//End visitors_count
	
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'cat_id' => '') );
		$instance['title'] 		= strip_tags( $instance['title'] );
		$instance['cat_id']		= strip_tags( $instance['cat_id'] );
		?>
        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('cat_id'); ?>">Category ID: </label>
        <input class="widefat" id="<?php echo $this->get_field_id('cat_id'); ?>" 
        name="<?php echo $this->get_field_name('cat_id'); ?>" type="text" value="<?php echo $instance['cat_id']; ?>" />
        </p>
	<?php } //End form
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = $instance['title'];
		$catID = $instance['cat_id'];
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;
		list_subcat($catID);
		echo $after_widget;
	} //End widget
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;	
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['cat_id'] 	= strip_tags( $new_instance['cat_id'] );
		return $instance;
	} //End function update
	
}// End class listCat_Class
function list_subcat($catID){
		global $post;
        global $wp_query;
		$catID;
		$args = array(
			'depth'        => 0,
			'child_of'     => $catID,
			'exclude'      => '',
			'title_li'     => __(''),
			'echo'         => 1,
			'hide_empty'		=>0,
			'sort_column'  => 'menu_order, post_title'
		);
		?>
        <style>
			.pageitem li{
				background:none;
				padding:10px 0 10px 15px !important;
				border-bottom: 1px solid #CCCCCC;
				border-top: 1px solid #CCCCCC;
				margin-top: -3px !important;
			}
			.current_page_item a{color:#960100 !important;}
			.pageitem li a{color:#084aa8;}
			.pageitem{
				padding-top: 10px !important;
			}
		</style>
        <ul class="pageitem">
        <?php wp_list_categories($args);?>
		</ul>
<?php }?>
