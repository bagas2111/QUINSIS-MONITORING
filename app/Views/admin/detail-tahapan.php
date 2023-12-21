<?= $this->extend('layout/admin') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="<?=base_url()?>css/admin/d-tahapan.css">
<!-- Rest of your layout content -->
<br>
<div class="content">
    <div class="row">
        <h2><b><?= $nama_project ?></b></h2>
        <h5 align="center"><b><?= $nama_tahapan ?></b></h5>
    </div>

    <!-- List Project -->
    <div class="project">
        <!-- Projects -->
        <button onclick="goBack()"><b>back</b></button>
        <button type="button" class="btn btn-secondary" id="addTaskBtn">
            <i class='bx bx-plus-medical'></i> ADD
        </button>

        <?php if (empty($tahapanData)) : ?>
            <p style="text-align: center;">No detail available.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Judul Tugas</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tahapanData as $tugas) : ?>
                        <tr onclick="window.location='/admin/output/<?= $tugas['id_tahapan'] ?>/<?= $tugas['nama_tugas'] ?>/<?= $tugas['id_detail'] ?>'" style="cursor: pointer;">
                            <td><a href="/admin/output/<?= $tugas['id_tahapan'] ?>/<?= $tugas['nama_tugas'] ?>/<?= $tugas['id_detail'] ?>" style="text-decoration: none;"><?= $tugas['nama_tugas'] ?></a></td>
                            <td><?= $tugas['desc_tugas'] ?></td>
                            <td class="status"><?= $tugas['status'] ?></td>
                            <td><?= $tugas['deadline'] ?></td>
                            <td class="crud">
                                <a href="<?= base_url('admin/hapusDetail/' . $tugas['id_detail']) ?>"><button class="btn btn-danger" onclick="event.stopPropagation(); return confirm('Apakah Anda yakin ingin menghapus pegawai ini?')">Delete</button></a>
                                <button  class="btn btn-success editTaskBtn" data-id="<?= $tugas['id_detail'] ?>"  
                        data-nama="<?= $tugas['nama_tugas'] ?>" 
                        data-desc="<?= $tugas['desc_tugas'] ?>" 
                        data-deadline="<?= $tugas['deadline'] ?>">Edit</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<!-- Pop-up for adding -->
<div class="popup" id="addPopup">
    <div class="popup-content">
        <span class="close" id="closeAddPopup">&times;</span>
        <h2>Tambah Data</h2><br>
        <form action="<?= base_url('admin/addDataDtahapan') ?>" method="post">
        <input type="hidden" id="nama" name="id_tahapan" value="<?=$id_tahapan?>"><br>
        <label for="editNama">Judul Tugas</label><br>
        <input type="text" id="dsa" name="nama_tugas" required><br>

        
        <label for="editDeskripsi">Deskripsi:</label><br>
        <input type="deskripsi" id="ddas" name="desc_tugas"><br>

        <label for="editDeadline">Deadline:</label><br>
        <input type="date"  id="das" name="end_date" required >

        <button type="submit">Tambah</button>
      </form>
    </div>
</div>

<!-- Pop-up for editing -->
<div class="popup" id="editPopup">
    <div class="popup-content">
        <span class="close" id="closeEditPopup">&times;</span>
        <h2>Edit Nama Tahapan</h2><br>
        <form action="<?= base_url('admin/updateDetail') ?>" method="post">
        <input type="hidden" id="editID" name="id">
        <label for="editNama">Judul Tugas</label><br>
        <input type="text" id="editNama" name="nama" required><br>

        
        <label for="editDeskripsi">Deskripsi:</label><br>
        <input type="deskripsi" id="editDesc" name="deskripsi" placeholder="con: dalam pengerjaan"><br>

        <label for="editDeadline">Deadline:</label><br>
        <input type="date"  id="editdate" name="date" required >

        <button type="submit">Update</button>
      </form>
    </div>
</div>

<script>
      function goBack() {
        window.history.back();
    }

    // Function to open the Add popup
    const addTaskBtn = document.getElementById("addTaskBtn");
    const addPopup = document.getElementById("addPopup");
    const closeAddPopup = document.getElementById("closeAddPopup");

    addTaskBtn.addEventListener("click", () => {
        addPopup.style.display = "block";
    });

    closeAddPopup.addEventListener("click", () => {
        addPopup.style.display = "none";
    });

    // Function to open the Edit popup
    const editButtons = document.querySelectorAll(".editTaskBtn");
    const editPopup = document.getElementById("editPopup");
    const closeEditPopup = document.getElementById("closeEditPopup");

    editButtons.forEach(editButton => {
        editButton.addEventListener("click", () => {
            editPopup.style.display = "block";
            event.stopPropagation();

            // You can add logic here to populate the edit form with data.
            const pegawaiId = editButton.getAttribute("data-id");
            // Mengambil nilai-nilai dari atribut data
            const desc = editButton.getAttribute("data-desc");
            const nama = editButton.getAttribute("data-nama");
            const deadline = editButton.getAttribute("data-deadline");

            // Mengisi nilai-nilai ke dalam input di dalam pop-up edit
            document.getElementById("editID").value = pegawaiId;
            document.getElementById("editDesc").value = desc;
            document.getElementById("editNama").value = nama;
            document.getElementById("editdate").value = deadline;
        });
    });

    closeEditPopup.addEventListener("click", () => {
        editPopup.style.display = "none";
    });
</script>

<?= $this->endSection() ?>
