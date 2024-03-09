<?php
	session_start();
	global $wpdb;
	$table_project = $wpdb->prefix . "project";
	$table_project_type = $wpdb->prefix . "project_type";
	$table_project_status = $wpdb->prefix . "project_status";

	$table_proponent_partner = $wpdb->prefix . "project_proponent_partner";
	$table_project_progress = $wpdb->prefix . "project_progress";
	$table_lists_documents = $wpdb->prefix . "lists_documents";
	$table_project_annual_emission_reductions = $wpdb->prefix ."project_annual_emission_reductions";

	// get email sender
	$table_email_config = $wpdb->prefix . "email_config";
	$emailInfo = $wpdb->get_row(  "SELECT * FROM $table_email_config WHERE id = 1" );
	// unset($_SESSION['hStep']);
	session_destroy();
	$statusSucc = '';
	$statusError = '';

	//Get user role in reviewer 
	$usersReviewer = get_users( array( 'role__in' => array( 'rts_reviewer')));

	if(isset($_GET['action']) && $_GET['action'] == 'delete'){
        $id = $_GET['id'];
		
		$proInfo = $wpdb->get_row( "SELECT * FROM $table_project WHERE id = $id" );

		// check table table_proponent_partner
		
		$checkPro1 = $wpdb->get_row( "SELECT * FROM $table_project_progress WHERE id_project = $id" );
		$checkPro2 = $wpdb->get_row( "SELECT * FROM $table_lists_documents WHERE id_project = $id" );
		$checkPro3 = $wpdb->get_row( "SELECT * FROM $table_project_annual_emission_reductions WHERE id_project = $id" );
		if($checkPro1){
			$statusError = "This project ".$proInfo->project_name." can't delete. Because this project have a transaction";
		}else if($checkPro2){
			$statusError = "This project ".$proInfo->project_name." can't delete. Because this project have a transaction";
		}else if($checkPro3){
			$statusError = "This project ".$proInfo->project_name." can't delete. Because this project have a transaction";
		}else{
			$wpdb->query( "DELETE FROM $table_proponent_partner WHERE id_project= $id" );
			$wpdb->query( "DELETE FROM $table_project WHERE id= $id" );

        	$statusSucc = 1;
		}
    } else if(isset($_GET['action']) && $_GET['action'] == 'add-reviewer'){
		$id = $_GET['id'];
		$reviewer_id = $_GET['reviewerID'];
		$reviewer_info = '';
		$wpdb->update( $table_project, array( 'reviewer_id' => $reviewer_id),array('id'=>$id));
		$statusSucc = 1;
		foreach($usersReviewer as $user){	
			if($user->id == $reviewer_id){
				$reviewer_info = $user;
				break;
			}
		}

		//Send notification email to reviewer 
		add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
		$emailTo = $reviewer_info->user_email;
		$subject = 'REDD+ you have been assigned as reviewer';
		$body = 'Hi,'.$reviewer_info->display_name.'<br>';
		$body .= 'you have been assigned as reviewer. login to redd+ website to see more detail.<br><br>';
		$body .= 'URL :<a href="'.get_home_url().'/wp-admin">'.get_home_url().'/wp-admin</a> <br><br>';
		$body .= 'Thank you'.$reviewer_info->user_email;
		$headers = array('Content-Type: text/html; charset=UTF-8','From: Cambodia Redd+ <'.$emailInfo->email_sender.'>', 'Cc: '.$emailInfo->email_send_to.'');
		$check = wp_mail($emailTo, $subject, $body, $headers);
	}

	// If admin display all project 
	if ( current_user_can( 'manage_options' ) ) {
		$projects_list = $wpdb->get_results("
		SELECT 

		rp.id, rp.project_name, rp.area, rp.project_description, rp.project_submit_date, rp.date_start,
		rp.date_end, rp.reviewer_id, rps.status_en,
		rpt.project_type_en
		
		FROM $table_project rp
		LEFT JOIN $table_project_type rpt
		ON rpt.id = rp.id_project_type
		LEFT JOIN $table_project_status rps 
		ON rps.id = rp.project_status
		ORDER BY rp.id DESC ");
	}else{
		// if not admin display only reviewer projects
		$current_login_user = get_current_user_id();
		$projects_list = $wpdb->get_results("
		SELECT 

		rp.id, rp.project_name,rp.area, rp.project_description, rp.project_submit_date, rp.date_start,
		rp.date_end, rp.reviewer_id, rps.status_en,
		rpt.project_type_en
		
		
		FROM $table_project rp
		LEFT JOIN $table_project_type rpt
		ON rpt.id = rp.id_project_type
		LEFT JOIN $table_project_status rps 
		ON rps.id = rp.project_status
		WHERE rp.reviewer_id = $current_login_user
		ORDER BY rp.id DESC ");
	}
	
	
    
    if(isset($_GET['status'])){
        $statusSucc = $_GET['status'];
    }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    
    });
