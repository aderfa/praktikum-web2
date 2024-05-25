<?php 
    include "database/connection.php";

    $bagiankon = $con->query("SELECT * FROM karyawan");


session_start();


if(isset($_SESSION['pesan'])) {

    echo '<div class="alert alert-danger">' . $_SESSION['pesan'] . '</div>';
    
    unset($_SESSION['pesan']);
}
?>

<div class="container-fluid px-4">
<div class="row">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Karyawan</h3>
                <a href="?page=karyawantambah">
                    <button class="btn btn-success"><i class="fas fa-plus-circle me-2"></i>Tambah</button>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <?php 
            $selectSQL = "SELECT * FROM bagian";
            $result = mysqli_query($con,$selectSQL);
            if (!$result) {
            ?>
            <div class="alert alert-danger">
                <?php echo mysqli_error($con) ?>
            </div>
        <?php 
        return;
            }
            if (mysqli_num_rows($result)==0) {
                ?>
                <div class="alert alert-light">
                    Data Kosong
                </div>
                <?php 
                return;
            }
            ?>
        
            <table class="table bg-white rounded shadow-sm  table-hover">
            <thead>
            <tr>
                <th scope="col" width="50">NIK</th>
                <th scope="col">Nama Karyawan</th>
                <th scope="col">bagian</th>
                <th scope="col" width="150">Aksi</th>
            </tr>
        </thead>
                <tbody>
            <?php
            $i = 1;
            
            foreach ($bagiankon as $bagian) { 
                
            ?>
                <tr class="align-middle">
                    <th scope="row"><?php echo htmlspecialchars($bagian['nik']); ?></th> 
                    
                    <td><?php echo htmlspecialchars($bagian['nama']); ?></td> 
                    <td><?php 
                    $bid = $bagian['bagian_id'];
                    $bagianid = $con->query("SELECT * FROM bagian WHERE id = $bid");
                    if($bagianid->num_rows > 0){
                        $row = $bagianid->fetch_assoc();
                        echo $row['nama'];
                    }
                    ?></td> 
                    <td>
                    <div class="btn-group" role="group">
    <a href="?page=karyawanedit&id=<?php echo $bagian['nik']; ?>" class="btn btn-primary btn-sm" ><i class="fas fa-edit me-1" ></i>Edit</a>
    <a href="?page=karyawanhapus&id=<?php echo $bagian['nik']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm" >
        <i class="fas fa-trash-alt me-1"></i>Hapus
    </a>
</div>

                    </td>
                </tr>
            <?php
                $i++; 
                
            }
            ?>
        </tbody>
    </table>
            </table>
        </div>
    </div>

</div>