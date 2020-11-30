<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "sistemzakat");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

// function registrasi
function registrasi($data){
	global $conn;
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// Cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if ( mysqli_fetch_assoc($result) ) {
			echo "<script>
				alert('Username Sudah Terdaftar!');
				</script>";
		return false; 
	}


	// Cek konfirmasi password
	if ( $password !== $password2) {
		echo "<script>
				alert('Password yang dimasukan tidak sesuai!');
				</script>";
		return false; 
	}


	//ENKRIPSI PASSWORD
	$password = password_hash($password, PASSWORD_DEFAULT);
	// $password = md5($password);
	 // var_dump($password); die;


	//TAMBAHKAN USERBARU KEDALAM DATABASE
	mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password')");

	return mysqli_affected_rows($conn);


}



 ?>


 