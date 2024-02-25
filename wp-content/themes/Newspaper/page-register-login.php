<?php

/* Template Name: register login */
// echo phpinfo();

get_header();
global $wpdb;
$table_project = $wpdb->prefix . "project";

if (isset($_POST['username'])) {
	$login_data = array();
	$login_data['user_login'] = sanitize_user($_POST['username']);
	$login_data['user_password'] = esc_attr($_POST['password']);

	$user = wp_signon( $login_data, false );

	if ( is_wp_error($user) ) {
		$errorLogin = $user->get_error_message();
	} else {    
		$project = $wpdb->get_row( "SELECT * FROM $table_project WHERE created_by = $user->ID ORDER BY project_status DESC, updated_at DESC LIMIT 1" );
		$urlProject = get_home_url().'/project-approved.html?id='.$project->id;

		wp_clear_auth_cookie();
		do_action('wp_login', $user->ID);
		wp_set_current_user($user->ID);
		wp_set_auth_cookie($user->ID, true);
		$redirect_to = $urlProject;
		wp_safe_redirect($redirect_to);
		exit;
	}
}else if ( is_user_logged_in() ) {
	$UserID = get_current_user_id();
	$project = $wpdb->get_row(  "SELECT * FROM $table_project WHERE created_by = $UserID ORDER BY project_status DESC, updated_at DESC LIMIT 1"  );
	$urlProject = get_home_url().'/project-approved.html?id='.$project->id;
	$redirect_to = $urlProject;
	wp_safe_redirect($redirect_to);
	
}


// style="background-color:red"
	if (have_posts()) { ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="body-container">

			<!-- Block menu page  -->
			<div class="header-margin-bottom"></div>
			<div class="td-crumb-container">
				<?php echo td_page_generator::get_page_breadcrumbs(get_the_title()); ?>
			</div>
			<div class="header-margin-top"></div>
		     <!-- End Block menu page  -->
			
			
			<div class="content-container-login">
				<div class="container">
					<div class="row register-login">
						<p class="title col-md-10 col-sm-12"><?php _e("[:km]ចុចចូល[:en]Login[:]");?></p>
						<div class="drawline col-md-10 col-sm-12"></div>

						<?php if( get_field('text-title') ): ?>
							<p class="detail col-md-10 col-sm-12"><?php echo get_field('text-title') ?></p>
						<?php endif; ?>

						<!-- login form -->
						<form class='formlogin' action="" method="post" enctype="multipart/form-data" id="formlogin">
						<div class="row">
							<div class="col-lg-12 form-login">
								
									<div class="form-group username">
										<label for="username"><?php _e("[:km]ឈ្មោះអ្នកប្រើប្រាស់[:en]Email/Username[:]");?></label>
										<input type="text" class="form-control require" name="username" id="username" placeholder="<?php _e("[:km]ឈ្មោះអ្នកប្រើប្រាស់[:en]Email/Username[:]");?>" >
									</div>
									<div class="form-group password">
										<label for="password"><?php _e("[:km]លេខកូដសម្ងាត់[:en]Password[:]");?></label>
										<input type="password" class="form-control require" name="password" id="password" placeholder="<?php _e("[:km]លេខកូដសម្ងាត់[:en]Password[:]");?>" >
									</div>
								
							</div> 
						</div>


						<div class="row remember-forgot">
							<div class=" col-sm-6 form-group no-padding ">
								<div class="form-check">
										<input class="form-check-input" type="checkbox" id="remember">
										<label class="form-check-label remember-text" for="remember">
											<?php _e("[:km]ចងចាំខ្ញុំ[:en]Remember me[:]");?>
										</label>
								</div>
							</div>
							<div class="col-sm-6 forgot-text"><a href="<?php echo get_home_url();?>/wp-login.php?action=lostpassword"> <?php _e("[:km]ភ្លេចលេខ/កូដសម្ងាត់?[:en]Forgot Password?[:]");?></a></div>
						</div>
						<!-- end login form  -->
						<div class="row remember-forgot pt-4">
							<div class="col-lg-12 text-center">
								<button type="submit" id='loginFormSubmit' class="text-login"><?php _e("[:km]ចុចចូល[:en]Log In[:]");?></button>
							</div>
						</div>
						
						</form>
						<?php 
							if(isset($errorLogin)){
							?>
								<p class="redColor detail col-md-12 col-sm-12 mt-2">
										<?php echo $errorLogin;?>
								</p>
						<?php
							}
						?>

					</div>
					
				</div>
				
			</>
			
		</div>
        <?php endwhile; ?>

	<?php }

get_footer();