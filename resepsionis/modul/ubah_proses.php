<?php 
include "../lib/koneksi.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM reservasi_pelanggan WHERE id = :id");
$stmt->execute(['id' => $id]);
$data = $stmt->fetch();


if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $statusBaru = $_POST['status'];
    $statusLama = $data['status'];

    // Update status
    $sql = "UPDATE reservasi_pelanggan SET status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'status' => $statusBaru,
        'id' => $id
    ]);

    // Cek jika status sebelumnya belum mengembalikan stok
    if (
        ($statusBaru === 'selesai check out' || $statusBaru === 'dibatalkan') &&
        !in_array($statusLama, ['selesai check out', 'dibatalkan']) // baru lakukan jika belum
    ) {
        $jumlah_kamar = $data['jml_kamar'];
        $id_kamar = $data['id_kamar'];

        $updateKamar = $pdo->prepare("UPDATE tb_kamar SET total_kamar = total_kamar + :jumlah WHERE id_kamar = :id_kamar");
        $updateKamar->execute([
            ':jumlah' => $jumlah_kamar,
            ':id_kamar' => $id_kamar
        ]);
    }

    echo "<script type='text/javascript'>
        alert('Data Proses berhasil diupdate! 🤩');
        window.location.href = 'dashboard_resepsionis.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses</title>


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
                    UBAH PROSES
                </p>

            </header>
            <hr class="mb-4">

            <div class="card rounded mb-3" style="box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="col-sm-12 mt-3">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nama Tamu:</label>
                                <input type="text" class="form-control" value="<?= $data['nama_tamu'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status:</label>
                                <select class="form-control" name="status" required style="border-color: black;">
                                    <option value="menunggu" <?= $data['status'] === 'menunggu' ? 'selected' : '' ?>>
                                        Menunggu</option>
                                    <option value="selesai check in"
                                        <?= $data['status'] === 'selesai check in' ? 'selected' : '' ?>>Selesai Check In
                                    </option>
                                    <option value="selesai check out"
                                        <?= $data['status'] === 'selesai check out' ? 'selected' : '' ?>>Selesai Check
                                        Out</option>
                                    <option value="dibatalkan"
                                        <?= $data['status'] === 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                </select>
                            </div>

                            <div class="my-4">
                                <button type="submit" name="btn" class="btn btn-primary">Update Data</button>
                            </div>
                            <div class="back">
                                <a href="dashboard_resepsionis.php"><i class="bi bi-arrow-left"></i> Kembali</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


        </div>
    </div>

</body>


</html>