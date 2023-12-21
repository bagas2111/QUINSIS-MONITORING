<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= base_url() ?>css/admin/project.css">

<!-- Rest of your layout content -->
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
      <button type="button" class="btn btn-secondary" id="addCardButton"><i class='bx bx-plus-medical'></i> ADD</button>
      <table id="projectTable" border="1">
        <thead>
          <tr>
            <th>Nama Project</th>
            <th>Nomor PO</th>
            <th>Tanggal PO</th>
            <th>Client Perusahaan</th>
            <th>Vendor Perusahaan</th>
            <th>Tanggal Start</th>
            <th>Deadline</th>
            <th>Tanggal Actual</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($projects)): ?>
            <?php foreach ($projects as $project): ?>
              <tr
                onclick="window.location='/admin/tahapan_admin/<?= $project['id_project'] ?>/<?= $project['nama_project'] ?>/<?= $project['no_po'] ?>/<?= $project['status'] ?>/<?= $project['deadline'] ?>'"
                style="cursor: pointer;">
                <td>
                  <?= $project['nama_project'] ?>
                </td>
                <td>
                  <?= $project['no_po'] ?>
                </td>
                <td>
                  <?= date('d-m-Y', strtotime($project['tgl_po'])) ?>
                </td>
                <td>
                  <?= $project['nama_perusahaan'] ?>
                </td>
                <td>
                  <?= $project['nama_vendor'] ?>
                </td>
                <td>
                  <?= date('d-m-Y', strtotime($project['start_project'])) ?>
                </td>
                <td>
                  <?= date('d-m-Y', strtotime($project['deadline'])) ?>
                </td>
                <td>
                  <?php if (!empty($project['selesai_project'])): ?>
                    <?= date('d-m-Y', strtotime($project['selesai_project'])) ?>
                  <?php else: ?>
                    Belum Selesai
                  <?php endif; ?>
                </td>
                <td>
                  <?= $project['status'] ?>
                </td>

                <td class="action-buttons">
                  <a href="<?= base_url('admin/hapusProject/' . $project['id_project']) ?>"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus pegawai ini?')"><button type="button"
                      class="delete" onclick="event.stopPropagation()"><i class="fa fa-trash-o"></i></button></a>
                  <button type="button" class="btn btn-warning btn-sm editButton" data-id="<?= $project['id_project'] ?>"
                    data-nama-project="<?= $project['nama_project'] ?>" data-no-po="<?= $project['no_po'] ?>"
                    data-tgl-po="<?= $project['tgl_po'] ?>" data-nama-perusahaan="<?= $project['nama_perusahaan'] ?>"
                    data-nama-vendor="<?= $project['nama_vendor'] ?>" data-start-project="<?= $project['start_project'] ?>"
                    data-deadline="<?= $project['deadline'] ?>" onclick="event.stopPropagation()"><i
                      class="fa fa-pencil"></i> edit</button>
                  <?php if ($project['status'] === 'selesai'): ?>
                    <button type="button" class="btn btn-danger"
                      onclick="openVerificationModal(event, '<?= $project['id_project'] ?>', '<?= $project['status'] ?>'); event.stopPropagation();"
                      style="font-size:10px">Batal Verifikasi</button>
                  <?php else: ?>
                    <button type="button" class="btn btn-success btn-sm"
                      onclick="openVerificationModal(event, '<?= $project['id_project'] ?>', '<?= $project['status'] ?>'); event.stopPropagation();">Verifikasi</button>
                  <?php endif; ?>
                  <a
                    href="<?= base_url('admin/project_pegawai/' . $project['id_project'] . '/' . $project['nama_project']) ?>"><button
                      type="button" class="btn btn-primary btn-sm" onclick="event.stopPropagation()">Pegawai</button></a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="10" style="text-align: center">No projects available.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div id="addCardModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <div class="box">
          <div class="form">
            <h1><b>Project Data</b></h1>
            <form action="<?= base_url('admin/addDataProject') ?>" method="post">
              <label for="nama_project"> Nama Project : <br>
                <input type="text" name="nama_project" id="nama_project">
              </label>
              <br>
              <div class="nomorPO">
                <label for="nomor_PO"> Nomor PO : <br>
                  <input type="number" name="no_po" id="no_po">
                </label>
              </div>
              <div class="tglPO">
                <label for="tgl_PO">Tanggal PO: <br>
                  <input type="date" name="tgl_po" id="tgl_po">
                </label>
                <br>
                <label for="client">Perusahaan Client <br>
                  <select name="id_perusahaan" id="id_perusahaan">
                    <option value=""></option>
                    <?php foreach ($perusahaan as $company): ?>
                      <option value="<?= $company['id'] ?>">
                        <?= $company['nama_perusahaan'] ?>
                      </option>
                    <?php endforeach; ?>
                  </select></label>
                <div class="vendor">
                  <label for="jenisPerusahaan">Perusahaan Vendor: <br>
                    <select name="id_vendor" id="id_vendor">
                      <option value=""></option>
                      <?php foreach ($vendor as $companyy): ?>
                        <option value="<?= $companyy['id'] ?>">
                          <?= $companyy['nama_vendor'] ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </label>
                </div>
                <div class="date">
                  <label for="start">Start_Date: <br>
                    <input type="date" name="start_project" id="start_project">
                </div>
                <div class="deadline">
                  <label for="deadline">Deadline: <br>
                    <input type="date" name="deadline" id="deadline">
                </div>
                <button type="submit" name="save">submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <div id="edit1" class="modal">
    <div class="modal-content">
      <span class="close1" onclick="closeEditModal()">&times;</span>
      <div class="box">
        <div class="form">
          <h1><b>Edit Data</b></h1>
          <form action="<?= base_url('admin/updateDataProject') ?>" method="post">
            <input type="hidden" name="id" id="editid">
            <label for="nama_project"> Nama Project : <br>
              <input type="text" name="nama_project" id="editNamaProject">
            </label>
            <br>
            <div class="nomorPO">
              <label for="nomor_PO"> Nomor PO : <br>
                <input type="number" name="no_po" id="editNoPo">
              </label>
            </div>
            <div class="tglPO">
              <label for="tgl_PO">Tanggal PO: <br>
                <input type="date" name="tgl_po" id="editTglPo">
              </label>
              <br>
              <label for="client">Perusahaan Client <br>
                <select name="id_perusahaan" id="id_perusahaan">
                  <option value="null" id="editNamaPerusahaan"></option>
                  <?php foreach ($perusahaan as $company): ?>
                    <option value="<?= $company['id'] ?>">
                      <?= $company['nama_perusahaan'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </label>

              <div class="vendor">
                <label for="jenisPerusahaan">Perusahaan Vendor: <br>
                  <select name="id_vendor" id="id_vendor">
                    <option value="null" id="editNamaVendor"></option>
                    <?php foreach ($vendor as $dor): ?>
                      <option value="<?= $dor['id'] ?>">
                        <?= $dor['nama_vendor'] ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </label>
              </div>
              <div class="date">
                <label for="start">Start_Date: <br>
                  <input type="date" name="start_project" id="editstartProject">
              </div>
              <div class="deadline">
                <label for="deadline">Deadline: <br>
                  <input type="date" name="deadline" id="editDeadline">
              </div>
              <button type="submit" name="save">submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Verification Modal -->
<div id="verificationModal" class="modal">
  <div class="modal-content">
    <span class="close2" onclick="closeVerificationModal()">&times;</span>
    <h1 style="text-align: center;">Verification Tahapan </h1>
    <h2 hidden></h2>
    <table border="1">
      <thead>
        <tr>
          <th>Tahapan</th>
          <th>status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($ferif) && is_array($ferif)): ?>
          <?php foreach ($ferif as $ferifData): ?>
            <tr>
              <td style="display: none;">
                <?= $ferifData['id_project'] ?>
              </td>
              <td>
                <?= $ferifData['nama'] ?>
              </td>
              <td>
                <?= $ferifData['status'] ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="2" style="text-align: center;">No projects available.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <div class="abc" id="abc">
      <form action="<?= base_url('admin/verifProject') ?>" method="post">
        <input type="hidden" name="idaja1" value="">
        <button type="submit" class="btn btn-success">Verifikasi</button>
      </form>
    </div>
    <div class="abdc" id="abdc">
      <form action="<?= base_url('admin/verifProjectGagal') ?>" method="post">
        <input type="hidden" name="idaja2" value="">
        <button type="submit" class="btn btn-danger"
          onclick="return confirm('Apakah Anda yakin ingin mebatalkan verifikasi ini?')">batalkan verifikasi</button>
      </form>
    </div>
  </div>