</script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">



<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo get_template_directory_uri();?>/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function($) {
		$('#listallProject').DataTable({
		    "lengthChange": false,
		    "pageLength": 10,
		    "info": true,
		    "dom": 'ftipr',
		    "autoWidth" : true,
		});

	});
</script>
<style>
	table th{
		font-size: 14px;
		text-align:left;
	}
	table td{
		font-size: 13px;
		text-align:left;
	}

	ul.wp-submenu-wrap li:nth-child(4),ul.wp-submenu-wrap li:nth-child(5){
		display: none;
	}
</style>



<div class="container-fluid text-center">
	<div class="row pt-4">
		<h2>List Projects</h2>
		<div class="col-sm-12">
			<?php 
			if($statusSucc != ''){
			?>
				<div class="alert alert-success text-left">
					<strong>Success!</strong>
				</div>
			<?php 
			}
			?>

			<?php 
			if($statusError != ''){
			?>
				<div class="alert alert-danger text-left">
					<strong><?php echo $statusError;?></strong>
				</div>
			<?php 
			}
			?>
			<div class="table-responsive">
				<table class="table table-striped" id="listallProject">
					<thead>
						<tr>
							<th>N°</th>
							<th>Type</th>
							<th style="width: 200px;">Name</th>
							<th style="width: 150px;">Area (Unit in ha)</th>

							<th style="width: 350px;">Description</th>
							<th>Submit Date</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Reviwer</th>
							<th>Status</th> 
							<th style="width: 100px">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$i=1;
						foreach ($projects_list as $row) {
					?>
					<tr>
						<td><?php echo $row->id;?></td>

						<td><?php echo $row->project_type_en;?></td>
						<td>
							<?php 
								echo wp_trim_words( $row->project_name, 20, '[...]' );
							?>
						</td>
						<td><?php echo $row->area;?></td>
						<td>
							<?php 
								echo wp_trim_words( $row->project_description, 20, '[...]' );
							?>
						</td>

						<td><?php echo $row->project_submit_date;?></td>
						<td><?php echo $row->date_start;?></td>
						<td><?php echo $row->date_end;?></td>
						<td>
							<?php 
								if(isset($row->reviewer_id) ){
									$reviewer_name = get_user_meta($row->reviewer_id); 
									echo $reviewer_name['nickname'][0];
								}else{
									echo "No reviewer";
								}
							?>
						</td>
						<td><?php echo $row->status_en;?></td>
						<td>
							<div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
								</button>
								<div class="dropdown-menu .d-flex .flex-column .flex" aria-labelledby="dropdownMenuButton">
									<?php if ( current_user_can( 'manage_options' ) ) { ?>
									<a type="button" class=" dropdown-item btn" role="button" data-toggle="modal" data-target="#assignReviewerModal">Add Reviewer</a> 
									<?php }?>
									<a class="dropdown-item" href="?page=project_status&id=<?php echo $row->id;?>" role="button">Add Status</a>
									<a class="dropdown-item" href="?page=project_document&id=<?php echo $row->id;?>" role="button">Project Documents</a>
									<a class="dropdown-item" href="?page=annual_emission_reductions&id=<?php echo $row->id;?>" role="button">Annual reductions</a>
									<a class="dropdown-item" href="?page=add_project&id=<?php echo $row->id;?>" role="button">View / Edit</a>
									<a class="dropdown-item" style="color:#dc3545;" href="?page=admin-page&id=<?php echo $row->id;?>&action=delete" role="button">Delete</a>
								</div>
							</div>

						</td>
					</tr>
					<!-- Assign reviewer modal pop up  -->
					<div class="modal fade" id="assignReviewerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Please select reviewer:</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="dropdown">
										<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownReviewer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Project reviewers
										</button>
										<div class="dropdown-menu .d-flex .flex-column .flex" aria-labelledby="dropdownReviewer">
											<?php 
												foreach($usersReviewer as $user){								
											?>
												<a class="dropdown-item" href="?page=admin-page&id=<?php echo $row->id;?>&reviewerID=<?php echo $user->id;?>&action=add-reviewer" role="button"><?php echo $user->display_name;?></a>
											<?php }?>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END Assign reviewer modal pop up  -->
					<?php 
							$i++; 
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

