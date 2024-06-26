<?php
include "database/connection.php";


if (isset($_GET['id'])) {
    $nik = $_GET['id'];


    $query = $con->prepare("SELECT * FROM karyawan WHERE nik = ?");
    $query->bind_param("s", $nik);
    $query->execute();
    $result = $query->get_result();
    $employee = $result->fetch_assoc();
    $query->close();
}

if (isset($_POST['simpan_button'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $gaji_pokok = $_POST['gaji_pokok'];
    $status_karyawan = $_POST['status_karyawan'];
    $bagian_id = $_POST['bagian_id'];

    
    
        
        $stmt = $con->prepare("UPDATE karyawan SET nama = ?, tanggal_mulai = ?, gaji_pokok = ?, status_karyawan = ?, bagian_id = ? WHERE nik = ?");
        $stmt->bind_param("sssssi", $nama, $tanggal_mulai, $gaji_pokok, $status_karyawan, $bagian_id, $nik);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success' role='alert'>Data karyawan berhasil diperbarui!</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Gagal memperbarui data karyawan!</div>";
        }

        $stmt->close();
    

       
    }

?>

<div id="top" class="row mb-3">
  <div class="col">
    <h3><?php echo isset($_GET['nik']) ? 'Edit' : 'Tambah'; ?> Data Karyawan</h3>
  </div>
  <div class="col">
    <a href="?page=karyawan" class="btn btn-primary float-end">
      <i class="fa fa-arrow-circle-left"></i>
      Kembali
    </a>
  </div>
</div>
<div id="pesan" class="row mb-3">
    <div class="col">
        
    </div>
</div>

<div id="inputan" class="row mb-3">
  <div class="col">
    <div class="card px-3">
      <form action="" method="POST">
        <div class="mb-3">
          <label for="nik" class="form-label">NIK</label>
          <input
            type="text"
            name="nik"
            class="form-control"
            id="nik"
            placeholder="misal: 001"
            value="<?php echo isset($employee['nik']) ? htmlspecialchars($employee['nik']) : ''; ?>"
            <?php echo isset($employee['nik']) ? 'readonly' : ''; ?>
            required
          />
        </div>
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input
            type="text"
            name="nama"
            class="form-control"
            id="nama"
            placeholder="misal: Muhammad Nor Abdillah"
            value="<?php echo isset($employee['nama']) ? htmlspecialchars($employee['nama']) : ''; ?>"
            required
          />
        </div>
        <div class="mb-3">
          <label for="tanggal_mulai" class="form-label">Tanggal Mulai Bekerja</label>
          <input    
            type="date"
            name="tanggal_mulai"
            class="form-control"
            id="tanggal_mulai"
            value="<?php echo isset($employee['tanggal_mulai']) ? htmlspecialchars($employee['tanggal_mulai']) : ''; ?>"
            required
          />
        </div>
        <div class="mb-3">
          <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
          <input
            type="number"
            name="gaji_pokok"
            class="form-control"
            id="gaji_pokok"
            value="<?php echo isset($employee['gaji_pokok']) ? htmlspecialchars($employee['gaji_pokok']) : ''; ?>"
            required
          />
        </div>
        <div class="mb-3">
          <label for="status_karyawan" class="form-label">Status Karyawan</label>
          <div>
            <input type="radio" id="Tetap" name="status_karyawan" value="Tetap" <?php echo isset($employee['status_karyawan']) && $employee['status_karyawan'] == 'Tetap' ? 'checked' : ''; ?> required>
            <label for="Tetap">Tetap</label>
          </div>
          <div>
            <input type="radio" id="kontrak" name="status_karyawan" value="KONTRAK" <?php echo isset($employee['status_karyawan']) && $employee['status_karyawan'] == 'KONTRAK' ? 'checked' : ''; ?> required>
            <label for="kontrak">Kontrak</label>
          </div>
          <div>
            <input type="radio" id="magang" name="status_karyawan" value="MAGANG" <?php echo isset($employee['status_karyawan']) && $employee['status_karyawan'] == 'MAGANG' ? 'checked' : ''; ?> required>
            <label for="magang">Magang</label>
          </div>
        </div>
        <div class="mb-3 mt-3">
          <label for="bagian_id" class="form-label">Bagian</label>
          <select class="form-select" aria-label="Default select example" name="bagian_id">
          <option value="" selected> -- Pilih Bagian -- </option>
            <?php 
            $bagianOp = $con->query("SELECT * FROM bagian");
            while ($row = $bagianOp->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '"' . (isset($employee['bagian_id']) && $employee['bagian_id'] == $row['id'] ? ' selected' : '') . '>' . htmlspecialchars($row['nama']) . '</option>';
            }
            ?>
        </select>
        </div>
        <div class="mb-3">
          <button class="btn btn-success" type="submit" name="simpan_button">
            <i class="fas fa-save"></i>
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
