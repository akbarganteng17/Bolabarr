<?php
require '../koneksi_db.php';

// Cek apakah ada data yang dikirim melalui form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui form
    $article_id = $_POST['article_id'];
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $isi = $_POST['isi'];

    // Query SQL untuk update data artikel berdasarkan ID
    $sql = "UPDATE artikel SET judul='$judul', kategori='$kategori', deskripsi='$deskripsi', isi='$isi' WHERE id=$article_id";

    // Jalankan query
    if (mysqli_query($conn, $sql)) {
       
        // Redirect ke halaman artikel.php setelah update berhasil
        header("Location: ../admin/artikel.php");
        exit(); // Pastikan untuk menghentikan eksekusi kode setelah pengalihan
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi database
    mysqli_close($conn);
}
?>
