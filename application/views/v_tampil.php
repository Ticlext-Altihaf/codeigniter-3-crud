<!DOCTYPE html>
<html lang="id">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<title>Read</title>
	<script>
		function deleteConfirm(s) {
			if(confirm('Yakin ingin menghapus ?')){
				window.location.href=s;
			}
			else{
				return false;
			}
		}
	</script>
</head>
<body>
<center><h1>Membuat CRUD (Create, Read, Update, Delete) dengan CodeIgniter 3</h1></center>
<center>
	<div>
		<?php echo anchor('create', 'Tambah Data (Create)'); ?>
		<br>
		<?php echo anchor('create/automatic', 'Tambah Data Otomatis (Create)'); ?>
		<br>
		<?php echo anchor('delete-all', 'Hapus Semua Data (Delete)'); ?>
		<br>
		<p>Jumlah Data: <?php echo $count; ?></p>
	</div>
</center>
<div class="table-responsive">
<table class="table table-striped table-bordered">
	<thead class="thead-dark">
	<tr>
		<th scope="col">No</th>
		<th>Nama</th>
		<th>Alamat</th>
		<th>Pekerjaan</th>
		<th>Action</th>
	</tr>
	</thead>

	<?php
	#source: malescoding.com
	$no = 1;
	foreach ($users as $u) {
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $u['nama'] ?></td>
			<td><?php echo $u['alamat'] ?></td>
			<td><?php echo $u['perkerjaan'] ?></td>
			<td>
				<a class="btn btn-primary" href="<?php echo site_url('update/' . $u['id']); ?>">Ubah Data (Update)</a>
				<button class="btn btn-danger" onclick="deleteConfirm('<?php echo site_url('delete/' . $u['id']); ?>')">Hapus Data (Delete)</button>
			</td>
		</tr>
	<?php } ?>
</table>
</div>
<footer style="
background-color: #f5f5f5;
text-align: center;
padding: 20px;
">
	<p>Not-Copyright; 2022 - <?php echo date('Y'); ?> <a href="https://github.com/Ticlext-Altihaf/codeigniter-3-crud">github.com/Ticlext-Altihaf/codeigniter-3-crud</a>
	</p>

</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
		integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
		crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
		integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
		crossorigin="anonymous"></script>
</body>

</html>


