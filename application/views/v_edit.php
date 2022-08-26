<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
</head>
<body>
<form method="post">
    <label>
        Nama:
        <input type="text" name="nama" value="<?php echo $nama ?>">

    </label>
    <br>
    <label>
        Alamat:
        <input type="text" name="alamat" value="<?php echo $alamat ?>">
    </label>
    <br>
    <label>
        Pekerjaan:
        <input type="text" name="perkerjaan" value="<?php echo $perkerjaan ?>">
    </label>
    <br>
    <button type="submit">Save</button>
</form>
</body>
</html>
