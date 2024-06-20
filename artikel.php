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
    <title>Bolabarr</title>
    <style>
        article {
            margin-bottom: 40px;
            border: 1px solid #ccc;
            padding: 50px;
            border-radius: 5px;
            background-color: #000;
        }

        article h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        article img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        article p {
            line-height: 1.6;
            word-wrap: break-word;
            /* Menambahkan properti untuk memecah kata */
        }

        article small {
            color: #888;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="css/layout.css" type="text/css" />
    <?php
    if (isset($_GET['slug'])) {
        $slug = $_GET['slug'];

        require 'koneksi_db.php';

        // Mengambil artikel berdasarkan slug
        $sql = "SELECT * FROM artikel WHERE slug = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Artikel tidak ditemukan.";
            exit();
        }

        $stmt->close();
        $sql_other_news = "SELECT * FROM artikel WHERE slug != ? LIMIT 3"; // Mengambil 3 artikel selain yang sedang ditampilkan
        $stmt_other_news = $conn->prepare($sql_other_news);
        $stmt_other_news->bind_param("s", $slug);
        $stmt_other_news->execute();
        $result_other_news = $stmt_other_news->get_result();

        $other_news = array();
        if ($result_other_news->num_rows > 0) {
            while ($row_other_news = $result_other_news->fetch_assoc()) {
                $other_news[] = $row_other_news;
            }
        }
    }

    $stmt_other_news->close();
    $conn->close();
    ?>




    ?>
</head>

<body id="top">
    <div class="wrapper col1">
        <div id="header">
            <div class="fl_left">
                <h1><a href="index.php">Bolabarr</a></h1>
                <p>BERITA BOLA TERUPDATE</p>
            </div>
            <div class="fl_right"><a href="#"><img src="../images/demo/468x60.gif" alt="" /></a></div>
            <br class="clear" />
        </div>
    </div>
    <!-- ####################################################################################################### -->
    <div class="wrapper col2">
        <div id="topbar">
            <div id="topnav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="">Berita</a></li>
                    <li><a href="">Liga Indonesia</a></li>
                    <li><a href="inggris.php">Liga Inggris</a></li>
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
    <div class="wrapper col3">
        <div id="breadcrumb">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>&raquo;</li>
                <li><?php echo htmlspecialchars($row['judul']); ?></li>
            </ul>
        </div>
    </div>
    <!-- ####################################################################################################### -->
    
    <div class="wrapper col3">
        <div id="container">
            <div id="content">
                <main>
                    <div class="container">
                        <article>
                            <h2><?php echo htmlspecialchars($row['judul']); ?></h2>
                            <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['judul']); ?>">
                            <p><?php echo nl2br(htmlspecialchars($row['isi'])); ?></p>
                            <p><small>Ditulis pada: <?php echo htmlspecialchars($row['tanggal_dibuat']); ?></small></p>
                        </article>
                    </div>
                </main>
            </div>
            <div id="column">
                <style>
                    .holder {
                        overflow: hidden;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                    }

                    .holder .title,
                    .holder p {
                        overflow: hidden;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                    }
                </style>
                <div class="holder">
                    <?php
                    $count = 0; // Initialize a counter
                    foreach ($other_news as $news) {
                        if ($count >= 2) break; // Exit the loop after two iterations
                    ?>
                        <div class="holder">
                            <h2 class="title"><img src="<?php echo htmlspecialchars($news['gambar']); ?>" alt="" width="60" height="60" /><?php echo htmlspecialchars($news['judul']); ?></h2>
                            <p><?php echo nl2br(htmlspecialchars($news['deskripsi'])); ?></p>
                            <p class="readmore"><a href="artikel.php?slug=<?php echo $news['slug']; ?>">Continue Reading &raquo;</a></p>
                        </div>
                    <?php
                        $count++; // Increment the counter
                    }
                    ?>
                </div>

                <!-- ####################################################################################################### -->
                <div class="wrapper col6">

                    <!-- ####################################################################################################### -->
                    <div class="wrapper col7">
                        <div id="copyright">
                            <p class="fl_left">Copyright Bolabarr; 2024 - All Rights Reserved - <a href="#">Bolabarr</a></p>
                            <br class="clear" />
                        </div>
                    </div>
</body>

</html>