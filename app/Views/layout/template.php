<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url()?>css/template.css">
    <link rel="icon"  type="images/x-icon" href="<?= base_url()?>img/logo.ico"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Project Management</title>

</head>
<body>
    
<div class="sidebar">
    <h1>bright</h1>
    <a href="/Dashboard/profile"><i class='bx bx-user-circle' style='color:#ffffff'></i> Profile</a>
  <a href="/Dashboard"><i class='bx bx-home-alt-2' style='color:#ffffff' ></i> Dashboard</a>
  <a href="/Dashboard/projects"><i class='bx bx-folder' style='color:#ffffff'></i> Projects</a>
  <a href="/Dashboard/pegawai "><i class='bx bx-bookmark'></i>&nbsp Employees</a>
</div>

<a href="<?= site_url('Login/logout') ?>"><i class='bx bx-log-in' style='color:#ffffff' id="out"> Logout</i></a>
<?= $this->renderSection('content') ?>


<!-- <footer class="jumbotron jumbotron-fluid mt-5 mb-0">
  <div class="container text-center">Copyright &copy <?= Date('Y') ?> giftallafaidza & Bagaskoro</div>
</footer> -->

</body>
</html>