<?php
	session_start();
    global $wpdb;
    $wp_plugin_dir = WP_CONTENT_DIR. '/plugins/myplugin';
    require($wp_plugin_dir.'/spreadsheet-reader/php-excel-reader/excel_reader2.php');
	require($wp_plugin_dir.'/spreadsheet-reader/SpreadsheetReader.php');


	$table_project = $wpdb->prefix . "project";
    $table_project_annual = $wpdb->prefix . "project_annual_emission_reductions";
    session_destroy();
	
	$activeStatus = 0;
	
    if(isset($_GET['id'])){
        $id_project = $_GET['id'];
        $projectInfo = $wpdb->get_row( "SELECT * FROM $table_project WHERE id = $id_project" );
    }else{
        $id_project = 0;
    }

    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
		$id_annual = $_GET['id_annual'];
        $wpdb->query( "DELETE FROM $table_project_annual WHERE id= $id_annual" );
		$activeStatus = 1;
	}

	if(isset($_GET['status']) && $_GET['status'] == 1){
		$activeStatus = $_GET['status'];
    }
    
    if($_FILES['upload_import']){

        $file = $_FILES['upload_import']['tmp_name'];
        $Spreadsheet = new SpreadsheetReader($file);
		$BaseMem = memory_get_usage();
        $Sheets = $Spreadsheet -> Sheets();
        $countSuccess = 0;
        foreach ($Sheets as $Index => $Name)
		{
			
            $item = 0;
			foreach ($Spreadsheet as $Key => $Row)
			{
                // var_dump($item.'=>'.$Row[0]);

                if($item == 0 && strtolower($Row[0]) != strtolower('Issuance Date')){
                    $error = 'The format not corect. please check your csv';
                    break;
                }
                if($item > 0){
                    if ($Row){

                        $issuse_date = '';
                        $vintage_start = '';
                        $vintage_end = '';
                        $verified = '';
                        $issued = '';
                        $methology = '';
                        $retire_date = '';
                        $buffer = '';

                        if($Row[0]){
                            $issuse_date = date("Y-m-d", strtotime(str_replace('/', '-', $Row[0])));
                        }
                        if($Row[1]){
                            $vintage_start = date("Y-m-d", strtotime(str_replace('/', '-', $Row[1])));
                        }
                        if($Row[2]){
                            $vintage_end = date("Y-m-d", strtotime(str_replace('/', '-', $Row[2])));
                        }
                        if($Row[7]){
                            $methology = $Row[7];
                        }
                        if($Row[8]){
                            $verified = $Row[8];
                        }
                        if($Row[9]){
                            $issued = $Row[9];
                        }
                        if($Row[12]){
                            $retire_date = date("Y-m-d", strtotime(str_replace('/', '-', $Row[12])));
                        }

                        // $checkDB = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_project_annual WHERE YEAR(vintage_end) = '$year' and id_project = $id_project" ) );
                        // if($checkDB->verified != ''){
                        //     $verified = $oldFileInfo->verified;
                        // }
                        $checkDB = $wpdb->get_row( "SELECT * FROM $table_project_annual WHERE 
                                                                    issuse_date = $issuse_date and 
                                                                    vintage_start = $vintage_start and 
                                                                    vintage_end = $vintage_end and 
                                                                    retire_date = $retire_date and 
                                                                    id_project = $id_project" 
                                                );
                        if($checkDB){
                            $data = array(
                                'issued' => $issued,
                                'methology' => $methology,
                                'updated_at' => date('Y-m-d H:i:s'),
                                'updated_by' => get_current_user_id()
                            );
                    
                            $id_CheckStatus = $wpdb->update( 
                                $table_project_annual, 
                                $data, 
                                array( 'id' => $checkDB->id )
                            ); 
                            if($checkSucc){
                                $countSuccess++;
                            }
                        }else{
                            $data = array(
                                'id_project' => $id_project, 
                                'issuse_date' => $issuse_date,
                                'vintage_start' => $vintage_start,
                                'vintage_end' => $vintage_end,
                                'verified' => $verified,
                                'issued' => $issued,
                                'methology' => $methology,
                                'retire_date' => $retire_date,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                                'created_by' => get_current_user_id(),
                                'updated_by' => get_current_user_id()
                            );
                            $format = array('%d','%s','%s','%s','%d','%d','%s','%s','%s','%s','%d','%d');
                            $wpdb->insert($table_project_annual,$data,$format);
                            $checkSucc = $wpdb->insert_id;
                            if($checkSucc){
                                $countSuccess++;
                            }
                        }
                        

                    }
                }
                $item++;
				
			}
		
			
		}
        

    }


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    
    });
</script>
<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">



