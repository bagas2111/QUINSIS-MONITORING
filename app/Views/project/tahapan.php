<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= base_url() ?>css/tahapan.css">

<!-- Rest of your layout content -->
<br>

<div class="content">
  <div class="row">
    <h1><b><?=$nama_project?></b></h1>
  </div><br>
  <div class="box"> 
  <a href="/dashboard/projects"><button class="back">back</button></a>

    <div class="project">
      <!-- Projects -->
      <table border="1">
        <thead>
          <tr>
            <th>Nama Project</th>
            <th>Tanggal Start</th>
            <th>Tanggal Target</th>
            <th style="width:0px;">status</th>
            <th>Tanggal Actual</th>
            <th>tanggal Tugas</th>
            <th style="width:150px;">Hasil Dokumen</th>
         </tr>
        </thead>
        <tbody>
        <?php if (!empty($tahapam)) : ?>
          <?php foreach ($tahapam as $tahapan) : ?>
          <tr onclick="window.location='/dashboard/detail_tahapan/<?= $tahapan['id_tahapan'] ?>/<?= $tahapan['nama_tahapan']?>/<?= $nama_project?>'" style="cursor: pointer;">
            <td><?= $tahapan['nama_tahapan'] ?></td>
            <td><?= date('d-F-Y', strtotime($tahapan['start_date'])) ?></td>
            <td><?= date('d-F-Y', strtotime($tahapan['Deadline'])) ?></td>
            <td><?= $tahapan['status'] ?></td>
            <td>
              <?php if (!empty($tahapan['tgl_actual'])) : ?>
                <?= date('d-F-Y', strtotime($tahapan['tgl_actual'])) ?>
              <?php else : ?>
                belum dikumpulkan
              <?php endif; ?>
            </td>
            <td>
              <?php if (!empty($tahapan['tgl_tugas'])) : ?>
                <?= date('d-F-Y', strtotime($tahapan['tgl_tugas'])) ?>
              <?php else : ?>
                belum dikumpulkan
              <?php endif; ?>
            </td>
            <td> 
              <?php if (!empty($tahapan['hasil_tahapan'])) : ?>
                <button type="button" class="btn btn-primary openUploadModal" data-id="<?= $tahapan['id_tahapan'] ?>"data-nama="<?= $tahapan['nama_tahapan'] ?>"><i class='bx bx-upload' style='color:#ffffff'></i> Upload</button>
                <a href="<?= site_url('admin/download/' . $tahapan['hasil_tahapan']); ?>" download>
                  <button onclick="event.stopPropagation()" class="btn btn-primary">Download File</button>
                </a>
              <?php else : ?>
                <button type="button" class="btn btn-primary openUploadModal" data-id="<?= $tahapan['id_tahapan'] ?>"data-nama="<?= $tahapan['nama_tahapan'] ?>"><i class='bx bx-upload' style='color:#ffffff'></i> Upload</button>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <td style="text-align: center;" colspan="7">No projects available.</td>
        <?php endif; ?> 
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal HTML -->
<div id="uploadModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeModal">&times;</span>
    <h2><span id="nama22"></span></h2>
        <p>Upload Dokumen Hasil</p>
        <div class="isi">
        <form action="<?= base_url('admin/uploadFile') ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" id="id4" name="id_tahapan">
            <label for="tgl1">Tanggal Upload :</label>
            <input type="date" name="tgl_actual" class="tgl_actual"><br>
            <label for="upload1">Upload file BAST :</label>
            <input type="file" name="file" id="file" class="file"><br><br>
            <button type="sumbit" class="btn btn-primary">Submit</button>
        </form>
        </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Get the modal and buttons
    var modal = document.getElementById('uploadModal');
    var openModalButtons = document.querySelectorAll('.openUploadModal');
    var closeModalButton = document.getElementById('closeModal');


    // Function to open the modal
    function openModal(event) {
      modal.style.display = 'block';
      event.stopPropagation();
      var id = event.currentTarget.getAttribute("data-id");
      var nama = event.currentTarget.getAttribute("data-nama");
      var nama22 = document.getElementById('nama22');
        if (nama22) {
            nama22.textContent = nama;
        }

      var inputid4 = document.getElementById("id4");

      if (inputid4) {
        inputid4.value = id;
      }
    }

    // Function to close the modal
    function closeModal() {
      modal.style.display = 'none';
    }

    // Attach event listeners to open modal buttons
    for (var i = 0; i < openModalButtons.length; i++) {
      openModalButtons[i].addEventListener('click', openModal);
    }

    // Attach event listener to close modal button
    closeModalButton.addEventListener('click', closeModal);

    // Close the modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
      if (event.target === modal) {
        closeModal();
      }
    });

    // Close the modal when pressing the Escape key
    window.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        closeModal();
      }
    });
  });
</script>


<?= $this->endSection() ?>
