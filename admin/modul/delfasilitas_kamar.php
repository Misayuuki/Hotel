<?php 
include "../lib/koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM fasilitas_kamar WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Data Fasilitas Kamar sudah berhasil dihapus nih! 🤩');
        window.location.href = '?page=fasilitas_kamar';
        </script>";
        exit; 
        
    } else {
        echo "Error : " . $stmt->errorInfo()[2];
    }
}

?>