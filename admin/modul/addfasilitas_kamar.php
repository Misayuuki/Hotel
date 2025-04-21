<?php 
include "../lib/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kamar = $_POST['id_kamar'];
    $fasilitas = $_POST['fasilitas'];


    $sql = "INSERT INTO fasilitas_kamar (id_kamar, fasilitas) 
            VALUES (:id_kamar, :fasilitas)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id_kamar' => $id_kamar,
        'fasilitas' => $fasilitas
 
    ]);

    echo "<script type='text/javascript'>
        alert('Data Fasilitas Kamar berhasil ditambahkan! 🤩');
        window.location.href = '?page=fasilitas_kamar';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kamar</title>


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
                    TAMBAH FASILITAS KAMAR
                </p>
            </header>
            <hr class="mb-4">

            <div class="card rounded mb-3" style="box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="col-sm-12 mt-3">
                        <form method="POST">
                            <?php
                            $stmt = $pdo->query("SELECT * FROM tb_kamar");
                            $kamars = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <div class="mb-3">
                                <label for="id_kamar" class="form-label">Kamar :</label>
                                <select class="form-control" id="id_kamar" name="id_kamar" required
                                    style="border-color: black;">
                                    <option value="">Pilih Kamar</option>
                                    <?php foreach ($kamars as $kamar): ?>
                                    <option value="<?= $kamar['id_kamar'] ?>"><?= $kamar['nama_kamar'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php
                                // Ambil data tipe_fasilitas dari database
                                $stmt = $pdo->query("SELECT * FROM tipe_fasilitas");
                                $tipeFasilitasList = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                            <div class="mb-3">
                                <label for="fasilitas" class="form-label">Fasilitas :</label>
                                <select class="form-control" id="fasilitas" name="fasilitas" required
                                    style="border-color: black;">
                                    <option value="">Pilih Fasilitas</option>
                                    <?php foreach ($tipeFasilitasList as $tf): ?>
                                    <option value="<?= htmlspecialchars($tf['tipe_fasilitas']) ?>">
                                        <?= htmlspecialchars($tf['tipe_fasilitas']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
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