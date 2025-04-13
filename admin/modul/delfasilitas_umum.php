<?php 
include "../lib/koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM fasilitas_umum WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Data Fasilitas Umum sudah berhasil dihapus nih! 🤩');
        window.location.href = '?page=fasilitas_umum';
        </script>";
        exit; 
        
    } else {
        echo "Error : " . $stmt->errorInfo()[2];
    }
}

?>