<?php 
require 'function.php';

if( isset($_POST["register"]) ) {

	if( registrasi($_POST) > 0) {
		echo "<script>
				alert('user baru berhasil ditambahkan')
				</script>";
	} else {
		echo mysqli_error($conn);
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
	<link rel="stylesheet" type="text/css" href="css/registrasi.css">
	<style>
		label{
			display: block;
		}
	</style>
</head>
<body>
	<h1>Halaman Registrasi</h1>

	<div class="container">

		<div class="avatar">
            <img src="icon/note.png">
        </div>

		<h2>Registrasi</h2>
		
		<form action="" method="post">
				<p class="garis">______________</p>
			
					<input type="text" name="username" id="username" placeholder="masukan username" required="">
			
					<input type="password" name="password" id="password" placeholder="masukkan password" required="">
			
					<input type="password" name="password2" id="password2" placeholder="ulangi password" required="">
			
		
					<button type="submit" name="register" id="registrasi">Register</button>
			
				<p class="garis2">______________</p>

				<a href="login.php" class="kembali">Kembali!</a>
		</form>
	</div>

	<footer>
		<p>&copy; Copyright 2020 | oleh <a href="http://instagram.com/taufiqurrahman_022">Taufiqurrahman</a></p>
	</footer>

</body>
</html>