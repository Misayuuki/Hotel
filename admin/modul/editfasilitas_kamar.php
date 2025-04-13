<?php 
include "../lib/koneksi.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM fasilitas_kamar WHERE id = :id");
$stmt->execute(['id' => $id]);
$data = $stmt->fetch();


if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kamar = $_POST['id_kamar'];
    $fasilitas = $_POST['fasilitas'];


    $sql = "UPDATE fasilitas_kamar SET id_kamar = :id_kamar, fasilitas = :fasilitas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id_kamar' => $id_kamar,
        'fasilitas' => $fasilitas,
        'id' => $id
    ]);

    echo "<script type='text/javascript'>
        alert('Data Fasilitas Kamar berhasil diupdate! 🤩');
        window.location.href = '?page=fasilitas_kamar';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kamar</title>


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
                    EDIT DATA FASILITAS KAMAR
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
                                <label for="id_kamar" class="form-label">Kamar</label>
                                <select class="form-control" id="id_kamar" name="id_kamar" required
                                    style="border-color: black;">
                                    <option value="">Pilih Kamar</option>
                                    <?php foreach ($kamars as $kamar): ?>
                                    <option value="<?= $kamar['id_kamar'] ?>"
                                        <?= $kamar['id_kamar'] == $data['id_kamar'] ? 'selected' : '' ?>>
                                        <?= $kamar['nama_kamar'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fasilitas" class="form-label">Fasilitas :</label>
                                <input type="text" class="form-control" id="fasilitas" name="fasilitas"
                                    style="border-color: black;" value="<?php echo $data['fasilitas']; ?>">
                            </div>
                            <div class="my-4">
                                <button type="submit" name="btn" class="btn btn-primary">Update Data</button>
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