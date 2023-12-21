<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="<?=base_url()?>css/detail-tahapan.css">
</div>

<!-- Rest of your layout content -->
<br>
<div class="content">
  <div class="row"><h1><b>Nama Tugas</b></h1></div>
    <!-- List Project -->
    <div class="project">
        <!-- Projects -->
        <button><a href="/dashboard/tahapan"><b>back</b></a></button>
<a href="/">
  <div class="object">
        <div class="col-head">Nama Tugas</div>
        <div class="col">Deskripsi Tugas</div>
        <div class="col">status : </div>
    </div></a>

<a href="/">
  <div class="object">
        <div class="col-head">Nama Tugas</div>
        <div class="col">Deskripsi Tugas</div>
        <div class="col">status</div>
    </div></a>

    <a href="/">
  <div class="object">
        <div class="col-head">Nama Tugas</div>
        <div class="col">Deskripsi Tugas</div>
        <div class="col">status</div>
    </div></a>

    </div>

        <p style=" text-align: center;">No projects available.</p>
</div></div>

<?= $this->endSection() ?>


