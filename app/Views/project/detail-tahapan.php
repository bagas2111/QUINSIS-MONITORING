<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="<?=base_url()?>css/detail-tahapan.css">
</div>

<!-- Rest of your layout content -->
<br>
<div class="content">
  <div class="row"><h1><b><?=$nama_tahapan?></b></h1></div>
  
    <!-- List Project -->
    <div class="project">
    <button onclick="goBack()">back</button>

       <table>
        <thead>
          <tr>
         <th>judul Tugas</th>
            <th>Deskripsi</th>
            <th>status</th>
            <th>Deadline</th>
          </tr>
        </thead>
        <tbody>
        <?php if (!empty($tahapanData)) : ?>
          <?php foreach ($tahapanData as $tahapan) : ?>
          <!-- <tr>
            <td><a href="/dashboard/hasil">Membuat Laporan wew</a></td>
            <td>siap public</td>
            <td>selesai</td>
            <td>12/02/23</td>
          </tr> -->
          <tr onclick="window.location='/dashboard/hasil/<?= $tahapan['id_tahapan'] ?>/<?= $tahapan['nama_tugas'] ?>/<?= $tahapan['id_detail'] ?>'" style="cursor: pointer;">
            <td><?= $tahapan['nama_tugas'] ?></td>
            <td><?= $tahapan['desc_tugas'] ?></td>
            <td><?= $tahapan['status'] ?></td>
            <td><?= $tahapan['deadline'] ?></td>
          </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <td style="text-align: center;" colspan="4">No projects available.</td>
        <?php endif; ?>
        </tbody>
       </table>
    </div>
</div></div>

<script>
  function goBack() {
        window.history.back();
    }
</script>

<?= $this->endSection() ?>


