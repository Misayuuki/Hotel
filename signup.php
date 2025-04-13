<?php
session_start();
include 'lib/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = 'user'; // Ini default role agar user itu gak bisa menjadi peran admin / resepsionis karna gak ada pilihan

    if (!empty($username) && !empty($email) && !empty($password)) {
        // Cek email udah terdaftar atau belum
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $error = "Email sudah digunakan!";
        } else {
            $hashed_password = md5($password);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$username, $email, $hashed_password, $role])) {
                header("Location: login.php?success=registrasi_berhasil");
                exit();
            } else {
                $error = "Gagal mendaftar, coba lagi!";
            }
        }
    } else {
        $error = "Mohon isi semua kolom!";
    }
}
?>

<!-- tampilan sign up -->
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .signup {
            min-height: 100vh;
        }
        .bg-image {
            background-image: url('https://img.freepik.com/free-vector/access-control-system-illustration_335657-4640.jpg?t=st=1740157078~exp=1740160678~hmac=fc7302087a09d7795cd2e8da656aa87f68c0e5182c95f1ea3dd6b72eb660af67&w=740');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
<div class="container ps-md-0 mt-5 mb-5">
    <div class="row g-0">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image rounded"></div>
        <div class="col-md-8 col-lg-6">
            <div class="signup d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <h3 class="mb-4 fw-semibold font-monospace" style="color:#605678;">Daftar Akun</h3>

                            <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>

                            <form method="POST">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username </label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email </label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password </label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-dark" type="submit" style="background-color: #605678;">Daftar Sekarang</button>
                                </div>
                                <p class="mt-3">Sudah punya akun? <a href="login.php" class="text-dark">Login disini</a></p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
