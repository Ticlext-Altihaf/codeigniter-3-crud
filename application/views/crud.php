<?php
/**
 * [
{
"name": "blog",
"fields": [
{
"name": "blog_id",
"type": "int",
"max_length": null,
"default": null,
"primary_key": 1
},
{
"name": "blog_title",
"type": "varchar",
"max_length": 100,
"default": null,
"primary_key": 0
},
{
"name": "blog_author",
"type": "varchar",
"max_length": 100,
"default": "King of Town",
"primary_key": 0
},
{
"name": "blog_description",
"type": "text",
"max_length": null,
"default": null,
"primary_key": 0
}
],
"count": 160
}
]
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Stolen from https://codepen.io/naikjavaid/pen/XPrpjr -->
	<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo site_url("/assets/css/main.css") ?>">
	<!-- use site_url for subdirectory webserver fix -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="<?php echo site_url("/assets/js/main.js") ?>"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<body>
<div class="container">
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
					<h2>Manage <b id="title">Tables</b></h2>
				</div>
				<div class="col-sm-6">
					<a href="#addTableModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i>
						<span>Add New Table</span></a>
					<a href="#deleteTableModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i>
						<span>Delete</span></a>
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
			<tr>
				<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
				</th>
				<th>Name</th>
				<th>Column Length</th>
				<th>Rows Length</th>
				<th>Actions</th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach ($tables as $table) {
				?>
				<tr>
					<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox1" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
					</td>
					<td><a href="<?php echo $table['name'] ?>"><?php echo $table['name'] ?></a></td>
					<td><?php echo count($table['fields']) ?></td>
					<td><?php echo $table['count'] ?></td>
					<td>
						<a href="#editTableModal" class="edit" data-toggle="modal"><i class="material-icons"
																					  data-toggle="tooltip" title="Edit">&#xE254;</i></a>
						<a href="#deleteTableModal" class="delete" data-toggle="modal"><i class="material-icons"
																						  data-toggle="tooltip"
																						  title="Delete">&#xE872;</i></a>
					</td>
				</tr>
				<?php
			}
			?>

			</tbody>
		</table>
		<div class="clearfix">
			<div class="hint-text">Showing <b><?php echo count($tables) ?></b> tables </div>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="addTableModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Add Table</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" required></textarea>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editTableModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Edit Table</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" required></textarea>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteTableModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Delete Table</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
