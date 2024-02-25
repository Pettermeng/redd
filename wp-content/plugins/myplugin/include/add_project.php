<?php
	session_start();

	global $wpdb;
	$table_name = $wpdb->prefix . "organization_category";

	$table_project = $wpdb->prefix . "project";
	$table_proponent_partner = $wpdb->prefix . "project_proponent_partner";
	$table_lists_documents = $wpdb->prefix . "lists_documents";
	$table_list_doc_type = $wpdb->prefix ."list_doc_type";

	$organizations = $wpdb->get_results( "SELECT * FROM $table_name order by title_en asc", OBJECT );

	$table_name = $wpdb->prefix . "project_type";

	$project_types = $wpdb->get_results( "SELECT * FROM $table_name order by project_type_en asc", OBJECT );

	$edit = false;
	$id_project = '';
	if(isset($_GET['id'])){
		$edit = true;
		$id_project =  $_GET['id'];
		$projectInfo = $wpdb->get_row( "SELECT * FROM $table_project WHERE id = $id_project" );
		$proponentinfo = $wpdb->get_row( "SELECT * FROM $table_proponent_partner WHERE id_project = $id_project and type = 'proponent' order by created_at asc" );
		$partnersInfo = $wpdb->get_results( "SELECT * FROM $table_proponent_partner WHERE id_project = $id_project and type = 'partner' order by created_at asc", OBJECT );
	}
