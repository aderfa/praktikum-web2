<?php
include 'database/connection.php';
session_start();

if(isset($_GET['id'])) {
   
    $id = intval($_GET['id']); 
    
    
    $stmt = $con->prepare("DELETE FROM bagian WHERE id = ?");
    
    $stmt->bind_param("i", $id);
    
    
    $stmt->execute();
    
   
    if($stmt->affected_rows > 0) {
        $_SESSION['pesan'] = '<i class="fas fa-exclamation-circle"></i> Data berhasil dihapus.';
    } else {
        $_SESSION['pesan'] = '<i class="fas fa-exclamation-circle"></i> Data tidak ditemukan atau gagal dihapus.';
    }
    
   
    $stmt->close();
}


echo '<script>window.location.href = "?page=bagian";</script>';
exit();
?>
