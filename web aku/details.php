<?php
  session_start();

 if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  } 

  include "config/function.php"; // memanggil file koneksi.php untuk koneksi ke database
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Sistem Monitoring Suhu dan Kelembaban</title>
    <link rel="stylesheet" href="font/OpenSans/OpenSans.css">
    <link rel="stylesheet" href="font/OpenSans/OpenSans-SemiBold.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,600;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="font/Rimouski/Rimouski.css">

    <style type="text/css">
        #wnntable tr:nth-child(even)
        {
            background-color: #709FB0;
        }
    </style>
</head>

<body>
<header>
    <div class="jumbotron"> 
        <p lang="id" translte=no >LABORATORIUM <img class="mb-4" src="assets/img/logo2.png" width="200" style="float: right; position: relative;"><img class="mb-4" src="assets/img/logo3.png" width="60" style="float: right; position: relative;"><img class="mb-4" src="assets//img/logo1.png" width="90" style="float: right;"><br>ELEKTRONIKA INSTRUMENTASI <br>KOMPUTASI & NUKLIR</p>
        
        
    </div >
    <div class="teks-berjalan">
        <marquee scrolldelay="10" style="word-spacing: 5px;">MONITORING SUHU DAN KELEMBABAN MENGGUNAKAN WEMOS D1 R1 DAN SENSOR SHT31-D LABORATORIUM ELEKTRONIKA INSTRUMENTASI KOMPUTASI DAN NUKLIR JURUSAN FISIKA FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM UNIVERSITAS  SRIWIJAYA INDERALAYA</marquee><!-- <p>o<div class="logout"><a id="logout" href="logout.php">LOGOUT</a></div></p> -->
    </div> 
    <nav>
        <ul>
          <li  id="hover"><a href="index.php">HOME</a></li>
          <li  id="hover"><a href="datasemua.php">DATA HARIAN</a></li>
          <li class="active" id="hover"><a href ="details.php">DETAILS</a></li>
        </ul>
    </nav>
