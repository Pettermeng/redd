<?php
	session_start();
	global $wpdb;
	$list_document_type = $wpdb->prefix . "list_doc_type";
	$lists_documents = $wpdb->prefix . "lists_documents";
	// unset($_SESSION['hStep']);
    session_destroy();
	$statusSucc = '';
	$msg = "";
    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
        $id = $_GET['id'];
		
		$checkPro = $wpdb->get_row( "SELECT * FROM $lists_documents WHERE id_list_doc_type = $id" );
		if($checkPro){
			$statusSucc = 2;
			$msg = "This type can't delete. it use from document list";
		}else{
			$wpdb->query( "DELETE FROM $list_document_type WHERE id= $id" );
        	$statusSucc = 1;
		}
    }
    
    if(isset($_GET['status'])){
        $statusSucc = $_GET['status'];
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
		    "pageLength": 10,
		    "info": true,
		    "dom": 'ftipr',
		    "autoWidth" : true,
		});
		// $('#listallProject').DataTable();

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
		<h2>List document type</h2>
		<div class="col-sm-12">
		<?php 
			if($statusSucc == 1){
			?>
				<div class="alert alert-success text-left">
					<strong>Success!</strong>
				</div>
			<?php 
			}else if($statusSucc == 2){
			?>
				<div class="alert alert-danger text-left">
					<strong><?php echo $msg ?></strong>
				</div>
			<?php 
			}
			?>
			<div class="table-responsive">
				<table class="table table-striped" id="listallProject">
					<thead>
						<tr>
							<th>N°</th>
							<th>Name english</th>
							<th>Name khmer</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$rows = $wpdb->get_results("
									SELECT *
									FROM $list_document_type 
									ORDER BY type_title_en DESC ");
						
						$i=1;
						foreach ($rows as $row) {
					?>
					<tr>
						<td><?php echo $row->id;?></td>

						<td><?php echo $row->type_title_en;?></td>
						<td><?php echo $row->type_title_kh;?></td>

						<td>
							
							<a class="btn btn-outline-secondary btn-sm" href="?page=add_document_type&id=<?php echo $row->id;?>" role="button">Edit</a>
							<a class="btn btn-outline-danger btn-sm" href="?page=document_type&id=<?php echo $row->id;?>&action=delete" role="button">Delete</a>
						</td>
					</tr>
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

