<?php 
    include "database/connection.php";

    $bagiankon = $con->query("SELECT * FROM bagian");


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
                <h3>Bagian</h3>
                <a href="?page=bagiantambah">
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
                <th scope="col" width="50">#</th>
                <th scope="col">Bagian</th>
                <th scope="col" width="150">Aksi</th>
            </tr>
        </thead>
                <tbody>
            <?php
            $i = 1;
            
            foreach ($bagiankon as $bagian) { 
                
            ?>
                <tr class="align-middle">
                    <th scope="row"><?php echo $i; ?></th> 
                    
                    <td><?php echo htmlspecialchars($bagian['nama']); ?></td> 
                    
                    <td>
                    <div class="btn-group" role="group">
    <a href="?page=bagianedit&id=<?php echo $bagian['id']; ?>" class="btn btn-primary btn-sm" ><i class="fas fa-edit me-1" ></i>Edit</a>
    <a href="?page=bagianhapus&id=<?php echo $bagian['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm" >
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