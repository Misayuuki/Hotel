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
    $total_harga = $_POST['totalHarga'];

    if (strtotime($checkin) < strtotime(date('Y-m-d'))) {
        echo "<script>alert('Tanggal check-in tidak boleh lebih awal dari hari ini! 😊');
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
    
    // Hitung jumlah malam untuk validasi harga
    $jumlahMalam = (strtotime($checkout) - strtotime($checkin)) / (60 * 60 * 24);
    $hargaPermalam = $pdo->query("SELECT harga FROM tb_kamar WHERE id_kamar = $id_kamar")->fetchColumn();
    $hargaSeharusnya = $hargaPermalam * $jml_kamar * $jumlahMalam;
    
    if ($total_harga != $hargaSeharusnya) {
        echo "<script>alert('Terjadi ketidaksesuaian dalam perhitungan harga! Silahkan coba lagi. 😊');
              window.history.back();
              </script>";
        exit();
    }
    
    $stmt = $pdo->prepare("SELECT total_kamar FROM tb_kamar WHERE id_kamar = :id_kamar");
    $stmt->execute([':id_kamar' => $id_kamar]);
    $kamar = $stmt->fetch();

    if ($jml_kamar < 1 || $jml_kamar > $kamar['total_kamar']) {
        echo "<script>alert('Jumlah kamar tidak valid! Pastikan jumlah kamar yang diminta tidak lebih dari yang tersedia! 😅');
              window.history.back();
              </script>";
        exit();
    }

    
    $sql = "INSERT INTO reservasi_pelanggan 
            (user_id, nama_pemesan, email, no_hp, nama_tamu, tgl_pesan, checkin, checkout, jml_kamar, total_harga, status, id_kamar) 
            VALUES (:user_id, :nama_pemesan, :email, :no_hp, :nama_tamu, NOW(), :checkin, :checkout, :jml_kamar, :total_harga, 'menunggu', :id_kamar)";
    
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
        ':total_harga' => $total_harga,
        ':id_kamar' => $id_kamar
    ]);
    
    $id_reservasi = $pdo->lastInsertId();

    // Kurangi total kamar
$update = $pdo->prepare("UPDATE tb_kamar SET total_kamar = total_kamar - :jumlah WHERE id_kamar = :id_kamar");
$update->execute([
    ':jumlah' => $jml_kamar,
    ':id_kamar' => $id_kamar
]);
    
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
            <input type="date" class="form-control" id="checkout" name="checkout" required >
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
                    <input type="text" class="form-control" id="telpon" name="telpon" style="border-color: black;"
                        required>
                </div>
                <div class="form-group mt-3 mb-2">
                    <label for="tamu" class="form-label">Nama Tamu</label>
                    <input type="text" class="form-control" id="tamu" name="tamu" style="border-color: black;" required>
                </div>
                <div class="form-group mt-3 mb-2">
                    <label for="idkamar" class="form-label">Tipe Kamar</label>
                    <select class="form-control" name="idkamar" id="idkamar" style="border-color: black;" required>
                        <?php foreach ($kamar as $k): ?>
                        <option value="<?= $k['id_kamar'] ?>" data-harga="<?= $k['harga'] ?>">
                            <?= $k['nama_kamar'] ?> (Rp <?= number_format($k['harga']) ?>)
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group mt-3 mb-2">
                    <label for="totalHarga" class="form-label">Total Harga</label>
                    <input type="text" class="form-control" id="totalHarga" readonly
                        style="border-color: black; background-color: #f3f3f3;">
                    <input type="hidden" name="totalHarga" id="hidden_totalHarga">

                </div>

                <div class="mt-4 mb-4">
                    <button type="submit" name="submit_reservasi" id="konfirmasi"
                        class="btn btn-outline-success">Konfirmasi Pemesanan</button>
                    <button type="button" id="tombol_batal" class="btn btn-outline-danger">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Set min date untuk check-in (hari ini)
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('checkin').min = today;
});

// Validasi saat check-in berubah
document.getElementById('checkin').addEventListener('change', function() {
    const checkinDate = new Date(this.value);
    const checkoutInput = document.getElementById('checkout');
    
    // Set min date untuk check-out (hari setelah check-in)
    const minCheckoutDate = new Date(checkinDate);
    minCheckoutDate.setDate(minCheckoutDate.getDate() + 1);
    checkoutInput.min = minCheckoutDate.toISOString().split('T')[0];
    
    // Reset check-out jika tidak valid
    if (new Date(checkoutInput.value) <= checkinDate) {
        checkoutInput.value = '';
    }
    
    updateTotalPrice();
});

// Validasi saat check-out berubah
document.getElementById('checkout').addEventListener('change', function() {
    const checkinDate = new Date(document.getElementById('checkin').value);
    const checkoutDate = new Date(this.value);
    
    if (checkoutDate <= checkinDate) {
        alert('Tanggal check-out harus setelah tanggal check-in!');
        this.value = '';
    }
    
    updateTotalPrice();
});

// Fungsi hitung total harga
function updateTotalPrice() {
    const selectedOption = document.getElementById('idkamar').selectedOptions[0];
    const hargaPerKamar = parseFloat(selectedOption.getAttribute('data-harga'));
    const jumlahKamar = parseInt(document.getElementById('jumlahKamar').value) || 0;
    const checkin = document.getElementById('checkin').value;
    const checkout = document.getElementById('checkout').value;
    
    // Hitung jumlah malam
    let jumlahMalam = 0;
    if (checkin && checkout) {
        const diffTime = Math.abs(new Date(checkout) - new Date(checkin));
        jumlahMalam = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    }
    
    const totalHarga = hargaPerKamar * jumlahKamar * jumlahMalam;
    
    document.getElementById('totalHarga').value = 'Rp ' + totalHarga.toLocaleString();
    document.getElementById('hidden_totalHarga').value = totalHarga;
}

// Tombol Pesan
document.getElementById('btnCari').addEventListener('click', function() {
    const checkin = document.getElementById('checkin').value;
    const checkout = document.getElementById('checkout').value;
    const jumlahKamar = document.getElementById('jumlahKamar').value;

    if (!checkin || !checkout || !jumlahKamar) {
        alert('Harap isi semua field tanggal dan jumlah kamar! 😊');
        return;
    }
    
    // Validasi jumlah malam
    const checkinDate = new Date(checkin);
    const checkoutDate = new Date(checkout);
    if (checkoutDate <= checkinDate) {
        alert('Tanggal check-out harus setelah tanggal check-in!');
        return;
    }

    document.getElementById('hidden_checkin').value = checkin;
    document.getElementById('hidden_checkout').value = checkout;
    document.getElementById('hidden_jumlahKamar').value = jumlahKamar;
    
    updateTotalPrice();
    
    document.getElementById('panel_pemesanan').style.display = 'block';
});

// Event listeners untuk update harga
document.getElementById('idkamar').addEventListener('change', updateTotalPrice);
document.getElementById('jumlahKamar').addEventListener('input', updateTotalPrice);
document.getElementById('tombol_batal').addEventListener('click', function() {
    document.getElementById('panel_pemesanan').style.display = 'none';
});
</script>
