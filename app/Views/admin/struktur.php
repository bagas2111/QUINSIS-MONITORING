<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="<?=base_url()?>css/admin/struktur.css">
<!-- Rest of your layout content -->
<br>
<div class="content">
  <div class="page-title">
    <h1><b>Data Pegawai</b></h1>
  </div>
  <div class="box">
    <div class="sub-title">
      <h1><?=$nama_project?></h1>
    </div><br>
    <div class="row-2">
      <button id="tambahBtn"><i class='bx bx-plus-medical' style="color:#fff;"></i> Tambah Data Pegawai</button>
      <table>
        <thead>
          <tr>
            <th><b>No</b></th>
            <th><b>Username</b></th>
            <th><b>Nama</b></th>
            <th><b>Jabatan</b></th>
            <th><b>Aksi</b></th>
          </tr>
        </thead>
        <tbody>
        <?php if (!empty($pegawai)) : ?>
          <?php $i = 1; // Variabel untuk menghitung baris ?>
                    <?php foreach ($pegawai as $pegawai) : ?>
          <tr>
            
            <td><?= $i++?></td>
            <td><?= $pegawai['username'] ?></td>
            <td><?= $pegawai['nama_pegawai'] ?></td>
            <td><?= $pegawai['nama_struktur'] ?></td>
            <td style="width: 270px;">
              <a href="<?= base_url('admin/hapusStruktur/' . $pegawai['id_pegawai'].'/'.$id) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pegawai ini?')"><button type="button" class="btn btn-danger">Delete</button></a>
              <button type="button" class="btn btn-success editButton" data-pegawaid="<?= $pegawai['id_pegawai'] ?>"
                  data-username="<?= $pegawai['username'] ?>"
                  data-nama="<?= $pegawai['nama_pegawai'] ?>"
                  data-struktur="<?= $pegawai['nama_struktur'] ?>">Edit
                </button>            
              </td>
          </tr>
          <?php endforeach; ?>
          <?php else : ?><tr>
          <p style="text-align: center;">belum ada pegawai yang terlibat di project ini</p>
          </tr>
                    
                <?php endif; ?>
        </tbody>
      </table>
    </div><br>
  </div>
</div>

<!-- Pop-up untuk menambahkan data pegawai -->
<div class="popup" id="addPopup">
  <div class="popup-content">
    <span class="close" id="closeAddPopup">&times;</span>
    <h2>Tambah Data Pegawai</h2>
  <form id="editForm" action="<?= base_url('admin/addDataStruktur') ?>" method="post">
  <label for="editNama">UserName :<br>
    <input type="hidden" id="nama_project" name="nama_project" value="<?=$nama_project?>">
    <input type="text" id="username" name="username" readonly>
    </label><br>
    <input type="hidden" id="id_project" name="id_project" value="<?=$id?>">
    <label for="editNama">Nama :<br>
    <select name="id_pegawai" id="id_pegawai" onchange="updateEmployeeId()">
                <option value=""></option>
                <?php foreach ($tambah as $company): ?>
                  <option value="<?= $company['id'] ?>" data-username="<?= $company['username'] ?>"><?= $company['nama'] ?></option>
                <?php endforeach; ?>
            </select>
    </label><br>

    <label for="editStruktur">Jabatan:<br>
    <input type="text" id="jabatan" name="nama_struktur" required>
    </label><br>
    <button type="submit">tambah</button>
  </form>
  </div>
</div>

<!-- Pop-up untuk mengedit data pegawai -->
<div class="popup" id="editPopup">
  <div class="popup-content">
    <span class="close" id="closeEditPopup">&times;</span>
    <h2>edit Data Pegawai</h2>
  <form id="editForm" action="<?= base_url('admin/updateDataStruktur') ?>" method="post">
  <label for="editNama">UserName :<br>
  <input type="hidden" id="editPegawaiId" name="old_id_pegawai">
  <input type="hidden" id="editPegawaiId" name="id_project" value="<?=$id?>">
    <input type="text" id="editUsername" name="username" disabled>
    <!-- ini username -->
    <input type="text" id="editUssername" name="username"style="float: right; margin-right: -180px;" disabled >
    </label><br>

    <label for="editNama">Nama :<br>
    <select name="id_pegawai" id="editid_pegawai" onchange="updateeEmployeeId()">
    <option value="" disabled selected>Nama yang sebelumnya dipilih</option>
                <?php foreach ($tambah as $company): ?>
                  <option value="<?= $company['id'] ?>" data-username="<?= $company['username'] ?>"><?= $company['nama'] ?></option>
                <?php endforeach; ?>
            </select>    
            <!-- ini nama -->
            <input type="text" style="float: right; margin-right: -180px;" id="editNama" disabled>
          </label><br>

    <label for="editStruktur">Jabatan:<br>
    <input type="text" id="editStruktur" name="nama_struktur" required>
    <br>
    <button type="submit">EDIT</button>
  </form>
  </div>
</div>



<!-- JavaScript code for pop-ups -->
<script>
function updateEmployeeId() {
    var select = document.getElementById("id_pegawai");
    var selectedOption = select.options[select.selectedIndex];
    var employeeId = selectedOption.getAttribute("data-username");
    document.getElementById("username").value = employeeId;
}
function updateeEmployeeId() {
    var select = document.getElementById("editid_pegawai");
    var selectedOption = select.options[select.selectedIndex];
    var employeeId = selectedOption.getAttribute("data-username");
    document.getElementById("editUsername").value = employeeId;
}
  const tambahBtn = document.getElementById("tambahBtn");
  const addPopup = document.getElementById("addPopup");
  const closeAddPopup = document.getElementById("closeAddPopup");
  const editButtons = document.querySelectorAll(".editButton");
  const editPopup = document.getElementById("editPopup");
  const closeEditPopup = document.getElementById("closeEditPopup");
  const editPegawaiIdInput = document.getElementById("editPegawaiId");

  tambahBtn.addEventListener("click", () => {
    addPopup.style.display = "block";
  });

  closeAddPopup.addEventListener("click", () => {
    addPopup.style.display = "none";
  });

  // Event listener untuk tombol edit
  editButtons.forEach(editButton => {
    editButton.addEventListener("click", () => {
      editPopup.style.display = "block";
      const pegawaiId = editButton.getAttribute("data-pegawaid");
      editPegawaiIdInput.value = pegawaiId;

      // Mengambil nilai-nilai dari atribut data
      const username = editButton.getAttribute("data-username");
      const nama = editButton.getAttribute("data-nama");
      const struktur = editButton.getAttribute("data-struktur");

      // Mengisi nilai-nilai ke dalam input di dalam pop-up edit
      document.getElementById("editUssername").value = username;
      document.getElementById("editNama").value = nama;
      document.getElementById("editStruktur").value = struktur;
    });
  }); 

  closeEditPopup.addEventListener("click", () => {
    editPopup.style.display = "none";
  });
</script>

<?= $this->endSection() ?>
