<?php
	session_start();
	global $wpdb;

	$table_project = $wpdb->prefix . "project";
    $table_list_doc_type = $wpdb->prefix . "list_doc_type";
    $table_lists_documents = $wpdb->prefix . "lists_documents";

    

    $edit = false;
	$id_project = '';
	if(isset($_GET['id_project'])){
		$id_project =  $_GET['id_project'];
        $projectInfo = $wpdb->get_row( "SELECT * FROM $table_project WHERE id = $id_project" );
        // check status of project
        
        $docTypes = $wpdb->get_results( "SELECT * FROM $table_list_doc_type order by type_title_en asc", OBJECT );
        // var_dump($docTypes);
        
    }
    
    if(isset($_GET['id_document']) && isset($_GET['id_project'])){
		$edit = true;
		$idProgress = $_GET['id_document'];

		$documentInfo = $wpdb->get_row( "SELECT * FROM $table_lists_documents WHERE id = $idProgress" );

	}

    if(isset($_POST['old_document_id'])){

    	$old_document_id = $_POST['old_document_id'];
    	$id_list_doc_type = $_POST['id_list_doc_type'];
		$date_submitted = $_POST['date_submitted'];
		$title = $_POST['title'];
        $file_project_description = $_FILES['upload_document'];
		$upload_document_old = $_POST['upload_document_old'];
		$link_download = $_POST['link_download'];

        // check old file
		$oldFileInfo = $wpdb->get_row( "SELECT * FROM $table_lists_documents WHERE id = $old_document_id" );
		
		if(count($file_project_description['name']) >0){ //check doc_type and upload  project_description
			// var_dump(count($file_project_description['name']));
			// die();
            // $docType = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_list_doc_type WHERE type_code = 'project_description'" ) );
			$wpdb->query( "DELETE FROM $table_lists_documents WHERE id=$old_document_id" );
			for($i=0; $i<count($file_project_description['name']); $i++){
				
				// block get info file
                $file_tmp_name = $file_project_description['tmp_name'][$i];
                $file_name = $file_project_description['name'][$i];
                $file_type = $file_project_description['type'][$i];
                
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
                        'id_list_doc_type' => $id_list_doc_type,
                        'title' => $title,
                        'file_type' => $file_type,
						'path' => $pathField,
						'link_download' => $link_download,
                        'date_submitted' => date("Y-m-d", strtotime(str_replace('/', '-', $date_submitted ))),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'created_by' => get_current_user_id(),
                        'updated_by' => get_current_user_id()
                    );
                    $format = array('%d','%d','%s','%s','%s','%s','%s','%s','%d','%d');
                    $wpdb->insert($table_lists_documents,$data,$format);
                }
			}
		}else if(count($upload_document_old) > 0){
			$data = array(
                'id_list_doc_type' => $id_list_doc_type,
                'date_submitted' => date("Y-m-d", strtotime(str_replace('/', '-', $date_submitted ))),
				'title' => $title,
				'link_download' => $link_download,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $id_CheckStatus = $wpdb->update( 
				$table_lists_documents, 
				$data, 
				array( 'id' => $old_document_id )
			); 
        }else{
            $data = array(
                'id_list_doc_type' => $id_list_doc_type,
                'date_submitted' => date("Y-m-d", strtotime(str_replace('/', '-', $date_submitted ))),
				'title' => $title,
				'file_type' => '',
				'path' => '',
				'link_download' => $link_download,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $id_CheckStatus = $wpdb->update( 
				$table_lists_documents, 
				$data, 
				array( 'id' => $old_document_id )
			); 
        }


        header("Location: ".admin_url()."/admin.php?page=project_document&id=".$id_project.'&status=1');
          


	}elseif(isset($_POST['id_list_doc_type'])){
        $id_list_doc_type = $_POST['id_list_doc_type'];
		$date_submitted = $_POST['date_submitted'];
		$title = $_POST['title'];
		$link_download = $_POST['link_download'];
		$file_project_description = $_FILES['upload_document'];
		$file_type = '';
		$pathField = '';
        
        if(count($file_project_description['name']) >0){ //check doc_type and upload  project_description
            // $docType = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_list_doc_type WHERE type_code = 'project_description'" ) );
            for($i=0; $i<count($file_project_description['name']); $i++){
                // block get info file
                $file_tmp_name = $file_project_description['tmp_name'][$i];
                $file_name = $file_project_description['name'][$i];
                $file_type = $file_project_description['type'][$i];
                
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
						'id_list_doc_type' => $id_list_doc_type,
						'title' => $title,
						'file_type' => $file_type,
						'path' => $pathField,
						'date_submitted' => date("Y-m-d", strtotime(str_replace('/', '-', $date_submitted ))),
						'link_download' => $link_download,
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
						'created_by' => get_current_user_id(),
						'updated_by' => get_current_user_id()
					);
					$format = array('%d','%d','%s','%s','%s','%s','%s','%s','%d','%d');
					$wpdb->insert($table_lists_documents,$data,$format);
                    
                    
                }
			}
			
		}else{
			$data = array(
				'id_project' => $id_project, 
				'id_list_doc_type' => $id_list_doc_type,
				'title' => $title,
				'file_type' => $file_type,
				'path' => $pathField,
				'date_submitted' => date("Y-m-d", strtotime(str_replace('/', '-', $date_submitted ))),
				'link_download' => $link_download,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
				'created_by' => get_current_user_id(),
				'updated_by' => get_current_user_id()
			);
			$format = array('%d','%d','%s','%s','%s','%s','%s','%s','%d','%d');
			$wpdb->insert($table_lists_documents,$data,$format);
		}

		header("Location: ".admin_url()."/admin.php?page=project_document&id=".$id_project.'&status=1');
		exit();
    }
    
    
