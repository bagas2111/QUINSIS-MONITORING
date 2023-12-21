<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url() ?>css/home.css">
</div>

<!-- Rest of your layout content -->
<br>
<div class="content">
    <div class="col-1">
        <div class="row-0">hi, Selamat Datang <b><?= $nama ?></b></div><br>
        <div class="row-01"><h4>Total Projects</h4></div><br>
        <?php if (empty($home)) : ?>
            <div class="row-05"><h1><b>0</b> Projects</h1></div>
        <?php else : ?>
            <div class="row-05"><h1><b><?= count($home) ?></b> Projects</h1></div>
        <?php endif; ?>
    </div>
    <div class="box">
        <div class="col-2">
            <?php if (empty($home)) : ?>
                <p style="text-align: center;">No projects available.</p>
            <?php else : ?>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Anggota</th>
                            <th>Deadline</th>
                            <th hidden>Progress</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">
                        <?php foreach ($home as $project) : ?>
                            <tr onclick="window.location='/dashboard/tahapan/<?= $project['id_project'] ?>/<?= $project['nama_project']?>'" style="cursor: pointer;">
                                <td><?= $project['nama_project'] ?></td>
                                <td>
                                  <?php
                                    $pegawai_terlibat = $project['pegawai_terlibat'];
                                    echo implode(', ', $pegawai_terlibat);
                                    ?>
                                </td>
                                <td><?= $project['deadline'] ?></td>
                                <td hidden>100%</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
