<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$username = $isLoggedIn ? $_SESSION['username'] : null;

?>

<!-- ini Topbar -->
<div class="topbar bg-topbar text-light py-2">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="phone-container">
            <i class="bi bi-telephone"></i>
            <span>+62 812-3456-7890</span>
        </div>

        <div>
            <ul class="navbar-nav">
                <?php if ($isLoggedIn): ?>
                <li class="nav-item dropdown">
                    <a class="admin-profil nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span><?php echo htmlspecialchars($username); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="buktiReservasi.php">Lihat Bukti Reservasi</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <div class="d-flex justify-content-between align-items-center gap-4">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="bi bi-person-circle"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php"><i class="bi bi-box-arrow-in-right"></i> Sign Up</a>
                    </li>
                </div>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<!-- Akhir Top Bar -->