?>
<?php 
	
   


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
    var i = 0;
	function functionUploadFile(fileName, labelName) {
		i++;
		if(fileName == 'upload_document'){
			var input = '<input type="file" class="form-control-file " id="upload_document_'+i+'" name="upload_document[]" accept="application/pdf,application/vnd.ms-excel,.kml,.kmz" >';
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
				console.log(i);
				jQuery('.'+labelName).find("li#needInput"+i).append(output.join(""));
				if(i>1){
					jQuery('.'+labelName).find("li#needInput"+(i-1)).remove();
				}
				jQuery("#"+fileName).removeClass('require');

				var class_div = '#blockStep2';
				if (fileName == "upload_document") {
					// jQuery(class_div + ' #title-upload-document').removeClass('label_red');
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
					// $(class_div + ' #title-upload-document').addClass('label_red');
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
                }else if(id == "date_submitted"){
                    $(class_div + ' .labelinput.datesubmit').addClass('label_red');
				}else{
					$(class_div+' #' + id).prev('label').addClass('label_red');
				}
				
				num = num + 1;
			} else {
				
					if (id == "upload_document") {
						// $(class_div + ' #title-upload-document').removeClass('label_red');
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

        $(document).off('click', '.removeFile').on('click', '.removeFile', function(){
			var id = $(this).attr('data-fileid');
			
			var main = $(this).parents('.input-file-style');
			var mainList = $(this).parents('.fileList');
			var j = 0;
			
			mainList.find('.listNameFile').each(function( index ) {
				j++;
				// console.log( index + ": " + $( this ).text() );
			});
			// console.log(j);
			if(j <= 1){
				// main.find('input.mainFileInput').addClass('require');
			}

			$('#needInput'+id).remove();
			
			return false;

		});
        $(document).off('click', '.removeIconFile').on('click', '.removeIconFile', function(){
			var id = $(this).attr('id');
			$('#remove_id_'+id).remove();
            // $('#upload_document').addClass('require');
		});


	    var countCat = 0;
		

		$('.save_step').click(function(e) {
            if(fun_validate('form#blockStepDocument') == 0){
                $('form#blockStepDocument').submit();
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

	<div class="row pt-4 pb-4">
		<?php if($edit){?>
			<h2><a href="?page=admin-page">List Project</a> > <a href="?page=project_document&id=<?php echo $id_project;?>">Projects document</a> > Edit document project <?php echo $projectInfo->project_name;?></h2>
		<?php }else{?>
            <h2><a href="?page=admin-page">List Project</a> > <a href="?page=project_document&id=<?php echo $id_project;?>">Projects document</a> > Add document project <?php echo $projectInfo->project_name;?></h2>
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
	
		<form method="POST" enctype="multipart/form-data"  action="" id="blockStepDocument">
            <div class="container-main ">
                
                
                
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1" class="labelinput">Document type*</label>

                            <?php if(isset($documentInfo->id)){?>
                            <input type="hidden" name="old_document_id" value="<?php echo $documentInfo->id;?>">
                        	<?php }?>

                            <select class="form-control selectOwrite require" name="id_list_doc_type" id="id_list_doc_type">
                                <option value="">Choose one of the following...</option>
                                <?php foreach ( $docTypes as $row ) { 
                                ?>
                                    <option value="<?php echo $row->id;?>" 
                                    		<?php if(isset($_POST['id_list_doc_type']) && $_POST['id_list_doc_type'] == $row->id){ echo 'selected';}elseif(isset($documentInfo->id_list_doc_type) && $documentInfo->id_list_doc_type == $row->id){echo 'selected';}?>

                                    		><?php echo $row->type_title_en;?>
                                    </option>
                                <?php 
                                } //end loop main
                                
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group datetime">
                            <label for="exampleFormControlSelect1" class="labelinput datesubmit">Date submitted*</label>
                            <div class="input-group date" data-provide="bootstrap-date">
                                <input type="text" value="<?php if(isset($_POST['date_submitted'])){ echo $_POST['date_submitted'];}elseif(isset($documentInfo->date_submitted)){echo date("d/m/Y", strtotime($documentInfo->date_submitted ));} ?>" class="form-control bootstrap-date require" id="date_submitted" name="date_submitted">
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
                            <label for="exampleFormControlInput1" class="labelinput ">Title*</label>
                            <input type="text" value="<?php if(isset($_POST['title'])){ echo $_POST['title'];}elseif(isset($documentInfo->title)){echo $documentInfo->title ;} ?>" class="form-control require" name="title" id="title" placeholder="Fill information here...">
                        </div>
                    </div>
					<div class="col-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1" class="labelinput ">Link</label>
                            <input type="text" value="<?php if(isset($_POST['link_download'])){ echo $_POST['link_download'];}elseif(isset($documentInfo->link_download)){echo $documentInfo->link_download ;} ?>" class="form-control" name="link_download" id="link_download" placeholder="Fill link here...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 fileupload">
                        <label for="exampleFormControlInput1" class="labelinput ">Document file</label>
                       
                        <div class="form-group">
                            <div class="input-file-style">
                                <input 
                                    type="file" 
                                    class="form-control-file mainFileInput " 
                                    id="upload_document"
                                    accept="application/pdf,application/vnd.ms-excel"
                                    >
                                <div>
                                <div class="row show-container">
                                    <div  onclick="functionUploadFile('upload_document','display-name-file')" class="button-file" id="button-file">Choose files</div>
                                    <!-- <div  class="button-file" id="upload-project-description">Choose files</div> -->
                                    <div class="col-lg-6 display-name" id="title-upload-document">
                                        Document.pdf ,Document.pdf
                                    </div>
                                    
                                </div>
                                <div class="display-name-file">
                                    <ul class="fileList">
                                       <?php 
                                       if(isset($documentInfo->file_type) && $documentInfo->file_type != ''){
                                       ?>
                                            <li class="listNameFile" id="remove_id_<?php echo $documentInfo->id;?>">
                                                <input type="hidden" name="upload_document_old[]" value="<?php echo $documentInfo->id;?>"> 
                                                <a class="removeIconFile" href="#" id="<?php echo $documentInfo->id;?>" inputid="upload_document"><i class="fa fa-times txt-color-red eventDelete" aria-hidden="true"></i></a> 
                                                <strong><?php echo $documentInfo->title;?></strong>
                                            </li>
                                        <?php 
                                        }
                                        ?>
                                    </ul>
                                </div>
                                    
                                </div>
                            </div>
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
                <button type="button" class="btn_next save_step" >Save</button>
            </div>
			
		</div>
	</div>
	
</div>
<?php 
}
?>