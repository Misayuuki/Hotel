<?php 
include "../lib/koneksi.php";

$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
$kode = isset($_GET['kode']) ? $_GET['kode'] : '';

$sql = "SELECT * FROM reservasi_pelanggan WHERE 1=1";
$params = [];

if (!empty($tanggal)) {
    $sql .= " AND checkin = :checkin";
    $params[':checkin'] = $tanggal;
}

if (!empty($kode)) {
    $sql .= " AND id = :id";
    $params[':id'] = $kode;
}

$sql .= " ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resepsionis</title>


    <style>
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .table img {
        max-width: 150px;
        height: auto;
        border-radius: 5px;
    }

    .no-data {
        text-align: center;
        font-style: italic;
        color: #6c757d;
        margin-top: 20px;
    }
    </style>
</head>

<body>

    <!-- RESEPSIONIS -->
    <div class="room-title text-center">
        <h2 class="rooms-title mt-2" style="font-family: 'Baskervville', serif; color:rgb(68, 73, 77)"><span
                class="icon"><i class="bi bi-people-fill me-2 mx-4" style="color: #c9a66b;"></i></span>Data Reservasi
        </h2>
    </div>

    <div class="container my-5">
        <div class="row">
            <form method="GET" class="row g-2 align-items-center mb-4">
                <div class="col-auto">
                    <input type="date" name="tanggal" class="form-control" value="<?= $tanggal ?>"
                        style="border: 1px solid #c9a66b;">
                </div>
                <div class="col-auto">
                    <input type="text" name="kode" class="form-control" placeholder="Cari kode reservasi"
                        value="<?= $kode ?>" style="border: 1px solid #c9a66b;">
                </div>



                <div class="col-auto">
                    <button type="submit" class="btn btn-outline-secondary  btn-sm rounded text-center">
                        search <i class="bi bi-search mx-1"></i>
                    </button>
                </div>
                <div class="col-auto">
                    <a href="dashboard_resepsionis.php" class="btn btn-outline-secondary btn-sm rounded text-center">
                        Reset <i class="bi bi-x-circle mx-1"></i>
                    </a>
                </div>
            </form>

            <hr class="mb-4">

            <div class="card rounded">
                <div class="card-body">

                    <?php if (count($data) > 0): ?>
                    <table class="table">
                        <thead style="font-family: 'Baskervville', serif;">
                            <tr>
                                <th>Kode Reservasi</th>
                                <th>Status</th>
                                <th>Nama Tamu</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Tanggal Pesan</th>
                                <th>Aksi</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($data as $rowResult): ?>
                            <tr>
                                <td><?=$rowResult['id']?></td>
                                <td><?=$rowResult['status']?></td>
                                <td><?=$rowResult['nama_tamu']?></td>
                                <td><?=$rowResult['checkin']?></td>
                                <td><?=$rowResult['checkout']?></td>
                                <td><?=$rowResult['tgl_pesan']?></td>



                                <td>
                                    <a class="btn btn-info btn-sm mb-2"
                                        href="?page=data_pelanggan&id=<?= $rowResult['id'] ?>">Lihat</a><br>

                                    <a class="btn btn-warning btn-sm"
                                        href="?page=ubah_proses&id=<?= $rowResult['id'] ?>">Proses</a>
                                </td>

                            </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                    <?php else: ?>
                    <p class="no-data">Tidak ada Data Tamu.</p>
                    <?php endif; ?>
                </div>
            </div>


        </div>
    </div>

</body>

</html>