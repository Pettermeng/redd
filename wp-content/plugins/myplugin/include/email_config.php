<?php
	session_start();
	global $wpdb;

	$email_config = $wpdb->prefix . "email_config";
    
    
    $msg = '';
    $classError = 'alert-success';
    $data = $wpdb->get_row( "SELECT * FROM $email_config WHERE id = 1 " );

    if(isset($_POST['id'])){

    	$id = $_POST['id'];
    	$email_sender = $_POST['email_sender'];
		$email_send_to = $_POST['email_send_to'];

        
        $data = array(
            'email_sender' => $email_sender,
			'email_send_to' => $email_send_to
        );
        $id_CheckStatus = $wpdb->update( 
			$email_config, 
			$data, 
			array( 'id' => $id )
        );

        if($id_CheckStatus){
        	$msg = 'Update Successful';
        	$classError = 'alert-success';
        }else{
        	$msg = 'Update fail. please try again!';
        	$classError = 'alert-danger';
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
		
            <h2> Email config </h2>
	</div>

        <?php 
        if($msg != ''){
        ?>
            <div class="alert <?php echo $classError;?> text-left">
                <strong><?php echo $msg;?></strong>
            </div>
        <?php 
        }
        ?>
	
		<form method="POST" enctype="multipart/form-data"  action="" id="blockStepDocument">
            <div class="container-main ">
                
                <?php 
                if(isset($data->id)){
                    echo '<input type="hidden" name="id" id="id" value="'.$data->id.'"> ';
                }
                ?>
                
                
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1" class="labelinput ">Email Sender*</label>
                            <input type="text" value="<?php if(isset($_POST['email_sender'])){ echo $_POST['email_sender'];}elseif(isset($data->email_sender)){echo $data->email_sender ;} ?>" class="form-control require" name="email_sender" id="email_sender" placeholder="Fill information here...">
                        </div>
                    </div>
					<div class="col-6">
                        <div class="form-group">
                            <label for="exampleFormControlInput1" class="labelinput ">Email CC*</label>
                            <input type="text" value="<?php if(isset($_POST['email_send_to'])){ echo $_POST['email_send_to'];}elseif(isset($data->email_send_to)){echo $data->email_send_to ;} ?>" class="form-control" name="email_send_to" id="email_send_to" placeholder="Fill information here...">
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