?>
<?php 
	// session_destroy();
	$hStep = 1;

	if(isset($_POST['stepValue'])){
		$hStep = $_POST['stepValue'];
		$_SESSION["hStep"] = $_POST['stepValue'];
	}

	if(isset($_SESSION["hStep"])){
		$hStep = $_SESSION["hStep"];
	}

	//$hStep = 2; //need remove

	if(isset($_POST['organization_name'])){

		$_SESSION["organization_name"] = $_POST['organization_name'];
		$_SESSION["id_cate_org"] = $_POST['id_cate_org'];
		// $_SESSION["id_cate_org"] = '';
		$_SESSION["funtcion"] = $_POST['funtcion'];
		$_SESSION["address"] = $_POST['address'];
		$_SESSION["postal_address"] = $_POST['postal_address'];
		$_SESSION["contact_person"] = $_POST['contact_person'];
		$_SESSION["emails"] = $_POST['emails'];
		$_SESSION["office_number"] = $_POST['office_number'];
		$_SESSION["cell_number"] = $_POST['cell_number'];
		$_SESSION["fax_number"] = $_POST['fax_number'];

		$_SESSION["activities_pro"] = $_POST['activities_pro'];
		$_SESSION["activities_related"] = $_POST['activities_related'];
		$_SESSION["activities_20yr"] = $_POST['activities_20yr'];

		$_SESSION["organization_name_partner"] = $_POST['organization_name_partner'];
		// $_SESSION["id_cate_org_partner"] = $_POST['id_cate_org_partner'];
		$_SESSION["funtcion_partner"] = $_POST['funtcion_partner'];
		$_SESSION["address_partner"] = $_POST['address_partner'];
		$_SESSION["postal_address_partner"] = $_POST['postal_address_partner'];
		$_SESSION["contact_person_partner"] = $_POST['contact_person_partner'];
		$_SESSION["emails_partner"] = $_POST['emails_partner'];
		$_SESSION["office_number_partner"] = $_POST['office_number_partner'];
		$_SESSION["cell_number_partner"] = $_POST['cell_number_partner'];
		$_SESSION["fax_number_partner"] = $_POST['fax_number_partner'];


	}

	if($_POST['id_project']){ //update 

		$project_name = $_POST['project_name'];
		$date_submission = $_POST['date_submission'];
		$project_description = $_POST['project_description'];
		$type_project = $_POST['type_project'];
		$project_start = $_POST['project_start'];
		$project_end = $_POST['project_end'];
		$greenhouse_gases = $_POST['greenhouse_gases'];
		$standard = $_POST['standard'];
		$description_strategy = $_POST['description_strategy'];

		$view_issued_records = $_POST['view_issued_records'];
		$view_buffer_records = $_POST['view_buffer_records'];

		$file_project_description = $_FILES['upload_document'];


		$projectLocation_file = $_FILES['upload_kml'];
		$otherdocument_file = $_FILES['upload_optional'];

		$filepdf_mrv = $_FILES['upload_mrv'];
		$filepdf_saIn = $_FILES['upload_safeguard'];
		$filepdf_bsi = $_FILES['upload_benefit'];

		// block old file name
		$upload_document_old = $_POST['upload_document_old'];
		$upload_kml_old = $_POST['upload_kml_old'];
		$upload_optional_old = $_POST['upload_optional_old'];
		$upload_mrv_old = $_POST['upload_mrv_old'];
		$upload_safeguard_old = $_POST['upload_safeguard_old'];
		$upload_benefit_old = $_POST['upload_benefit_old'];

		$id_project = $_POST['id_project'];
		
		$checkbox_mrv = 0;
		if($_POST['mrvCheckbox'] == 'on'){
			$checkbox_mrv = 1;
		}

		$checkbox_safeguard = 0;
		if($_POST['saInCheckbox'] == 'on'){
			$checkbox_safeguard = 1;
		}

		$checkbox_benefit_sharing = 0;
		if($_POST['bsiCheckbox'] == 'on'){
			$checkbox_benefit_sharing = 1;
		}


		

		$data_project = array(
					'id_project_type' => $type_project, 
					'project_name' => $project_name,
					'project_submit_date' => date("Y-m-d", strtotime(str_replace('/', '-', $date_submission ))),
					'project_description' => $project_description,
					'date_start' => date("Y-m-d", strtotime(str_replace('/', '-', $project_start ))),
					'date_end' => date("Y-m-d", strtotime(str_replace('/', '-', $project_end ))),
					'greenhouse_gases' => $greenhouse_gases,
					'standard' => $standard,
					'description_strategy' => $description_strategy,

					'view_issued_records' => $view_issued_records,
					'view_buffer_records' => $view_buffer_records,

					'project_status' => 1,

					'checkbox_mrv' => $checkbox_mrv,
					'checkbox_safeguard' => $checkbox_safeguard,
					'checkbox_benefit_sharing' => $checkbox_benefit_sharing,

					'updated_at' => date('Y-m-d H:i:s'),
					'updated_by' => get_current_user_id()
				);
		$result_add = $wpdb->update( 
			$table_project, 
			$data_project, 
			array( 'id' => $id_project )
		); 


		// check old file clear or not and update
		// $upload_document_old
		if(count($upload_document_old) > 0){
			$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'project_description'" );
			$ids = implode( ',', array_map( 'absint', $upload_document_old ) );
			$wpdb->query( "DELETE FROM $table_lists_documents WHERE id_project= $id_project and id_list_doc_type=$docType->id and ID NOT IN($ids)" );
		}
		if(count($upload_kml_old) > 0){
			$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'project_locations'" );
			$ids = implode( ',', array_map( 'absint', $upload_kml_old ) );
			$wpdb->query( "DELETE FROM $table_lists_documents WHERE id_project= $id_project and id_list_doc_type=$docType->id and ID NOT IN($ids)" );
		}
		if(count($upload_optional_old) > 0){
			$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'other_documents'" );
			$ids = implode( ',', array_map( 'absint', $upload_optional_old) );
			$wpdb->query( "DELETE FROM $table_lists_documents WHERE id_project= $id_project and id_list_doc_type=$docType->id and ID NOT IN($ids)" );
		}
		if(count($upload_mrv_old) > 0){
			$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'mrv'" );
			$ids = implode( ',', array_map( 'absint', $upload_mrv_old ) );
			$wpdb->query( "DELETE FROM $table_lists_documents WHERE id_project= $id_project and id_list_doc_type=$docType->id and ID NOT IN($ids)" );
		}
		if(count($upload_safeguard_old) > 0){
			$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'sain'" );
			$ids = implode( ',', array_map( 'absint', $upload_safeguard_old ) );
			$wpdb->query( "DELETE FROM $table_lists_documents WHERE id_project= $id_project and id_list_doc_type=$docType->id and ID NOT IN($ids)" );
		}
		if(count($upload_benefit_old) > 0){
			$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'bsi'" );
			$ids = implode( ',', array_map( 'absint', $upload_benefit_old ) );
			$wpdb->query( "DELETE FROM $table_lists_documents WHERE id_project= $id_project and id_list_doc_type=$docType->id and ID NOT IN($ids)" );
		}



		// block upload file
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
			$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'other_documents'" );
			for($i=0; $i<count($otherdocument_file['name']); $i++){
				// block get info file
				$file_tmp_name = $otherdocument_file['tmp_name'][$i];
				$file_name = $otherdocument_file['name'][$i];

				$sub= explode('.', $file_name);
				$data = explode('.'.end($sub), $file_name);
				if(isset($data)){
					$title = $data[0];
				}else{
					$title = $file_name;
				}
				
				$file_type = $otherdocument_file['type'][$i];
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
			$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'mrv'" );
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
			$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'bsi'");
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

		// delete old Partner and Proponent
		$result_delete = $wpdb->delete( $table_proponent_partner, array( 'id_project' => $id_project ), array( '%d' ) );
		// if($result_delete){
			// block insert Project Proponent 
			$data = array(
				'id_project' => $id_project, 
				'id_cate_org' => $_SESSION["id_cate_org"],
				'type' => 'proponent',
				'organization_name' => $_SESSION["organization_name"],
				'funtcion' => $_SESSION["funtcion"],
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
			// var_dump($wpdb->insert_id);
			

			

			// block Project Partner
			for($p = 0; $p< count($_SESSION["organization_name_partner"]); $p++){
				// var_dump($_SESSION["organization_name_partner"][$p]);
				$data = array(
					'id_project' => $id_project, 
					// 'id_cate_org' => $_SESSION["id_cate_org_partner"][$p],
					'type' => 'partner',
					'organization_name' => $_SESSION["organization_name_partner"][$p],
					'funtcion' => $_SESSION["funtcion_partner"][$p],
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
				$format = array('%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%d');
				$wpdb->insert($table_proponent_partner,$data,$format);

			}

			// add to table redd_project_progress
			// $table_redd_project_progress = $wpdb->prefix . "project_progress";
			// $data = array(
			// 	'id_project' => $id_project, 
			// 	'id_status' => 1,
			// 	'date' => date('Y-m-d'),
			// 	'created_at' => date('Y-m-d H:i:s'),
			// 	'updated_at' => date('Y-m-d H:i:s'),
			// 	'created_by' => get_current_user_id(),
			// 	'updated_by' => get_current_user_id()
			// );
			// $format = array('%d','%d','%s','%s','%s','%d','%d');
			// $check = $wpdb->insert($table_redd_project_progress,$data,$format);
		// }

		session_destroy();
		header("Location: ".admin_url()."/admin.php?page=admin-page&status=1");
		exit();
		



	}else if(isset($_POST['project_name'])){

		$project_name = $_POST['project_name'];
		$date_submission = $_POST['date_submission'];
		$project_description = $_POST['project_description'];
		$type_project = $_POST['type_project'];
		$project_start = $_POST['project_start'];
		$project_end = $_POST['project_end'];
		$greenhouse_gases = $_POST['greenhouse_gases'];
		$standard = $_POST['standard'];
		$description_strategy = $_POST['description_strategy'];

		$view_issued_records = $_POST['view_issued_records'];
		$view_buffer_records = $_POST['view_buffer_records'];

		$file_project_description = $_FILES['upload_document'];


		$projectLocation_file = $_FILES['upload_kml'];
		$otherdocument_file = $_FILES['upload_optional'];

		$filepdf_mrv = $_FILES['upload_mrv'];
		$filepdf_saIn = $_FILES['upload_safeguard'];
		$filepdf_bsi = $_FILES['upload_benefit'];


		$checkbox_mrv = 0;
		if($_POST['mrvCheckbox'] == 'on'){
			$checkbox_mrv = 1;
		}

		$checkbox_safeguard = 0;
		if($_POST['saInCheckbox'] == 'on'){
			$checkbox_safeguard = 1;
		}

		$checkbox_benefit_sharing = 0;
		if($_POST['bsiCheckbox'] == 'on'){
			$checkbox_benefit_sharing = 1;
		}


		

		$data_project = array(
					'id_project_type' => $type_project, 
					'project_name' => $project_name,
					'project_submit_date' => date("Y-m-d", strtotime( str_replace('/', '-', $date_submission ))),
					'project_description' => $project_description,
					'date_start' => date("Y-m-d", strtotime( str_replace('/', '-', $project_start ))),
					'date_end' => date("Y-m-d", strtotime( str_replace('/', '-', $project_end ))),
					'greenhouse_gases' => $greenhouse_gases,
					'standard' => $standard,
					'description_strategy' => $description_strategy,

					'view_issued_records' => $view_issued_records,
					'view_buffer_records' => $view_buffer_records,

					'project_status' => 1,

					'checkbox_mrv' => $checkbox_mrv,
					'checkbox_safeguard' => $checkbox_safeguard,
					'checkbox_benefit_sharing' => $checkbox_benefit_sharing,

					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
					'created_by' => get_current_user_id(),
					'updated_by' => get_current_user_id()
				);
		$format_project = array('%d','%s','%s','%s','%s','%s','%s','%d','%s','%s','%s','%d','%d','%d','%s','%s','%d','%d');
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
				$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'other_documents'" );
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
				$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'mrv'" );
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
				$docType = $wpdb->get_row( "SELECT * FROM $table_list_doc_type WHERE type_code = 'bsi'");
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
				'funtcion' => $_SESSION["funtcion"],
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
			// var_dump($wpdb->insert_id);
			

			// block Project Partner
			for($p = 0; $p< count($_SESSION["organization_name_partner"]); $p++){
				// var_dump($_SESSION["organization_name_partner"][$p]);
				$data = array(
					'id_project' => $id_project, 
					'id_cate_org' => $_SESSION["id_cate_org_partner"][$p],
					'type' => 'partner',
					'organization_name' => $_SESSION["organization_name_partner"][$p],
					'funtcion' => $_SESSION["funtcion_partner"][$p],
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
				$format = array('%d','%d','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%d');
				$wpdb->insert($table_proponent_partner,$data,$format);

			}

			// add to table redd_project_progress
			$table_redd_project_progress = $wpdb->prefix . "project_progress";
			$data = array(
				'id_project' => $id_project, 
				'id_status' => 1,
				'step_status' => 'C',// set step status to "Completed" auto
				'date' => date('Y-m-d'),
				'end_date' => date('Y-m-d'),
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
				'created_by' => get_current_user_id(),
				'updated_by' => get_current_user_id()
			);
			$format = array('%d','%d','%s','%s','%s','%s','%s','%d','%d');
			$check = $wpdb->insert($table_redd_project_progress,$data,$format);

			session_destroy();
			header("Location: ".admin_url()."/admin.php?page=admin-page");
			exit();
		}


	}
	
	// var_dump($_SESSION["organization_name"]);

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/bootstrap-datepicker.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo get_template_directory_uri();?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/bootstrap-datepicker.min.js"></script>

<script src="<?php echo get_template_directory_uri();?>/js/jquery.session.js"></script>

<script type="text/javascript">

	fun_validate = function(class_div) {
        var num;
        num = 0;
        $(class_div + " .require").each(function(index, element) {
			var id, info, value;
			value = $(element).val();
			id = $(element).attr('id');
			
			if (value == '') {
				console.log(id+'=>'+value);
				// $(class_div+' #' + id).parents().find('label').addClass('okok');
				if (id == "upload_document") {
					$(class_div + ' #title-upload-document').addClass('label_red');
				}
				else if (id == "upload_kml") {
					$(class_div + ' #project-location').addClass('label_red');
				}
				else if (id == "upload_optional") {
					$(class_div + ' #document-optional').addClass('label_red');
				}
				else if (id == "upload_mrv") {
					$(class_div + ' #display-name-upload_mrv').addClass('label_red');
				}
				else if (id == "upload_safeguard") {
					$(class_div + ' #display-name-safeguard').addClass('label_red');
				}
				else if (id == "upload_benefit") {
					$(class_div + ' #display-name-benefit').addClass('label_red');
				}else{
					$(class_div+' #' + id).prev('label').addClass('label_red');
				}
				
				num = num + 1;
			} else {
				if (id === 'emails') {
					pattern = /^[0-9a-z\._\-]+@[a-zA-Z_\-]+?\.[a-zA-Z]{2,}?(\.[a-zA-Z]{2,})?$/
					if(!pattern.test(value)){
						// $(class_div+' #' + id).parents().find('label').addClass('label_red');
						$(class_div+' #' + id).prev('label').addClass('label_red');
						num = num + 1;
					}else{
						$(class_div+' #' + id).prev('label').removeClass('label_red');
					}
				} else {
					if (id == "upload_document") {
						$(class_div + ' #title-upload-document').removeClass('label_red');
					}
					else if (id == "upload_kml") {
						$(class_div + ' #project-location').removeClass('label_red');
					}
					else if (id == "upload_optional") {
						$(class_div + ' #document-optional').removeClass('label_red');
					}
					else if (id == "upload_mrv") {
						$(class_div + ' #display-name-upload_mrv').removeClass('border_label_red');
					}
					else if (id == "upload_safeguard") {
						$(class_div + ' #display-name-safeguard').removeClass('border_label_red');
					}
					else if (id == "upload_benefit") {
						$(class_div + ' #display-name-benefit').removeClass('border_label_red');
					}
					else if (id == "greenhouse_gases") {
						$(class_div + ' #label-greenhouse').removeClass('label_red');
					}
					else {
						$(class_div+' #' + id).prev('label').removeClass('label_red');
					}
					
				}
			}
        });
        if (num > 0) {
          return 1;
        } else {
          return 0;
        }
    };

	// storeData = function(class_div) {
	// 	$.each($('form'+class_div).serializeArray(), function(i, field) {
	// 		var input = $('input[name='+field.name+']');
	// 		field.value = $.trim(field.value);
	// 		console.log(field.value);
	// 	});
	// };

	$(document).ready(function() {
		// var content = '<div class="container-main needLoopItem"><div class="row"><div class="col-8"><div class="form-group"><label for="exampleFormControlInput1" class="labelinput ">Name of Organization(Project Partner)*</label><input type="text" class="form-control require" name="organization_name_partner[]" id="organization_name_partner" placeholder="Fill information here..."></div></div><div class="col-4"><div class="form-group"><label for="exampleFormControlSelect1" class="labelinput">Organizational Category*</label><select class="form-control selectOwrite require" id="id_cate_org_partner" name="id_cate_org_partner[]"><option value="">Choose one of the following...</option><?php foreach ( $organizations as $row ) { ?><option value="<?php echo $row->id;?>"><?php echo $row->title_en;?></option><?php }?></select></div></div></div><div class="row"><div class="col-6"><div class="form-group"><label for="exampleFormControlInput1" class="labelinput">Fuction/Responsibility*</label><textarea class="form-control require" id="funtcion_partner" rows="3" placeholder="Fill information here..." name="funtcion_partner[]"></textarea></div></div><div class="col-6"><div class="form-group"><label for="exampleFormControlInput1" class="labelinput">Address*</label><textarea class="form-control require" id="address_partner" rows="3" placeholder="Fill information here..." name="address_partner[]"></textarea></div></div></div><div class="row"><div class="col-6"><div class="form-group"><label for="exampleFormControlInput1" class="labelinput">Postal Address (if different from Address)</label><textarea class="form-control " id="postal_address_partner" rows="3" placeholder="Fill information here..." name="postal_address_partner[]"></textarea></div></div><div class="col-6"><div class="form-group"><label for="exampleFormControlInput1" class="labelinput">Contact Person(s)*</label><textarea class="form-control require" id="contact_person_partner" rows="3" placeholder="Fill information here..." name="contact_person_partner[]"></textarea></div></div></div><div class="row"><div class="col-6"><div class="form-group"><label for="exampleFormControlInput1" class="labelinput ">Email Address*</label><input type="email" class="form-control require" id="emails_partner" placeholder="Fill information here..." name="emails_partner[]"></div></div><div class="col-6"><div class="form-group"><label for="exampleFormControlSelect1" class="labelinput">Telephone Numbers*</label><input type="text" class="form-control require" id="office_number_partner" placeholder="Office number(s)" name="office_number_partner[]"><input type="text" class="form-control require" id="cell_number_partner" placeholder="Cell number(s)" name="cell_number_partner[]"></div></div></div><div class="row"><div class="col-6"><div class="form-group"><label for="exampleFormControlInput1" class="labelinput ">Fax Number(s)</label><input type="text" class="form-control require" id="fax_number_partner" placeholder="Fill information here..." name="fax_number_partner[]"></div></div><div class="col-6"></div></div></div>';
	    var countCat = 0;
		$('#add_more_partner').click(function(e) {
			countCat++;
			var content = '<div class="container-main needLoopItem" id="category_'+countCat+'"><div class="removeIcon" id="'+countCat+'"><i class="fa fa-times txt-color-red eventDelete" aria-hidden="true"></i></div><div class="row"><div class="col-12"><div class="form-group"> <label for="exampleFormControlInput1" class="labelinput ">Name of Organization(Project Partner)*</label> <input type="text" class="form-control require" name="organization_name_partner[]" id="organization_name_partner'+countCat+'" placeholder="Fill information here..."></div></div></div><div class="row"><div class="col-6"><div class="form-group"> <label for="exampleFormControlInput1" class="labelinput">Fuction/Responsibility*</label><textarea class="form-control require" name="funtcion_partner[]" id="funtcion_partner'+countCat+'" rows="3" placeholder="Fill information here..." name="funtcion_partner[]"></textarea></div></div><div class="col-6"><div class="form-group"> <label for="exampleFormControlInput1" class="labelinput">Address*</label><textarea class="form-control require" name="address_partner[]" id="address_partner'+countCat+'" rows="3" placeholder="Fill information here..." name="address_partner[]"></textarea></div></div></div><div class="row"><div class="col-6"><div class="form-group"> <label for="exampleFormControlInput1" class="labelinput">Postal Address (if different from Address)</label><textarea class="form-control " name="postal_address_partner[]" id="postal_address_partner'+countCat+'" rows="3" placeholder="Fill information here..." name="postal_address_partner[]"></textarea></div></div><div class="col-6"><div class="form-group"> <label for="exampleFormControlInput1" class="labelinput">Contact Person(s)*</label><textarea class="form-control require" name="contact_person_partner[]" id="contact_person_partner'+countCat+'" rows="3" placeholder="Fill information here..." name="contact_person_partner[]"></textarea></div></div></div><div class="row"><div class="col-6"><div class="form-group"> <label for="exampleFormControlInput1" class="labelinput ">Email Address*</label> <input type="email" class="form-control require" name="emails_partner[]" id="emails_partner'+countCat+'" placeholder="Fill information here..." name="emails_partner[]"></div></div><div class="col-6"><div class="form-group"> <label for="exampleFormControlSelect1" class="labelinput">Telephone Numbers*</label> <input type="text" class="form-control require" name="office_number_partner[]" id="office_number_partner'+countCat+'" placeholder="Office number(s)" name="office_number_partner[]"> <input type="text" class="form-control " name="cell_number_partner[]" id="cell_number_partner'+countCat+'" placeholder="Cell number(s)" name="cell_number_partner[]"></div></div></div><div class="row"><div class="col-6"><div class="form-group"> <label for="exampleFormControlInput1" class="labelinput ">Fax Number(s)</label> <input type="text" class="form-control " name="fax_number_partner[]" id="fax_number_partner'+countCat+'" placeholder="Fill information here..." name="fax_number_partner[]"></div></div><div class="col-6"></div></div></div>';
			$(".contentBtnAdd").before(content);
		});

		$('.next_step').click(function(e) {
			
				// console.log(storeData('#blockStep1'));
				var stepNum = $(this).attr('step');
				// var url = '<?php echo get_home_url(); ?>/wp-admin/admin.php?page=add_project&step='+(parseInt(stepNum)+1);
				// window.location.href = url;
				if(stepNum == 1){
					if(fun_validate('#blockStep1') == 0){
						$('form#blockStep1').submit();
					}
				}else{
					if(fun_validate('#blockStep2') == 0){
						$('form#blockStep2').submit();
					}
				}
			
		});

		$('.back_step').click(function(e) {
			$('form#blockStepBack').submit();
		});

		
		$(document).off('click', '.removeIcon').on('click', '.removeIcon', function(){
			var id = $(this).attr('id');
			$('#category_'+id).remove();
		});

		$(document).off('click', '.removeIconUpdate').on('click', '.removeIconUpdate', function(){
			var id = $(this).attr('id');
			$('#category_update'+id).remove();
		});

		$(document).off('click', '.removeIconFile').on('click', '.removeIconFile', function(){
			var id = $(this).attr('id');
			$('#remove_id_'+id).remove();
		});
		$(document).off('click', '.removeFile').on('click', '.removeFile', function(){
			var id = $(this).attr('data-fileid');
			
			var main = $(this).parents('.input-file-style');
			var mainList = $(this).parents('.fileList');
			var j = 0;

			var mainID = $(this).attr('inputid');

			if(mainID != 'upload_document'){
				mainList.find('.listNameFile').each(function( index ) {
					j++;
					// console.log( index + ": " + $( this ).text() );
				});
				console.log(j);
				if(j <= 1){
					main.find('input.mainFileInput').addClass('require');
				}
			}

			$('#needInput'+id).remove();
			
			return false;

		});

		$('.checkboxEvent').click(function(e) {
			var id = $(this).attr('id');
			if(this.checked){
				$("#"+id+"File").show();
				$("#"+id+"File").find('input').addClass('require');
			}else{
				$("#"+id+"File").hide();
				$("#"+id+"File").find('input').removeClass('require');
				$("#"+id+"File").find(input).val('');
			}
			
		});		

		// $('.datepicker').datepicker({
		// 	format: 'dd/mm/yy'
		// });
		$('.bootstrap-date').datepicker({
            format: 'dd/mm/yyyy'
        });
        $('.bootstrap-date-range').datepicker({
            format: 'dd/mm/yyyy',
            inputs: $('.actual_range')
        });
	});
	
	var i = 0;
	function functionUploadFile(fileName, labelName) {
		i++;
		if(fileName == 'upload_document'){
			var input = '<input type="file" class="form-control-file " id="upload_document_'+i+'" name="upload_document[]" accept="application/pdf,application/vnd.ms-excel" >';
		}else if(fileName == 'upload_kml'){
			var input = '<input type="file" class="form-control-file " id="upload_document_'+i+'" name="upload_kml[]" accept=".kml" >';
		}else if(fileName == 'upload_optional'){
			var input = '<input type="file" class="form-control-file " id="upload_document_'+i+'" name="upload_optional[]" accept="application/pdf,application/vnd.ms-excel" >';
		}else if(fileName == 'upload_mrv'){
			var input = '<input type="file" class="form-control-file " id="upload_document_'+i+'" name="upload_mrv[]" accept="application/pdf,application/vnd.ms-excel" >';
		}else if(fileName == 'upload_safeguard'){
			var input = '<input type="file" class="form-control-file " id="upload_document_'+i+'" name="upload_safeguard[]" accept="application/pdf,application/vnd.ms-excel" >';
		}else if(fileName == 'upload_benefit'){
			var input = '<input type="file" class="form-control-file " id="upload_document_'+i+'" name="upload_benefit[]" accept="application/pdf,application/vnd.ms-excel" >';
		}
		// console.log(input);
		// multiple
		// var removeLink = "<a class=\"removeFile\" href=\"#\" data-fileid=\"" + i + "\">Remove</a>";
		jQuery('.'+labelName).children(".fileList").append("<li class='listNameFile' id='needInput"+i+"'>"+input+"</li> ");

		document.getElementById('upload_document_'+i).click();
		document.getElementById('upload_document_'+i).addEventListener("change", function (data) {
			var files = data.target.files;
			// var filenames = document.getElementById(labelName);
			// filenames.innerHTML = ""
			
			if (files.length > 0) {
				var output = [];
				var p = 0;
				Array.from(files).forEach((file) => {
					p++;
					var removeLink = "<a class=\"removeFile\" href=\"#\" data-fileid=\"" + i + "\" inputID='"+fileName+"'><i class='fa fa-times txt-color-red eventDelete' aria-hidden='true'></i></a>";
					
					if(p == 1){ 
						output.push(removeLink+" <strong>", escape(file.name), "</strong>");
					}else{
						output.push(" <strong>", escape(file.name), "</strong>");
					}
					
					// var input = '<input type="file" class="form-control-file hiddenFile" id="upload_document_'+p+'" name="upload_documentFile[]" accept="application/pdf,application/vnd.ms-excel">';
					// filenames.innerHTML += input+file.name + ' , ';
				})
				// console.log(output);
				jQuery('.'+labelName).find("li#needInput"+i).append(output.join(""));
				jQuery("#"+fileName).removeClass('require');

				var class_div = '#blockStep2';
				if (fileName == "upload_document") {
					jQuery(class_div + ' #title-upload-document').removeClass('label_red');
				}
				else if (fileName == "upload_kml") {
					jQuery(class_div + ' #project-location').removeClass('label_red');
				}
				else if (fileName == "upload_optional") {
					jQuery(class_div + ' #document-optional').removeClass('label_red');
				}
				else if (fileName == "upload_mrv") {
					jQuery(class_div + ' #display-name-upload_mrv').removeClass('label_red');
				}
				else if (fileName == "upload_safeguard") {
					jQuery(class_div + ' #display-name-safeguard').removeClass('label_red');
				}
				else if (fileName == "upload_benefit") {
					jQuery(class_div + ' #display-name-benefit').removeClass('label_red');
				}
				else if (fileName == "greenhouse_gases") {
					jQuery(class_div + ' #label-greenhouse').removeClass('label_red');
				}
				else {
					jQuery(class_div + ' #' + id).prev('label').removeClass('label_red');
				}
			}else{
				jQuery('.'+labelName).find("li#needInput"+i).remove();
			}
		});
	}
</script>

<style>
	ul.wp-submenu-wrap li:nth-child(4),ul.wp-submenu-wrap li:nth-child(5){
		display: none;
	}
	body{
		background: none !important;
	}
	.hideItem{
		display:none;
	}
	.container-main{
		max-width: 780px;
	}
	.header-title{
		font-family: Tahoma;
		font-style: normal;
		font-weight: bold;
		font-size: 20px;
		line-height: 25px;
		/* identical to box height, or 125% */

		text-align: center;

		/* Redd+ Black */

		color: #333333;

		border-bottom: 2px solid #83BC83;
		padding-bottom: 10px;
	}
	label.labelinput{
		font-family: Tahoma;
		font-style: normal;
		font-weight: bold;
		font-size: 15px;
		line-height: 20px;
		color: #333333;
	}
	.sublabelinput{
		font-family: Tahoma;
		font-style: normal;
		font-weight: normal;
		font-size: 10px;
		line-height: 15px;

		color: #333333;
	}
	.sublabelinputStyle2{
		font-family: Tahoma;
		font-style: normal;
		font-weight: normal;
		font-size: 15px;
		line-height: 25px;
		color: #333333;
	}
	input.form-control::placeholder, textarea.form-control::placeholder{
		font-family: Tahoma;
		font-style: normal;
		font-weight: normal;
		font-size: 10px;
		line-height: 15px;
		color: #999999;
	}
	.label_red{
		color: #F00808 !important;
	}
	select.selectOwrite{
		height: 38px !important;
	}
	select.form-control{
		font-family: Tahoma;
		font-style: normal;
		font-weight: normal;
		font-size: 10px;
		line-height: 15px;
		color: #999999;
	}
	#office_number, #office_number_partner{
		margin-bottom: 10px;
	}
	.content-style-1{
		font-family: Tahoma;
		font-style: normal;
		font-weight: normal;
		font-size: 15px;
		line-height: 25px;
		color: #333333;
	}

	label.labelinput-style2{
		font-family: Tahoma;
		font-style: normal;
		font-weight: normal;
		font-size: 12px;
		line-height: 18px;

		color: #333333;
	}

	.btn_add_more{
		font-family: Tahoma;
		font-style: normal;
		font-weight: normal;
		font-size: 12px;
		line-height: 20px;
		text-align: center;
		color: #077907;

		border: 1px solid #077907;
		box-sizing: border-box;

		padding: 5px 10px;
    	background: none;
	}
	.btn_add_more:hover{
		color: #999999;
		border-color: #999999;
	}
	.info_require{
		font-family: Verdana;
		font-style: italic;
		font-weight: normal;
		font-size: 8px;
		line-height: 18px;
		color: #F00808;
	}
	.btn_next{
		background: #077907;
		padding: 10px 30px;

		font-family: Tahoma;
		font-style: normal;
		font-weight: normal;
		font-size: 12px;
		line-height: 20px;
		text-align: center;
		color: #FFFFFF;

		border: none;
		float: right;
	}
	.needLoopItem{
		margin-top: 20px;
		margin-bottom: 10px;
		padding: 20px;
		background: rgba(153, 153, 153, 0.5);
		position: relative;
	}
	.pStyle{
		font-family: Tahoma;
		font-style: normal;
		font-weight: normal;
		font-size: 15px;
		line-height: 25px;
		color: #333333;
	}
	.form-check-input{
		position: relative;
	}
	.form-check{
		padding-left:0px;
	}
	.hideCheckbox{
		display: none;
	}
	.removeIcon{
		position: absolute;
		right: -8px;
		top: -10px;
	}
	.removeIconUpdate{
		position: absolute;
		right: -8px;
		top: -10px;
	}
	.txt-color-red{
		color: red;
		font-size: 25px;
	}
	.fileList{
		position: relative;
		margin-right: 8px;
    	margin-top: 10px;
	}
	.fileList .txt-color-red{
		color: red;
		font-size: 15px;
	}
	.fileList .listNameFile{

	}


	.form-group .input-file-style .form-control-file {
		padding: 10px;
		display: none;
	}
	.form-group .input-file-style .show-container{
		padding: 10px;
	}
	.form-group .input-file-style .show-container .button-file{
		width: 110px;
		text-align: center;
		font-family: Tahoma;
		font-style: normal;
		font-weight: normal;
		font-size: 12px;
		color: #FFFFFF;
		cursor: pointer;
		background-color:#077907;
		align-self: center;
		padding: 7px 0px 7px 0px;

	}
	.form-group .input-file-style .show-container .display-name{
		font-family: Tahoma;
		font-style: normal;
		font-weight: normal;
		font-size: 10px;
		line-height: 14px;
		padding: 9px;
		align-self: center;
		color: #FFFFFF;
		background-color: #828282;
	}
	
</style>

<div class="container-fluid">

	<div class="row pt-4">
		<?php if($edit){?>
			<h1>Edit Project Name : <?php echo $projectInfo->project_name;?></h1>
		<?php }else{?>
			<h1>Add Project</h1>
		<?php }?>
	</div>
	
	<?php 
	if($hStep == 1){
	?>
		<form method="POST" enctype="multipart/form-data"  action="" id="blockStep1">
			<input type="hidden" id="" name="stepValue" value="2">
				<?php 
					if($edit){
						include 'step1edit.php';
					}else{
						include 'step1.php';
					}
				?>
		</form>
	<?php }else if($hStep == 2){?>
		<form method="POST" enctype="multipart/form-data" action="" id="blockStep2">
			<input type="hidden" id="" name="stepValue" value="3">
			<?php 
				if($edit){
			?>
				<input type="hidden" id="id_project" name="id_project" value="<?php echo $id_project;?>">
			<?php		
					include 'step2edit.php';
				}else{
					include 'step2.php';
				}
			?>
		</form>
	<?php }?>


	<div class="container-main">
		<div class="row pt-4">
			<div class="col-6">
				<span class="info_require">*Required fields</span>
			</div>
			<?php 
			if($hStep == 1){
			?>
				<div class="col-6 ">
					<button type="button" class="btn_next next_step" step="1">Next</button>
				</div>
			<?php }else if($hStep == 2){?>
				<form method="POST" enctype="application/x-www-form-urlencoded" action="" id="blockStepBack">
					<input type="hidden" id="" name="stepValue" value="1">
				</form>
				<div class="col-3 ">
					<button type="button" class="btn_next back_step" step="1">Back</button>
				</div>
				<div class="col-3 ">
					<button type="button" class="btn_next next_step" step="2">Next</button>
				</div>
			<?php }?>
		</div>
	</div>
	
</div>