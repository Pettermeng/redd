<?php
	global $wpdb;
	$table_name = $wpdb->prefix . "type";

	if(isset($_GET['action'])){
		$id = $_GET['id'];
        $result_delete = $wpdb->delete( $table_name, array( 'ID' => $id ), array( '%d' ) );
		if ($result_delete) {
	?>
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>Delete record successfully!</strong>
		</div>
	<?php
		} else {
		    echo "Error: " . $sql . "<br>";
		}
	}
	if(isset($_POST['submit_save'])){
		$type = $_POST['type_name'];
		$result_add = $wpdb->insert( 
					$table_name,
					array( 
						'type_name' => $type
					), 
					array( 
						'%s' 
					)
				);
		
		if ($result_add) {
	?>
		<div class="alert alert-info" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>New record created successfully!</strong>
		</div>
	<?php		
		} else {
		    echo "Error: " . $sql . "<br>";
		}
	}
	if(isset($_POST['submit_update'])){
		$id = $_POST['id'];
		$type = $_POST['type_name'];
		$result_add = $wpdb->update( 
									$table_name, 
									array( 
										'type_name' => $type,	// string
									), 
									array( 'ID' => $id ), 
									array( 
										'%s',	// value1
									), 
									array( '%d' ) 
								);
		if ($result_add) {
	?>
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>Update record successfully!</strong>
		</div>
	<?php		
		} else {
		    echo "Error: " . $result_add . "<br>";
		}
	}
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    $('form').submit(function() {
	    	var budget = $("#type_name").val();
    		if (budget === '') {
    			alert("input Type");
    			return false;
	        }
      	});
    });
</script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<style>
	body{
		background: none !important;
	}
</style>

<div class="container-fluid">
	<div class="row">
		<h2>Type</h2>
	</div>
	<?php if($_GET['id']){ ?>
	<?php
		$row_val = $wpdb->get_row("SELECT * FROM $table_name WHERE id='".$_GET['id']."'");
	?>
		<form action="#" method="post">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<input type="hidden" name="id" id="id" value="<?php echo $row_val->id;?>"/>
					    <input type="text" class="form-control" value="<?php echo $row_val->type_name;?>" name="type_name" id="type_name" placeholder="Type" style="width:50%;">
					</div>
					<!-- <button type="submit" class="btn btn-default">Submit</button> -->
					<input type="submit" name="submit_update" class="btn btn-default" value="Save"/>
				</div>
			</div>
		</form>
	<?php }else{?>
	<form action="#" method="post">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
				    <input type="text" class="form-control" name="type_name" id="type_name" placeholder="Type" style="width:50%;">
				</div>
				<!-- <button type="submit" class="btn btn-default">Submit</button> -->
				<input type="submit" name="submit_save" class="btn btn-default" value="Save"/>
			</div>
		</div>
	</form>
	<?php }?>

	<?php
		$total = $wpdb->get_var("
	    SELECT COUNT(id)
	    FROM $table_name
		");
		$limit = 10;
		$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
		$offset = ($page - 1)  * $limit;

	?>
	<div class="row">
		<h2>Lists Type</h2>
		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<th>N°</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
					<?php 
						$post_id = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC Limit $offset,$limit");
						$i=1;
						foreach ($post_id as $row) {
					?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $row->type_name;?></td>
						<td>
							<a class="btn btn-info btn-xs" href="?page=add_type&id=<?php echo $row->id;?>" role="button">Edit</a>
							<a class="btn btn-danger btn-xs" href="?page=add_type&id=<?php echo $row->id;?>&action=delete" role="button">Delete</a>
						</td>
					</tr>
					<?php 
						$i++; 
						}
					?>
				</table>
			</div>
		</div>
	</div>
		<?php
		

		echo paginate_links( array(
		    'base' => add_query_arg( 'cpage', '%#%' ),
		    'format' => '',
		    'prev_text' => __('&laquo;'),
		    'next_text' => __('&raquo;'),
		    'total' => ceil($total / $limit),
		    'current' => $page
		));
	?>
</div>

<script type="text/javascript">
	function updateIframeSize(h){
		//ocument.getElementById('iframe-chart').height = h+"px";
	}	
</script>