</div>

</div>
<script>
  const showAddPopup = document.getElementById("showAddPopup");
  const addPopup = document.getElementById("addPopup");
  const addForm = document.getElementById("addForm");
  const closePopup = document.getElementById("closePopup");
  const idajaInput1 = document.querySelector('input[name="idaja1"]');
  const idajaInput2 = document.querySelector('input[name="idaja2"]');

  const editButtons = document.querySelectorAll(".editButton");
  const editPopup = document.getElementById("edit1");
  const closeEditPopup = document.getElementById("closeEditPopup");
  const editForm = document.getElementById("editForm");
  // Ambil tombol "Add Card" dan modalnya
  var addCardButton = document.getElementById("addCardButton");

  // Function to open the edit modal
  editButtons.forEach(editButton => {
    editButton.addEventListener("click", () => {
      editPopup.style.display = "block";
      const namaProject = editButton.getAttribute("data-nama-project");
      const noPo = editButton.getAttribute("data-no-po");
      const tglPo = editButton.getAttribute("data-tgl-po");
      const namaPerusahaan = editButton.getAttribute("data-nama-perusahaan");
      const namaVendor = editButton.getAttribute("data-nama-vendor");
      const startProject = editButton.getAttribute("data-start-project");
      const deadline = editButton.getAttribute("data-deadline");
      const id = editButton.getAttribute("data-id");
      // Mengisi nilai-nilai ke dalam input di dalam pop-up edit
      document.getElementById("editid").value = id;
      document.getElementById("editNamaProject").value = namaProject;
      document.getElementById("editNoPo").value = noPo;
      document.getElementById("editTglPo").value = tglPo;
      // Set the text of the "editNamaPerusahaan" option
      document.getElementById("editNamaPerusahaan").textContent = namaPerusahaan;
      document.getElementById("editNamaVendor").textContent = namaVendor;
      document.getElementById("editstartProject").value = startProject;
      document.getElementById("editDeadline").value = deadline;
    });
  });

  // Function to close the edit modal
  function closeEditModal() {
    var editModal = document.getElementById("edit1");
    editModal.style.display = "none";
  }

  // Function to open the verification modal
  // Function to open the verification modal
  // Function to open the verification modal
  function openVerificationModal(event, projectId, projectStatus) {
    
    // Tampilkan modal verifikasi
    var verificationModal = document.getElementById("verificationModal");
    verificationModal.style.display = "block";

    // Isi nilai projectId langsung ke dalam elemen h2
    var h2Element = document.querySelector("#verificationModal h2");
    h2Element.textContent = projectId;

    // Simpan nilai id_project_value (jika diperlukan)
    $id_project_value = projectId;
    if (idajaInput1) {
      idajaInput1.value = projectId;
    }
    if (idajaInput2) {
      idajaInput2.value = projectId;
    }

    // Dapatkan semua baris tabel dalam modal
    var tableRows = verificationModal.querySelectorAll("table tbody tr");

    // Sembunyikan semua baris tabel
    tableRows.forEach(function (row) {
        row.style.display = "none"; // Semua baris disembunyikan terlebih dahulu
    });

    // Menampilkan hanya baris yang sesuai dengan nilai projectId
    tableRows.forEach(function (row) {
        var idProjectCell = row.querySelector("td:first-child");
        if (idProjectCell.textContent.trim() === projectId.trim()) {
            row.style.display = "table-row"; // Menampilkan baris yang sesuai
        }
    });

    
    // Tentukan elemen yang akan ditampilkan berdasarkan status
    var abcDiv = document.getElementById("abc");
    var abdcDiv = document.getElementById("abdc");

    if (projectStatus === "selesai") {
      abcDiv.style.display = "none";
      abdcDiv.style.display = "block";
    } else {
      abcDiv.style.display = "block";
      abdcDiv.style.display = "none";
    }

    event.stopPropagation();
  }







  // Function to close the verification modal
  function closeVerificationModal() {
    var verificationModal = document.getElementById("verificationModal");
    verificationModal.style.display = "none";
  }

  // Function to close the add card modal
  function closeAddCardModal() {
    var addCardModal = document.getElementById("addCardModal");
    addCardModal.style.display = "none";
  }

  // Ambil elemen tombol close
  var closeButton1 = document.getElementsByClassName("close")[0];
  var closeButton2 = document.getElementsByClassName("close1")[0];
  var closeButton3 = document.getElementsByClassName("close2")[0];

  // Close modal when clicking outside
  window.onclick = function (event) {
    var modals = document.getElementsByClassName("modal");
    for (var i = 0; i < modals.length; i++) {
      var modal = modals[i];
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  }

  // Ketika tombol "Add Card" diklik, tampilkan modal
  addCardButton.onclick = function () {
    addCardModal.style.display = "block";
  }

  // Ketika tombol close di klik, sembunyikan modal
  closeButton1.onclick = function () {
    closeAddCardModal();
  }

  closeButton2.onclick = function () {
    closeEditModal();
  }

  closeButton3.onclick = function () {
    closeVerificationModal();
  }


  // Function to sort table by status
  function sortTableByStatus() {
    var selectedStatus = document.getElementById('sortStatus').value;
    var table = document.getElementById('projectTable');
    var rows = Array.from(table.getElementsByTagName('tr'));

    rows.shift(); // Remove the header row from the sorting

    rows.sort(function (rowA, rowB) {
      var statusA = rowA.cells[8].innerText.trim();
      var statusB = rowB.cells[8].innerText.trim();

      if (selectedStatus === 'all') return 0;
      if (selectedStatus === 'belum selesai') {
        if (statusA === 'belum selesai' && statusB !== 'belum selesai') return -1;
        if (statusA !== 'belum selesai' && statusB === 'belum selesai') return 1;
        return 0;
      }

      if (selectedStatus === 'selesai') {
        if (statusA === 'selesai' && statusB !== 'selesai') return -1;
        if (statusA !== 'selesai' && statusB === 'selesai') return 1;
        return 0;
      }
    });

    // Rearrange the table rows based on the sorted array
    rows.forEach(function (row) {
      table.appendChild(row);
    });
  }


</script>
<?= $this->endSection() ?>