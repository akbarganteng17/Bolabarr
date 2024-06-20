<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Koneksi ke database
    $servername = "localhost";
    $username = "root"; // sesuaikan dengan username database Anda
    $password = ""; // sesuaikan dengan password database Anda
    $dbname = "artikel_db";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Mengambil data dari form
    $judul = $_POST["judul"];
    $deskripsi = $_POST["deskripsi"];
    $isi = $_POST["isi"];
    $tanggal_dibuat = date("Y-m-d H:i:s");

    // Membuat slug dari judul
    function createSlug($string)
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
        return $slug;
    }

    $slug = createSlug($judul);

    // Mengunggah gambar
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Memeriksa apakah file adalah gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }








    // Memeriksa apakah $uploadOk bernilai 0 karena kesalahan
    if ($uploadOk == 0) {
        echo "Maaf, file Anda tidak terunggah.";
    } else {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Menyimpan data ke database
            $sql = "INSERT INTO artikel (user_id, judul, deskripsi, isi, tanggal_dibuat, gambar, slug) VALUES (1, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $judul, $deskripsi, $isi, $tanggal_dibuat, $target_file, $slug);

            if ($stmt->execute()) {
                // Artikel berhasil diunggah
                echo "<script>alert('Artikel berhasil diunggah.');</script>";
            } else {
                echo "Terjadi kesalahan: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
        }
    }

    // Menutup koneksi database
    $conn->close();
}
