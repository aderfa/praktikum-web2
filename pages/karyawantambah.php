<?php include 'database/connection.php';
$bagiankon = $con->query("SELECT * FROM karyawan");

?>
<body>
    <div class="d-flex" id="wrapper">


       
      
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Bagian Tambah</h3>
                            <a href="?page=karyawan">
                                <button class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i>Kembali</button>
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
                                    
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        
                                        $nama_bagian = $_POST["nama_bagian"];

                                        
                                        $cek = "SELECT * FROM bagian WHERE nama='$nama_bagian'";
                                        $hasil = $con->query($cek);

                                        if ($hasil->num_rows > 0) {
                                           
                                            echo '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Data gagal ditambahkan atau sudah ada</div>';
                                        } else {
                                            
                                            $query = "INSERT INTO bagian (nama) VALUES ('$nama_bagian')";
                                            if ($con->query($query) === TRUE) {
                                               
                                                echo '<div class="alert alert-success" role="alert"><i class="fas fa-check-circle"></i> Data berhasil ditambahkan</div>';
                                            } else {
                                               
                                                echo '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Terjadi kesalahan. Data gagal ditambahkan</div>';
                                            }
                                        }
                                    }
                                    ?>
                                    <form action="" method="POST">
                                        <div class="mb-3">
                                            <label for="nama_bagian" class="form-label">Nama Bagian</label>
                                            <input type="text" class="form-control" id="nama_bagian" name="nama_bagian"
                                                placeholder="ex : HRD" required>
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
