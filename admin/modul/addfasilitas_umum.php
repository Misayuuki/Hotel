<?php 
include "../lib/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_fasilitas = $_POST['fasilitasu'];
    $keterangan = $_POST['keterangan'];

    // Proses upload gambar
    $gambar = $_FILES['gbr']['name'];
    $folder = "../gbrfasilitasu/";
    $target_file = $folder . basename($gambar);


    if (move_uploaded_file($_FILES['gbr']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO fasilitas_umum (nama_fasilitas, keterangan, gambar) VALUES (:nama_fasilitas, :keterangan, :gambar)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'nama_fasilitas' => $nama_fasilitas,
            'keterangan' => $keterangan,
            'gambar' => $gambar
        ]);

        echo "<script type='text/javascript'>alert('Data Fasilitas berhasil ditambahkan! 🤩');
        window.location.href = '?page=fasilitas_umum';
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
    <title>Tambah Fasilitas Umum</title>


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
                    TAMBAH FASILITAS UMUM
                </p>

            </header>
            <hr class="mb-4">

            <div class="card rounded mb-3" style="box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="col-sm-12 mt-3">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama_fasilitas" class="form-label">Nama Fasilitas : </label>
                                <input type="text" class="form-control" id="fasilitasu" name="fasilitasu"
                                    style="border-color: black;">
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan : </label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan"
                                    style="border-color: black;">
                            </div>
                            <div class="mb-3">
                                <label for="upload_gambar" class="form-label">Upload Gambar :</label>
                                <input type="file" class="form-control" id="gbr" name="gbr"
                                    style="border-color: black;">
                            </div>
                            <div class="my-4">
                                <button type="submit" name="btn" class="btn btn-primary">Input Data</button>
                            </div>
                            <div class="back">
                                <a href="?page=fasilitas_umum"><i class="bi bi-arrow-left"></i> Kembali</a>
                            </div>
                        </form>
                  
                    </div>
                </div>
            </div>


        </div>
    </div>

</body>

</html>