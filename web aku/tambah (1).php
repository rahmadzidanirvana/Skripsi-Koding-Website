<?php 
include ('koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$Tanggal_Waktu=date("d-m-Y H:i:s");
//$Tanggal=$_GET['tanggal'];
$Tanggal=date("d-m-Y");
$Waktu=date("H:i:s");
$Suhu = $_GET['suhu'];
$Kelembaban = $_GET['kelembaban'];
$sqlt = "INSERT INTO test (Tanggal,Waktu,Suhu,Kelembaban,Tanggal_Waktu) VALUES ('$Tanggal','$Waktu','$Suhu','$Kelembaban','$Tanggal_Waktu')";
if ($koneksi->query($sqlt)=== TRUE) 
{
    echo "NEW RECORD SUCCESFULLY CREATED";
}
else
{
	echo "error:".$sqlt."</br>".$koneksi->error;
} 
$koneksi->close();
?>