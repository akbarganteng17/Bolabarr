<?php
    // Koneksi ke database
    require 'koneksi_db.php';
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Template Name: Newserific
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolabarr</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="css/layout.css" type="text/css" />
</head>
<style>
    #hpage_latest {
        display: block;
        width: 100%;
    }

    #hpage_latest ul {
        margin: 0;
        padding: 0;
        list-style: none;
        display: flex;
    }

    #hpage_latest li {
        display: block;
        width: 200px;
        margin: 0 15px 0 0;
        padding: 0;
    }

    #hpage_latest li.last {
        margin-right: 0;
    }

    #hpage_latest img {
        margin: 0;
        padding: 4px;
        border: 1px solid #BFE009;
        width: 190px;
        height: 80px;
        object-fit: cover;
    }

    #hpage_latest .readmore {
        text-align: right;
    }

    #latestnews {
        display: block;
        width: 100%;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    #latestnews li {
        display: block;
        width: 100%;
        min-height: 99px;
        margin: 0 0 25px 0;
        padding: 0 0 15px 0;
        border-bottom: 1px dotted #C7C5C8;
        overflow: hidden;
    }

    #latestnews li img {
        width: 80px;
        height: 80px;
        float: left;
        margin: 0 10px 0 0;
        padding: 4px;
        border: 1px solid #BFE009;
        clear: left;
    }

    #latestnews li p {
        display: inline;
    }

    #latestnews li p strong a {
        text-decoration: none;
        color: #C7C5C8;
        display: block;
        margin-bottom: 5px;
    }

    #latestnews li.last {
        margin-bottom: 0;
    }
</style>


<body id="top">
    <div class="wrapper col1">
        <div id="header">
            <div class="fl_left">
                <h1><a href="index.php">Bolabar</a></h1>
                <p>BERITA BOLA TERUPDATE</p>
            </div>
            <div class="fl_right"><a href="#"><img src="images/demo/468x60.gif" alt="" /></a></div>
            <br class="clear" />
        </div>
        

    </div>
    <!-- ####################################################################################################### -->
    <div class="wrapper col2">
        <div id="topbar">
            <div id="topnav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="indonesia.php">Liga Indonesia</a></li>
                    <li class="active"><a href="inggris.php">Liga Inggris</a></li>
                    <li><a href="spanyol.php">Liga Spanyol</a></li>
                    <li><a href="jerman.php">Liga Jerman</a></li>
                    <li><a href="prancis.php">Liga Perancis</a></li>
                    <li><a href="login.php">login</a></li>
                </ul>
            </div>
            
            <br class="clear" />
        </div>
    </div>
    <!-- ####################################################################################################### -->
    <div class="wrapper col4">
        <div id="container">
            <div id="content">
                <div id="featured_post">
                    <?php
                    // Mengambil berita utama dari kategori liga_inggris
                    $sql = "SELECT * FROM artikel WHERE kategori='liga_inggris' ORDER BY tanggal_dibuat DESC LIMIT 1";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Menampilkan berita utama
                        while ($row = $result->fetch_assoc()) {
                            // Mengambil paragraf pertama dari isi artikel
                            $isi_artikel = $row["isi"];
                            $paragraf_pertama = strtok($isi_artikel, "\n");

                            echo '<div class="card">';
                            echo '<div class="card-body">';
                            echo '<a href="artikel.php?slug=' . $row["slug"] . '">';
                            echo '<img src="' . $row["gambar"] . '" class="card-img-top">';
                            echo '<p class="card-title">' . htmlspecialchars($row["judul"], ENT_QUOTES, 'UTF-8') . '</p>';
                            echo '</div></a>';
                            echo '<p class="card-text text-white">' . htmlspecialchars($paragraf_pertama, ENT_QUOTES, 'UTF-8') . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo "Tidak ada berita utama.";
                    }
                    ?>
                </div>

                <div id="hpage_latest">
                    <ul>
                        <?php
                        // Mengambil beberapa berita terbaru dari kategori liga_inggris
                        $sql_latest = "SELECT * FROM artikel WHERE kategori='liga_inggris' ORDER BY tanggal_dibuat DESC LIMIT 3 OFFSET 1";
                        $result_latest = $conn->query($sql_latest);

                        if ($result_latest->num_rows > 0) {
                            // Menampilkan berita terbaru
                            while ($row_latest = $result_latest->fetch_assoc()) {
                                echo '<li>';
                                // Menambahkan slug ke dalam URL gambar
                                echo '<a href="artikel.php?slug=' . $row_latest["slug"] . '"><img src="' . $row_latest["gambar"] . '" alt="' . $row_latest["judul"] . '" /></a>';
                                // Menambahkan slug ke dalam judul
                                echo '<p><a href="artikel.php?slug=' . $row_latest["slug"] . '">' . $row_latest["judul"] . '</a></p>';
                                echo '<p>' . substr($row_latest["deskripsi"], 0, 100) . '...</p>';
                                echo '<p class="readmore"><a href="artikel.php?slug=' . $row_latest["slug"] . '">Continue Reading &raquo;</a></p>';
                                echo '</li>';
                            }
                        } else {
                            echo "<li>Tidak ada berita terbaru.</li>";
                        }
                        ?>
                    </ul>
                    <br class="clear" />
                </div>

            </div>
            <div id="column">
                <ul id="latestnews">
                    <?php
                    // Mengambil beberapa berita lainnya dari kategori liga_inggris
                    $sql_news = "SELECT * FROM artikel WHERE kategori='liga_inggris' ORDER BY tanggal_dibuat DESC LIMIT 3 OFFSET 4";
                    $result_news = $conn->query($sql_news);

                    if ($result_news->num_rows > 0) {
                        // Menampilkan berita lainnya
                        $count = 0;
                        while ($row_news = $result_news->fetch_assoc()) {
                            $count++;
                            $last_class = ($count == $result_news->num_rows) ? ' class="last"' : '';
                            echo '<li' . $last_class . '>';
                            echo '<img src="' . $row_news["gambar"] . '" alt="" />';
                            echo '<p><strong><a href="artikel.php?slug=' . $row_news["slug"] . '">' . $row_news["judul"] . '</a></strong></p>';
                            echo '<p>' . substr($row_news["deskripsi"], 0, 100) . '...</p>';
                            echo '</li>';
                        }
                    } else {
                        echo "<li>Tidak ada berita lainnya.</li>";
                    }
                    ?>
                </ul>
            </div>
            <br class="clear" />

        </div>
        <!-- ####################################################################################################### -->
        <div class="wrapper col5">
            <div class="gallery">
                <h2>Latest Gallery Pics</h2>
                <ul>
                    <?php
                    // Mengambil semua gambar dari tabel
                    $sql = "SELECT gambar FROM artikel";
                    $result = $conn->query($sql);

                    // Menampilkan gambar-gambar dalam galeri
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<li><a href="#"><img src="' . $row["gambar"] . '" width="174" height="174" alt="" /></a></li>';
                        }
                    } else {
                        echo "<li>Tidak ada gambar dalam database.</li>";
                    }

                    // Menutup koneksi
                    $conn->close();
                    ?>

                </ul>
                <br class="clear" />
                </ul>
            </div>


</body>

</html>