</header>
<main>
  <div class="kotak">
        <div class="konten">
            <div class="datarows" style="justify-content: center; ">
              <center style="
                  display:flex; 
                  color: black; 
                  background-color: #337AB7; 
                  margin-top: 0px; 
                  border-top-right-radius: 12px;
                  border-top-left-radius: 12px;  
                  padding: 20px; 
                  color: white; 
                  font-family: sans-serif; 
                  font-size: 20px;
                  justify-content: center;
              " >
                Grafik Suhu
              </center>
              <div id="Grafik" 
                   style="
                   display: flex;
                   margin-top: px;
                   padding: 20px;
                   width: 100%;
              ">
                 <script src="jquery-latest.js"></script> 
                  <script>
                  var refreshId = setInterval(function()
                  {
                      $('#responsecontainer').load('grafik/data.php');
                  }, 1000);
                  </script>
                        
                  <!-- Begin page content -->
                  <script type="text/javascript" src="grafik/assets/js/jquery-3.4.0.min.js"></script>
                  <script type="text/javascript" src="grafik/assets/js/mdb.min.js"></script>
                      
                  <div id="responsecontainer" style="width: 900px; margin: auto; margin-bottom: 15px;" >
                  </div>
              </div>
            </div>
            <div class="datarows" style="justify-content: center; ">
              <center style="
                  display:flex; 
                  color: black; 
                  background-color: #337AB7; 
                  margin-top: 0px; 
                  border-top-right-radius: 12px;
                  border-top-left-radius: 12px;  
                  padding: 20px; 
                  color: white; 
                  font-family: sans-serif; 
                  font-size: 20px;
                  justify-content: center;
              " >
                Grafik Kelembaban
              </center>
              <div id="Grafik" 
                   style="
                   display: flex;
                   margin-top: px;
                   padding: 20px;
                   width: 100%;
              ">
                               <!-- <div class="">
                  <div class="grafik">
                      <center>
                        <h2>Grafik Hasil Pengukuran Suhu</h2> -->
                        <div style="width: 900px; margin: auto; margin-bottom: 15px;" >
                            <canvas id="linechart"></canvas>
                        </div>
                      <!-- </center>
                  </div>
              </div> -->
              
              </div>
            </div>
            <div class="datarows" >
              <center style="
                  display:flex; 
                  color: black; 
                  background-color: #337AB7; 
                  margin-top: 0px; 
                  border-top-right-radius: 12px;
                  border-top-left-radius: 12px;  
                  padding: 20px; 
                  color: white; 
                  font-family: sans-serif; 
                  font-size: 20px;
                  justify-content: center;
                  transition: 0.3s;
              " >
                Tabel Suhu dan Kelembaban
              </center>
              <div id="Tabel" 
                   style="
                   display: flex;
                   margin-top: px;
                   padding: 20px;
                   width: 100%;
                   justify-content: center;
              ">
                <div>
                  <table id="wnnntable" style="border-radius: 12px;">
                    <tr>
                      <th colspan="4" 
                          style="
                          text-align: center; 
                          color:white; 
                          background-color: #413C69; 
                          padding:20px ;
                          font-family: sans-serif; 
                          font-style: normal;
                          font-variant: normal;
                          font-size: 20px;
                          border-top-right-radius: 12px;
                          border-top-left-radius: 12px; ">
                      Data Sensor Suhu Dan Kelembaban Jurusan Fisika Universitas Sriwijaya
                      </th>
                    </tr>
                    <tr>
                      <th>No</th>
                      <th>Suhu</th>
                      <th>Kelembaban</th>
                      <th>Tanggal/Waktu</th>
                    </tr>
                  <?php
                    $tampil = mysqli_query($koneksi, "SELECT * FROM test ");
                    $data = mysqli_fetch_array($tampil); 
                    $jumlahdataperhalaman = 20;
                    $jumlahdata = mysqli_num_rows($tampil);
                    $jumlahhalaman = ceil($jumlahdata/$jumlahdataperhalaman);
                    $halamanaktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
                    $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
                    $show = mysqli_query($koneksi,"SELECT * FROM test ORDER BY ID DESC LIMIT $awaldata, $jumlahdataperhalaman");
                    $i= 1 + $awaldata;
                    $jumlahlink = 4;
                      if($halamanaktif > $jumlahlink)
                      {
                          $start_number = $halamanaktif - $jumlahlink;
                      }
                      else
                      {
                          $start_number = 1;
                      }
                      if($halamanaktif < ($jumlahhalaman - $jumlahlink))
                      {
                          $end_number = $halamanaktif + $jumlahlink;
                      }
                      else
                      {
                          $end_number = $jumlahhalaman;
                      }
                      foreach($show as $data) :
                     ?>

                    <tr>
                      <td ><?= $i;?></td>
                      <td ><?=$data['Suhu'] ?>&deg;C</td>
                      <td><?=$data['Kelembaban'] ?>%</td>
                      <td><?=$data['Tanggal_Waktu']?></td>
                    </tr>
                    
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    </table>
                    
                    <div class="navigator" style="margin-top: 20px; margin-bottom: 0px; text-align: center; ">                        
	                    <?php if($halamanaktif > 1): ?>
                        <a href="?hal=<?=$halamanaktif-1; ?>" style="font-size:12px; color: blue; text-decoration: none; margin-right: 20px;" > Previous </a>
                      <?php endif; ?>
                      <?php if($halamanaktif > 3): ?>
                        <a href="?hal=<?=1 ?>" style="font-weight: bold; font-size:12px; color: blue; text-decoration: none; margin-right: 15px;"> << </a>
                      <?php endif; ?>    
                      <?php for($i=$start_number; $i <= $end_number; $i++) : ?>
                        <?php if($i == $halamanaktif) : ?>
                            <a href="?hal=<?=$i;?>" style="font-weight: bold; font-size: 12px;text-decoration: none; margin-right: 15px;"><?=$i;?></a>
                        <?php else : ?>
                            <a href="?hal=<?=$i;?>" style="color: blue; font-size: 12px; text-decoration: none; margin-right: 15px;"><?=$i;?></a>
                        <?php endif; ?>
                        <?php endfor; ?>
                       <?php if($halamanaktif < $jumlahhalaman): ?>
                        <a href="?hal=<?=$jumlahhalaman ?>" style="font-weight: bold; font-size:12px; color: blue; text-decoration: none; margin-right: 20px;"> >> </a>
                        <?php endif; ?>
                        <?php if($halamanaktif < $jumlahhalaman): ?>
                        <a href="?hal=<?=$halamanaktif+1; ?>" style="font-size:12px; color: blue; text-decoration: none;"> Next </a>
                        <?php endif; ?>
                    </div>
                </div>
              </div>
            </div>
        </div>
           
  </div>
</main>
<?php 
include('koneksi.php');
$Waktu = mysqli_query($koneksi,"SELECT * FROM test  ORDER BY ID DESC LIMIT 12");
$Kelembaban = mysqli_query($koneksi,"SELECT * FROM test ORDER BY ID DESC LIMIT 12
");
?>
<script  type="text/javascript">
var ctx = document.getElementById("linechart").getContext("2d");
var data = {
    labels: [<?php while($p= mysqli_fetch_array($Waktu)){ echo '"' . $p['Waktu'].'",';} ?>],
    datasets: [
        {
            label: "Kelembaban",
            fill: true,
            lineTension: 0.5,
            backgroundColor: "rgba(0, 137, 132, .2)",
            borderColor: "rgba(0, 10, 130, .7)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(0, 10, 130, .7)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(0, 10, 130, .7)",
            pointHoverBorderColor: "rgba(0, 10, 130, .7)",
            pointHoverBorderWidth: 2,
            pointRadius: 5,
            pointHitRadius: 10,
            data: [<?php while($p= mysqli_fetch_array($Kelembaban)){ echo '"' . $p['Kelembaban'].'",';} ?>]
        }
        ]
    };

var myBarChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
    legend: {
    display: true
    },
    barValueSpacing: 20,
    scales: {
    yAxes: [{
    ticks: {
        min: 0,
        }
        }],
    xAxes: [{ 
        gridLines: {
        color: "rgba(105, 0, 132, .2)",
        }
    }]
}
}
});
</script>

<footer style="margin-top: 20px;"> Laboratorium Oseanografi Fisis Dan Sains Atmosfer, Jurusan Fisika &#169; 2021, 
      Fakultas Matematika dan Ilmu Pengetahuan Alam &copy; 2021, Universitas Sriwijaya, Inderalaya<br><span><a style="color: white;" href="logout.php" ><i>logout</i></a></span></footer>

</body>
</html>
