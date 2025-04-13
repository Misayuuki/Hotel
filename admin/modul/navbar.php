<nav class="navbar navbar-expand-lg bg-body-white">
        <div class="container">

            <a class="navbar-brand" href="dashboard_admin.php"> <img src="../asset/img/aloha4.png" alt="Admin Avatar" class="me-2"
                    height="65" width="65"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav me-3">
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="dashboard_admin.php">Dashboard</a>
                    </li>
                    <li class="nav-item  mx-2">
                        <a class="nav-link" href="?page=kamarhotel">Kamar</a>
                    </li>
                    <li class="nav-item  mx-2">
                        <a class="nav-link" href="?page=fasilitas_kamar">Fasilitas Kamar</a>
                    </li>
                    <li class="nav-item  mx-2">
                        <a class="nav-link" href="?page=fasilitas_umum">Fasilitas Hotel</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="admin-profil nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"  style="color:  #c9a66b;">
                                <i class="bi bi-person-circle me-2"></i>
                            <span><?= htmlspecialchars($_SESSION['username']); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="?page=keluar">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>