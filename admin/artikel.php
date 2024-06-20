<?php
session_start();

// Periksa apakah pengguna sudah login, jika tidak, arahkan kembali ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit();
}
require '../koneksi_db.php';
// Lakukan query untuk mengambil data username dari tabel users
$sql = "SELECT username FROM users";
$result = $conn->query($sql);

// Periksa apakah query berhasil dan terdapat hasil
$username = "Guest"; // Default username
if ($result->num_rows > 0) {
    // Ambil data username dari hasil query
    $row = $result->fetch_assoc();
    $username = $row['username'];
}
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
    <title>Bolabar</title>
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
                                <a class="dropdown-item" href="../code/proses_logout.php"><i class="fas fa-cog mr-2"></i>logout</a>
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
                                <a class="nav-link active" href="artikel.php"><i class="fa fa-fw fa-book"></i>Artikel</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="kategori.php"><i class="fa fa-fw fa-tags"></i>Kategori</a>
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
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Artikel</h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus
                                    vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Artikel</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->


                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
                    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
                    <style>
                        /* Style untuk modal */
                        .modal {
                            display: none;
                            position: fixed;
                            z-index: 1;
                            left: 0;
                            top: 0;
                            width: 100%;
                            height: 100%;
                            overflow: auto;
                            background-color: rgba(0, 0, 0, 0.4);
                        }

                        .modal-content {
                            background-color: #fefefe;
                            margin: 15% auto;
                            padding: 20px;
                            border: 1px solid #888;
                            width: 80%;
                        }

                        .close {
                            color: #aaa;
                            float: right;
                            font-size: 28px;
                            font-weight: bold;
                        }

                        .close:hover,
                        .close:focus {
                            color: black;
                            text-decoration: none;
                            cursor: pointer;
                        }
                    </style>
                    </head>

                    <body>
                        <!-- Button untuk membuka modal -->
                        <button class="btn btn-danger" onclick="openModal()">Tambah Artikel</button>


                        <!-- Modal -->
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal()">&times;</span>
                                <h1 class="text-center">Form Tambah Artikel</h1>
                                <form action="../code/uploadartikel.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="judul">Judul Artikel:</label>
                                        <input type="text" class="form-control" id="judul" name="judul" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Kategori Artikel:</label>
                                        <select class="form-control" id="kategori" name="kategori" required>
                                            <option value="liga_indonesia">Liga Indonesia</option>
                                            <option value="liga_spanyol">Liga Spanyol</option>
                                            <option value="liga_inggris">Liga Inggris</option>
                                            <option value="liga_jerman">Liga Jerman</option>
                                            <option value="liga_perancis">Liga Perancis</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi Artikel:</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="isi">Isi Artikel:</label>
                                        <textarea class="form-control" id="isi" name="isi" rows="10" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="gambar">Gambar Artikel:</label>
                                        <input type="file" class="form-control-file" id="gambar" name="gambar" accept="image/*" required>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary">Tambah Artikel</button>
                                </form>
                            </div>
                        </div>




                        <!-- Include Bootstrap JS -->
                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                        <script>
                            // Fungsi untuk membuka modal
                            function openModal() {
                                document.getElementById("myModal").style.display = "block";
                            }

                            // Fungsi untuk menutup modal
                            function closeModal() {
                                document.getElementById("myModal").style.display = "none";
                            }
                        </script>


                        <div class="row">

                            <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Baris Artikel</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">#</th>
                                                        <th class="border-0">tanggal dibuat</th>
                                                        <th class="border-0">judul</th>
                                                        <th class="border-0">kategori</th>
                                                        <th class="border-0">deskripsi</th>
                                                        <th class="border-0">isi</th>
                                                        <th class="border-0">user_id</th>
                                                        <th class="border-0">gambar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    // Query untuk mengambil data dari tabel
                                                    $query = "SELECT id, tanggal_dibuat, judul, kategori, deskripsi, isi, user_id, gambar FROM artikel";
                                                    $result = $conn->query($query);

                                                    // Tampilkan data dalam tabel
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            // Truncate deskripsi and isi for display
                                                            $deskripsi_truncated = strlen($row['deskripsi']) > 50 ? substr($row['deskripsi'], 0, 50) . '...' : $row['deskripsi'];
                                                            $isi_truncated = strlen($row['isi']) > 50 ? substr($row['isi'], 0, 50) . '...' : $row['isi'];

                                                            // Escape the text data
                                                            $judul = htmlspecialchars($row['judul'], ENT_QUOTES, 'UTF-8');
                                                            $kategori = htmlspecialchars($row['kategori'], ENT_QUOTES, 'UTF-8');
                                                            $deskripsi = htmlspecialchars($row['deskripsi'], ENT_QUOTES, 'UTF-8');
                                                            $isi = htmlspecialchars($row['isi'], ENT_QUOTES, 'UTF-8');
                                                            $gambar = htmlspecialchars($row['gambar'], ENT_QUOTES, 'UTF-8');

                                                            echo "<tr>";
                                                            echo "<td>{$row['id']}</td>";
                                                            echo "<td>{$row['tanggal_dibuat']}</td>";
                                                            echo "<td>{$judul}</td>";
                                                            echo "<td>{$kategori}</td>";
                                                            echo "<td>{$deskripsi_truncated}</td>";
                                                            echo "<td>{$isi_truncated}</td>";
                                                            echo "<td>{$row['user_id']}</td>";
                                                            echo " <td>{$row['gambar']}</td>";
                                                            echo "<td>";
                                                            echo "<form action='../code/hapusartikel.php' method='post' style='display:inline;'>";
                                                            echo "<input type='hidden' name='article_id' value='{$row['id']}'>";
                                                            echo "<button type='submit' name='delete' class='btn btn-danger'>Hapus</button>";
                                                            echo "</form>";
                                                            echo "<button class='btn btn-primary' onclick='openEditModal({$row['id']}, \"{$judul}\", \"{$kategori}\", `{$deskripsi}`, `{$isi}`, \"{$gambar}\")'>Edit</button>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='9'>Tidak ada data.</td></tr>";
                                                    }
                                                    ?>

                                                    <div id="editModal" class="modal">
                                                        <div class="modal-content">
                                                            <span class="close" onclick="closeEditModal()">&times;</span>
                                                            <h1 class="text-center">Form Edit Artikel</h1>
                                                            <form action="../code/editartikel.php" method="post">
                                                                <div class="form-group">
                                                                    <label for="edit_judul">Judul Artikel:</label>
                                                                    <input type="text" class="form-control" id="edit_judul" name="judul" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit_kategori">Kategori Artikel:</label>
                                                                    <select class="form-control" id="edit_kategori" name="kategori" required>
                                                                        <option value="liga_indonesia">Liga Indonesia</option>
                                                                        <option value="liga_spanyol">Liga Spanyol</option>
                                                                        <option value="liga_inggris">Liga Inggris</option>
                                                                        <option value="liga_saudi">Liga Saudi</option>
                                                                        <option value="liga_perancis">Liga Perancis</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit_deskripsi">Deskripsi Artikel:</label>
                                                                    <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="4" required></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit_isi">Isi Artikel:</label>
                                                                    <textarea class="form-control" id="edit_isi" name="isi" rows="10" required></textarea>
                                                                </div>


                                                                <!-- Input hidden untuk menyimpan ID artikel yang akan diedit -->
                                                                <input type="hidden" id="edit_article_id" name="article_id">

                                                                <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        function openEditModal(id, judul, kategori, deskripsi, isi, gambar) {
                                                            document.getElementById("edit_judul").value = judul;
                                                            document.getElementById("edit_kategori").value = kategori;
                                                            document.getElementById("edit_deskripsi").value = deskripsi;
                                                            document.getElementById("edit_isi").value = isi;
                                                            document.getElementById("edit_article_id").value = id;
                                                            document.getElementById("editModal").style.display = "block";
                                                        }

                                                        function closeEditModal() {
                                                            document.getElementById("editModal").style.display = "none";
                                                        }

                                                        // Close modal when clicking outside of it
                                                        window.onclick = function(event) {
                                                            var modal = document.getElementById("editModal");
                                                            if (event.target == modal) {
                                                                modal.style.display = "none";
                                                            }
                                                        }
                                                    </script>

                                                    
                                                    <!-- Include Bootstrap JS -->
                                                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                                                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
                                                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                                                    <script>
                                                        // Fungsi untuk membuka modal
                                                        function openModal() {
                                                            document.getElementById("myModal").style.display = "block";
                                                        }

                                                        // Fungsi untuk menutup modal
                                                        function closeModal() {
                                                            document.getElementById("myModal").style.display = "none";
                                                        }
                                                    </script>

                                        </div>



                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <?php
                // Tutup koneksi
                $conn->close();
                ?>
                </tbody>
                </table>
            </div>
            </tbody>
            </table>
        </div>

        </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
    <!-- ============================================================== -->
    <!-- end recent orders  -->


    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customer acquistion  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    Akbar Bimantara T 220605110080 Teknik Informatika</a>.
                </div>
            </div>
        </div>
    </div>

    <style>
        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
        }

        .footer p {
            margin: 0;
        }
    </style>

    </div>
    <!-- ============================================================== -->
    <!-- end footer -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
</body>

</html>