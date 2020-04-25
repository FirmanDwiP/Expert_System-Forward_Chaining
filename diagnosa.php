<?php
include "config/koneksi.php";

// kalo dibuka halaman utama diagnosa tanpa child ($_GET), delete tmp_gejala
if(count($_GET) == 0) mysql_query("DELETE FROM tmp_gejala");
?>


<!DOCTYPE>
<html>
    <head>
        <title>SIPASIS</title> <!-- Judul-->
        <meta charset="utf-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
        <link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap -->
        <link href="css/diagnosastyle.css" rel="stylesheet"> <!-- CSS -->
    </head>
        <body>
        <div id="page">
            <img src="img/ikon2.png" width="150x" height="55px">
            <a href="index.php">Beranda</a>
            <a href="diagnosa.php" class="active">Diagnosa</a>
            <a href="ttgkami.php">Tentang Kami</a>
            <a href="loginadmin.php" style="float:right">Login Admin</a>
        </div>
        <?php 
            
            function input_ke_tmp_gejala($gejala){ //fungsi untuk ngimput ke temporari

                $query = mysql_query("SELECT * FROM tabel_pengunjung ORDER BY kode_pengunjung DESC LIMIT 1"); //memilih user yang baru (descending yang terakhir) where kode peng = session []
                $tabel_pengunjung = mysql_fetch_array($query); //mysql_fetch_array() - menampilkan nama array

                mysql_query("INSERT into tmp_gejala set kode_pengunjung = '". $tabel_pengunjung["kode_pengunjung"] ."', kode_gejala = '".$gejala."'");
            }


        ?> 
        <div id="coba">
            <?php 
            // diganonsa mulai
            if(isset($_GET["page"]) && isset($_GET["diagnose"])){  // UNTUK MENGECEK S GET PINDAH HALAMAN
                $kode_gejala_tmp = "G0001"; //gejala dimulai dari G0001
                if(isset($_GET["pilih"])){// SETELAH KE HEADER
                    $kode_gejala_tmp = $_GET["pilih"];
                }

                $gejala = mysql_query("SELECT * FROM tabel_gejala WHERE kode_gejala = '".$kode_gejala_tmp."'");
                $gejala_temporary = mysql_fetch_array($gejala); // UNTUK MENAMPILKAN NAMA GEJALA

                ?>
                
                <form method="post" action="">
                    <table style="background: white">
                        <tr><center><h2>Jawablah pertanyaan di bawah ini :</h2></tr></center>
                        <tr>
                            <td colspan="2"><p>Apakah anda mengalami gejala <?=$gejala_temporary["nama_gejala"]?> ?</p> <!-- nama gejala --></td>
                        </tr>
                        <tr>
                            <td><center><input type="submit" name="ke_induk_gejala_ya" value="Ya" class="btn btn-success"></td></center>
                            <td><center><input type="submit" name="ke_induk_gejala_tidak" value="Tidak" class="btn btn-danger"" ></td></center>
                        </tr>
                    </table>
                </form>

                <?php
                if(isset($_POST["ke_induk_gejala_ya"])){ //jika klik ya
                    $cek_induk_gejala_ya = mysql_query("SELECT * FROM tabel_gejala WHERE kode_induk_ya = '".$kode_gejala_tmp."'");
                    $induk_gejala_ya = mysql_fetch_array($cek_induk_gejala_ya);

                    $pilihan_ya = $induk_gejala_ya["kode_gejala"]; // cek pilihannya di tabel gejala pada kode_iduk_ya
                    input_ke_tmp_gejala($kode_gejala_tmp);

                    // header = redirect
                    header('Location:diagnosa.php?page=visitor&diagnose&pilih='.$pilihan_ya.'&induk='.$kode_gejala_tmp); //jika ada gejala yang muncul setelah gejala induk tadi

                    if(!$pilihan_ya){ //jika tidak ada (setiap jawaban ya pasti ada penyakit)
                        header('Location:kesimpulan.php');
                    }
                }elseif(isset($_POST["ke_induk_gejala_tidak"])){ //jika klik tidak
                    $cek_induk_gejala_tidak = mysql_query("SELECT * FROM tabel_gejala WHERE kode_induk_tidak = '".$kode_gejala_tmp."'");
                    $induk_gejala_tidak = mysql_fetch_array($cek_induk_gejala_tidak);   

                    $yang_tidak = $induk_gejala_tidak["kode_gejala"]; // cek pilihannya di tabel gejala pada kode_iduk_ya

                    header('Location:diagnosa.php?page=visitor&diagnose&pilih='.$yang_tidak.'&induk='.$kode_gejala_tmp);
                    
                    if(!$yang_tidak){ 
                        header('Location:kesimpulan.php');
                    }
                }
            } else{
            ?>
                <form method="post" action="" id="geeky" autocomplete="off">
                <table style="background: #36622b; color: white">
                    <tr>
                        <td>Nama Lengkap</td>
                        <td><input type="text" class="masuk form-control" name="nama_lengkap" required="true" /></td>
                    </tr>
                    <tr>
                        <td>Nomer HP</td>
                        <td><input type="number" class="masuk form-control" name="no_hp" required="true" /></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>
                            <input class="datepicker form-control" name="ttl" required="true">
                            <!-- <input type="date" name="ttl"> -->
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><textarea name="alamat" class="textarea form-control" required="true"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2"> <center>
                            <input type="submit" value="Lanjut" name="btn_lanjut1" class="btn btn-info"/>
                            <input type="button" value="Batal" class="btn btn-danger" onclick="self.history.back()"/></center>
                        </td>
                    </tr>
                </table>
                </form>
                <?php
                if(isset($_POST["btn_lanjut1"])){ // waktu user input data
                    $tanggal_lahir = date("Y-m-d", strtotime($_POST["ttl"]));

                    mysql_query("insert into tabel_pengunjung set nama_pengunjung = '".$_POST["nama_lengkap"]."', nohp_pengunjung = '".$_POST["no_hp"]."', ttl_pengunjung = '".$tanggal_lahir."', alamat_pengunjung = '".$_POST["alamat"]."'");
                    
                    $result = mysql_query("SELECT LAST_INSERT_ID()");

                    $row = mysql_fetch_array($result);

                    session_start();
                    $_SESSION["visitorid"] = $row[0]; //sesi pengunjung dari index 0 (yang mana id terakhir yang daftar)

                    echo "<script>location.href='?page=visitor&diagnose'</script>";
                    }
                }

                ?>
        </div>
<?php include('footer.php'); ?>