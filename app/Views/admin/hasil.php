<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url() ?>css/admin/output.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<br><br><br>

<div class="content">
    <div class="row">
    <h1><b><?= $nama_tugas ?></b></h1>
    </div>
    <div hidden>
    ID Detail: <?php echo $id_detail; ?>
    </div>  


    <!-- List Project -->
    <div class="project">
        <!-- Projects -->
        <button onclick="goBack()"><a>back</a></button>

        <!-- Display File Name -->
        <?php if (!empty($apiData)) : ?>
            <?php foreach ($apiData as $tugas) : ?>
                <?php if ($tugas['id_detail'] == $id_detail) : ?>
                    <div class="object">
                        <div class="col-head"><?= $tugas['nama_tugas'] ?></div>
                        <div class="col"><?= $tugas['desc_tugas'] ?></div>
                        <div class="col" hidden><?= $tugas['id_detail'] ?></div>
                        <div class="col"> status: <?= $tugas['status'] ?></div>
                        
                        <div class="col">
                            <form action="<?= base_url('dashboard/uploadFile') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_detail" value="<?php echo $id_detail; ?>">
                                <!-- <input type="text" name="drive" id="drive" placeholder="Link google drive"> -->
                                <div class="col"> Upload File : <input type="file" name="file" id="file"></div>
                                <button>submit</button>
                            </form>
                            <?php
                            // Mengonversi string JSON ke array asosiatif PHP
                            $file_data = json_decode($file_name, true);

                            if ($file_data !== null && trim($file_name) === '{"result":null}') {
                            } else {
                            ?>
                                <a href="<?= site_url('admin/download/'  . $file_name); ?>" download>
                                    <button>Download File</button>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p style="text-align: center;">No projects available.</p>
        <?php endif; ?>
    </div>
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<?= $this->endSection() ?>
