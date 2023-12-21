<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/css/projects.css"> <!-- Corrected the base_url() path -->

<br>

<div class="content">
  <div class="row">
    <h1><b>Projects</b></h1>
  </div><br>

  <div class="sort">
    <!-- Sort by status dropdown -->
    <?php if (!empty($projects)): ?>
      <div>
        <label for="sortStatus">Sort by Status:</label>
        <select name="sortStatus" id="sortStatus" onchange="sortTableByStatus()">
          <option value="all">All</option>
          <option value="selesai">Selesai</option>
          <option value="belum selesai">Belum Selesai</option>
        </select>
      </div>
    <?php endif; ?>
  </div>


  <div class="box">
    <div class="project">
      <!-- Projects -->
      <table border="1" id="projectTable"> <!-- Added the id attribute to the table -->
        <thead>
          <tr>
            <th rowspan="2">Nama Project</th>
            <!-- Removed the <span> inside the <th> -->
            <th colspan="2">PO</th>
            <th rowspan="2">client Perusahaan</th>
            <th rowspan="2">Vendor Perusahaan</th>
            <th rowspan="2" style="width:60px;">tgl start</th>
            <th rowspan="2">deadline</th>
            <th rowspan="2" style="width:75px;">tgl Actual</th>
            <th rowspan="2" style="width:50px;">status</th>
            <th rowspan="2" style="width:120px;">anggota</th>
          </tr>
          <tr>
            <th style="width: 2px;">Nomor</th>
            <th style="width:60px;">Tanggal</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($projects)): ?>
            <?php foreach ($projects as $project): ?>
              <tr
                onclick="window.location='/dashboard/tahapan/<?= $project['id_project'] ?>/<?= $project['nama_project'] ?>'"
                style="cursor: pointer;">
                <td>
                  <?= $project['nama_project'] ?>
                </td>
                <td>
                  <?= $project['no_po'] ?>
                </td>
                <td>
                  <?= $project['tgl_po'] ?>
                </td>
                <td>
                  <?= $project['nama_perusahaan'] ?>
                </td>
                <td>
                  <?= $project['nama_vendor'] ?>
                </td>
                <td>
                  <?= $project['start_time'] ?>
                </td>
                <td>
                  <?= $project['deadline'] ?>
                </td>
                <td>
                  <?php if (!empty($project['selesai_project'])): ?>
                    <?= date('d-F-Y', strtotime($project['selesai_project'])) ?>
                  <?php else: ?>
                    belum selesai
                  <?php endif; ?>
                </td>
                <td>
                  <?= $project['status'] ?>
                </td>
                <td class="action-buttons">
                  <ul> <!-- Start of the unordered list for anggota -->
                    <?php
                    $pegawai_terlibat = $project['pegawai_terlibat'];
                    foreach ($pegawai_terlibat as $pegawai) {
                      echo "<li>$pegawai</li>";
                    }
                    ?>
                  </ul> <!-- End of the unordered list for anggota -->
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="9" style="text-align: center;">No projects available.</td> <!-- Corrected the colspan value -->
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Tambahkan script JavaScript di bagian head atau sebelum akhir </body> -->
<script>
  function sortTableByStatus() {
    var selectedStatus = document.getElementById('sortStatus').value;
    var table = document.getElementById('projectTable');
    var rows = Array.from(table.getElementsByTagName('tr'));

    rows.shift(); // Remove the header row from the sorting

    // Create separate arrays for "belum selesai" and "selesai" rows
    var belumSelesaiRows = [];
    var selesaiRows = [];

    rows.forEach(function (row) {
      if (row.cells.length >= 9) {
        var status = row.cells[8].innerText.trim();
        if (status === 'belum selesai') {
          belumSelesaiRows.push(row);
        } else if (status === 'selesai') {
          selesaiRows.push(row);
        }
      }
    });

    // Combine rows based on the selectedStatus
    var sortedRows = selectedStatus === 'belum selesai' ? belumSelesaiRows.concat(selesaiRows) : selesaiRows.concat(belumSelesaiRows);

    // Rearrange the table rows based on the sorted array
    sortedRows.forEach(function (row) {
      table.appendChild(row);
    });
  }


</script>

<?= $this->endSection() ?>