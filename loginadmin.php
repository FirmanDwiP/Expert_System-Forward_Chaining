<?php
session_start();
include "config/koneksi.php";
?>

<html>
	<head>
        <title>SIPASIS</title> <!-- Judul-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap -->
        <link href="css/style.css" rel="stylesheet"> <!-- CSS -->
    </head>
	<body style="background: #71D371;">
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="login">
					<a href="index.php">
					<img src="img/ikon2.png" class="img-fluid"></a>
					<h2>Login Admin</h2>
					<br/>
					<form method="post" name="login" action="">
						<div class="from-input form-group">
							<input type="text" name="username" id="username" placeholder="Username" required="true" />
						</div>
						<div class="from-input form-group">
							<input type="password" name="password" id="password" placeholder="Password" required="true" />
						</div>			
						<div>
							<input type="submit" name="tombol_admin" value="Login" class="btn btn-success">
						</div>
					</form>
					<?php
						if(isset($_POST["tombol_admin"])){
							if(empty($_POST["username"]) || empty($_POST["password"])){
								echo NULL;
							} else {
								$pass = md5($_POST["password"]);
								$sql = mysql_query("SELECT * FROM tabel_admin WHERE 
									username = '$_POST[username]'
									 AND password = '$pass'");
								
								$check = mysql_num_rows($sql);
								$r = mysql_fetch_array($sql);
								if($check < 1){
									NULL;
								} else {
									// session_register("authid");
									$_SESSION["authid"] = $r['id_admin'];
									echo "<script>location.href='admin/wellamin.php'</script>";
								}
							}
						} 	
						?>
					</div>
			</div>
		</div>
	</div>
	 <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
     <script src="js/bootstrap.bundle.min.js" ></script>
</body>
 
</html>