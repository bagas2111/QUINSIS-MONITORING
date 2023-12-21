<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url() ?>css/admin/home.css">
</div>
<!-- Rest of your layout content -->
<br>
<div class="content">
  <div class="col-1">
    <div class="row-0"> hi, Selamat Datang <b>
        <?= $nama ?>
      </b></div><br>
    <div class="row-01">
      <h4>Total Projects</h4>
    </div><br>
    <div class="row-05">
      <h1><b>
          <?= count($project) ?>
        </b>&nbspProjects</h1>
    </div>
  </div>
  <div class="box">
    <div class="col-2">
      <table border="1">
        <thead>
          <tr>
            <th>Project</th>
            <th>Anggota</th>
            <th>Deadline</th>
            <th>Progress</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($project)): ?>
            <?php foreach ($project as $project): ?>
              <tr
                onclick="window.location='/admin/tahapan_admin/<?= $project['id_project'] ?>/<?= $project['nama_project'] ?>/<?= $project['no_po'] ?>/<?= $project['status'] ?>/<?= $project['deadline'] ?>'"
                style="cursor: pointer;">
                <td>
                  <?= $project['nama_project'] ?>
                </td>
                <td>
                  <?= $project['anggota'] ?>
                </td>
                <td>
                  <?= date('d-F-Y', strtotime($project['deadline'])) ?>
                </td>
                <td><?= $project['progres_hasil'] ?>%</td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <td colspan="3">No projects available.</td>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection() ?>