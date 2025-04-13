<?php

include "../lib/koneksi.php";

$id_reservasi = $_GET['id'];

$sql = "SELECT r.*, k.nama_kamar 
        FROM reservasi_pelanggan r
        JOIN tb_kamar k ON r.id_kamar = k.id_kamar
        WHERE r.id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_reservasi]);
$reservasi = $stmt->fetch();

if (!$reservasi) {
    echo "<script>alert('Reservasi tidak ditemukan!'); window.location.href='index.php';</script>";
    exit();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>


    <style>
    label {
        display: block;
        margin-bottom: 8px;
        color: #666;

    }

    .back a {
        display: inline-block;
        text-align: center;
        color: #5A6C57;
        text-decoration: none;
    }

    .back a:hover {
        text-decoration: underline;

    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <header>
                <p style="font-family: 'Baskervville', serif;">
                    <span class="icon"><i class="bi bi-journal me-2 mx-4"></i></span>
                    DETAIL RESERVASI
                </p>

            </header>
            <hr class="mb-4">

            <div class="card rounded mb-3" style="box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="col-sm-12 mt-3">

                        <table class="table table-striped" style="width:100%; border: 1px solid  #c9a66b;">
                            <tbody>
                                <tr>
                                    <td width="30%"> Nama Pemesan</td>
                                    <td><?= $reservasi['nama_pemesan'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Tamu</td>
                                    <td><?= $reservasi['nama_tamu'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?= $reservasi['email'] ?></td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td><?= $reservasi['no_hp'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pesan</td>
                                    <td><?= $reservasi['tgl_pesan'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Check-in</td>
                                    <td><?= $reservasi['checkin'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Check-out</td>
                                    <td><?= $reservasi['checkout'] ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Kamar</td>
                                    <td><?= $reservasi['nama_kamar'] ?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Kamar</td>
                                    <td><?= $reservasi['jml_kamar'] ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?= ucfirst($reservasi['status']) ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="back">
                            <a href="dashboard_resepsionis.php"><i class="bi bi-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</body>


</html>