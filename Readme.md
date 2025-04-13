# Aplikasi Pemesana Hotel online 

Aplikasi ini merupakan sistem Reservasi Hotel Online Sederhana yang mendukung beberapa peran pengguna, yaitu Admin, Resepsionis, dan User (Tamu).

## Fitur User
- Melihat informasi kamar dan fasilitas kamar
- Melihat fasilitas umum hotel
- Mengisi form reservasi
- Cetak bukti reservasi
- Beberapa data terisi otomatis setelah login
- Melihat riwayat bukti reservasi

## Fitur admin
- CRUD Kamar
- CRUD Fasilitas Kamar
- CRUD Fasilitas Umum

## Fitur Resepsionis
- Pencarian Data Tamu Berdasarkan Tanggal Checkin
- Pencarian Data Tamu Berdasarkan Nama
- Lihat Detail Lengkap Data Reservasi
- Update Proses Status Reservasi 


## Fitur Tambahan
- login
- signup


## Cara Instalasi

1. **Persiapan Lingkungan:**
   - Install XAMPP atau Appserv.
   - Buat database di MySQL dengan nama `db_aloha` (atau sesuai pilihan).

2. **Langkah Instalasi:**
   - Clone atau download file proyek ini.
   - Pindahkan folder proyek ke direktori `htdocs` di XAMPP atau disesuaikan.
   - Buat database MySQL dengan nama `db_aloha` atau disesuaikan.
   - Import file `db_aloha.sql` ke dalam database.
   - Ubah pengaturan koneksi database di file `koneksi.php` (username, password, dan nama database).
   - Akses aplikasi melalui browser: `http://localhost/Hotel/`.

## Cara Menggunakan | bagian user (Tamu)

1. **Masuk Kehalaman Utama**
    - Masuk Kehalaman utama atau landing page untuk melihat konten kamar ataupun  detail fasilitas kamar dan umum

2. **Login Atau Daftar Akun Pengguna**
   - Sebelum Melakukan Reservasi Tamu Harus Masuk Kehalaman login jika akun sudah dibuat, jika belum daftarkan akun dan masukan data sesuai form signup. fungsinya adalah agar tidak terjadi spam reservasi dan agar mempermudah tamu untuk melakukan reservasi dan tamu bisa melihat fitur bukti reservasi, jika sewaktu waktu dibutuhkan
   
3. **Input Form Reservasi:**
   - Jika tamu ingin melakukan reservasi, tamu harus memasukan tanggal checkin, tanggal checkout dan juga jumlah kamar yang dipesan lalu klik button pesan maka form reservasi akan muncul dengan sebagian data tamu yang sudah terisi

4. **Cetak Bukti Reservasi**
   - setelah melakukan reservasi tamu bisa mencetak bukti reservasi dan melihat riwayat bukti reservasi.


## Cara Menggunakan | bagian resepsionis

1. **Login Resepsionis**
    - Login Ke dashboard resepsionis menggunakan akun email dan password yang Sudah diberikan

2. **Masuk Ke tampilan dashboard Resepsionis**
    - Jika sudah login akan masuk ke dashboard resepsionis dan dapat mengelola data reservasi tamu 

3. **Mencari data tamu berdasarkan tanggal checkin**
    - Jika ingin mencari data tamu, silahkan input tanggal  dan klik button search, jika sudah klik  button reset untuk kembali

4. **Mencari data tamu berdasarkan Nama**
    - Jika ingin mencari data tamu berdasarkan nama, silahkan input nama  dan klik button search, jika sudah klik  button reset untuk kembali

5. **Melihat detail reservasi**
   - jika ingin melihat detail reservasi, resepsionis bisa mengklik button "lihat"

6. **Update Status Reservasi**
  - jika ingin mengupdate status reservasi, resepsionis bisa mengklik button "update"


## Cara Menggunakan | bagian admin

1. **Login ke Dashboard Admin**
   - Login Ke dashboard admin menggunakan akun email dan password yang Sudah diberikan

2. **Kelola Data Kamar**
   - Tambahkan kamar baru
   - Edit atau hapus data kamar
   - Tentukan jumlah, kapasitas, deskripsi, dan gambar, dll

3. **Kelola Fasilitas Kamar**
   - Tambahkan fasilitas sesuai tipe kamar
   - Edit atau hapus fasilitas kamar

4. **Fasilitas Umum Hotel**
   - Tambahkan fasilitas seperti kolam renang, gym, restoran, dll.
   - Edit atau hapus fasilitas umum



## Akun Admin dan resepsionis

1. **Admin**
   - username : admin
   - email : alana@gmail.com
   - password : 12345

2. **Resepsionis**
   - username : resepsionis
   - email : janice@gmail.com
   - password : 12345