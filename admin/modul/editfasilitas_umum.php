<?php 
include "../lib/koneksi.php";

$id = $_GET['id']; // ambil id
$stmt = $pdo->prepare("SELECT * FROM fasilitas_umum WHERE id = :id");
$stmt->execute(['id' => $id]);
$data = $stmt->fetch();

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_fasilitas = $_POST['fasilitasu'];
    $keterangan = $_POST['keterangan'];

    // Jika ada gambar yang diupload
    if (!empty($_FILES['gbr']['name'])) {
        $fileName = $_FILES['gbr']['name'];
        $fileTmp = $_FILES['gbr']['tmp_name'];
        $uploadPath = "../gbrfasilitasu/" . $fileName;

        if (move_uploaded_file($fileTmp, $uploadPath)) {
            $gambar = $fileName; 
        } else {
            echo "<script>alert('Gagal mengunggah gambar!');</script>";
            exit;
        }
    } else {
        $gambar = $data['gambar']; 
    }

    
    $stmt = $pdo->prepare("UPDATE fasilitas_umum SET nama_fasilitas = :nama_fasilitas, keterangan = :keterangan, gambar = :gambar WHERE id = :id");
    $stmt->execute([
        'nama_fasilitas' => $nama_fasilitas,
        'keterangan' => $keterangan,
        'gambar' => $gambar,
        'id' => $id
    ]);

    echo "<script type='text/javascript'>
        alert('Data Kamar berhasil diupdate! 🤩');
        window.location.href = '?page=fasilitas_umum';
    </script>";
    exit;

   
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
                    <span class="icon"><i class="bi bi-building me-2 mx-4"></i></span>
                    EDIT FASILITAS UMUM
                </p>

            </header>
            <hr class="mb-4">

            <div class="card rounded mb-3" style="box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="col-sm-12 mt-3">
                        <form method="POST" enctype="multipart/form-data" class="px-3">
                            <div class="mb-3">
                                <label for="nama_fasilitas" class="form-label">Nama Fasilitas : </label>
                                <input type="text" class="form-control" id="fasilitasu" name="fasilitasu"
                                    style="border-color: black;" value="<?php echo $data['nama_fasilitas']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan : </label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan"
                                    style="border-color: black;" value="<?php echo $data['keterangan']; ?>">
                                    
                            </div>
                            <div class="mb-3">
                                <label for="upload_gambar" class="form-label">Upload Gambar :</label>
                                <input type="file" class="form-control" id="gbr" name="gbr" style="border-color: black;">
                                <img src="../gbrfasilitasu/<?=$data['gambar']?>" alt="Gambar Fasilitas"
                                    style="max-width: 200px; margin-top: 10px; border-radius: 10px;">

                            </div>
                            <div class="my-4">
                                <button type="submit" name="btn" class="btn btn-primary">Update Data</button>
                            </div>
                            <div class="back">
                                <a href="?page=fasilitas_umum"><i class="bi bi-arrow-left"></i> Kembali</a>
                            </div>
                        </form>

                        <?php 
       
        ?>
                    </div>
                </div>
            </div>


        </div>
    </div>

</body>

</html>