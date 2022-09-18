
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Stolen from https://codepen.io/naikjavaid/pen/XPrpjr -->
	<title><?php echo $table?>  - Bootstrap CRUD Data Table for Database with Modal Form</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
		body {
			color: #566787;
			background: #f5f5f5;
			font-family: "Varela Round", sans-serif;
			font-size: 13px;
		}
		.table-wrapper {
			background: #fff;
			padding: 20px 25px;
			margin: 30px 0;
			border-radius: 3px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
		}
		.table-title {
			padding-bottom: 15px;
			background: #435d7d;
			color: #fff;
			padding: 16px 30px;
			margin: -20px -25px 10px;
			border-radius: 3px 3px 0 0;
		}
		.table-title h2 {
			margin: 5px 0 0;
			font-size: 24px;
		}
		.table-title .btn-group {
			float: right;
		}
		.table-title .btn {
			color: #fff;
			float: right;
			font-size: 13px;
			border: none;
			min-width: 50px;
			border-radius: 2px;
			border: none;
			outline: none !important;
			margin-left: 10px;
		}
		.table-title .btn i {
			float: left;
			font-size: 21px;
			margin-right: 5px;
		}
		.table-title .btn span {
			float: left;
			margin-top: 2px;
		}
		table.table tr th,
		table.table tr td {
			border-color: #e9e9e9;
			padding: 12px 15px;
			vertical-align: middle;
		}
		table.table tr th:first-child {
			width: 60px;
		}
		table.table tr th:last-child {
			width: 100px;
		}
		table.table-striped tbody tr:nth-of-type(odd) {
			background-color: #fcfcfc;
		}
		table.table-striped.table-hover tbody tr:hover {
			background: #f5f5f5;
		}
		table.table th i {
			font-size: 13px;
			margin: 0 5px;
			cursor: pointer;
		}
		table.table td:last-child i {
			opacity: 0.9;
			font-size: 22px;
			margin: 0 5px;
		}
		table.table td a {
			font-weight: bold;
			color: #566787;
			display: inline-block;
			text-decoration: none;
			outline: none !important;
		}
		table.table td a:hover {
			color: #2196f3;
		}
		table.table td a.edit {
			color: #ffc107;
		}
		table.table td a.delete {
			color: #f44336;
		}
		table.table td i {
			font-size: 19px;
		}
		table.table .avatar {
			border-radius: 50%;
			vertical-align: middle;
			margin-right: 10px;
		}
		.pagination {
			float: right;
			margin: 0 0 5px;
		}
		.pagination li a {
			border: none;
			font-size: 13px;
			min-width: 30px;
			min-height: 30px;
			color: #999;
			margin: 0 2px;
			line-height: 30px;
			border-radius: 2px !important;
			text-align: center;
			padding: 0 6px;
		}
		.pagination li a:hover {
			color: #666;
		}
		.pagination li.active a,
		.pagination li.active a.page-link {
			background: #03a9f4;
		}
		.pagination li.active a:hover {
			background: #0397d6;
		}
		.pagination li.disabled i {
			color: #ccc;
		}
		.pagination li i {
			font-size: 16px;
			padding-top: 6px;
		}
		.hint-text {
			float: left;
			margin-top: 10px;
			font-size: 13px;
		}
		/* Custom checkbox */
		.custom-checkbox {
			position: relative;
		}
		.custom-checkbox input[type="checkbox"] {
			opacity: 0;
			position: absolute;
			margin: 5px 0 0 3px;
			z-index: 9;
		}
		.custom-checkbox label:before {
			width: 18px;
			height: 18px;
		}
		.custom-checkbox label:before {
			content: "";
			margin-right: 10px;
			display: inline-block;
			vertical-align: text-top;
			background: white;
			border: 1px solid #bbb;
			border-radius: 2px;
			box-sizing: border-box;
			z-index: 2;
		}
		.custom-checkbox input[type="checkbox"]:checked + label:after {
			content: "";
			position: absolute;
			left: 6px;
			top: 3px;
			width: 6px;
			height: 11px;
			border: solid #000;
			border-width: 0 3px 3px 0;
			transform: inherit;
			z-index: 3;
			transform: rotateZ(45deg);
		}
		.custom-checkbox input[type="checkbox"]:checked + label:before {
			border-color: #03a9f4;
			background: #03a9f4;
		}
		.custom-checkbox input[type="checkbox"]:checked + label:after {
			border-color: #fff;
		}
		.custom-checkbox input[type="checkbox"]:disabled + label:before {
			color: #b8b8b8;
			cursor: auto;
			box-shadow: none;
			background: #ddd;
		}
		/* Modal styles */
		.modal .modal-dialog {
			max-width: 400px;
		}
		.modal .modal-header,
		.modal .modal-body,
		.modal .modal-footer {
			padding: 20px 30px;
		}
		.modal .modal-content {
			border-radius: 3px;
		}
		.modal .modal-footer {
			background: #ecf0f1;
			border-radius: 0 0 3px 3px;
		}
		.modal .modal-title {
			display: inline-block;
		}
		.modal .form-control {
			border-radius: 2px;
			box-shadow: none;
			border-color: #dddddd;
		}
		.modal textarea.form-control {
			resize: vertical;
		}
		.modal .btn {
			border-radius: 2px;
			min-width: 100px;
		}
		.modal form label {
			font-weight: normal;
		}

	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
		$(document).ready(function () {
			// Activate tooltip
			$('[data-toggle="tooltip"]').tooltip();

			// Select/Deselect checkboxes
			var checkbox = $('table tbody input[type="checkbox"]');
			$("#selectAll").click(function () {
				if (this.checked) {
					checkbox.each(function () {
						this.checked = true;
					});
				} else {
					checkbox.each(function () {
						this.checked = false;
					});
				}
			});
			checkbox.click(function () {
				if (!this.checked) {
					$("#selectAll").prop("checked", false);
				}
			});
		});

	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<body>
