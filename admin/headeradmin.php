<?php
session_start();
if(empty($_SESSION["authid"])){
    echo "<script>location.href='../loginadmin.php'</script>";
}
include "../config/koneksi.php";
?>

<!DOCTYPE>
<html>

    <head>
        <title>SIPASIS</title> <!-- Judul-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap -->
        <link href="../css/adminstyle.css" rel="stylesheet"> <!-- CSS -->
    </head>

    <body style="background: #fbfad3">
        <div id="well">
            <div id="welldalam">
                <img src="../img/ikon2.png" width="150x" height="55px">
                <a href="wellamin.php">Home</a>
                <a href="gejala.php">Data Gejala</a>
                <a href="penyakit.php">Data Penyakit</a>
                <a href="relasi.php">Relasi</a>
                <a href="pengunjung.php">Pengunjung</a>
                <br><br><br><br><br>
                <a href="logout.php" style="background: red" class="btn">Logout</a>
            </div>
        </div>