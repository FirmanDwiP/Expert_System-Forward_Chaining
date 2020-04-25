<?php
include "./config/koneksi.php";
    session_start(); 
    
    if(isset($_SESSION["visitorid"])){
        $session_uid = $_SESSION["visitorid"];

        // delete table pengunjung dari session, kalo gak ada kesimpulan
        mysql_query("DELETE FROM tabel_pengunjung WHERE kode_pengunjung = '$session_uid'");
    }

    // echo phpversion();
?>


<!DOCTYPE>
<html>
    <head>
        <title>SIPASIS</title> <!-- Judul-->
        <meta charset="utf-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet"> 
        <link href="css/style.css" rel="stylesheet"> <!-- CSS -->
    </head>

   