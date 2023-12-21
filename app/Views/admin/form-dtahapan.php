<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"  type="images/x-icon" href="<?= base_url()?>img/logo.ico">
    <link rel="stylesheet" href="<?=base_url()?>css/admin/form-dtahapan.css">
    <title>Data Project</title>
</head>
<body>

<div class="box">
    <div class="form">
        <h1><b>Detail Tahapan</b></h1>
    <form action="" method="post">
    <label for="nama_project"> Nama Project : <br>
    <input type="text" name="nama_project" id="nama_project">
</label>
<br><br>
<label for="deskripsi"> Deskripsi : <br>
    <textarea name="deskripsi" id="" cols="30" rows="2"></textarea>
</label>
<br>
<br>
<label id="deadline"> <h2>Deadline</h2>
    <span class="date"><p>Tanggal :</p>
    <input type="date" name="date" id="date"></span>
    <Span class="time">
    <p>Waktu :</p>
    <input type="time" name="time" id="time">
    </Span>
</label>
<br>
<br>
<button type="submit" name="save"><a href="#">submit</a></button>
    </form>
</div></div>

</body>
</html>