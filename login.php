<?php 
session_start();

require 'function.php';

// Cek Cookie
if ( isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	// Ambil username berdasarkan id
	$result = mysqli_query($conn,"SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	// Cek cookie dan username
	if ($key === hash('sha256', $row['username']) ){
		$_SESSION['login'] = true;
	}
}



// Session ketika belum login akan dibalekan kehalaman login langsung
if( isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}


if( isset($_POST["login"]) ){
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username ='$username'");

	//cek username
	if ( mysqli_num_rows( $result ) === 1 ) {


		//cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"] ) ){

			// Sset SESSION
			$_SESSION["login"] = true;

			// Cek REMEMBER
			if ( isset($_POST['remember']) ) {
				// Buat cookie
				
				setcookie('id', $row['id'], time() + 3600);
				setcookie('key', hash('sha256', $row['username']), time() + 3600);


			}

			header("Location: index.php");
			exit;
		}

		}
		$error = true;
	}




 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/logincss.css">
</head>
<body>

	<h1> Sistem Pendataan Zakat </h1>


	<div class="container">


		<!-- bulat login -->
		<div class="avatar">
            <img src="icon/user.png">
        </div>


	<h2>Login</h2>
	<br>

	<form action="" method="post">

		<p class="garis">______________</p>

		<ul>
			
				
				<input type="text" name="username" id="username" placeholder="username" required="">
			
				<input type="password" name="password" id="password" placeholder="password" required="">
			
				<label for="remember" class="labelrmbr">Remember me :</label>
				<input type="checkbox" name="remember" id="remember">
			
				<!-- Pesan kesalahan login -->
				<div class="pesansalah">	
				<?php if(isset($error)) : ?>
					<script type="text/javascript">alert("Username/Password Salah!")</script>
				<?php endif; ?>
				</div>

				<button type="submit" name="login" class="login">Login!</button>
				<br>
			
		</ul>		

		<p class="garis2">______________</p>
			
		<a href="registrasi.php" class="registrasi">Registrasi!</a>

	</form>

	</div>
	</body>

	<footer>
		<p>&copy; Copyright 2020 | oleh <a href="http://instagram.com/taufiqurrahman_022">Taufiqurrahman</a></p>
	</footer>

</body>
</html>