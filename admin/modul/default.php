<?php
include "../lib/koneksi.php";


$total_reservasi = $pdo->query("SELECT COUNT(*) FROM reservasi_pelanggan")->fetchColumn();
$jumlah_user = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'user'")->fetchColumn();
$total_kamar = $pdo->query("SELECT COUNT(*) FROM tb_kamar")->fetchColumn();
$stok_kamar = $pdo->query("SELECT SUM(total_kamar) FROM tb_kamar")->fetchColumn();
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
    .card-custom {
        border: none;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        transition: 0.3s;
    }

    .card-custom:hover {
        transform: translateY(-4px);
    }

    .stat-title {
        font-size: 1rem;
        color: #6c757d;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: bold;
        color: #343a40;
    }

    .highlight {
        color: #c9a66b;
    }

    .btn-custom {
        background-color: #c9a66b;
        border: none;
        color: white;
    }

    .btn-custom:hover {
        background-color: #b99056;
    }
    </style>
</head>

<body>
    <?php session_start(); ?>
    <div class="container mt-5">
        <div class="alert alert-warning text-center" role="alert"
            style="background-color:#fff8e1; border-left:5px solid #c9a66b;">
            <h4 class="alert-heading">Selamat bekerja, <?= $_SESSION['username']; ?>!</h4>
            <p>Semoga harimu menyenangkan. Apa pun yang kamu kelola hari ini, semoga lancar dan berdampak baik!</p>
        </div>
    </div>


    <div class="container py-3">

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-custom bg-white text-center">
                    <div class="stat-title">Total Reservasi</div>
                    <div class="stat-value highlight"><?= $total_reservasi ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom bg-white text-center">
                    <div class="stat-title">Jumlah Pengguna</div>
                    <div class="stat-value highlight"><?= $jumlah_user ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom bg-white text-center">
                    <div class="stat-title">Total Tipe Kamar</div>
                    <div class="stat-value highlight"><?= $total_kamar ?></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-custom bg-white text-center">
                    <div class="stat-title">Stok Kamar</div>
                    <div class="stat-value highlight"><?= $stok_kamar ?></div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>