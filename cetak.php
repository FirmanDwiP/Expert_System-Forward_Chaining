<!DOCTYPE>
<head>
<title>Sistem Pakar Diagnosa Penyakit Psoriasis</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<?php  
include "config/koneksi.php";
?>

</head>

<body onLoad="javascript: window.print()"> 

<?php 
$kode_pengunjung = $_GET["u"];
$kode_penyakit = $_GET["kesimpulan"];

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

<!-- header -->
<center><h1>Hasil Diagnosa Penyakit</h1></center>

<table  cellpadding="5" width="100%">
<tr>
    <td colspan="3"><hr color="#AAAAAA"></td>
  </tr>
  <tr>
    <td colspan="3"><center><h2>Biodata User (Pasien)</h2></center></td>
    </tr>
  <tr>
    <td width="21%"><strong>Nama </strong></td>
    <td width="2%">:</td>
    <td width="77%"><?php   echo $data['nama_pengunjung'];?></td>
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
    <td colspan="3"><hr color="#AAAAAA"></td>
  </tr>
  <tr>
    <td colspan="3"><h2>Hasil Diagnosa</h2></td>
    </tr>
  
  <tr>
    <td valign="top"><div align="right"><strong>Penyakit </strong></div></td>
    <td valign="top">:</td>
    <td valign="top"><?=$data['nama_penyakit']?></td>
  </tr>

  <tr>
    <td valign="top"><div align="right"><strong>Gejala Umum</strong></div></td>
    <td valign="top">:</td>
    <td>
      <?php
      // rekammedis -> rule -> gejala (relasi join)

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
    <td colspan="3"><hr color="#AAAAAA"></td>
  </tr>
</table>



</body>
</html>