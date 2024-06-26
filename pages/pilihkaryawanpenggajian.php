<div id="top" class="row mb_3">
    <div class="col">
        <h3>Pilih Karyawan</h3>
    </div>
    <div class="col">
        <a href="javascript:history.back()" class="btn btn-primary">
            <i class="fa fa-arrow-circle-left"></i>
            Kembali
        </a>
    </div>
</div>
<div id="content" class="row mb_3">
    <div class="col">
        <?php
        include "database/connection.php";
        $no = 1;
        $select_sql = "SELECT K.*,B.nama nama_bagian FROM karyawan K LEFT JOIN bagian B ON K.bagian_id = B.id";
        $result = $con->query($select_sql);
       
        if (!$result) {
            ?>
            <div class="alert alert-danger" role="alert">
                <?= mysqli_error($connection) ?>
            </div>
            <?php
            return;
        }
        if (mysqli_num_rows($result) == 0) {
            ?>
            <div class="alert alert-light" role="alert">
                Data Kosong
            </div>
            <?php
            return;
        }
        ?>
        <table class="table bg-white rounded shadow-sm table-hover">
            <thead>
                <tr>
                    <th scope="col">NIK</th>
                    <th scope="col">Nama Karyawan</th>
                    <th scope="col">Bagian</th>
                    <th class="text-end" scope="col">Gaji Pokok</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr class="align-middel">
                        <th scope="row"><?= $row["nik"] ?></th>
                        <td><?= $row["nama"] ?></td>
                        <td><?= $row["nama_bagian"] ?></td>
                        <td class="text-end"><?= number_format($row["gaji_pokok"]) ?></td>
                        <td>
                            <a href="?page=penggajiantambah&nik=<?= $row["nik"] ?>" class="btn btn-success">
                                <i class="fa fa-arrow-circle-right"></i>
                                Pilih
                            </a>
                        </td>
                    </tr>


                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>