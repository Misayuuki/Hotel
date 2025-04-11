<?php 
include "../lib/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kamar = $_POST['namakamar'];
    $deskripsi = $_POST['deskripsi'];
    $total_kamar = $_POST['tokamar'];
    $detail_kamar = $_POST['detail_kamar'];
    $kapasitas = $_POST['kapasitas'];
    $gambar = $_FILES['gbr']['name'];
    $folder = "../gbrkamar/";
    $target_file = $folder . basename($gambar);


    if (move_uploaded_file($_FILES['gbr']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO tb_kamar (nama_kamar, deskripsi, total_kamar, detail_kamar, kapasitas, gambar) VALUES (:nama_kamar, :deskripsi, :total_kamar, :detail_kamar, :kapasitas, :gambar)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nama_kamar' => $nama_kamar,
            'deskripsi' => $deskripsi,
            'total_kamar' => $total_kamar,
            'detail_kamar' => $detail_kamar,
            'kapasitas' => $kapasitas,
            'gambar' => $gambar
        ]);

        echo "<script type='text/javascript'>alert('Data Kamar berhasil ditambahkan! 🤩');
        window.location.href = '?page=kamarhotel';
        </script>";
    } else {
        echo "<script>alert('Gagal mengupload gambar.');</script>";
    }
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
                    TAMBAH KAMAR
                </p>

            </header>
            <hr class="mb-4">

            <div class="card rounded mb-3" style="box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="col-sm-12 mt-3">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama_kamar" class="form-label">Nama Kamar : </label>
                                <input type="text" class="form-control" id="namakamar" name="namakamar"
                                    style="border-color: black;">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi : </label>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                    style="border-color: black;">
                            </div>
                            <div class="mb-3">
                                <label for="total_kamar" class="form-label">Total Kamar : </label>
                                <input type="number" class="form-control" id="tokamar" name="tokamar"
                                    style="border-color: black;">
                            </div>
                            <div class="mb-3">
                                <label for="detail_kamar" class="form-label">Detail Kamar :</label>
                                <input type="text" class="form-control" id="detail_kamar" name="detail_kamar"
                                style="border-color: black;"> 
                            </div>
                            <div class="mb-3">
                                <label for="kapasitas" class="form-label">Kapasitas :</label>
                                <input type="text" class="form-control" id="kapasitas" name="kapasitas"
                                    style="border-color: black;">
                            </div>
                            <div class="mb-3">
                                <label for="upload_gambar" class="form-label">Upload Gambar Kamar :</label>
                                <input type="file" class="form-control" id="gbr" name="gbr"
                                    style="border-color: black;">
                            </div>
                            <div class="my-4">
                                <button type="submit" name="btn" class="btn btn-primary">Input Data</button>
                            </div>
                            <div class="back">
                                <a href="?page=kamarhotel"><i class="bi bi-arrow-left"></i> Kembali</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


        </div>
    </div>

</body>

</html>