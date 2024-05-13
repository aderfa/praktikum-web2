<?php 
    include "database/connection.php";
?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col">
            <h3>Bagian</h3>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <?php 
            $selectSQL = "SELECT * FROM bagian";
            $result = mysqli_query($connection,$selectSQL);
            if (!$result) {
            ?>
            <div class="alert alert-danger">
                <?php echo mysqli_error($connection) ?>
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
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle">
                        <th scope="row">1</th>
                        <td>HRD</td>
                    </tr>
                    <tr class="align-middle">
                        <th scope="row">2</th>
                        <td>Finance</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
