<?php
if(!function_exists('ultimate_layouts_plugin_settings') && !function_exists('ultimate_layouts_register_settings') && !function_exists('ultimate_layouts_settings_page')){
	function ultimate_layouts_register_settings(){
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_rtl_mode');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_cat_link');
		
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_120_90');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_100_100');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_200_200');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_400_300');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_800_600');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_1200_900');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_400_400');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_800_800');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_1200_1200');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_400_225');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_800_450');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_1200_675');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_400_600');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_800_1200');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_1200_1800');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_400_free');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_800_free');
		register_setting('ultimate_layouts_settings_group', 'ultimate_layouts_img_1200_free');
	}
	function ultimate_layouts_settings_page(){
		ob_start();
	?>
		<div class="wrap">
			<h2><strong><?php echo __("Right To Left (RTL) Mode", 'ultimate_layouts')?></strong></h2>    
			<form method="post" action="options.php">
				<?php 
				settings_fields('ultimate_layouts_settings_group');
				do_settings_sections('ultimate_layouts_settings_group');
				$opt_rtl_mode = trim(get_option('ultimate_layouts_rtl_mode'));
				$opt_cat_link = trim(get_option('ultimate_layouts_cat_link'));
				
				$ultimate_layouts_img_120_90 = trim(get_option('ultimate_layouts_img_120_90', '0'));
				$ultimate_layouts_img_100_100 = trim(get_option('ultimate_layouts_img_100_100', '0'));
				$ultimate_layouts_img_200_200 = trim(get_option('ultimate_layouts_img_200_200', '0'));
				$ultimate_layouts_img_400_300 = trim(get_option('ultimate_layouts_img_400_300', '1'));
				$ultimate_layouts_img_800_600 = trim(get_option('ultimate_layouts_img_800_600', '1'));
				$ultimate_layouts_img_1200_900 = trim(get_option('ultimate_layouts_img_1200_900', '1'));
				$ultimate_layouts_img_400_400 = trim(get_option('ultimate_layouts_img_400_400', '0'));
				$ultimate_layouts_img_800_800 = trim(get_option('ultimate_layouts_img_800_800', '0'));
				$ultimate_layouts_img_1200_1200 = trim(get_option('ultimate_layouts_img_1200_1200', '0'));
				$ultimate_layouts_img_400_225 = trim(get_option('ultimate_layouts_img_400_225', '0'));
				$ultimate_layouts_img_800_450 = trim(get_option('ultimate_layouts_img_800_450', '0'));
				$ultimate_layouts_img_1200_675 = trim(get_option('ultimate_layouts_img_1200_675', '0'));
				$ultimate_layouts_img_400_600 = trim(get_option('ultimate_layouts_img_400_600', '1'));
				$ultimate_layouts_img_800_1200 = trim(get_option('ultimate_layouts_img_800_1200', '1'));
				$ultimate_layouts_img_1200_1800 = trim(get_option('ultimate_layouts_img_1200_1800', '0'));
				$ultimate_layouts_img_400_free = trim(get_option('ultimate_layouts_img_400_free', '0'));
				$ultimate_layouts_img_800_free = trim(get_option('ultimate_layouts_img_800_free', '0'));
				$ultimate_layouts_img_1200_free = trim(get_option('ultimate_layouts_img_1200_free', '0'));
				?>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php echo __("Enabled RTL", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_rtl_mode" id="ultimate_layouts_rtl_mode" style="width:200px;">
                            	<option value="0" <?php if($opt_rtl_mode=='0'){echo 'selected';}?>><?php echo __("NO", 'ultimate_layouts')?></option>
                                <option value="1" <?php if($opt_rtl_mode=='1'){echo 'selected';}?>><?php echo __("YES", 'ultimate_layouts')?></option>
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Disabled Link For Taxonomy, Category, Tags...", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_cat_link" id="ultimate_layouts_cat_link" style="width:200px;">                            	
                            	<option value="0" <?php if($opt_cat_link=='0'){echo 'selected';}?>><?php echo __("NO", 'ultimate_layouts')?></option> 
                                <option value="1" <?php if($opt_cat_link=='1'){echo 'selected';}?>><?php echo __("YES", 'ultimate_layouts')?></option>                               
                            </select>                        
                        </td>
					</tr>
                    
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 120*90px", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_120_90" id="ultimate_layouts_img_120_90" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_120_90=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_120_90=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 100(px) x 100(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_100_100" id="ultimate_layouts_img_100_100" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_100_100=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_100_100=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 200(px) x 200(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_200_200" id="ultimate_layouts_img_200_200" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_200_200=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_200_200=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 400(px) x 300(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_400_300" id="ultimate_layouts_img_400_300" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_400_300=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_400_300=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 800(px) x 600(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_800_600" id="ultimate_layouts_img_800_600" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_800_600=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_800_600=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 1200(px) x 900(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_1200_900" id="ultimate_layouts_img_1200_900" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_1200_900=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_1200_900=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 400(px) x 400(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_400_400" id="ultimate_layouts_img_400_400" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_400_400=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_400_400=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 800(px) x 800(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_800_800" id="ultimate_layouts_img_800_800" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_800_800=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_800_800=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 1200(px) x 1200(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_1200_1200" id="ultimate_layouts_img_1200_1200" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_1200_1200=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_1200_1200=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 400(px) x 225(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_400_225" id="ultimate_layouts_img_400_225" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_400_225=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_400_225=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 800(px) x 450(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_800_450" id="ultimate_layouts_img_800_450" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_800_450=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_800_450=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 1200(px) x 675(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_1200_675" id="ultimate_layouts_img_1200_675" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_1200_675=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_1200_675=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 400(px) x 600(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_400_600" id="ultimate_layouts_img_400_600" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_400_600=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_400_600=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 800(px) x 1200(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_800_1200" id="ultimate_layouts_img_800_1200" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_800_1200=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_800_1200=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 1200(px) x 1800(px)", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_1200_1800" id="ultimate_layouts_img_1200_1800" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_1200_1800=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_1200_1800=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 400(px) x free", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_400_free" id="ultimate_layouts_img_400_free" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_400_free=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_400_free=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 800(px) x free", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_800_free" id="ultimate_layouts_img_800_free" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_800_free=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_800_free=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
                    <tr valign="top">
						<th scope="row"><?php echo __("Image Size: 12000(px) x free", 'ultimate_layouts')?></th>
						<td>
                        	<select name="ultimate_layouts_img_1200_free" id="ultimate_layouts_img_1200_free" style="width:200px;">
                            	<option value="1" <?php if($ultimate_layouts_img_1200_free=='1'){echo 'selected';}?>><?php echo __("Enabled", 'ultimate_layouts')?></option>                            	
                            	<option value="0" <?php if($ultimate_layouts_img_1200_free=='0'){echo 'selected';}?>><?php echo __("Disabled", 'ultimate_layouts')?></option>                                                               
                            </select>                        
                        </td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
            Image sizes are generated when you upload new images in Wordpress. So, if you want to use one of the image size set in Global options with images uploaded before installing Ultimate Layouts then you must regenerate them. You can use a plugin like <a href="https://fr.wordpress.org/plugins/regenerate-thumbnails/">Regenerate Thumbnail</a> to regenerate all image sizes. 
	<?php 
		$output_string = ob_get_contents();
		ob_end_clean();
		echo $output_string;
	};
	function ultimate_layouts_plugin_settings(){
		add_options_page(__('Ultimate Layouts Settings', 'ultimate_layouts'), __('Ultimate Layouts Settings', 'ultimate_layouts'), 'manage_options', 'ul-plugin-settings.php', 'ultimate_layouts_settings_page');
		add_action('admin_init', 'ultimate_layouts_register_settings');
	}
	add_action('admin_menu', 'ultimate_layouts_plugin_settings');
}