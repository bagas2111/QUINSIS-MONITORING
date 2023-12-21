<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon"  type="images/x-icon" href="<?= base_url()?>img/logo.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Project Management</title>

</head>
<body>
    
<style>
    @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Poppins&display=swap');

body {
    margin: 0px;
    padding: 0px;
    font-family: "Lato", sans-serif;
  }
  
h1{
    padding: 5px 28px;
    color: #ffff;
    text-transform: uppercase;
}
  .sidebar {
    margin-top: -70px;
    padding: 0px;
    width: 200px;
    background-color: #315AA8;
    position: fixed;
    height: 1200px;
    overflow: auto;
  }
  
  .sidebar a {
    display: block;
    color: #ffff;
    padding: 16px;
    font-family: 'Poppins', sans-serif;
    text-decoration: none;
  }
   
  .sidebar a.active {
    background-color: #315AA8;
    color: white;
  }
  
  .sidebar a:hover:not(.active) {
    background-color: #BA9FE6;
    color: white;
    border-radius: 20px;
    transition: 0.6s ease;
  }
  
  @media screen and (max-width: 700px) {
    .sidebar {
      width: 100%;
      height: auto;
      position: relative;
    }
    .sidebar a {float: left;}
    div.content {margin-left: 0;}
  }
  
  @media screen and (max-width: 400px) {
    .sidebar a {
      text-align: center;
      float: none;
    }
  }

.content{
    border: 2px solid black;
    margin: 60px 250px;
    padding: 5px 5px;
    width: 1200px;
    
}



.col-1{
    background:  linear-gradient(54deg, #315AA8 0%, rgba(166, 115, 232, 0.44) 100%);
    border: 2px solid blue;
    border-radius:15px;
    margin: 2px 5px;
    padding: 20px 190px;
    float: center;
    font-family: 'Poppins', sans-serif;
    color: white;
}
.col-2{
    border: 2px solid pink;
    margin: 2px 5px;
    padding: 20px 190px;
    float: center;
}
.col-3{
    border: 2px solid pink;
    margin: 2px 5px;
    padding: 20px 190px;
    float: center;
}
.col-4{
    border: 2px solid pink;
    margin: 2px 5px;
    padding: 20px 190px;
    float: center;
}


.row-0{
    justify-content: center;
    padding: 20px 20px;
    display: inline-block;  
    margin-left: 500px;
}

.row-01{
    justify-content: center;    
    display: inline-block;  
}

.row-05{
    justify-content: center;
    margin-top:-50px;
    padding: 0px 5px;
    display: inline-block; 

}

.row-1{
    justify-content: center;
    padding: 5px 30px;
    border: 2px solid purple;
    height: 20px;
    display: inline-block;  
}

.row-2{
    justify-content: center;
    padding: 5px 30px;
    border: 2px solid purple;
    height: 20px;
    display: inline-block;  
}

.row-3{
    justify-content: center;
    padding: 5px 30px;
    border: 2px solid purple;
    height: 20px;
    display: inline-block;  
}




</style>

<div class="sidebar">
    <h1>bright</h1>
    <a href="#home"><i class='bx bx-home-alt-2' style='color:#ffffff' ></i>&nbspHome</a>
    <a href="#news"><i class='bx bx-folder' style='color:#ffffff'></i> Projects</a>
    <a href="#contact"><i class='bx bx-envelope' style='color:#ffffff'></i> Message</a>
    <a href="#about">About</a>
    <a href="#"><i class='bx bx-log-in' style='color:#ffffff'>&nbspLogout</i></a> <!-- Add the logout link -->
    
</div>

<!-- Rest of your layout content -->


<div class="content">
    <div class="col-1">
        <div class="row-0"> hi, Selamat Datang username </div><br>
        <div class="row-01"><h4>Total Projects</h4></div><br>
        <div class="row-05"><h1><b>20</b>&nbspProjects</h1></div>
    </div>
    <div class="col-2">
        <div class="row-1">ID:</div>
        <div class="row-1">Jenis Project:</div>
        <div class="row-1">Nama Project:</div>
        <div class="row-1">Pegawai:</div>
        <div class="row-1">Pegawai Terlibat:</div>
    </div>
    <div class="col-3">
        <div class="row-2">ID:</div>
        <div class="row-2">Jenis Project:</div>
        <div class="row-2">Nama Project:</div>
        <div class="row-2">Pegawai:</div>
        <div class="row-2">Pegawai Terlibat:</div>
    </div>
    <div class="col-4">
        <div class="row-3">ID:</div>
        <div class="row-3">Jenis Project:</div>
        <div class="row-3">Nama Project:</div>
        <div class="row-3">Pegawai:</div>
        <div class="row-3">Pegawai Terlibat:</div>
    </div>

        <p>No projects available.</p>
</div>
</body>
</html>