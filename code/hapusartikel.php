<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    require '../koneksi_db.php';

    // Tangkap nilai article_id
    $article_id = $_POST["article_id"];

    // Hapus artikel berdasarkan ID
    $sql = "DELETE FROM artikel WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $article_id);

    if ($stmt->execute()) {
      
        header("Location: ../admin/artikel.php");
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
}
