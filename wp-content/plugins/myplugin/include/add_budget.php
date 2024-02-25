<?php
	if(isset($_GET['action'])){
		$id = $_GET['id'];
		$query = "DELETE FROM ad0p_budget WHERE id='".$id."'";
        $result_delete = mysql_query($query);
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
		$type = $_POST['budget'];
		$sql = "INSERT INTO ad0p_budget (budget) VALUES ('".$type."')";
		$result_add = mysql_query($sql);
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
		$type = $_POST['budget'];
		$sql = "UPDATE ad0p_budget SET budget='".addslashes($type )."' WHERE id='".$id."'";
        
		$result_add = mysql_query($sql);
		if ($result_add) {
	?>
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>Update record successfully!</strong>
		</div>
	<?php
		} else {
		    echo "Error: " . $sql . "<br>";
		}
	}

?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    $('form').submit(function() {
	    	var budget = $("#budget").val();
    		if (budget === '') {
    			alert("input Budget");
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
		<h2>Budget</h2>
	</div>
	<?php if($_GET['id']){ ?>
	<?php
		$sql_row = "SELECT * FROM ad0p_budget WHERE id='".$_GET['id']."'";
		$result_row = mysql_query($sql_row);
		$row_val = mysql_fetch_assoc($result_row);
	?>
		<form action="#" method="post">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<input type="hidden" name="id" id="id" value="<?php echo $row_val['id'];?>"/>
					    <input type="text" class="form-control" value="<?php echo $row_val['budget'];?>" name="budget" id="budget" placeholder="Budget" style="width:50%;">
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
				    <input type="text" class="form-control" name="budget" id="budget" placeholder="Budget" style="width:50%;">
				</div>
				<input type="submit" name="submit_save" class="btn btn-default" value="Save"/>
			</div>
		</div>
	</form>
	<?php }?>
	<div class="row">
		<h2>Lists Budget</h2>
		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table table-striped">
					<tr>
						<th>N°</th>
						<th>Budget</th>
						<th>Action</th>
					</tr>
					<?php 
						$sql = "SELECT * FROM ad0p_budget ORDER BY id DESC";
						$result = mysql_query($sql);
					?>
					<?php 
						$i=1;
						while($row = mysql_fetch_assoc($result)) { 
					?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $row['budget'];?></td>
						<td>
							<a class="btn btn-info btn-xs" href="?page=add_budget&id=<?php echo $row['id'];?>" role="button">Edit</a>
							<a class="btn btn-danger btn-xs" href="?page=add_budget&id=<?php echo $row['id'];?>&action=delete" role="button">Delete</a>
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
</div>

