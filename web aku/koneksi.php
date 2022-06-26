<?php 
    $host    = "localhost";
	$user    = "sundeywe_tugasakhir";
	$pass    = "VHr8;,u*5i&f";
	$db      = "sundeywe_tugasakhir";
	$koneksi = mysqli_connect($host, $user, $pass, $db);
	if(mysqli_connect_errno())
	{
		echo "Database Not Connected".mysqli_connect_error();
    }
?>