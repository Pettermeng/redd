<?php
session_start();

/* Template Name: Registation Complete */

get_header();

global $wpdb;

if(isset($_POST['project-name'])){

    $project_name = $_POST['project-name'];
    $date_submission = $_POST['date_submission'];
    $project_description = $_POST['project_description'];
    $type_project = $_POST['type_project'];
    $project_start = $_POST['project_start'];
    $project_end = $_POST['project_end'];
    $greenhouse_gases = $_POST['greenhouse_gases'];
    $standard = $_POST['standard'];
    $description_strategy = $_POST['description_strategy'];

    $file_project_description = $_FILES['upload_document'];
    $projectLocation_file = $_FILES['upload_kml'];
	$projectLocation_file_image = $_FILES['upload_jpg'];
    $otherdocument_file = $_FILES['upload_optional'];    
    $filepdf_mrv = $_FILES['upload_mrv'];
    $filepdf_saIn = $_FILES['upload_safeguard'];
    $filepdf_bsi = $_FILES['upload_benefit'];
    
    $checkbox_mrv = 0;
    if($_POST['mrv'] == 'on'){
        $checkbox_mrv = 1;
    }

    $checkbox_safeguard = 0;
    if($_POST['safeguard'] == 'on'){
        $checkbox_safeguard = 1;
    }

    $checkbox_benefit_sharing = 0;
    if($_POST['benefit'] == 'on'){
        $checkbox_benefit_sharing = 1;
	}
	
		$table_project = $wpdb->prefix . "project";
		$table_proponent_partner = $wpdb->prefix . "project_proponent_partner";
		$table_lists_documents = $wpdb->prefix . "lists_documents";
		$table_list_doc_type = $wpdb->prefix ."list_doc_type";

		$data_project = array(
					'id_project_type' => $type_project, 
					'project_name' => $project_name,
					'project_submit_date' => date("Y-m-d", strtotime( str_replace('/', '-', $date_submission ))),
					'project_description' => $project_description,
					'date_start' => date("Y-m-d", strtotime(str_replace('/', '-', $project_start ))),
					'date_end' => date("Y-m-d", strtotime(str_replace('/', '-', $project_end ))),
					'greenhouse_gases' => $greenhouse_gases,
					'standard' => $standard,
					'description_strategy' => $description_strategy,
					'project_status' => 1,

					'checkbox_mrv' => $checkbox_mrv,
					'checkbox_safeguard' => $checkbox_safeguard,
					'checkbox_benefit_sharing' => $checkbox_benefit_sharing,

					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				);
		$format_project = array('%d','%s','%s','%s','%s','%s','%s','%d','%s','%d','%d','%d','%d','%s','%s');
		$wpdb->insert($table_project,$data_project,$format_project);
		$id_project = $wpdb->insert_id;
		if ($id_project) {

			if(count($file_project_description['name']) >0){ //check doc_type and upload  project_description
				$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'project_description'" );
				for($i=0; $i<count($file_project_description['name']); $i++){
					// block get info file
					$file_tmp_name = $file_project_description['tmp_name'][$i];
					$file_name = $file_project_description['name'][$i];
					$file_type = $file_project_description['type'][$i];

					$sub= explode('.', $file_name);
					$data = explode('.'.end($sub), $file_name);
					if(isset($data)){
						$title = $data[0];
					}else{
						$title = $file_name;
					}
					
					if($file_name != ''){
						$array = explode('.', $file_name);
						$extension = end($array);
						$file_name = mt_rand(1, 99999).'_file.'.$extension;
						$uploaddir = wp_upload_dir();
						$file_path = $uploaddir['path']."/".$file_name;
						$pathField = $uploaddir['url']."/".$file_name;

						move_uploaded_file($file_tmp_name, $file_path);
						
						$data = array(
							'id_project' => $id_project, 
							'id_list_doc_type' => $docType->id,
							'title' => $title,
							'file_type' => $file_type,
							'path' => $pathField,
							'date_submitted' => date('Y-m-d'),
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
							'created_by' => get_current_user_id(),
							'updated_by' => get_current_user_id()
						);
						$format = array('%d','%d','%s','%s','%s','%s','%s','%s','%d','%d');
						$wpdb->insert($table_lists_documents,$data,$format);
					}
				}
			}

			if(count($projectLocation_file_image['name']) >0){ //check doc_type and upload  project_locations
				// In database table list_doc_type create new project_locations_vector 
				$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'project_locations_vector'" );
				for($i=0; $i<count($projectLocation_file_image['name']); $i++){
					// block get info file
					$file_tmp_name = $projectLocation_file_image['tmp_name'][$i];
					$file_name = $projectLocation_file_image['name'][$i];
					$file_type = $projectLocation_file_image['type'][$i];
					$sub= explode('.', $file_name);
					$data = explode('.'.end($sub), $file_name);
					if(isset($data)){
						$title = $data[0];
					}else{
						$title = $file_name;
					}

					if($file_name != ''){
						$array = explode('.', $file_name);
						$extension = end($array);
						$file_name = mt_rand(1, 99999).'_file.'.$extension;
						$uploaddir = wp_upload_dir();
						$file_path = $uploaddir['path']."/".$file_name;
						$pathField = $uploaddir['url']."/".$file_name;


						move_uploaded_file($file_tmp_name, $file_path);
						
						$data = array(
							'id_project' => $id_project, 
							'id_list_doc_type' => $docType->id,
							'title' => $title,
							'file_type' => $file_type,
							'path' => $pathField,
							'date_submitted' => date('Y-m-d'),
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
							'created_by' => get_current_user_id(),
							'updated_by' => get_current_user_id()
						);
						$format = array('%d','%d','%s','%s','%s','%s','%s','%s','%d','%d');
						$wpdb->insert($table_lists_documents,$data,$format);
					}
				}
			}
			// Upload project location vector/image file 
			if(count($projectLocation_file['name']) >0){ //check doc_type and upload  project_locations
				$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'project_locations'" );
				for($i=0; $i<count($projectLocation_file['name']); $i++){
					// block get info file
					$file_tmp_name = $projectLocation_file['tmp_name'][$i];
					$file_name = $projectLocation_file['name'][$i];
					$file_type = $projectLocation_file['type'][$i];
					$sub= explode('.', $file_name);
					$data = explode('.'.end($sub), $file_name);
					if(isset($data)){
						$title = $data[0];
					}else{
						$title = $file_name;
					}

					if($file_name != ''){
						$array = explode('.', $file_name);
						$extension = end($array);
						$file_name = mt_rand(1, 99999).'_file.'.$extension;
						$uploaddir = wp_upload_dir();
						$file_path = $uploaddir['path']."/".$file_name;
						$pathField = $uploaddir['url']."/".$file_name;


						move_uploaded_file($file_tmp_name, $file_path);
						
						$data = array(
							'id_project' => $id_project, 
							'id_list_doc_type' => $docType->id,
							'title' => $title,
							'file_type' => $file_type,
							'path' => $pathField,
							'date_submitted' => date('Y-m-d'),
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
							'created_by' => get_current_user_id(),
							'updated_by' => get_current_user_id()
						);
						$format = array('%d','%d','%s','%s','%s','%s','%s','%s','%d','%d');
						$wpdb->insert($table_lists_documents,$data,$format);
					}
				}
			}

			if(count($otherdocument_file['name']) >0){ //check doc_type and upload  other_documents
				$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'other_documents'");
				for($i=0; $i<count($otherdocument_file['name']); $i++){
					// block get info file
					$file_tmp_name = $otherdocument_file['tmp_name'][$i];
					$file_name = $otherdocument_file['name'][$i];
					$file_type = $otherdocument_file['type'][$i];
					

					$sub= explode('.', $file_name);
					$data = explode('.'.end($sub), $file_name);
					if(isset($data)){
						$title = $data[0];
					}else{
						$title = $file_name;
					}
					
					if($file_name != ''){
						$array = explode('.', $file_name);
						$extension = end($array);
						$file_name = mt_rand(1, 99999).'_file.'.$extension;
						$uploaddir = wp_upload_dir();
						$file_path = $uploaddir['path']."/".$file_name;
						$pathField = $uploaddir['url']."/".$file_name;
						move_uploaded_file($file_tmp_name, $file_path);
						
						$data = array(
							'id_project' => $id_project, 
							'id_list_doc_type' => $docType->id,
							'title' => $title,
							'file_type' => $file_type,
							'path' => $pathField,
							'date_submitted' => date('Y-m-d'),
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
							'created_by' => get_current_user_id(),
							'updated_by' => get_current_user_id()
						);
						$format = array('%d','%d','%s','%s','%s','%s','%s','%s','%d','%d');
						$wpdb->insert($table_lists_documents,$data,$format);
					}
				}
			}

			if(count($filepdf_mrv['name']) >0){ //check doc_type and upload  mrv
				$docType = $wpdb->get_row(  "SELECT * FROM $table_list_doc_type WHERE type_code = 'mrv'" );
				for($i=0; $i<count($filepdf_mrv['name']); $i++){
					// block get info file
					$file_tmp_name = $filepdf_mrv['tmp_name'][$i];
					$file_name = $filepdf_mrv['name'][$i];
					$file_type = $filepdf_mrv['type'][$i];
					$sub= explode('.', $file_name);
					$data = explode('.'.end($sub), $file_name);
					if(isset($data)){
						$title = $data[0];
					}else{
						$title = $file_name;
					}
					
					if($file_name != ''){
						$array = explode('.', $file_name);
						$extension = end($array);
						$file_name = mt_rand(1, 99999).'_file.'.$extension;
						$uploaddir = wp_upload_dir();
						$file_path = $uploaddir['path']."/".$file_name;
						$pathField = $uploaddir['url']."/".$file_name;
						move_uploaded_file($file_tmp_name, $file_path);
						
						$data = array(
							'id_project' => $id_project, 
							'id_list_doc_type' => $docType->id,
							'title' => $title,
							'file_type' => $file_type,
							'path' => $pathField,
							'date_submitted' => date('Y-m-d'),
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
							'created_by' => get_current_user_id(),
							'updated_by' => get_current_user_id()
						);
						$format = array('%d','%d','%s','%s','%s','%s','%s','%s','%d','%d');
						$wpdb->insert($table_lists_documents,$data,$format);
					}
				}
			}

			if(count($filepdf_saIn['name']) >0){ //check doc_type and upload  sain
				$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'sain'" );
				for($i=0; $i<count($filepdf_saIn['name']); $i++){
					// block get info file
					$file_tmp_name = $filepdf_saIn['tmp_name'][$i];
					$file_name = $filepdf_saIn['name'][$i];
					$file_type = $filepdf_saIn['type'][$i];
					$sub= explode('.', $file_name);
					$data = explode('.'.end($sub), $file_name);
					if(isset($data)){
						$title = $data[0];
					}else{
						$title = $file_name;
					}
					
					if($file_name != ''){
						$array = explode('.', $file_name);
						$extension = end($array);
						$file_name = mt_rand(1, 99999).'_file.'.$extension;
						$uploaddir = wp_upload_dir();
						$file_path = $uploaddir['path']."/".$file_name;
						$pathField = $uploaddir['url']."/".$file_name;
						move_uploaded_file($file_tmp_name, $file_path);
						
						$data = array(
							'id_project' => $id_project, 
							'id_list_doc_type' => $docType->id,
							'title' => $title,
							'file_type' => $file_type,
							'path' => $pathField,
							'date_submitted' => date('Y-m-d'),
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
							'created_by' => get_current_user_id(),
							'updated_by' => get_current_user_id()
						);
						$format = array('%d','%d','%s','%s','%s','%s','%s','%s','%d','%d');
						$wpdb->insert($table_lists_documents,$data,$format);
					}
				}
			}

			if(count($filepdf_bsi['name']) >0){ //check doc_type and upload  bsi
				$docType = $wpdb->get_row(  "SELECT * FROM $table_list_doc_type WHERE type_code = 'bsi'"  );
				for($i=0; $i<count($filepdf_bsi['name']); $i++){
					// block get info file
					$file_tmp_name = $filepdf_bsi['tmp_name'][$i];
					$file_name = $filepdf_bsi['name'][$i];
					$file_type = $filepdf_bsi['type'][$i];
					$sub= explode('.', $file_name);
					$data = explode('.'.end($sub), $file_name);
					if(isset($data)){
						$title = $data[0];
					}else{
						$title = $file_name;
					}

					if($file_name != ''){
						$array = explode('.', $file_name);
						$extension = end($array);
						$file_name = mt_rand(1, 99999).'_file.'.$extension;
						$uploaddir = wp_upload_dir();
						$file_path = $uploaddir['path']."/".$file_name;
						$pathField = $uploaddir['url']."/".$file_name;
						move_uploaded_file($file_tmp_name, $file_path);
						
						$data = array(
							'id_project' => $id_project, 
							'id_list_doc_type' => $docType->id,
							'title' => $title,
							'file_type' => $file_type,
							'path' => $pathField,
							'date_submitted' => date('Y-m-d'),
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
							'created_by' => get_current_user_id(),
							'updated_by' => get_current_user_id()
						);
						$format = array('%d','%d','%s','%s','%s','%s','%s','%s','%d','%d');
						$wpdb->insert($table_lists_documents,$data,$format);
					}
				}
			}

			// block insert Project Proponent 
			// var_dump($_SESSION["id_cate_org"]);
			$data = array(
				'id_project' => $id_project, 
				'id_cate_org' => $_SESSION["id_cate_org"],
				'type' => 'proponent',
				'organization_name' => $_SESSION["organization_name"],
				'funtcion' => $_SESSION["function"],
				'address' => $_SESSION["address"],
				'postal_address' => $_SESSION["postal_address"], 
				'contact_person' => $_SESSION["contact_person"],
				'emails' => $_SESSION["emails"],
				'office_number' => $_SESSION["office_number"],
				'cell_number' => $_SESSION["cell_number"],
				'fax_number' => $_SESSION["fax_number"],
				'activities_pro' => $_SESSION["activities_pro"], 
				'activities_related' => $_SESSION["activities_related"],
				'activities_20yr' => $_SESSION["activities_20yr"],
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
				'created_by' => get_current_user_id(),
				'updated_by' => get_current_user_id()
			);
			$format = array('%d','%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%d');
			$wpdb->insert($table_proponent_partner,$data,$format);
			

			// block Project Partner
			// var_dump($_SESSION["organization_name_partner"]);
			for($p = 0; $p< count($_SESSION["organization_name_partner"]); $p++){
				// var_dump($_SESSION["organization_name_partner"][$p]);
				$data = array(
					'id_project' => $id_project, 
					// 'id_cate_org' => $_SESSION["id_cate_org_partner"][$p],
					'type' => 'partner',
					'organization_name' => $_SESSION["organization_name_partner"][$p],
					'funtcion' => $_SESSION["function_partner"][$p],
					'address' => $_SESSION["address_partner"][$p],
					'postal_address' => $_SESSION["postal_address_partner"][$p], 
					'contact_person' => $_SESSION["contact_person_partner"][$p],
					'emails' => $_SESSION["emails_partner"][$p],
					'office_number' => $_SESSION["office_number_partner"][$p],
					'cell_number' => $_SESSION["cell_number_partner"][$p],
					'fax_number' => $_SESSION["fax_number_partner"][$p],
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
					'created_by' => get_current_user_id(),
					'updated_by' => get_current_user_id()
				);
				$format = array('%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%d');
				$wpdb->insert($table_proponent_partner,$data,$format);
				// var_dump($wpdb->insert_id);

			}

			// audo create db

			
			$email_address = $_SESSION["emails"];
			$exists = email_exists( $email_address );
			// var_dump($email_address);
			// check user 
			if($exists){
				$table_user = $wpdb->prefix . "users";
				$userInfo = $wpdb->get_row(  "SELECT * FROM $table_user WHERE user_email = '$email_address'" );
				// var_dump($userInfo);
				$user_id_new = $userInfo->ID;
			}else{

				$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
				$username = $_SESSION["contact_person"];
				$password = substr(str_shuffle($data), 0, 7);

				$userdata = array(
					'user_login' =>  $email_address,
					'user_email'   =>  $email_address,
					'user_pass'  =>  $password,
					'display_name'   => $username,
					'role' => 'project'

				);

				$user_id_new = wp_insert_user( $userdata );

			}

			$result_add = $wpdb->update( 
				$table_project, 
				array( 
					'created_by' => $user_id_new,	// number
					'updated_by' => $user_id_new,	// number
					'updated_at' => date('Y-m-d H:i:s')
				), 
				array( 'id' => $id_project )
			);
			

			// add to table redd_project_progress
			$table_redd_project_progress = $wpdb->prefix . "project_progress";
			$data = array(
				'id_project' => $id_project, 
				'id_status' => 1,
				'process' => 'Concept Note and GIS information submitted',
				'date' => date('Y-m-d'),
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
				'created_by' => $user_id_new,
				'updated_by' => $user_id_new
			);
			$format = array('%d','%d','%s','%s','%s','%s','%d','%d');
			$check = $wpdb->insert($table_redd_project_progress,$data,$format);
			$id_project_progress = $wpdb->insert_id;

			// get email sender
			$table_email_config = $wpdb->prefix . "email_config";
			$emailInfo = $wpdb->get_row(  "SELECT * FROM $table_email_config WHERE id = 1" );

			if($exists){

				add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
				$emailTo = $_SESSION["emails"];
				$subject = 'Account for redd+';
				// $body = get_template_part( 'includes/my_email_template' );
				$body = 'Your email already account on Redd+, you can use old account email '.$emailTo.' to login will see new project '.$project_name.'<br><br>';
				$body .= 'URL :<a href="'.get_home_url().'/register-login.html">'.get_home_url().'/register-login.html</a> <br><br>';
				// $body .= '<b>Email :'.$_SESSION["emails"].'</b><br><br>';
				$body .= '<b>Project Name :'.$project_name.'</b><br><br>';
				$body .= 'Thank you';
				$headers = array('Content-Type: text/html; charset=UTF-8','From: Cambodia Redd+ <'.$emailInfo->email_sender.'>', 'Cc: '.$emailInfo->email_send_to.'');
				$check = wp_mail($emailTo, $subject, $body, $headers);
			}else{

				add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
				$emailTo = $_SESSION["emails"];
				$subject = 'Account for redd+';
				$body = 'You can use this account to login redd+ <br><br>';
				$body .= 'URL :<a href="'.get_home_url().'/register-login.html">'.get_home_url().'/register-login.html</a> <br><br>';
				$body .= '<b>Email :'.$_SESSION["emails"].'</b><br><br>';
				$body .= '<b>Password :'.$password.'</b><br><br>';
				$body .= '<b>Project Name :'.$project_name.'</b><br><br>';
				$body .= 'Thank you';
				$headers = array('Content-Type: text/html; charset=UTF-8','From: Cambodia Redd+ <'.$emailInfo->email_sender.'>', 'Cc: '.$emailInfo->email_send_to.'');
				$check = wp_mail($emailTo, $subject, $body, $headers);

			}

			
			// var_dump($check);

			session_destroy();
			// header("Location: ".admin_url()."/admin.php?page=admin-page");
			// exit();
		}else{
			$fullurl = get_permalink(get_page_by_path( 'project-detail' ));
			$reUrl = str_replace("project-detail.html","registation-complete.html",$fullurl);
			header("Location: ".$reUrl).'?status=error';
			exit();
		}
}


