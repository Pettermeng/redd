<?php
	session_start();
	global $wpdb;
	$table_project = $wpdb->prefix . "project";
    $table_project_type = $wpdb->prefix . "project_type";
    $table_project_progress = $wpdb->prefix . "project_progress";
    $table_project_status = $wpdb->prefix . "project_status";
    session_destroy();
    
    if(isset($_GET['id'])){
        $id_project = $_GET['id'];
    }else{
        $id_project = 0;
    }

    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
        $process_id = $_GET['id_process'];
        $wpdb->query( "DELETE FROM $table_project_progress WHERE id= $process_id" );

        // get last status
        $lastStatus = $wpdb->get_row( "SELECT * FROM $table_project_progress WHERE id_project = $id_project order by id_status DESC limit 1" );
        // update status project
        $result_add = $wpdb->update( 
            $table_project, 
            array( 
				'project_status' => $lastStatus->id_status,	// number
				'date_approval' => NULL	// number
            ), 
            array( 'id' => $id_project )
        );
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
		<h2><a href="?page=admin-page">List Project</a> > Projects status</h2>
        
		<div class="col-sm-12">
			<?php 
			if(isset($_GET['status']) && $_GET['status'] == 1){
			?>
				<div class="alert alert-success text-left">
					<strong>Success!</strong>
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
                <div class="col-sm-4 text-left">
                    <a class="btn btn-primary" href="?page=add_project_status&id_project=<?php echo $id_project;?>" role="button">Add Status</a>
                </div>
                <div class="col-sm-8 text-left">
                    <h2>Projects name: <?php echo $projectInfo->project_name;?></h2>
                </div>
            </div>

			<div class="table-responsive">
				<table class="table table-striped text-left" id="listallProject">
					<thead>
						<tr>
							<th style="width:5%;">N°</th>
                            <th style="width:5%;">Status ID</th>
							<th style="width:20%;">Status Name</th>
							<th style="width:10%;">Start Date</th>
							<th style="width:10%;">End Date</th>


							<th style="width:20%;">Process</th>
							<th style="width:10%;">Status</th>
							<th style="width:20%;">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$rows = $wpdb->get_results("
									SELECT 

									pp.id , pp.id_project, pp.id_status, pp.date as date_process, pp.end_date, pp.process,pp.step_status,
									ps.status_en, ps.status_kh, ps.parent
									
									FROM $table_project_progress pp
                                    LEFT JOIN $table_project_status ps
                                    ON pp.id_status = ps.id
                                    where pp.id_project = $id_project
                                    ORDER BY pp.id ASC ");
						
						$i=1;
						foreach ($rows as $row) {
					?>
					<tr>
                        <td><?php echo $i;?></td>
						<td> <?php echo $row->id_status;?></td>
						<td><?php echo $row->status_en;?></td>
						<td ><?php echo $row->date_process;?></td>
						<td ><?php echo $row->end_date;?></td>
						<td><?php echo $row->process;?></td>
						<td>
							<?php if($row->step_status == 'N' || !isset($row->step_status)) echo "Not yet started"?>
							<?php if($row->step_status == 'O') echo "Ongoing"?>
							<?php if($row->step_status == 'C') echo "Completed"?>
						</td>

						<td >
						<?php 
							if($row->id_status > 6 && ($projectInfo->project_status == 5 || $projectInfo->project_status == 6)){
						?>

						<?php 
							}else if($row->id_status == 5 || $row->id_status == 6){
						?>
							<a class="btn btn-outline-secondary btn-sm" href="?page=add_project_status&id_progress=<?php echo $row->id;?>&id_project=<?php echo $id_project;?>" role="button">Edit</a>
							<a class="btn btn-outline-danger btn-sm deletedItem" href="?page=project_status&id=<?php echo $id_project;?>&id_process=<?php echo $row->id;?>&action=delete" role="button">Delete</a>
						<?php		
							}else if( ($row->id_status >= 1) && ($row->id_status >= $projectInfo->project_status )){
                        ?>
							<a class="btn btn-outline-secondary btn-sm" href="?page=add_project_status&id_progress=<?php echo $row->id;?>&id_project=<?php echo $id_project;?>" role="button">Edit</a>
							<a class="btn btn-outline-danger btn-sm deletedItem" href="?page=project_status&id=<?php echo $id_project;?>&id_process=<?php echo $row->id;?>&action=delete" role="button">Delete</a>
                        <?php 
                            }
                        ?>
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

