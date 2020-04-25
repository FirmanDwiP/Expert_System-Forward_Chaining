<?php

mysql_connect("localhost","root","");
mysql_select_db("sipasis");

function kd_auto($table, $inisial){
	$struktur = mysql_query("SELECT * FROM ".$table."");
	$field = mysql_field_name($struktur, 0);
	$panjang = mysql_field_len($struktur, 0);

	
	$sql = mysql_query("SELECT max(".$field.") FROM ".$table."");
	$row = mysql_fetch_array($sql);

	if($row[0] == ""){
		$angka = 0;
	} else {
		$angka = substr($row[0], strlen($inisial));
	}

	$angka++;
	$angka = strval($angka);
	$tmp = "";
	for($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++){
		$tmp = $tmp."0";
	}

	return $inisial.$tmp.$angka;
}



// $sql_pengunjung = mysql_query("select * from tbl_pengunjung where nama_lengkap = '".$_SESSION["authid"]."'");
// $r_pengunjung   = mysql_fetch_array($sql_pengunjung);
// $id_pengunjung  = $r_pengunjung['id_pengunjung'];

?>