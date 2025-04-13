<?php 
include "lib/koneksi.php";
$sql = "SELECT * FROM fasilitas_umum ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$fasilitas = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Fasilitas -->
<div class="room-title text-center">
    <!-- <i class="fa-solid fa-bed" style="font-size: 30px; color: #c9a66b;"></i> -->
    <h2 class="rooms-title mt-5" style="font-family: 'Baskervville', serif;">Our Facilities</h2>
    <div class="divider"></div>
    <p class="mt-3 fst-italic text-capitalize" style="font-size: 1rem;">Let's Explore our hotel's best Facilities
    </p>
</div>

<div class="container py-4 mt-4 mb-5">
    <div class="row">
        <!-- Fasilitas 1 -->
        <?php foreach($fasilitas as $item): ?>
        <div class="col-md-4 mb-4">
            <div class="card border-0 mb-3">
                <img src="gbrfasilitasu/<?=$item['gambar']?>" class="img-fluid rounded zoom-effect" alt="Fasilitas Umum">
            </div>
            <div class="desk py-3 text-center" style="border: 1px solid #c9a66b; border-radius:10px; height:auto">
            <h5 class="card-title"><?=$item['nama_fasilitas']?></h5>
            <p class="card-text fst-italic mt-2 px-2"><?=$item['keterangan']?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>