<?php 

session_start();

if ( isset($_SESSION["login"]) ) {
	header("Location: index.php"); 
	exit;
}

require 'config/koneksi.php';

if ( isset($_POST["login"]) ) {

	$username = ($_POST["username"]);
	$password = ($_POST["password"]);

	$result = mysqli_query($koneksi, "SELECT * FROM test2 WHERE username = '$username'");

	// cek username
	if ( mysqli_num_rows($result) === 1 ) { 

		// cek password
		$row = mysqli_fetch_assoc($result);
		if ( $password === $row["password"] ) { 

			// set session 
			$_SESSION["login"] = true;
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
	<title>Halaman Login</title>
	<link rel="stylesheet" href="my_css/style.css">
</head>
<body style="background-image: url(assets/img/bg-login.jpg);
			 background-repeat: no-repeat;
			 background-size: cover;
			 background-position: center center;
			 background-attachment: fixed;
			 ">

	<form class="Login" action="" method="post">
		<h1>Login Here</h1>
		<?php if ( isset($error) ) : ?>
			<p>Login gagal, mohon periksa kembali username dan password yang digunakan.</p>
		<?php endif; ?>
		<input type="text" name="username" placeholder="Username" autocomplete="off">	
		<input type="password" name="password" placeholder="Password">
		<button type="submit" name="login">Enter</button>
	</form>

</body>
</html>