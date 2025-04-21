<?php 
include "../lib/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipe_fasilitas = $_POST['tipe_fasilitas'];

    $sql = "INSERT INTO tipe_fasilitas (tipe_fasilitas) VALUES (:tipe_fasilitas)";
    $stmt = $pdo->prepare($sql);
    $sukses = $stmt->execute([
        'tipe_fasilitas' => $tipe_fasilitas
    ]);

    if ($sukses) {
        $pesan = "<p class='text-success'>✅ Data berhasil ditambahkan!</p>";
    } else {
        $pesan = "<p class='text-danger'>❌ Gagal menambahkan data.</p>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tipe Fasilitas</title>


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
                    <span class="icon"><i class="bi bi-plus-square me-2 mx-4"></i></span>
                    Tambah Tipe Fasilitas
                </p>
            </header>
            <hr class="mb-4">

            <div class="card rounded mb-3" style="box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="col-sm-12 mt-3">
                    <?php if (isset($pesan)) echo $pesan; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="fasilitas" class="form-label">Tipe Fasilitas :</label>
                                <input type="text" class="form-control" id="tipe_fasilitas" name="tipe_fasilitas" style="border-color: black;">
                            </div>
                            <div class="my-4">
                                <button type="submit" name="btn" class="btn btn-primary">Input Data</button>
                            </div>
                            <div class="back">
                                <a href="?page=fasilitas_kamar"><i class="bi bi-arrow-left"></i> Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>