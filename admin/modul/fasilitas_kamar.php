<?php 
include "../lib/koneksi.php";

$sql = "SELECT f.*, k.nama_kamar 
        FROM fasilitas_kamar f 
        INNER JOIN tb_kamar k ON f.id_kamar = k.id_kamar 
        ORDER BY f.id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Fasilitas Kamar</title>


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

    .btn-sm {
        margin: 2px;
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
    <div class="container my-5">
        <div class="row">
            <header>
                <p style="font-family: 'Baskervville', serif;">
                    <a class="btn btn-outline-success btn-sm" href="?page=addfasilitas_kamar">Tambah</a>
                    <span class="icon"><i class="bi bi-people-fill me-2 mx-4"></i></span>
                    Data Fasilitas Kamar
                </p>

            </header>
            <hr class="mb-4">

            <div class="card rounded">
                <div class="card-body">

                    <?php if (count($data) > 0): ?>
                    <table class="table">
                        <thead style="font-family: 'Baskervville', serif;">
                            <tr>
                                <th>No</th>
                                <th>Kamar</th>
                                <th>Nama Fasilitas</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            <?php foreach ($data as $rowResult): ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$rowResult['nama_kamar']?></td>
                                <td><?=$rowResult['fasilitas']?></td>
                    

                                <td>
                                    <a class="btn btn-primary btn-sm mb-2"
                                        href="?page=editfasilitas_kamar&id=<?= $rowResult['id'] ?>">Update</a><br><a
                                        class="btn btn-danger btn-sm"
                                        href="?page=delfasilitas_kamar&id=<?= $rowResult['id'] ?>"
                                        onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                    <?php else: ?>
                    <p class="no-data">Tidak ada data Fasilitas Kamar.</p>
                    <?php endif; ?>
                </div>
            </div>


        </div>
    </div>

</body>

</html>