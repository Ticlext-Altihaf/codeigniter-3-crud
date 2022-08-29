<!DOCTYPE html>
<html>
<head>
    <title>Read</title>
</head>
<body>
<center><h1>Membuat CRUD (Create, Read, Update, Delete) dengan CodeIgniter </h1></center>
<center>
	<div>
		<?php echo anchor('create','Tambah Data (Create)'); ?>
		<br>
		<?php echo anchor('create/automatic','Tambah Data Otomatis (Create)'); ?>
		<br>
		<?php echo anchor('delete-all','Hapus Semua Data (Delete)'); ?>
		<br>
		<p>Jumlah Data: <?php echo $count; ?></p>
	</div>
</center>
<table style="margin:20px auto;" border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Pekerjaan</th>
        <th>Action</th>
    </tr>
    <?php
    #source: malescoding.com
    $no = 1;
    foreach($users as $u){
        ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $u['nama'] ?></td>
            <td><?php echo $u['alamat'] ?></td>
            <td><?php echo $u['perkerjaan'] ?></td>
            <td>
                <?php echo anchor('update/'.$u['id'],'Edit (Update)'); ?>
                <?php echo anchor('delete/'.$u['id'],'Hapus (Delete)'); ?>
            </td>
        </tr>
    <?php } ?>
</table>
</body>
</html>


