<?php
	session_start();
	global $wpdb;
	$table_project = $wpdb->prefix . "project";
    $table_list_doc_type = $wpdb->prefix . "list_doc_type";
    $table_lists_documents = $wpdb->prefix . "lists_documents";
    session_destroy();
	
	$activeStatus = 0;
	
    if(isset($_GET['id'])){
        $id_project = $_GET['id'];
    }else{
        $id_project = 0;
    }

    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
		$id_document = $_GET['id_document'];
		$listDocumentInfo = $wpdb->get_row( "SELECT * FROM $table_lists_documents WHERE id = $id_document" );
        $wpdb->query( "DELETE FROM $table_lists_documents WHERE id= $id_document" );
		$activeStatus = 1;

		$data = $listDocumentInfo->path;
		// unlink($data);
	}

	if(isset($_GET['status']) && $_GET['status'] == 1){
		$activeStatus = $_GET['status'];
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
	}
	table td{
		font-size: 13px;
	}
	ul.wp-submenu-wrap li:nth-child(4),ul.wp-submenu-wrap li:nth-child(5){
		display: none;
	}
</style>



<div class="container-fluid text-center">
	<div class="row pt-4">
		<h2><a href="?page=admin-page">List Project</a> > Projects document</h2>
        
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
            if($id_project > 0){
            ?>
            <?php 
                $projectInfo = $wpdb->get_row( "SELECT * FROM $table_project WHERE id = $id_project" );
            ?>

            <div class="row mt-4">
                <div class="col-sm-4 text-left">
					
                    <a class="btn btn-primary" href="?page=add_project_document&id_project=<?php echo $id_project;?>" role="button">Add Document</a>
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
							<th style="width:15%;">Type</th>
							<th style="width:25%;">title</th>
							<th style="width:10%;">File Type</th>
							<!-- <th style="width:10%;">Link</th> -->
							<th style="width:10%;">Date submitted</th>
							<th style="width:25%;">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$rows = $wpdb->get_results("
									SELECT 

									ld.id , ld.id_project, ld.id_list_doc_type, ld.title, ld.file_type, ld.path, ld.date_submitted, ld.link_download,
									ldt.type_title_en , ldt.type_title_kh, ldt.type_code
									
									FROM $table_lists_documents ld
                                    LEFT JOIN $table_list_doc_type ldt
                                    ON ld.id_list_doc_type = ldt.id
                                    where ld.id_project = $id_project
                                    ORDER BY ld.id_list_doc_type ASC ");
						
						$i=1;
						foreach ($rows as $row) {
					?>
					<tr>
                        <td><?php echo $i;?></td>
						<td>
							<?php 
								echo $row->type_title_en;
							?>
						</td>
						<td><?php echo $row->title;?></td>
						<td ><?php echo $row->file_type;?></td>
						<!-- <td ><?php echo $row->link_download;?></td> -->
						<td ><?php echo $row->date_submitted;?></td>

						<td>
							<?php 
							if($row->link_download != ''){
							?>
								<a class="btn btn-outline-secondary btn-sm" target="_blank" href="<?php echo $row->link_download;?>" role="button">Download</a>
							<?php 
							}else{
							?>
								<a download class="btn btn-outline-secondary btn-sm" target="_blank" href="<?php echo $row->path;?>" role="button">Download</a>
							<?php 
							}
							?>
							<a class="btn btn-outline-secondary btn-sm" href="?page=add_project_document&id_document=<?php echo $row->id;?>&id_project=<?php echo $id_project;?>" role="button">Edit</a>
							<a class="btn btn-outline-danger btn-sm deletedItem" href="?page=project_document&id=<?php echo $id_project;?>&id_document=<?php echo $row->id;?>&action=delete" role="button">Delete</a>
                       
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

