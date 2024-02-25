<?php
/*
Plugin Name: List Sub Page && Get Gallery Images By post/page ID
Description: List Sub Page in Widget
Version: 1.0
*/
?>
<?php 
define('show_subpage_url', WP_PLUGIN_URL.'/show_subpage');
add_action('widgets_init', 'subpage_widget_class');
function subpage_widget_class(){register_widget('subpage_Class');}

class subpage_Class extends WP_Widget {
	function subpage_Class() {
		$widget_ops = array( 'classname' => 'subpage_widget','description' => __('For Widget only', 'archives_widget') );
		$this->WP_Widget( 'subpage_widget', __('List Sub Page', 'subpage_widget'), $widget_ops);
	}//End visitors_count
	
	/*function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'page_id' => '') );
		$instance['title'] 		= strip_tags( $instance['title'] );
		$instance['page_id']	= strip_tags( $instance['page_id'] );*/
	
        /*<p>
        <label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('page_id'); ?>">Parent Page ID: </label>
        <input class="widefat" id="<?php echo $this->get_field_id('page_id'); ?>" 
        name="<?php echo $this->get_field_name('page_id'); ?>" type="text" value="<?php echo $instance['page_id']; ?>" />
        </p>
 		}*/
	
	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		if ( $title ) echo $before_title . '' . $after_title;
		list_subpage();
		echo $after_widget;
	} //End widget
	
	/*function update( $new_instance, $old_instance ) {
		$instance = $old_instance;	
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['page_id'] 	= strip_tags( $new_instance['page_id'] );
		return $instance;
	}*/ //End function update
	
}// End class listCat_Class

function wpdocs_is_subpage() {
	// Load details about this page.
	$post = get_post();
	
	// test to see if the page has a parent
	if ( is_page() && $post->post_parent ) {
		// Return the ID of the parent post.
		return $post->post_parent;
	// There is no parent so ...
	} else {
		// ... The answer to the question is false
			return false;
	}
}

function list_subpage(){
		global $post;
        global $wp_query;
		if ($post->post_parent)	{
			$ancestors = get_post_ancestors($post->ID);
			$root = count($ancestors)-1;
			$parent = $ancestors[$root];
			?>
		<style>
			header.entry-header{display:none !important;}
		</style>
		<?php } elseif(is_single()){
			$parent = -1;
			}else {
			$parent = $post->ID;
		?>
		<style>
			header.entry-header{display:none !important;}
		</style>
		<?php
		}
		//$small_title = get_post_meta($parent, 'khmer_title', true );
		//$subtitle_menu = new Subtitle_walker();
		$args = array(
			'depth'        => 0,
			'child_of'     => $parent,
			'exclude'      => '',
			'exclude_tree' => 0,
			'include'      => '',
			'title_li'     => __(''),
			'echo'         => 1,
			'authors'      => '',
			'sort_column'  => 'menu_order',
			'sort_order'   => 'ASC',
			'post_type'    => 'page',
			'post_status'  => 'publish',
			//'walker' => $subtitle_menu
		);
		?>
       
        <style>
			.subpage_widget{padding:0px !important;background:none !important;border:none !important;}
            li.current_page_item a{color:#077907;}
            li.current_page_item .children li a{color:#000;}
		</style>
        <h1 class="entry-title fw-light"><?php echo get_the_title($parent); ?></h1>
        <ul class="nav nav-pills nav-stacked col-sm-12">
        	<?php wp_list_pages($args);?>
		</ul>
<?php }

function show_gallaryByPostId_func( $atts ){
    $a = shortcode_atts( array(
        'id' =>0
    ), $atts );
    global $wpdb;
    $post_id =  $a['id'];
    ob_start();
    na_get_gallery_image_urls($post_id);
    return ob_get_clean();
}
add_shortcode( 'getGallery', 'show_gallaryByPostId_func' );

function na_get_gallery_image_urls( $post_id, $number = false ) {?>
    <style>
        .my_custom_gallery_wrapper{}
        img.my_custom_gallery{ margin: 0 5px;max-width: 30%;}
    </style>
<?php
    $post = get_post($post_id);
    $count = 0;
    $number = 20;
    // Make sure the post has a gallery in it
    if( ! has_shortcode( $post->post_content, 'gallery' ) )
        return;
    // Retrieve all galleries of this post
    $galleries = get_post_galleries_images( $post );
    // Loop through all galleries found
    echo '<div class="my_custom_gallery_wrapper">';
    foreach( $galleries as $gallery ) {
        // Loop through each image in each gallery
        foreach( $gallery as $image ) {
            if ( $number == $count )
                return;
            echo '<a href="'.get_permalink($post_id).'">'.'<img src="'.$image.'" class="my_custom_gallery">'.'</a>';
            $count++;
        }
    }
    echo '</div>';
}


function eventListing_func()
{
    $args = array(
        'posts_per_page' => 8,
        'offset' => 0,
        'category' => '',
        'category_name' => '',
        'orderby' => 'date',
        'order' => 'DESC',
        'include' => '',
        'exclude' => '',
        'meta_key' => '',
        'meta_value' => '',
        'post_type' => 'tribe_events',
        'post_mime_type' => '',
        'post_parent' => '',
        'author' => '',
        'author_name' => '',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $eventListing = get_posts($args);
    ob_start();
    if(function_exists('qtranxf_getLanguage')){
        if(qtranxf_getLanguage()=='km'){
            $lang='?lang=km';
        }
    }
    ?>
    <script type="text/javascript">
        jQuery( document ).ready(function() {
            jQuery("#link_to_events").after("<a href='<?php echo home_url( '/events/list' ).$lang;?>' class='td-pulldown-category more_events'><i class='fa fa-caret-right'></i><span><?php _e('[:en]View List[:km]មើលប្រតិទិន[:]');?></span></a>");
        });
    </script>
    <style>
        a.more_events {
            color: #077907 !important;
            display: inline !important;
            position: relative !important;
        }
        a.more_events span{margin-left: 10px;}
    </style>
    <?php
    echo '<ul class="event_list">';
    foreach ($eventListing as $event) : setup_postdata($event);
        $startDate=strtotime(get_post_meta( $event->ID, '_EventStartDate', true ));
        echo '<li class="event">';
        _e('<span>'.date('d-M-Y',$startDate).'</span><a href="'.get_permalink($event->ID).'">'.get_the_title($event->ID).'</a>');
        echo '</li>';
    endforeach;
    wp_reset_postdata();
    echo '</ul>';
    return ob_get_clean();
}
add_shortcode( 'EventList', 'eventListing_func' );
?>