<div class="container">
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">

				<div class="col-sm-6">
					<h2>Manage <b><?php echo $table; ?>s</b></h2>
				</div>
				<div class="col-sm-6">
					<a href="<?php echo site_url()?>" class="btn btn-primary"><i class="material-icons">home</i> <span>Back to Home</span></a>
					<a href="#addModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New <?php echo $table; ?></span></a>
					<a href="#deleteModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
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
				<?php
				foreach ($fields as $column) {
					echo "<th>$column</th>";
				}
				?>
			</tr>
			</thead>
			<tbody>

			<?php
			/**
			 *     "data": [
			{
			"blog_id": "1",
			"blog_title": "blog_title1",
			"blog_author": "blog_author1",
			"blog_description": "blog_description1"
			},
			 * ]
			 */
			$i = 2;
			foreach ($data as $row) {
				echo "<tr>";
				echo "<td><span class=\"custom-checkbox\"><input type=\"checkbox\" id=\"checkbox$i\" name=\"options[]\" value=\"$i\"><label for=\"checkbox$i\"></label></span></td>";
				foreach ($row as $column) {
					echo "<td>$column</td>";
				}
				echo "<td><a href=\"#editModal\" class=\"edit\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Edit\">&#xE254;</i></a><a href=\"#deleteModal\" class=\"delete\" data-toggle=\"modal\"><i class=\"material-icons\" data-toggle=\"tooltip\" title=\"Delete\">&#xE872;</i></a></td>";
				echo "</tr>";
			}
			?>
			</tbody>
		</table>
		<?php
		/*
		 *   "pagination": {
        "offset": 0,
        "limit": 25,
        "total": 160,
        "pages": 7,
        "current_page": 1,
        "next": {
            "page": 2,
            "offset": 25,
            "path": "/api/v1/blog?offset=25&limit=25",
            "url": "http://[::1]/codeigniter-3-crud/api/v1/blog?offset=25&limit=25"
        },
        "first": {
            "page": 1,
            "offset": 0,
            "path": "/api/v1/blog?offset=0&limit=25",
            "url": "http://[::1]/codeigniter-3-crud/api/v1/blog?offset=0&limit=25"
        },
        "last": {
            "page": 7,
            "offset": 150,
            "path": "/api/v1/blog?offset=150&limit=25",
            "url": "http://[::1]/codeigniter-3-crud/api/v1/blog?offset=150&limit=25"
        }
    }
		 */
		?>
		<div class="clearfix">
			<div class="hint-text">Showing <b><?php echo $pagination['limit']; ?></b> out of <b><?php echo $pagination['total']; ?></b> entries</div>
			<ul class="pagination">
				<li class="page-item <?php echo $pagination['current_page'] == 1 ? 'disabled' : ''; ?>"><a href="<?php echo "?offset=" . $pagination['first']['offset'] . "&limit=" . $pagination['limit']; ?>" class="page-link">First</a></li>

				<?php
				//check if previous available
				if(isset($pagination['previous'])){
					echo "<li class=\"page-item\"><a href=\"?offset=".$pagination['previous']['offset']."&limit=".$pagination['limit']."\" class=\"page-link\">Previous</a></li>";
				}
				//if the 1st page show from 1 - 5 or total page which ever is lower
				//if the last page show from total page - 5 - total page
				//if in middle show from current page - 2 or first page whichever is higher - current page + 2 or last page whichever is lower
				$first_page = 1;
				$last_page = $pagination['pages'];
				if($pagination['current_page'] == 1){
					$first_page = 1;
					$last_page = $pagination['pages'] > 5 ? 5 : $pagination['pages'];
				}elseif($pagination['current_page'] == $pagination['pages']){
					$first_page = $pagination['pages'] > 5 ? $pagination['pages'] - 5 : 1;
					$last_page = $pagination['pages'];
				}else{
					$first_page = $pagination['current_page'] - 2 > 1 ? $pagination['current_page'] - 2 : 1;
					$last_page = $pagination['current_page'] + 2 < $pagination['pages'] ? $pagination['current_page'] + 2 : $pagination['pages'];
				}
				for ($i = $first_page; $i <= $last_page; $i++) {
					$offset = ($i - 1) * $pagination['limit'];
					$url = "?offset=$offset&limit=" . $pagination['limit'];
					?>
					<li class="page-item <?php echo $pagination['current_page'] == $i ? 'active' : ''; ?>"><a href="<?php echo $url; ?>" class="page-link"><?php echo $i; ?></a></li>
					<?php
				}
				if(isset($pagination['next'])){
					echo "<li class=\"page-item\"><a href=\"?offset=".$pagination['next']['offset']."&limit=".$pagination['limit']."\" class=\"page-link\">Next</a></li>";
				}
				?>

				<li class="page-item <?php echo $pagination['current_page'] == $pagination['pages'] ? 'disabled' : ''; ?>"><a href="<?php echo "?offset=" . $pagination['last']['offset'] . "&limit=" . $pagination['limit']; ?>" class="page-link">Last</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="addModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Add <?php echo $table; ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<?php
					foreach ($fields as $field) {
						?>
						<div class="form-group">
							<label><?php echo $field; ?></label>
							<input type="text" class="form-control" required>
						</div>
						<?php
					}
					?>
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
<div id="editModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Edit <?php echo $table; ?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<?php
					foreach ($fields as $field) {
						?>
						<div class="form-group">
							<label><?php echo $field; ?></label>
							<input type="text" class="form-control" required>
						</div>
						<?php
					}
					?>
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
<div id="deleteModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Delete <?php echo $table; ?></h4>
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
