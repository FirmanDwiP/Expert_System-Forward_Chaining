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

<script type="text/javascript">

function popup(url) 
{
 var width  = 580;
 var height = 300;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=yes';
 params += ', scrollbars=yes';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'funnyfacebox', params);
 if (window.focus) {newwin.focus()}
 return false;
}
</script>
<?php

	include('config/koneksi.php');


	function generate_pengunjung(){ // fungsi baca pengunjung untuk menampilkan kesimpulan
		$query = mysql_query("SELECT * FROM tabel_pengunjung ORDER BY kode_pengunjung DESC LIMIT 1");
        return $tabel_pengunjung = mysql_fetch_array($query);
	}
  
    function generate_tmp_gejala(){ // fungsi baca tmp gejala untuk mencari kesimpulan
        $rule = []; //UNTU return null kalo misalnya sql nya null
        $tabel_pengunjung = generate_pengunjung();

        $tmp_gejala_pengunjung = mysql_query("SELECT * FROM tmp_gejala WHERE kode_pengunjung = '".$tabel_pengunjung["kode_pengunjung"]."' ORDER BY kode_gejala ASC");

        while($join_rule = mysql_fetch_array($tmp_gejala_pengunjung)){
            $rule[] = $join_rule["kode_gejala"]; //CUNA DI AMBIL KODENYA
        } 
        return $rule;
    }


    function kesimpulan(){
        $final = implode(",",generate_tmp_gejala());

        $penyakit_final = mysql_query("SELECT a.kode_penyakit, GROUP_CONCAT(c.kode_gejala) as Gejala
		FROM tabel_penyakit a
    	inner JOIN rule b
        	on a.kode_penyakit = b.kode_penyakit
            inner JOIN tabel_gejala c
            on b.kode_gejala = c.kode_gejala
            GROUP by a.kode_penyakit
            HAVING Gejala = '$final' 
            -- PENCOCOKAN TMP
            ORDER BY Gejala ASC
            ");
        // $penyakit_final = select * from rule where gejala = $final

        $kesimpulan = mysql_fetch_array($penyakit_final);

        return $kesimpulan["kode_penyakit"]; // MENGEMBALIKAN KODE PENYAKIT DARI KECOCOKAN TMP
    }

    date_default_timezone_set("Asia/Jakarta");
    $datetime = date("Y-m-d H:i:s");

    $ada_kesimpulan = null;
	
	// if(isset($_GET["show"])){
	//     if($_GET["show"] == "0"){ // tidak ada kesimpulan
 //        // ambil user session
 //        session_start(); 
 //        $session_uid = $_SESSION["visitorid"];

 //        // delete table pengunjung dari session, kalo gak ada kesimpulan
 //        mysql_query("DELETE FROM tabel_pengunjung WHERE kode_pengunjung = '$session_uid'");

	//     	$ada_kesimpulan = false;
	//     }elseif ($_GET["show"] == "1"){ // ada kesimpulan

	//     	$ada_kesimpulan = true; //ketika ada kesimpulan langsung insert ke dalam database
	// 		mysql_query("INSERT into rekammedis SET kode_pengunjung = '".generate_pengunjung()["kode_pengunjung"]."', kode_penyakit = '". kesimpulan() ."', tgl_rekammedis = '". $datetime ."'");
	//     }
 //    }

$kode_pengunjung = generate_pengunjung()["kode_pengunjung"];
$kode_penyakit = kesimpulan(); //kode penyakit yang sesuai kesimpulan

 if($kode_penyakit == null){ // tidak ada kesimpulan
        // ambil user session
        session_start(); 
        $session_uid = $_SESSION["visitorid"];

        // delete table pengunjung dari session, kalo gak ada kesimpulan
        mysql_query("DELETE FROM tabel_pengunjung WHERE kode_pengunjung = '$session_uid'");

        $ada_kesimpulan = false;
      }else{ // ada kesimpulan

        $ada_kesimpulan = true; //ketika ada kesimpulan langsung insert ke dalam database
      mysql_query("INSERT into rekammedis SET kode_pengunjung = '".$kode_pengunjung."', kode_penyakit = '".$kode_penyakit."', tgl_rekammedis = '". $datetime ."'");
      }

$qry = mysql_query("SELECT a.nama_pengunjung, a.ttl_pengunjung, a.nohp_pengunjung, a.alamat_pengunjung,
					c.nama_penyakit, c.definisi, c.pengobatan, c.pencegahan,
					b.tgl_rekammedis
					FROM tabel_pengunjung a 
					JOIN rekammedis b
						ON a.kode_pengunjung = b.kode_pengunjung
					JOIN tabel_penyakit c
						ON b.kode_penyakit = c.kode_penyakit
					WHERE c.kode_penyakit = '$kode_penyakit' AND a.kode_pengunjung = '$kode_pengunjung'
					ORDER BY b.kode_rekammedis DESC LIMIT 1
					"); 

$data = mysql_fetch_array($qry);
?>

<div class="container">
<table width="100%" style="background:#729d39">
  <?php 
  if($ada_kesimpulan){ ?>
  <tr>
    <td colspan="3"><center><h2>Biodata User (Pasien)</h2></center></td>
    </tr>
  <tr>
    <td width="21%"><strong>Nama </strong></td>
    <td width="2%">:</td>
    <td width="77%"><?php 	echo $data['nama_pengunjung'];?></td>
  </tr>
   <tr>
    <td><strong>Tanggal Lahir</strong></td>
    <td>:</td>
    <td><?php echo $data['ttl_pengunjung'];?></td>
  </tr>
  <tr>
    <td><strong>NO HP</strong></td>
    <td>:</td>
    <td><?=$data['nohp_pengunjung'];?></td>
  </tr>
  <tr>
    <td><strong>Alamat</strong></td>
    <td>:</td>
    <td><?php echo $data['alamat_pengunjung'];?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><hr color="#fbfad3"></td>
  </tr>

<?php } ?>
  <tr>
    <td colspan="3"><h2>Hasil Diagnosa</h2></td>
    </tr>
  
  <tr>
    <td><div align="right"><strong>Penyakit </strong></div></td>
    <td>:</td>
    <td><?= ($ada_kesimpulan) ? $data['nama_penyakit'] : "Anda tidak terkena penyakit Psoriasis , sistem mendeteksi tidak ada gejala yang cocok dengan penyakit psoriasis<br><strong>Silahkan pilih menu diagnosa</strong> atau langsung konsultasi dengan dokter";?></td>
  </tr>

  <?php if($ada_kesimpulan){ ?>
  <tr>
    <td valign="top"><div align="right"><strong>Gejala Umum</strong></div></td>
    <td valign="top">:</td>
    <td>
    	<?php
    	// rekammedis -> rule -> gejala (relasi join) untuk menampilkasn gejala umum pada kesimpulan

		$sql_gejala = "SELECT * 
					FROM rule a
					JOIN tabel_gejala b
						ON a.kode_gejala = b.kode_gejala 
					WHERE a.kode_penyakit = '$kode_penyakit'
		";

		$qry_gejala = mysql_query($sql_gejala);
			$i=0;
			while($hsl_gejala=mysql_fetch_array($qry_gejala)){
				$i++;
				echo "$i. $hsl_gejala[nama_gejala] <br>";
			}
		 
			?>    </td>

  </tr>
  <tr>
    <td valign="top"><div align="right"><strong>Definisi</strong></div></td>
    <td valign="top">:</td>
    <td valign="top"><?php echo $data['definisi'];?></td>
  </tr>
  <tr>
    <td valign="top"><div align="right"><strong>Pengobatan</strong></div></td>
    <td valign="top">:</td>
    <td valign="top"><?php echo $data['pengobatan'];?></td>
  </tr>
  <tr>
    <td valign="top"><div align="right"><strong>Pencegahan</strong></div></td>
    <td valign="top">:</td>
    <td valign="top" style="white-space: pre-line"><?php echo $data['pencegahan'];?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>Waktu Diagnosa</strong></div></td>
    <td>:</td>
    <td><?=$data['tgl_rekammedis']?></td>
  </tr>
  <tr>
    <td colspan="3"><hr color="#fbfad3"></td>
  </tr>
  <tr>
    <td colspan="3" align="center">
<input type="submit" onclick="popup('cetak.php?act=detail&u=<?php echo $kode_pengunjung;?>&kesimpulan=<?php echo $kode_penyakit;?>')" name="submit" value="Cetak" class= "btn btn-dark"/>

<input type="submit" class= "btn btn-dark" value="Konsultasi Baru" onclick="window.location='prepare.php';" />
</td>

    </tr>

<?php } ?>
</table>
</div>