<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo get_template_directory_uri();?>/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
    fun_validate = function(class_div) {
        var num;
        num = 0;
        $(class_div + " .require").each(function(index, element) {
			var id, info, value;
			value = $(element).val();
			id = $(element).attr('id');
            classPa = $(element).parent().attr('data-provide');
            console.log(classPa);
			
			if (value == '') {
				console.log(id+'=>'+value);
				if( classPa == 'bootstrap-date'){
                    $(class_div + ' .labelinput.datesubmit').addClass('label_red');
                }else{
                    $(class_div+' #' + id).addClass('label_red');
                }
				
				
				
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
	$(document).ready(function($) {
		$('#listallProject').DataTable({
		    "lengthChange": false,
		    "pageLength": 20,
		    "info": true,
		    "dom": 'ftipr',
		    "autoWidth" : true,
		});
		// $('#listallProject').DataTable();

        $('.deletedItem').click(function(e) {
            if(confirm("Are you sure you want to delete?")){
                return true;
            }
            else{
                return false;
            }
		});

        $('.upload_step').click(function(e) {
            if(fun_validate('form#importcsv') == 0){
                $('form#importcsv').submit();
            }
		});

	});
</script>
<style>
	table th{
		font-size: 14px;
	}
	table td{
		font-size: 13px;
	}
	ul.wp-submenu-wrap li:nth-child(4),ul.wp-submenu-wrap li:nth-child(5){
		display: none;
    }
    .label_red{
		color: #F00808 !important;
	}
</style>



<div class="container-fluid text-center">
	<div class="row pt-4">
		<h2><a href="?page=admin-page">List Project</a> > Annual emission reductions of project <?php echo $projectInfo->project_name;?></h2>
        
		<div class="col-sm-12">
			<?php 
			if($activeStatus == 1){
			?>
				<div class="alert alert-success text-left">
					<strong>Success!</strong>
				</div>
			<?php 
			}
			?>
            <?php 
			if(isset($countSuccess) && $countSuccess > 0){
			?>
				<div class="alert alert-success text-left">
                    <?php 
                    if($countSuccess > 1){
                    ?>
					    <strong>Success <?php echo $countSuccess.'Records';?></strong>
                    <?php 
                    }else{
                    ?>
                        <strong>Success <?php echo $countSuccess.'Record';?></strong>
                    <?php 
                    }
                    ?>
				</div>
			<?php 
			}
            ?>
            
            <?php 
			if(isset($error)){
			?>
				<div class="alert alert-danger text-left">
                    
                    <strong><?php echo $error;?></strong>
				</div>
			<?php 
			}
			?>
            

            <?php 
            if($id_project > 0){
            ?>
            <?php 
                $projectInfo = $wpdb->get_row( "SELECT * FROM $table_project WHERE id = $id_project" );
            ?>

            <div class="row mt-4">
                <div class="col-sm-12 text-center">
                    <h2>Projects name: <?php echo $projectInfo->project_name;?></h2>
                </div>
                <div class="col-sm-12 text-left">
					
                    <a class="btn btn-primary" href="?page=add_annual_emission_reductions&id_project=<?php echo $id_project;?>" role="button">Add New</a>
                </div>
                <div class="col-sm-12 text-left pt-2">
                    <form method="POST" enctype="multipart/form-data"  action="" id="importcsv">
                        <div class="row">
                           
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-primary upload_step" >Import CSV</button>
                            </div>
                            <div class="col-sm-10">
                                <input 
                                    type="file" 
                                    class="form-control-file require" 
                                    id="upload_import"
                                    name="upload_import"
                                    accept=".csv"
                                    >
                            </div>
                        </div>
                    </form>
                    
                </div>
                
                
                
                
            </div>

			<div class="table-responsive">
				<table class="table table-striped text-left" id="listallProject">
					<thead>
						<tr>
							<th style="width:5%;">N°</th>
							<th style="width:10%;">Issuse date</th>
							<th style="width:10%;">Vintage start</th>
							<th style="width:10%;">vintage_end</th>
                            <th style="width:10%;">Retire date</th>

							<th style="width:15%;">Verified</th>
							<th style="width:15%;">Issued</th>
                            <th style="width:10%;">Methology</th>
							<th style="width:15%;">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$rows = $wpdb->get_results("
									SELECT * FROM $table_project_annual
                                    where id_project = $id_project
                                    ORDER BY id DESC ");
						
						$i=1;
						foreach ($rows as $row) {
					?>
					<tr>
                        <td><?php echo $i;?></td>
						<td>
							<?php echo $row->issuse_date;?>
						</td>
                        <td>
							<?php echo $row->vintage_start;?>
						</td>
                        <td>
							<?php echo $row->vintage_end;?>
						</td>
                        <td>
							<?php echo $row->retire_date;?>
						</td>
						<td><?php echo $row->verified;?></td>
						<td ><?php echo $row->issued;?></td>
						<td ><?php echo $row->methology;?></td>

						<td>
							<a class="btn btn-outline-secondary btn-sm" href="?page=add_annual_emission_reductions&id_annual=<?php echo $row->id;?>&id_project=<?php echo $id_project;?>" role="button">Edit</a>
							<a class="btn btn-outline-danger btn-sm deletedItem" href="?page=annual_emission_reductions&id=<?php echo $id_project;?>&id_annual=<?php echo $row->id;?>&action=delete" role="button">Delete</a>
                       
						</td>
					</tr>
					<?php 
							$i++; 
						}
					?>
					</tbody>
				</table>
			</div>
            <?php 
            }
            ?>
		</div>
	</div>
</div>

