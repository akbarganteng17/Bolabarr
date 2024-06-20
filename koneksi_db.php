<?php
    // Koneksi ke database
    $servername = "localhost";
    $username = "id22293028_akbarbima";
    $password = "akbarganteng1!A";
    $dbname = "id22293028_artikel_db";

    // Membuat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Memeriksa koneksi
    if ($conn->connect_error) {
      die("Koneksi gagal: " . $conn->connect_error);
    }
    ?>