<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"  type="images/x-icon" href="<?= base_url()?>img/logo.ico">
    <link rel="stylesheet" href="<?=base_url()?>css/login.css">
    <title>Log in</title>
</head>
<body>

<div class="box">
    <div class="form">
    <form action="" method="post">
    <h1><b>LOG IN</b></h1>
    <label for="username"> Username : <br>
    <input type="text" name="username" id="username">
</label>
<br><br>
<label for="password"> Password : <br>
    <input type="text" name="password" id="password">
</label>
<br>
<br>
<button type="submit" name="save">Log in</button>
    </form>
</div></div>

</body>
</html>