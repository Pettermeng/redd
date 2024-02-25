<?php
	session_start();
	global $wpdb;

	$table_project = $wpdb->prefix . "project";
    $table_project_type = $wpdb->prefix . "project_type";
    $table_project_progress = $wpdb->prefix . "project_progress";
    $table_project_status = $wpdb->prefix . "project_status";
    $table_project_proponent = $wpdb->prefix . "project_proponent_partner";
    $table_lists_documents = $wpdb->prefix . "lists_documents";

    

    $edit = false;
	$id_project = '';
	if(isset($_GET['id_project'])){
		$id_project =  $_GET['id_project'];
        $projectInfo = $wpdb->get_row( "SELECT * FROM $table_project WHERE id = $id_project" );
		$project_proponent_email = $wpdb->get_row( "SELECT emails FROM $table_project_proponent where id_project = $id_project and type = 'proponent'");

        
        if($projectInfo->project_status == 1){
            
			$statusAll = $wpdb->get_results( "SELECT * FROM $table_project_status where id = 2 and parent = 0 order by id asc ,status_en asc", OBJECT );
		}else if($projectInfo->project_status == 7){
			$statusAll = $wpdb->get_results( "SELECT * FROM $table_project_status where parent = $projectInfo->project_status order by id asc ,status_en asc", OBJECT );
		}else if($projectInfo->project_status == 9){
			$statusAll = $wpdb->get_results( "SELECT * FROM $table_project_status where parent = $projectInfo->project_status order by id asc ,status_en asc", OBJECT );
		}else if($projectInfo->project_status == 10){
			$statusAll = $wpdb->get_results( "SELECT * FROM $table_project_status where id in (5,6) order by id asc ,status_en asc", OBJECT );
        }else{
            $statusAll = $wpdb->get_results( "SELECT * FROM $table_project_status where id in ($projectInfo->project_status,$projectInfo->project_status+1) and parent = 0 order by id asc ,status_en asc", OBJECT );
        }

        
    }
    
    
