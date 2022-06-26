<?php
include "config/koneksi.php"; // memanggil file koneksi.php untuk koneksi ke database
date_default_timezone_set('Asia/Jakarta');
$Tanggal = date("Y-m-d");
$Waktu = date("H:i:s");
//header("Content-type: application/octet-stream");
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=Data Sensor $Tanggal.csv");
//select table to export the data
$Tanggal_Terkini = mysqli_query($koneksi,"SELECT MAX(Tanggal) AS Tanggal FROM test ");
$row=mysqli_fetch_array($Tanggal_Terkini);
$Tanggal_Terkini = $row['Tanggal'];
$select_table=mysqli_query($koneksi,"SELECT Tanggal,Waktu,Suhu,Kelembaban FROM test WHERE Tanggal='$Tanggal_Terkini'");
$rows = mysqli_fetch_assoc($select_table);
if ($rows)
{
getcsv(array_keys($rows));
}
while($rows)
{
getcsv($rows);
$rows = mysqli_fetch_assoc($select_table);
}

// get total number of fields present in the database
function getcsv($no_of_field_names)
{

$separate = '';


// do the action for all field names as field name
foreach ($no_of_field_names as $field_name)
{
if (preg_match('/\\r|\\n|,|"/', $field_name))
{
$field_name = '' . str_replace('', $field_name) . '';
}
echo $separate . $field_name;

//sepearte with the comma
$separate = ',';
}

//make new row and line
echo "\r\n";
}


?>