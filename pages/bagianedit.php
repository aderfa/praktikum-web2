<?php 
session_start();
include 'database/connection.php';
$bagiankon = $con->query("SELECT * FROM bagian");

?>
<body>
    <div class="d-flex" id="wrapper">


       
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Bagian Edit</h3>
                            <a href="bagiantambah.php">
                                <button class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i>Tambah</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                if(isset($_GET['id'])) {
                                    
    $id = intval($_GET['id']); // fix sql injection untuk edit
} else {
   
    header("Location: ?pages=bagian");
    exit();
}

// fix sql injection untuk edit
$stmt = $con->prepare("SELECT * FROM bagian WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nama_bagian = $row['nama'];

  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_bagian_baru = $_POST["nama_bagian"];

        
        $update_stmt = $conn->prepare("UPDATE bagian SET nama = ? WHERE id = ?");
        $update_stmt->bind_param("si", $nama_bagian_baru, $id);
        
        if ($update_stmt->execute()) {
            echo '<div class="alert alert-success" role="alert"><i class="fas fa-check-circle"></i> Data berhasil diperbarui</div>';
            $nama_bagian = $nama_bagian_baru; 
        } else {
            echo '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Terjadi kesalahan. Data gagal diperbarui</div>';
        }

        $update_stmt->close();
    }
} else {
    
    echo '<script>window.location.href = "?page=bagian";</script>';
    $_SESSION['pesan'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Data tidak ditemukan</div>';
}

$stmt->close();
?>
                                    <form action="" method="POST">
                                        <div class="mb-3">
                                            <label for="nama_bagian" class="form-label">Nama Bagian</label>
                                            <input type="text" class="form-control" id="nama_bagian" name="nama_bagian" placeholder="ex : HRD" required value="<?php echo htmlspecialchars($nama_bagian); ?>">

                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="gas" class="btn btn-success"><i
                                                    class="fas fa-save me-2"></i>Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>




</body>
</html>
