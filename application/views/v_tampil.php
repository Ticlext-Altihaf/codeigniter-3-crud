<!DOCTYPE html>
<html>
<head>
    <title>Read</title>
</head>
<body>
<center><h1>Membuat CRUD (Create, Read, Update, Delete) dengan CodeIgniter </h1></center>
<center><?php echo anchor('create','Tambah Data (Create)'); ?></center>
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


