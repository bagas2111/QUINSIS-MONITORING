<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url() ?>css/profile.css">
</head>


<!-- Rest of your layout content -->
<br>
<div class="content">
    <div class="row-01">
        <h4>Data Diri</h4>
        <?php foreach ($profile as $value) : ?>
            <form action="<?= base_url('dashboard/updateProfile') ?>" method="post">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Username :</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="id" name="id" value="<?= $id_pegawai ?>">
                        <input type="text" readonly class="form-control-plaintext" id="username" name="username" value="<?= $value['username'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama :</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control-plaintext" id="nama" name="nama" value="<?= $value['nama'] ?>">
                    </div>
                </div><br>
                <h4>Change Password</h4><br>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password Baru :</label>
                    <div class="col-sm-4"> <!-- Reduced the width further -->
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                        <i class="bx bx-hide" id="showPassword" style="cursor: pointer;"></i>
                    </div>
                </div>
                <button type="submit" name="submit">Submit</button>
            </form>
        <?php endforeach; ?>
    </div><br>
</div>
<!-- Rest of your script and template code -->

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#showPassword").click(function () {
            var passwordField = $("#password");

            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
                $("#showPassword").removeClass("bx-hide").addClass("bx-show");
            } else {
                passwordField.attr("type", "password");
                $("#showPassword").removeClass("bx-show").addClass("bx-hide");
            }
        });
    });
</script>

<?= $this->endSection() ?>
