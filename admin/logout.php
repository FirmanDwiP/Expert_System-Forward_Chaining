<!-- unset($_SESSION["authid"]);
echo "<script>location.href='wellamin.php'</script>";


session_start();
if(empty($_SESSION["authid"])){
    echo "<script>location.href='../loginadmin.php'</script>";
}
include "../config/koneksi.php";
 -->
 <?php
session_start();
unset($_SESSION["authid"]);
echo "<script>location.href='wellamin.php'</script>";
?>