?>
<?php 
	// get email sender
	$table_email_config = $wpdb->prefix . "email_config";
	$emailInfo = $wpdb->get_row(  "SELECT * FROM $table_email_config WHERE id = 1" );
	
    $msg = '';

    if(isset($_POST['old_progress_id'])){

    	$id_progress = $_POST['old_progress_id'];
    	$id_status = $_POST['id_status'];
		$step_status = $_POST['step_status'];
        $date = $_POST['date'];
		$end_date = $_POST['end_date'];
        $process = $_POST['process'];
        $id_project =  $_GET['id_project'];
        //check status
         $check = $projectInfo = $wpdb->get_row( "SELECT * FROM $table_project_progress WHERE id_project = $id_project and process = '$process' and id_status = '$id_status' and id <> $id_progress" );
		 if($check){
            $statusInfo = $wpdb->get_row( "SELECT * FROM $table_project_status WHERE id = $id_status" );
            $msg = 'This status '.$statusInfo->status_en.' with process '.$process.' already exit. please try other one';
         }else{
         	
            $data = array(
                'id_status' => $id_status,
                'date' => date("Y-m-d", strtotime(str_replace('/', '-', $date ))),
				'end_date' => date("Y-m-d", strtotime(str_replace('/', '-', $end_date ))),
                'process' => $process,
				'step_status' => $step_status,
                'updated_at' => date('Y-m-d H:i:s')
            );

            $id_CheckStatus = $wpdb->update( 
				$table_project_progress, 
				$data, 
				array( 'id' => $id_progress )
			); 
            if($id_CheckStatus){

                // update status project
				$STATUS_APPROVED_ID= 8;
				if($id_status == $STATUS_APPROVED_ID){
					$result_add = $wpdb->update( 
						$table_project, 
						array( 
							'project_status' => $id_status,	// number
							'date_approval' => date('Y-m-d H:i:s')	// number
						), 
						array( 'id' => $id_project )
					);
				}else{
					$result_add = $wpdb->update( 
						$table_project, 
						array( 
							'project_status' => $id_status	// number
						), 
						array( 'id' => $id_project )
					);
				}


                header("Location: ".admin_url()."/admin.php?page=project_status&id=".$id_project);
            }else{
                $msg = 'Data can\'t save . please try other one';
            }

            
         }


	}else if(isset($_POST['id_status'])){
        $id_status = $_POST['id_status'];
        $date = $_POST['date'];
		$end_date = $_POST['end_date'];
        $process = $_POST['process'];
        $id_project =  $_GET['id_project'];
		$step_status = $_POST['step_status'];
		$projectInformation = $wpdb->get_row( "SELECT * FROM $table_project WHERE id = $id_project" );
         //check status
         $check = $projectInfo = $wpdb->get_row( "SELECT * FROM $table_project_progress WHERE id = $id_project and process = '$process' and id_status = '$id_status'" );
		 if($check){
            $statusInfo = $wpdb->get_row( "SELECT * FROM $table_project_status WHERE id_project = $id_status" );
            $msg = 'This status '.$statusInfo->status_en.' with process '.$process.' already exit. please try other one';
         }else{
            $data = array(
                'id_project' => $id_project, 
                'id_status' => $id_status,
                'date' => date("Y-m-d", strtotime(str_replace('/', '-', $date ))),
				'end_date' => date("Y-m-d", strtotime(str_replace('/', '-', $end_date ))),
                'process' => $process,
				'step_status' => $step_status,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => get_current_user_id(),
                'updated_by' => get_current_user_id()
            );
            $format = array('%d','%d','%s','%s','%s','%s','%s','%d','%d');
            $wpdb->insert($table_project_progress,$data,$format);
            $id_CheckStatus = $wpdb->insert_id;
            if($id_CheckStatus){

                // update status project
				$STATUS_APPROVED_ID= 8;
				if($id_status == $STATUS_APPROVED_ID){
					$result_add = $wpdb->update( 
						$table_project, 
						array( 
							'project_status' => $id_status,	// number
							'date_approval' => date('Y-m-d H:i:s')	// number
						), 
						array( 'id' => $id_project )
					);
				}else{
					$result_add = $wpdb->update( 
						$table_project, 
						array( 
							'project_status' => $id_status	// number
						), 
						array( 'id' => $id_project )
					);
					$previous_id_status = $id_status - 1;
					$result_status_add = $wpdb->update( 
						$table_project_progress, 
						array( 
							'step_status' => 'C'	// step status = Completed
						), 
						array( 'id_project' => $id_project, 'id_status' => $previous_id_status)
					);
					
				}

				// Upload file 
				$file_name = $_FILES['evaluation_report_file'];

				$pathField ="";
				if(isset($file_name)){
					$array = explode('.', $file_name['name']);
                    $extension = end($array);
					$file_tmp_name = $file_name['tmp_name'];
					$file_type =  $file_name['type'];
					$custom_file_name = date('Y-m-d').'-'.mt_rand(1, 99999).'-evaluation-report.'.$extension;
                    $uploaddir = wp_upload_dir();
                    $file_path = $uploaddir['path']."/".$custom_file_name;
                    $pathField = $uploaddir['url']."/".$custom_file_name;
					$id_evaluation_doc_type = 17;
					move_uploaded_file($file_tmp_name, $file_path);
					
					$data = array(
						'id_project' => $id_project, 
						'id_list_doc_type' => $id_evaluation_doc_type,
						'title' => $custom_file_name,
						'file_type' => $file_type,
						'path' => $pathField,
						'date_submitted' => date('Y-m-d H:i:s'),
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
						'created_by' => get_current_user_id(),
						'updated_by' => get_current_user_id()
					);
					
					$format = array('%d','%d','%s','%s','%s','%s','%s','%s','%d','%d');
					$wpdb->insert($table_lists_documents,$data,$format); 
                }

				// Send email 
				add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
				$STATUS_REVIEW_ID = 5;
				if($id_status == $STATUS_REVIEW_ID){
					$emailTo = $project_proponent_email->emails;
					$subject = 'REDD+ project status updated';
					$body = 'Your project has been updated. login to redd+ website to see more detail.<br><br>';
					$body .= 'URL :<a href="'.get_home_url().'/register-login.html">'.get_home_url().'/register-login.html</a> <br><br>';
					$body .= '<b>Project Name :'.$projectInformation->project_name.'</b><br><br>';
					$body .= 'Evaluation report: '.$pathField;
					$body .= 'Thank you';
					$headers = array('Content-Type: text/html; charset=UTF-8','From: Cambodia Redd+ <'.$emailInfo->email_sender.'>', 'Cc: '.$emailInfo->email_send_to.'');
				}else{

					$emailTo = $project_proponent_email->emails;
					$subject = 'REDD+ project status updated';
					$body = 'Your project has been updated. login to redd+ website to see more detail.<br><br>';
					$body .= 'URL :<a href="'.get_home_url().'/register-login.html">'.get_home_url().'/register-login.html</a> <br><br>';
					$body .= '<b>Project Name :'.$projectInformation->project_name.'</b><br><br>';
					$body .= 'Thank you';
					$headers = array('Content-Type: text/html; charset=UTF-8','From: Cambodia Redd+ <'.$emailInfo->email_sender.'>', 'Cc: '.$emailInfo->email_send_to.'');
				}
				
				$check = wp_mail($emailTo, $subject, $body, $headers);

				//redirect to project status list
                header("Location: ".admin_url()."/admin.php?page=project_status&id=".$id_project);
            }else{
                $msg = 'Data can\'t save . please try other one';
            }

            
         }



	}else if(isset($_GET['id_progress']) && isset($_GET['id_project'])){
		$edit = true;
		$idProgress = $_GET['id_progress'];

		$processInfo = $wpdb->get_row( "SELECT * FROM $table_project_progress WHERE id = $idProgress" );

		if($projectInfo->project_status == 7){
			$statusAll = $wpdb->get_results( "SELECT * FROM $table_project_status where parent = $projectInfo->project_status order by id asc ,status_en asc", OBJECT );
		}else if($projectInfo->project_status == 9){
			$statusAll = $wpdb->get_results( "SELECT * FROM $table_project_status where parent = $projectInfo->project_status order by id asc ,status_en asc", OBJECT );
		}else if($projectInfo->project_status == 10){
			$statusAll = $wpdb->get_results( "SELECT * FROM $table_project_status where id in (5,6) order by id asc ,status_en asc", OBJECT );
        }else{

        	if($projectInfo->project_status > 2){
        		$statusAll = $wpdb->get_results( "SELECT * FROM $table_project_status where id in ($projectInfo->project_status,$projectInfo->project_status-1) and parent = 0 order by id asc ,status_en asc", OBJECT );
        	}else{
        		$statusAll = $wpdb->get_results( "SELECT * FROM $table_project_status where id in ($projectInfo->project_status) and parent = 0 order by id asc ,status_en asc", OBJECT );
        	}
            
        }

	}	


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

	

	$(document).ready(function() {
	    var countCat = 0;


		$('.save_step').click(function(e) {
            // if(fun_validate('form#blockStepStatus') == 0){
                $('form#blockStepStatus').submit();
            // }
		});

		// set default dates
		var start = new Date();
		// set end date to max one year period:
		var end = new Date(new Date().setYear(start.getFullYear()+1));

		$('#date').datepicker({
			format: 'dd/mm/yyyy',
			autoclose:true,
			startDate : start,
			endDate   : end
		}).on('changeDate', function(){
			$('#end_date').datepicker('setStartDate', $(this).val());
		}); 

		$('#end_date').datepicker({
			format: 'dd/mm/yyyy',
			autoclose:true,
			startDate : start,
			endDate   : end,
		}).on('changeDate', function(){
			$('#date').datepicker('setEndDate',  $(this).val());
		});
		$('#evaluation_report_upload').hide();
		$('#id_status').on('change', function() {
			const STEP_FIVE_RTS_REVIEW = 5;
			if (this.value == STEP_FIVE_RTS_REVIEW) {
				$('#evaluation_report_upload').show();
			}else{
				$('#evaluation_report_upload').hide();
			}
		});

	});
	
	var i = 0;
	
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
<?php 
if(isset($_GET['id_project'])){
?>
<div class="container-fluid">
	
	<div class="row pt-4">
		<?php if($edit){?>
			<h2><a href="?page=admin-page">List Project</a> > <a href="?page=project_status&id=<?php echo $id_project;?>">Projects status</a> > Edit status project <?php echo $projectInfo->project_name;?></h2>
		<?php }else{?>
            <h2><a href="?page=admin-page">List Project</a> > <a href="?page=project_status&id=<?php echo $id_project;?>">Projects status</a> > Add status project <?php echo $projectInfo->project_name;?></h2>
		<?php }?>
	</div>

        <?php 
        if($msg != ''){
        ?>
            <div class="alert alert-success text-left">
                <strong><?php echo $msg;?></strong>
            </div>
        <?php 
        }
        ?>
	
		<form method="POST" enctype="multipart/form-data"  action="" id="blockStepStatus">
            <div class="container-main ">
                
                
                
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1" class="labelinput">Step*</label>

                            <?php if(isset($processInfo->id)){?>
                            <input type="hidden" name="old_progress_id" value="<?php echo $processInfo->id;?>">
                        	<?php }?>

                            <select class="form-control selectOwrite require" name="id_status" id="id_status">
                                <option value="">Choose one of the following...</option>
                                <?php foreach ( $statusAll as $row ) { 
                                ?>
                                    <option value="<?php echo $row->id;?>" 
                                    		<?php if($_POST['id_status'] == $row->id) echo 'selected';?>

                                    		<?php if(isset($processInfo->id_status) && ($processInfo->id_status == $row->id)) echo 'selected';?> 

                                    		><?php echo $row->status_en;?>
                                    </option>
                                    <?php 
                                    if($projectInfo->project_status >= 4 && $projectInfo->project_status <= 6){
                                        $statusChail = $wpdb->get_results( "SELECT * FROM $table_project_status where parent = $row->id order by id asc, status_en asc", OBJECT );
                                        if($statusChail){
                                            foreach ( $statusChail as $subRow ) {
                                    ?>
                                                <option value="<?php echo $subRow->id;?>" 
                                                	<?php if($_POST["id_status"] == $subRow->id) echo 'selected';?> 

                                                	<?php if(isset($processInfo->id_status) && ($processInfo->id_status == $subRow->id)) echo 'selected';?> 

                                                	> &nbsp;&nbsp;&nbsp; <?php echo $subRow->status_en;?></option>
                                    <?php 
                                            }
                                        }
                                    }
                                    ?>
                                <?php 
                                } //end loop main
                                
                                ?>
                            </select>
                        </div>
                    </div>
					<div class="col-4">
					<div class="form-group">
                            <label for="exampleFormControlSelect1" class="labelinput">Status*</label>
                            <select class="form-control selectOwrite require" name="step_status" id="step_status">
                                <option value="N" <?php if(!isset($processInfo->step_status)) echo 'selected';?> >Not yet started</option>
                                <option value="O" <?php if(isset($processInfo->step_status) && $processInfo->step_status == 'O') echo 'selected';?> >Ongoing</option>
								<option value="C" <?php if(isset($processInfo->step_status) && $processInfo->step_status == 'C')  echo 'selected';?> >Completed</option>
                            </select>
                        </div>
					</div>
                </div>
				<div class="row">
					<div class="col-6">
                        <div class="form-group datetime">
                            <label for="exampleFormControlSelect1" class="labelinput">Start Date *</label>
                            <div class="input-group date" data-provide="bootstrap-date">
                                <input type="text" autocomplete="off" value="<?php if(isset($_POST['date'])){ echo $_POST['date'];}elseif(isset($processInfo->date)){echo date("d/m/Y", strtotime($processInfo->date ));} ?>" class="form-control bootstrap-date" id="date" name="date">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-6">
					<div class="form-group datetime">
                            <label for="exampleFormControlSelect1" class="labelinput">End Date *</label>
                            <div class="input-group date" data-provide="bootstrap-date">
                                <input type="text" autocomplete="off" value="<?php if(isset($_POST['end_date'])){ echo $_POST['end_date'];}elseif(isset($processInfo->end_date)){echo date("d/m/Y", strtotime($processInfo->end_date ));} ?>" class="form-control bootstrap-date" id="end_date" name="end_date">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1" class="labelinput">Process content*</label>
                            <textarea class="form-control require" id="process" rows="3" placeholder="Fill information here..." name="process"><?php if(isset($_POST['process'])){ echo $_POST['process'];}elseif(isset($processInfo->process)){echo $processInfo->process;} ?></textarea>
                        </div>
                    </div>
                    
                </div>
				<div class="evaluation-report" id="evaluation_report_upload">
						<label for="inputGroupFileAddon01" class="labelinput">Evaluation report*</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="evaluation_report_file" name="evaluation_report_file" aria-describedby="inputGroupFileAddon01" accept=".docx,.xlsx,.pdf">
								<label class="custom-file-label" for="evaluation_report_file">Choose file</label>
							</div>
						</div>	
				</div>
                
            </div>
		</form>
	


	<div class="container-main">
		<div class="row pt-4">
			<div class="col-6">
				<span class="info_require">*Required fields</span>
			</div>
			
            <div class="col-6 ">
                <button type="button" class="btn_next save_step" >Submit</button>
            </div>
			
		</div>
	</div>
	
</div>
<?php 
}
?>
