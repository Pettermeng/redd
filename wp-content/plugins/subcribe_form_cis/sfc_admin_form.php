<div class="wrap">
	<h2>Subscribe Reference</h2>
    <form method="post" action="options.php"><?php wp_nonce_field('update-options'); ?>
    	<?php settings_fields( 'sfc_ref' ); ?>
    	<?php do_settings_sections( 'sfc_ref' ); ?>
        
    	<?php 
			$selected_cats =get_option('post_category');
			wp_category_checklist(0, 0, $selected_cats);
		?>
        <?php submit_button(); ?>
    </form>
</div>