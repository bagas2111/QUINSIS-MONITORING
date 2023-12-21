<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="images/x-icon" href="<?= base_url() ?>img/logo.ico">
    <link rel="stylesheet" href="<?= base_url() ?>css/admin/regist.css">
    <title>pegawai</title>
</head>

<body>

    <div class="box">
        <div class="form">
            <form action="" method="post">
                <h1><b>DATA PEGAWAI</b></h1>
                <label for="username"> Username : <br>
                    <input type="text" name="username" id="username">
                </label>
                <br>
                <br>
                <label for="nama"> Nama : <br>
                    <input type="text" name="nama" id="nama">
                </label>
                <br>
                <br>
                <label for="perusahaan">Perushaan:</label> <br>
                <select id="perusahaan">
                    <option value=""></option>
                    <option value="#">Admin</option>
                    <option value="#">Mannager</option>
                    <option value="#">Pegawai</option>
                </select>
                <br>
                <br>
                <label for="password"> Password : <br>
                    <input type="password" name="password" id="password">
                </label>
                <br><br>
                <button type="submit" name="save">Register</button>
            </form>
        </div>
    </div>

</body>

</html>