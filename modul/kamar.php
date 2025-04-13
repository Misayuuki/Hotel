<?php 
include "lib/koneksi.php";
$sql = "SELECT * FROM tb_kamar ORDER BY id_kamar DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data_kamar = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!-- KAMAR -->
<div class="room-title text-center">
    <!-- <i class="fa-solid fa-bed" style="font-size: 30px; color: #c9a66b;"></i> -->
    <h2 class="rooms-title mt-5" style="font-family: 'Baskervville', serif;">Our Rooms</h2>
    <div class="divider"></div>
    <p class="mt-3 fst-italic text-capitalize" style="font-size: 1rem;">Choose from some of the most popular rooms
    </p>
</div>


<?php foreach($data_kamar as $kamar): 
    $sql_fasilitas = "SELECT * FROM fasilitas_kamar WHERE id_kamar = :id_kamar";
    $stmt_fasilitas = $pdo->prepare($sql_fasilitas);
    $stmt_fasilitas->bindParam(':id_kamar', $kamar['id_kamar'], PDO::PARAM_INT);
    $stmt_fasilitas->execute();
    $fasilitas_kamar = $stmt_fasilitas->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container mt-4">
    <div class="row align-items-stretch mb-3">
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="gbrkamar/<?=$kamar['gambar']?>" class="img-fluid rounded zoom-effect" alt="Gambar Contoh">
        </div>
        <div class="col-md-6 px-5 p-4" style="background-color:#c9a66b; border-radius:10px;">
            <h3 class="mt-4" style="font-family: 'Baskervville', serif;"><?=$kamar['nama_kamar']?></h3>
            <p class="mt-2 fst-italic text-capitalize" style="font-size: 1rem;">
                <?=$kamar['deskripsi']?>
            </p>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <span class="d-flex align-items-center">
                    <i class="bi bi-people-fill me-2"></i> <?=$kamar['kapasitas']?>
                </span>
                <!-- <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalFasilitas"><i
                            class="bi bi-eye"></i> Read More</button> -->
                <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                    data-bs-target="#exampleModal<?=$kamar['id_kamar']?>">
                    <i class="bi bi-eye"></i> Read More</button>
            </div>
            <div class="d-grid gap-2 mt-4">
                <a class="btn btn-outline-dark" href="?page=form_reservasi" role="button"><i
                        class="bi bi-calendar-check"></i> Book
                    Now</a>
            </div>
        </div>
    </div>
</div>
<!-- AKHIR KAMAR -->



<!-- Modal -->
<div class="modal fade" id="exampleModal<?=$kamar['id_kamar']?>" tabindex="-1"
    aria-labelledby="exampleModalLabel<?=$kamar['id_kamar']?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel<?=$kamar['id_kamar']?>"><?=$kamar['nama_kamar']?>
                    Detail Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 mb-4"> <img src="gbrkamar/<?=$kamar['gambar']?>"
                                class="img-fluid rounded zoom-effect" alt="Gambar Contoh"></div>
                        <div class="col-md-6 ms-auto">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab<?=$kamar['id_kamar']?>"
                                        data-bs-toggle="tab" data-bs-target="#nav-home<?=$kamar['id_kamar']?>"
                                        type="button" role="tab" aria-controls="nav-home<?=$kamar['id_kamar']?>"
                                        aria-selected="true" style="color: #c9a66b;">Fasilitas</button>
                                    <button class="nav-link" id="nav-profile-tab<?=$kamar['id_kamar']?>"
                                        data-bs-toggle="tab" data-bs-target="#nav-profile<?=$kamar['id_kamar']?>"
                                        type="button" role="tab" aria-controls="nav-profile<?=$kamar['id_kamar']?>"
                                        aria-selected="false" style="color: #c9a66b;">Detail
                                        Kamar</button>


                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">
                                <!--konten pertama-->
                                <div class="tab-pane fade show active" id="nav-home<?=$kamar['id_kamar']?>"
                                    role="tabpanel" aria-labelledby="nav-home-tab<?=$kamar['id_kamar']?>" tabindex="0">
                                    <div class="container-fluid">
                                        <div class="row my-3">
                                            <ul>
                                                <?php foreach($fasilitas_kamar as $fasilitas): ?>
                                                <li><?=$fasilitas['fasilitas']?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <!-- div akhir row-->
                                    </div>
                                    <!-- div akhir container-->
                                </div>
                                <!--div akhir konten pertama-->

                                <!--konten kedua-->
                                <div class="tab-pane fade" id="nav-profile<?=$kamar['id_kamar']?>" role="tabpanel"
                                    aria-labelledby="nav-profile-tab<?=$kamar['id_kamar']?>" tabindex="0">
                                    <div class="container-fluid">
                                        <div class="row my-2">

                                            <p class="mt-2 fst-italic text-capitalize" style="font-size: 1rem;">
                                                <?=$kamar['detail_kamar']?>
                                            </p>
                                            <p>
                                                <strong style="color:#c9a66b;">Harga Per Malam / Hari : </strong> Rp.
                                                500.000++
                                            </p>
                                            <figcaption class="blockquote-footer mt-0">
                                                <i>Harga dapat bervariasi berdasarkan jenis kamar. Hubungi resepsionis
                                                    untuk informasi lebih lanjut.</i>
                                            </figcaption>
                                        </div>
                                        <!-- div akhir row-->
                                    </div>
                                    <!-- div akhir container-->
                                </div>
                                <!--div akhir konten kedua-->



                            </div>
                            <!--akhir tab content-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>