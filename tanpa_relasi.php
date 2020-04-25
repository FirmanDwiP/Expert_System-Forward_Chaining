<?php
include('header.php');

    function generate_rule(){
        $rule = [];
        $query = mysql_query("SELECT * FROM tabel_pengunjung ORDER BY kode_pengunjung DESC LIMIT 1");
        $tabel_pengunjung = mysql_fetch_array($query);

        $tmp_gejala_pengunjung = mysql_query("SELECT * FROM tmp_gejala WHERE kode_pengunjung = '".$tabel_pengunjung["kode_pengunjung"]."'");

        while($join_rule = mysql_fetch_array($tmp_gejala_pengunjung)){
            $rule[] = $join_rule["kode_gejala"];
        } 
        return $rule;
    }

    function kesimpulan(){
        $final = implode("|",generate_rule());
        $query_rule = mysql_query("SELECT * FROM rule WHERE kode_gejala = '".$final."' LIMIT 1");
        $kesimpulan = mysql_fetch_array($query_rule);

        $kode_penyakit_final = $kesimpulan["kode_penyakit"];
        $penyakit_final = mysql_query("SELECT * FROM tabel_penyakit WHERE kode_penyakit = '".$kode_penyakit_final."' LIMIT 1");

        $kesimpulan = mysql_fetch_array($penyakit_final);

        return $kesimpulan["definisi"];
    }



echo kesimpulan(); ?>