<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "botline1_penggajian";

$connection = mysqli_connect($servername, $username,$password,$dbname);
if (!$connection) {
    die("Gagal terkoneksi: ". mysqli_connect_error());
}
?>
