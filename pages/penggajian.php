<div id="top" class="row mb-3">
    <div class="col">
        <h3>Penggajian</h3>
    </div>
    <div class="col">
        <a href="?page=pilihkaryawanpenggajian" class="btn btn-success float-end">
            <i class="fa fa-plus-circle"></i>
            Tambah
        </a>
        <div class="col">
            <a href="?page=pilihbulantahunpenggajian" class="btn btn-primary fload-end">
                <i class="fa fa-arrow-circle-live"></i>
                Kembali
            </a>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        <div class="row mb-3">
            <div class="col">
                <?php
                include "database/connection.php";

                $no = 1;
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];

                $select_sql = "";
                if ($bulan == "Semua") {

                    if ($tahun == "Semua") {
                        $select_sql = "SELECT P.* , K.nama FROM penggajian P
LEFT JOIN karyawan K ON P.karyawan_nik = K.nik";
                    } else {
                        $select_sql = "SELECT P.* , K.nama FROM penggajian P
LEFT JOIN karyawan K ON P.karyawan_nik = K.nik WHERE tahun = '$tahun'";
                    }
                } else {
                    if ($tahun != "Semua") {
                        $select_sql = "SELECT P.* , K.nama FROM penggajian P
LEFT JOIN karyawan K ON P.karyawan_nik = K.nik WHERE tahun = '$tahun' AND bulan = '$bulan'";
                    }
                }

                 
                 $result = $con->query($select_sql);
                if (!$result) {

                    echo '<div class="alert alert-danger" role="alert">';
                    echo mysqli_error($connection);
                    echo '</div>';

                    return;
                }

                if (mysqli_num_rows($result) == 0) {

                    echo '<div class="alert alert-light" role="alert">';
                    echo "Data kosong";
                    echo '</div>';

                    return;
                }

                ?>
                <table class="table bg-white rounded shadow-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">NIK</th>
                            <th scope="col">Nama</th>
                            <th scope="col">bulan</th>
                            <th scope="col">Tahun</th>
                            <th class="text-end" scope="col">Gaji Dibayar</th>
                            <th scope="col" width="200">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <th scope="row"><?= $row["karyawan_nik"] ?></th>
                                <td><?= $row["nama"] ?></td>
                                <td><?= $row["bulan"] ?></td>
                                <td><?= $row["tahun"] ?></td>
                                <td class="text-end"><?= number_format($row["gaji_bayar"]) ?></td>
                                <td>
                                    <a href="?page=penggajianhapus&id=<?= $row["id"] ?>&bulan=<?= $bulan ?>&tahun=<?= $tahun ?>"
                                        onclick="javascript: return confirm('Konfirmasi data akan dihapus')"
                                        class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                        Hapus
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
    </div>
</div>