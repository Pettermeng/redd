<?php
	session_start();
	global $wpdb;

	$organization_category = $wpdb->prefix . "organization_category";
    
    

    $edit = false;
    $msg = '';

    if(isset($_POST['old_org_id'])){

    	$old_org_id = $_POST['old_org_id'];
    	$title_en = $_POST['title_en'];
		$title_kh = $_POST['title_kh'];

        // check old file
		$checkData = $wpdb->get_row( "SELECT * FROM $organization_category WHERE id != $old_org_id and title_en = '$title_en' " );
        
		if($checkData){ //check doc_type and upload  project_description
			$msg = 'Title '.$title_en.' has already. please try other title';
		 
        }else{
            $data = array(
                'title_en' => $title_kh,
				'title_kh' => $title_kh
            );
            $id_CheckStatus = $wpdb->update( 
				$organization_category, 
				$data, 
				array( 'id' => $old_org_id )
            ); 
            header("Location: ".admin_url()."/admin.php?page=organizational_category&status=1");
            exit();
        }
          
    }else if(isset($_GET['id'])){ // edit page
        $edit = true;
        $old_org_id = $_GET['id'];
        $oldInfo = $wpdb->get_row( "SELECT * FROM $organization_category WHERE id = $old_org_id " );

	}elseif(isset($_POST['title_en'])){
        $title_en = $_POST['title_en'];
		$title_kh = $_POST['title_kh'];
        
        $checkData = $wpdb->get_row( "SELECT * FROM $organization_category WHERE title_en = '$title_en' " );
		
		if($checkData){ //check doc_type and upload  project_description
			$msg = 'Title '.$title_en.' has already. please try other title';
		 
        }else{
            $data = array(
                'title_en' => $title_en, 
                'title_kh' => $title_kh
            );
            $format = array('%s','%s');
            $wpdb->insert($organization_category,$data,$format);

		    header("Location: ".admin_url()."/admin.php?page=organizational_category&status=1");
            exit();
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
    

	fun_validate = function(class_div) {
        var num;
        num = 0;
        $(class_div + " .require").each(function(index, element) {
			var id, info, value;
			value = $(element).val();
			id = $(element).attr('id');
			
			if (value == '') {
				console.log(id+'=>'+value);
				
				$(class_div+' #' + id).prev('label').addClass('label_red');
				
				num = num + 1;
			} else {
				
					$(class_div+' #' + id).prev('label').removeClass('label_red');
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
		

		$('.save_step').click(function(e) {
            if(fun_validate('form#blockStepDocument') == 0){
                $('form#blockStepDocument').submit();
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

<div class="container-fluid">

	<div class="row pt-4 pb-4">
		<?php if($edit){?>
			<h2><a href="?page=organizational_category">List organizational category</a> > Edit organizational category <?php echo $oldInfo->title_en;?></h2>
		<?php }else{?>
            <h2><a href="?page=organizational_category">List organizational category</a> > Add organizational category </h2>
		<?php }?>
	</div>

        <?php 
        if($msg != ''){
        ?>
            <div class="alert alert-danger text-left">
                <strong><?php echo $msg;?></strong>
            </div>
        <?php 
        }
        ?>
	
		<form method="POST" enctype="multipart/form-data"  action="" id="blockStepDocument">
            <div class="container-main ">
                
                <?php 
                if(isset($oldInfo->id)){
                    echo '<input type="hidden" name="old_org_id" id="old_org_id" value="'.$oldInfo->id.'"> ';
                }
                ?>
                
                
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1" class="labelinput ">Title english*</label>
                            <input type="text" value="<?php if(isset($_POST['title_en'])){ echo $_POST['title_en'];}elseif(isset($oldInfo->title_en)){echo $oldInfo->title_en ;} ?>" class="form-control require" name="title_en" id="title_en" placeholder="Fill information here...">
                        </div>
                    </div>
					<div class="col-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1" class="labelinput ">Title khmer*</label>
                            <input type="text" value="<?php if(isset($_POST['title_kh'])){ echo $_POST['title_kh'];}elseif(isset($oldInfo->title_kh)){echo $oldInfo->title_kh ;} ?>" class="form-control" name="title_kh" id="title_kh" placeholder="Fill information here...">
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