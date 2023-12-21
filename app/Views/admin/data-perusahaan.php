
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url()?>css/admin/data-perusahaan.css">
    <link rel="icon"  type="images/x-icon" href="<?= base_url()?>img/logo.ico">
    <title>Data Perusahaan</title>
</head>
<body>

<div class="box">
    <div class="form">
    <form action="" method="post">
    <h1><b>DATA PERUSAHAAN</b></h1>
        <label for="nama"> Nama Perusahaan: <br>
            <input type="text" name="nama" id="nama" Placeholder="nama perusahaan">
        </label> <br> <br>
        <label for="username"> Jenis Perushaan : <br>
            <input type="text" name="username" id="username" placeholder="username">
        </label><br> <br>
        <label for="alamat"> Alamat Perushaan : <br>
            <textarea name="alamat" id="" cols="38" rows="2" placeholder="alamat"></textarea>
        </label> <br> <br>
        <label for="phone"> Contact Person : <br>
            <input type="phone" name="phone" id="phone" placeholder="no telp">
        </label> <br> <br>
        <button type="submit" name="save">Daftar</button>
    </form>
</body>
</html>
