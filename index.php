<?php 
session_start();
include "lib/koneksi.php";

// Cek apakah pengguna sudah login
$isLoggedIn = isset($_SESSION['user_id']);
$username = $isLoggedIn ? $_SESSION['username'] : null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Aloha Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


    <link rel="stylesheet" href="asset/css/main.css">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .phone-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    #sticky-navbar {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 1;
        background-color: #fff;
        margin: auto;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    }

    .nav-link:hover {
        color: #c9a66b;
    }

    .zoom-effect {
        transition: transform 0.2s;
    }

    .zoom-effect:hover {
        transform: scale(1.1);
    }

    #footer {
        border-top: 1px solid #ddd;
        padding-top: 15px;
        margin-bottom: 0;
        clear: both;
        font-size: 15px;
        margin-top: 20px;

    }

    .sosmed a {
        font-size: 20px;
        color: #666;
        margin-right: 10px;
        transition: 0.3s;
    }

    .sosmed a:hover {
        color: #c9a66b;
    }

    .brown {
        color: #c9a66b;
        text-decoration: none;
        font-weight: 500;
    }

    .brown:hover {
        text-decoration: underline;

    }

    .divider {
        width: 60px;
        height: 3px;
        background-color: #c9a66b;
        ;
        margin: 10px auto;
        border-radius: 8px;
    }
    </style>
</head>

<body>

    <?php
include "modul/topbar.php";
include "modul/navbar.php";



$page = isset($_GET['page']) ? $_GET['page'] : null;

if ($page) {
    // Ini Halaman manual routing
    if ($page == 'keluar') {
        header("Location: logout.php");
        exit();
    } 
    // Ini Halaman otomatis dicari di modul/
    elseif (file_exists("modul/$page.php")) {
        include "modul/$page.php";
    } else {
        echo "<p>Halaman tidak ditemukan.</p>";
    }
} else {
    include "modul/default.php";
}
?>

    <!-- ini Bagian Footer -->
    <footer id="footer">
        <div class="container-fluid mb-0">
            <div class="row align-items-center mx-5">
                <div class="col-lg-10 col-md-9 mt-3">
                    <p><a href="#" target="_blank" class="brown"
                            style="font-family: 'Baskervville', serif;"><strong>Aloha Hotels</strong></a> | <i>Destinasi
                            terbaik untuk perjalanan bisnis & liburan</i></p>
                    <p>Jl. MH Thamrin No. 10, Menteng, Jakarta Pusat 10350, Indonesia <br>
                        Phone: <a href="https://web.whatsapp.com/" class="brown">+62 66 502 0888</a>, Fax: +62 66 603
                        2233, Email: <a href="https://mail.google.com/" class="brown">Reservation@AlohaHotels.com</a>
                    </p>
                </div>
                <div class="col-lg-2 col-md-3 text-lg-end text-md-end text-center">
                    <p style="font-family: 'Baskervville', serif;"><strong>FOLLOW US</strong></p>
                    <div class="sosmed">
                        <a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.youtube.com/"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bottom text-center mt-3 mb-0">
            <div class="container">
                <p style="font-family: 'Baskervville', serif;">Copyright &copy; 2025 All rights reserved - Aloha Hotels
                </p>
            </div>
        </div>
    </footer>
    <!-- ini akhir Footer -->





</body>

</html>