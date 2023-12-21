<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url() ?>css/data-pegawai.css">

<!-- Rest of your layout content -->
<br>
<div class="content">
  <div class="row">
    <h1><b>Projects</b></h1>
  </div><br>
  <div class="box">
    <div class="row-2">
      <table>
        <thead>
          <tr>
            <th><b>No.</b></th>
            <th><b>Nama Project</b></th>
            <th><b>nama client</b></th>
            <th><b>Alamat client</b></th>
            <th><b>Contact Person client</b></th>
            <th><b>Nama Vendor</b></th>
            <th><b>Alamat Vendor</b></th>
            <th><b>Contact Person Vendor</b></th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($data2)): ?>
            <?php foreach ($data2 as $data): ?>
              <tr>
                <td>1</td>
                <td>
                  <?= $data['nama_project'] ?>
                </td>
                <td>
                  <?= $data['nama_perusahaan'] ?>
                </td>
                <td>
                  <?= $data['alamat_perusahaan'] ?>
                </td>
                <td>
                  <?= $data['contact_perusahaan'] ?>
                </td>
                <td>
                  <?= $data['nama_vendor'] ?>
                </td>
                <td>
                  <?= $data['alamat_vendor'] ?>
                </td>
                <td>
                  <?= $data['contact_vendor'] ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <td style="text-align: center;" colspan="8">No projects available.</td>
          <?php endif; ?>
        </tbody>
      </table>
    </div><br>
    <!-- <p style="text-align: center;">No projects available.</p>  -->
  </div>
</div>

<?= $this->endSection() ?>