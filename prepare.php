<?php
	
	include "./config/koneksi.php";
    mysql_query("DELETE FROM tmp_gejala");
    session_destroy();

    header('Location: diagnosa.php');

?>
