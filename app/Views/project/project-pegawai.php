<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="<?=base_url()?>css/P-Pegawai.css">
<!-- Rest of your layout content -->
<br>
<div class="content">
  <div class="page-title">
    <h1><b>Data Pegawai</b></h1>
  </div>
  <div class="box">
    <div class="sub-title">
      <h1>Nama Project</h1>
    </div><br>
    <div class="row-2">
      <table>
        <thead>
          <tr>
            <th><b>No</b></th>
            <th><b>Username</b></th>
            <th><b>Nama</b></th>
            <th><b>Jabatan</b></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
            
            <td>1</td>
            <td>Bagas_21</td>
            <td>bagaskoro</td>
            <td>co</td>
          </tr>
                    
        </tbody>
      </table>
    </div><br>
  </div>
</div>

<?= $this->endSection() ?>
