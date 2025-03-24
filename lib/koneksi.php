<?php 
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_aloha";

try {
    //koneksi dengan pdo
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    //set mode error pdo untuk tampilan exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Koneksi Mu Berhasil Nich!";
} catch (PDOException $e) {
    //menangkap error jika koneksi gagal
    echo "Koneksi gagal:" . $e->getMessage();
}
?>