// style="background-color:red"
	if (have_posts()) { ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="body-container">
				
			<div class="header-margin-bottom"></div>
			<div class="td-crumb-container">
				<?php echo td_page_generator::get_page_breadcrumbs(get_the_title()); ?>
			</div>
			<div class="header-margin-top"></div>
			<!-- block process -->
			<div class="processStep">
					<div class="step1 active">
						<div class="point"></div>
						<div class="titleStep"><?php _e("[:km]ប្រតិបត្តិការនិង<br>ដៃគូគម្រោងរេដបូក[:en]Project Proponent<br>and Partners[:]");?></div>
					</div>
					<div class="step2 active">
						<div class="point"></div>
						<div class="titleStep"><?php _e("[:km]គម្រោងលម្អិត[:en]Project Details[:]");?></div>
					</div>
					<div class="step3 active">
						<div class="point"></div>
						<div class="titleStep"><?php _e("[:km]ការចុះបញ្ជីគម្រោង<br>រេដបូកបានបញ្ចប់[:en]Registration <br> Completed[:]");?></div>
					</div>
			</div>

			<!-- block process -->
			<div class="content-container-complete">
				<div class="row stepOne"><?php _e("[:km]ដំណើរការចុះបញ្ជីគម្រោងរេដបូកបានបញ្ចប់ [:en]Registration complete[:]");?></div>
				<div class="container">
					
				<?php 
					if(isset($id_project)){
					?>
						<?php if( get_field('complete-content') ): ?>
							<div class="row registation-complete">
								<p class="title col-md-10 col-sm-12"><?php _e("[:km]ដំណើរការចុះបញ្ជីគម្រោងរេដបូកបានបញ្ចប់[:en]Registration Complete[:]");?>!</p>
								<div class="drawline col-md-10 col-sm-12"></div>
								<p class="detail col-md-10 col-sm-12">
									<?php echo str_replace("[name_of_project] ",$project_name ,get_field('complete-content')); ;?>
								</p>
							</div>
						<?php endif; ?>
					<?php }
					?>
				</div>
			</div>
			
		</div>
        <?php endwhile; ?>

	<?php }

get_footer();