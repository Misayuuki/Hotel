<?php
session_start();
include "lib/koneksi.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil reservasi terakhir milik user ini
$sql = "SELECT r.*, k.nama_kamar 
        FROM reservasi_pelanggan r
        JOIN tb_kamar k ON r.id_kamar = k.id_kamar
        WHERE r.user_id = ? 
        ORDER BY r.tgl_pesan DESC LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$reservasi = $stmt->fetch();

if (!$reservasi) {
    echo "<script>alert('Kamu belum melakukan reservasi.'); window.location.href='index.php';</script>";
    exit();
}
?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Reservasi Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .header {
        border-bottom: 2px dashed #ddd;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .hotel-logo img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }


    table {
        width: 100%;
        margin-top: 10px;
    }

    table,
    th,
    td {
        border: 1px dashed black;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: rgb(224, 200, 158);
    }

    .print-btn {
        background-color: #c9a66b;
        color: rgb(28, 29, 31);
    }

    .back-btn {
        background-color: rgb(28, 29, 31);
        color: #c9a66b;
    }


    .info-pemesan p {
        margin-bottom: 10px;
    }
    </style>
</head>

<body>
    <div class="container mt-4" style="font-family: 'Baskervville', serif;">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="hotel-logo">
                <img src="asset/img/aloha4.png" alt="Hotel Logo">
            </div>
            <div class="hotel-info p-2 mt-2 fst-italic text-end">
                <h2 style="color: #c9a66b;">Aloha Hotels </h2>
                <p>Jl. MH Thamrin No. 10, Menteng, Jakarta Pusat, Indonesia</p>
                <p>+62 66 502 0888</p>
                <p>Reservation@AlohaHotels.com</p>
            </div>
        </div>
        <h5 class="mt-4" style="color: #c9a66b; margin-bottom: 15px; font-family: 'Baskervville', serif;">
            <i class="bi bi-person-circle me-2"></i> Bukti Reservasi
        </h5>
        <div class="info-pemesan mb-4">
            <div class="row">
                <!-- Kolom Pertama -->
                <div class="col-md-6">
                    <p><strong>Nama Pemesan:</strong> <?= $reservasi['nama_pemesan'] ?></p>
                    <p><strong>Email:</strong> <?= $reservasi['email'] ?></p>
                    <p><strong>No Telpon:</strong> <?= $reservasi['no_hp'] ?></p>
                </div>

                <!-- Kolom Kedua -->
                <div class="col-md-6">
                    <p><strong>Nama Tamu:</strong> <?= $reservasi['nama_tamu'] ?></p>
                    <p><strong>Tanggal Pemesanan:</strong> <?= $reservasi['tgl_pesan'] ?></p>
                    <p><strong>Status:</strong> <?= ucfirst($reservasi['status']) ?></p>
                </div>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kamar</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Jumlah Kamar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $reservasi['id'] ?></td>
                    <td><?= $reservasi['nama_kamar'] ?></td>
                    <td><?= $reservasi['checkin'] ?></td>
                    <td><?= $reservasi['checkout'] ?></td>
                    <td><?= $reservasi['jml_kamar'] ?></td>
                </tr>
            </tbody>
        </table>
        <!-- <p class="mt-3 fst-italic"><strong>Catatan:</strong> Pastikan berada di hotel 30 menit sebelum check-in.</p> -->
        <div class="catatan mt-4 ">
            <div class="alert alert-warning">
                <strong><i class="bi bi-info-circle"></i> Catatan:</strong>
                Harap datang 30 menit sebelum waktu check-in. Reservasi akan hangus jika tidak check-in sebelum 19:00.
            </div>

        </div>


    </div>
    <div class="d-flex justify-content-center align-items-center my-4">
        <a class="btn back-btn mx-3" href="index.php"><i class="bi bi-arrow-left"></i>
            Kembali</a>
        <button class="btn print-btn  mx-3" onclick="window.print()"><i class="bi bi-printer"></i></i> Cetak
            Bukti</button>
    </div>


</body>

</html>