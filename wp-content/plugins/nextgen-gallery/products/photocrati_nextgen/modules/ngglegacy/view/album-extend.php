<?php 
/**
Template Page for the album overview (extended)

Follow variables are useable :

	$album     	 : Contain information about the first album
    $albums    	 : Contain information about all albums
	$galleries   : Contain all galleries inside this album
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/
?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($galleries)) : ?>

<div class="ngg-albumoverview">	
	<!-- List of galleries -->
	<?php foreach ($galleries as $gallery) : ?>

	<div class="ngg-album">
		<!--<div class="ngg-albumtitle">
            <a href="<?php /*echo nextgen_esc_url($gallery->pagelink) */?>"><?php /*echo $gallery->title */?></a>
        </div>-->
        <div class="ngg-albumcontent">
            <div class="ngg-thumbnail">
                <a href="<?php echo nextgen_esc_url($gallery->pagelink) ?>">
                    <img class="Thumb" alt="<?php echo esc_attr($gallery->title) ?>" src="<?php echo nextgen_esc_url($gallery->previewurl) ?>"/>
                </a>
            </div>
            <div class="thumb-caption">
                <div class="ngg-albumtitle">
                    <a href="<?php echo $gallery->pagelink ?>"><?php echo $gallery->title ?></a>
                </div>
                <?php if ($gallery->counter > 0) : ?>
                    &nbsp;(<strong><?php echo $gallery->counter ?></strong> <?php _e('Photos', 'nggallery') ?>)
                <?php endif; ?>
            </div>
		</div>
	</div>

 	<?php endforeach; ?>
 	
	<!-- Pagination -->
 	<?php echo $pagination ?>
 	
</div>

<?php endif; ?>
