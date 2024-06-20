<?php
session_start();

// Periksa apakah pengguna sudah login, jika tidak, arahkan kembali ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit();
}

require '../koneksi_db.php';

// Query untuk mengambil data kategori dan jumlah artikel dalam setiap kategori
$sql = "SELECT kategori, COUNT(*) as jumlah_artikel FROM artikel GROUP BY kategori";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" href="../css/kategori.css">
    <title>Bolabar - Kategori Artikel</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.html">Bolabar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">Selamat datang, <?php echo $username; ?></h5>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="../code/proses_logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="index.php"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="artikel.php"><i class="fa fa-fw fa-book"></i>Artikel</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="kategori.php"><i class="fa fa-fw fa-tags"></i>Kategori</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="penulis.php"><i class="fa fa-fw fa-info-circle"></i>About Penulis</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Kategori Artikel</h2>
                            <p class="pageheader-text">Daftar kategori artikel dan jumlah artikel dalam setiap kategori.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    // Tampilkan data kategori dan jumlah artikel dalam setiap kategori
                    if ($result->num_rows > 0) {
                        $kategori_colors = ['#f8f9fa', '#ffc107', '#17a2b8']; // Warna latar belakang untuk setiap kotak
                        $kategori_index = 0; // Indeks warna kategori saat ini

                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='col-xl-3 col-lg-4 col-md-6'>";
                            echo "<div class='kategori-box' style='background-color: {$kategori_colors[$kategori_index]};'>";
                            echo "<div class='kategori-title'>{$row['kategori']}</div>";
                            echo "<div class='jumlah-artikel'>Jumlah Artikel: {$row['jumlah_artikel']}</div>";
                            echo "</div>";
                            echo "</div>";

                            // Ganti warna kategori untuk kotak berikutnya
                            $kategori_index = ($kategori_index + 1) % count($kategori_colors);
                        }
                    } else {
                        echo "<div class='col-xl-12'>";
                        echo "<div class='alert alert-warning'>Tidak ada data kategori.</div>";
                        echo "</div>";
                    }
                    ?>

                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>