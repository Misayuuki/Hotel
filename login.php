<?php
session_start();
include 'lib/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); 

    if (!empty($username) && !empty($email) && !empty($password)) {
        // ini queri buat cari user berdasarkan username email password
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND email = ? AND password = ?");
        $stmt->execute([$username, $email, $password]);
        $user = $stmt->fetch();

        if ($user) {      
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // ini tuh buat ngarahin halaman berdasarkan peran / rolenya
            if ($user['role'] == 'admin') {
                header("Location: admin/dashboard_admin.php");
            } elseif ($user['role'] == 'resepsionis') {
                header("Location: resepsionis/dashboard_resepsionis.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Username, email, atau password salah!";
        }
    } else {
        $error = "Mohon isi semua kolom!";
    }
}

?>



<!-- tampilan login -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    .login {
        min-height: 100vh;
    }

    .bg-image {
        background-image: url('https://img.freepik.com/free-vector/access-control-system-illustration_335657-4640.jpg?t=st=1740157078~exp=1740160678~hmac=fc7302087a09d7795cd2e8da656aa87f68c0e5182c95f1ea3dd6b72eb660af67&w=740');
        background-size: cover;
        background-position: center;
    }

    .login-heading {
        font-weight: 300;

    }

    .btn-login {
        font-size: 0.9rem;
        letter-spacing: 0.05rem;
        padding: 0.75rem 1rem;
    }
    </style>
</head>
<body>
<div class="container ps-md-0 mt-5 mb-5">
        <div class="row g-0">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image rounded"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                <h3 class="login-heading mb-4 fw-semibold font-monospace" style="color:#605678;">Welcome to Aloha Hotels!</h3>
                              
                                <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>

                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username </label>
                                        <input type="text" class="form-control" id="username" placeholder="Masukan Username disini"
                                            name="username" style="border-color: black;">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email </label>
                                        <input type="email" class="form-control" id="email" placeholder="Masukan Email disini"
                                            name="email" style="border-color: black;">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password </label>
                                        <input type="password" class="form-control" id="password" placeholder="Masukan Password disini"
                                            name="password" style="border-color: black;">
                                    </div>
                                    <div class="d-grid gap-2">
                                    <button name="btn" class="btn btn-dark"  type="submit" style="background-color: #605678;">Masuk Sekarang</button>
                                    </div>
                                    <p class="mt-3">kamu gak punya akun? <a href="signup.php" class="text-dark">Daftar disini ya</a></p>
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