<?php
include('koneksi.php');
if (!$koneksi) {
die('Could not connect: ' . mysql_error());
}
$sql = "SELECT * FROM test" ;
$result = $koneksi->query($sql);
if($result->num_rows>0){
  while($row = $result->fetch_assoc()) {
$data=$row['Suhu'] . "/" . $row['Kelembaban']. "/" ;
echo $data;
    }
}
mysqli_close($koneksi);
?>