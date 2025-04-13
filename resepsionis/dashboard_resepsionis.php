<?php 
session_start();
if (empty($_SESSION['username']) || $_SESSION['role'] !== 'resepsionis') {
    echo "<script>alert('Maaf Hanya admin yang bisa mengakses Halaman Ini!'); window.location.href='../login.php';</script>";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resepsionis Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../asset/css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
    </style>
</head>

<body>

<?php 
include "modul/navbare.php";

$page = isset($_GET['page']) ? $_GET['page'] : null;

if ($page) {
    // manual routing
    if ($page == 'keluar') {
        header("Location: ../logout.php"); 
        exit();
    } 
    // otomatis
    elseif (file_exists("modul/$page.php")) {
        include "modul/$page.php";
    } else {
        echo "<p>Halaman tidak ditemukan.</p>";
    }
} else {
    include "modul/defaultre.php";
}

?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>