<?php 
include "../lib/koneksi.php";

if (isset($_GET['id_kamar'])) {
    $id = $_GET['id_kamar'];
    $sql = "DELETE FROM tb_kamar WHERE id_kamar = :id_kamar";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_kamar', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Data Kamar sudah berhasil dihapus nih! 🤩');
        window.location.href = '?page=kamarhotel';
        </script>";
        exit; 
        
    } else {
        echo "Error : " . $stmt->errorInfo()[2];
    }
}

?>