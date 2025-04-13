<?php 
session_start();
include "lib/koneksi.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_reservasi'])) {
    
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Anda harus login terlebih dahulu untuk melakukan reservasi! 😊');
              window.location.href = 'login.php';
              </script>";
        exit();
    }

    $nama_pemesan = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['telpon'];
    $nama_tamu = $_POST['tamu'];
    $id_kamar = $_POST['idkamar'];
    $jml_kamar = $_POST['jumlahKamar'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $user_id = $_SESSION['user_id'];


    if ($jml_kamar < 1) {
        echo "<script>alert('Jumlah kamar harus minimal 1! 😅');
              window.history.back();
              </script>";
        exit();
    }

    if (strtotime($checkout) <= strtotime($checkin)) {
        echo "<script>alert('Tanggal check-out harus setelah tanggal check-in! 😊');
              window.history.back();
              </script>";
        exit();
    }

    $stmt = $pdo->prepare("SELECT total_kamar FROM tb_kamar WHERE id_kamar = :id_kamar");
    $stmt->execute([':id_kamar' => $id_kamar]);
    $kamar = $stmt->fetch();

    if ($jml_kamar > $kamar['total_kamar']) {
        echo "<script>alert('Maaf, kamar tidak tersedia sebanyak yang diminta! 😅');
              window.history.back();
              </script>";
        exit();
    }


    $sql = "INSERT INTO reservasi_pelanggan 
            (user_id, nama_pemesan, email, no_hp, nama_tamu, tgl_pesan, checkin, checkout, jml_kamar, status, id_kamar) 
            VALUES (:user_id, :nama_pemesan, :email, :no_hp, :nama_tamu, NOW(), :checkin, :checkout, :jml_kamar, 'menunggu', :id_kamar)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id' => $user_id,
        ':nama_pemesan' => $nama_pemesan,
        ':email' => $email,
        ':no_hp' => $no_hp,
        ':nama_tamu' => $nama_tamu,
        ':checkin' => $checkin,
        ':checkout' => $checkout,
        ':jml_kamar' => $jml_kamar,
        ':id_kamar' => $id_kamar
    ]);
    
    $id_reservasi = $pdo->lastInsertId();
    
    echo "<script>alert('Reservasi berhasil! 🤩');
          window.location.href = 'buktiReservasi.php?id=$id_reservasi';
          </script>";
    exit();
}


$kamar = $pdo->query("SELECT * FROM tb_kamar")->fetchAll();
?>

<!-- Check in, Check Out, jumlah kamar -->
<div class="container mt-5">
    <form class="row gx-3 justify-content-center align-items-end" id="form_tanggal">
        <div class="col-md-3">
            <label for="checkin">Check In :</label>
            <input type="date" class="form-control" id="checkin" name="checkin" required min="<?= date('Y-m-d') ?>">
        </div>

        <div class="col-md-3">
            <label for="checkout">Check Out :</label>
            <input type="date" class="form-control" id="checkout" name="checkout" required>
        </div>

        <div class="col-md-3">
            <label for="jumlahKamar">Jumlah Kamar :</label>
            <input type="number" class="form-control" id="jumlahKamar" name="jumlahKamar" min="1" required>
        </div>
      
        <div class="col-auto d-flex align-items-end">
            <button type="button" id="btnCari" class="btn text-white w-100 mt-3 mt-md-0"
                style="background-color: #c9a66b; color: rgb(49, 46, 39);">Pesan</button>
        </div>
    </form>
</div>

<!-- Form Reservasi -->
<div class="container mt-4 col-sm-8" id="panel_pemesanan" style="border-radius: 15px; display: none;">
    <div class="card" style="box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
        <div class="card-body text-white" style="background-color: #c9a66b; font-family: 'Baskervville', serif;">
            <h4>Form Reservasi</h4>
            <p>Silahkan memasukan data pada form ini untuk memulai pemesanan!</p>
        </div>
        <div class="card-body bg-white mx-3">
            <form id="form_pesan" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="checkin" id="hidden_checkin">
                <input type="hidden" name="checkout" id="hidden_checkout">
                <input type="hidden" name="jumlahKamar" id="hidden_jumlahKamar">
                
                <div class="form-group mt-3 mb-2">
                    <label for="nama" class="form-label">Nama Pemesan</label>
                    <input type="text" class="form-control" id="nama" name="nama" style="border-color: black;" 
                    value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>" required>
                </div>
                <div class="form-group mt-3 mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" style="border-color: black;" 
                    value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" required>
                </div>
                <div class="form-group mt-3 mb-2">
                    <label for="telpon" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control" id="telpon" name="telpon" style="border-color: black;" required>
                </div>
                <div class="form-group mt-3 mb-2">
                    <label for="tamu" class="form-label">Nama Tamu</label>
                    <input type="text" class="form-control" id="tamu" name="tamu" style="border-color: black;" required>
                </div>
                <div class="form-group mt-3 mb-2">
                    <label for="idkamar" class="form-label">Tipe Kamar</label>
                    <select class="form-control" name="idkamar" id="idkamar" style="border-color: black;" required>
                        <?php foreach ($kamar as $k): ?>
                            <option value="<?= $k['id_kamar'] ?>"><?=$k['nama_kamar']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-4 mb-4">
                    <button type="submit" name="submit_reservasi" id="konfirmasi" class="btn btn-outline-success">Konfirmasi Pemesanan</button>
                    <button type="button" id="tombol_batal" class="btn btn-outline-danger">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('btnCari').addEventListener('click', function() {
    const checkin = document.getElementById('checkin').value;
    const checkout = document.getElementById('checkout').value;
    const jumlahKamar = document.getElementById('jumlahKamar').value;
    
    if (!checkin || !checkout || !jumlahKamar) {
        alert('Harap isi semua field tanggal dan jumlah kamar! 😊');
        return;
    }
    
    document.getElementById('hidden_checkin').value = checkin;
    document.getElementById('hidden_checkout').value = checkout;
    document.getElementById('hidden_jumlahKamar').value = jumlahKamar;
    
    document.getElementById('panel_pemesanan').style.display = 'block';
});

document.getElementById('tombol_batal').addEventListener('click', function() {
    document.getElementById('panel_pemesanan').style.display = 'none';
});
</script>