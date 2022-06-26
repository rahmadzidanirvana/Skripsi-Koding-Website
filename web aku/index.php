<?php
  session_start();

 if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
  } 

  include "config/function.php"; // memanggil file koneksi.php untuk koneksi ke database
?>
<!DOCTYPE html>
<html>
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
    <script src="config/Chart.js"></script>
</head>
<body>
  <header>
    <div class="jumbotron"> 
        <p lang="id" translte=no >LABORATORIUM <img class="mb-4" src="assets/img/logo2.png" width="200" style="float: right; position: relative;"><img class="mb-4" src="assets/img/logo3.png" width="60" style="float: right; position: relative;"><img class="mb-4" src="assets//img/logo1.png" width="90" style="float: right;"><br>ELEKTRONIKA INSTRUMENTASI <br>KOMPUTASI & NUKLIR </p>
    </div >
    <div class="teks-berjalan">
        <marquee scrolldelay="10" style="word-spacing: 5px;">MONITORING SUHU DAN KELEMBABAN MENGGUNAKAN WEMOS D1 R1 DAN SENSOR SHT31-D LABORATORIUM ELEKTRONIKA INSTRUMENTASI KOMPUTASI DAN NUKLIR JURUSAN FISIKA FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM UNIVERSITAS  SRIWIJAYA INDERALAYA</marquee><!-- <p>o<div class="logout"><a id="logout" href="logout.php">LOGOUT</a></div></p> -->
    </div> 
    </div> 
    <nav>
        <ul>
          <li class="active" id="hover"><a href="index.php">HOME</a></li>
          <li  id="hover"><a href="datasemua.php">DATA HARIAN</a></li>
          <li  id="hover"><a href ="details.php">DETAILS</a></li>
        </ul>
    </nav>
</header>

<main>
  <div class="box">
        <div class="content">
            <div class="singledata" style="padding: 15px;">
                <div class="temp">                     
                    <div class="kota">Inderalaya, Sumatera Selatan</div>
                    <div class="jam">Per <?php $Waktu_Terkini = mysqli_query($koneksi,"SELECT (Waktu) AS Waktu FROM test WHERE ID IN (SELECT MAX(ID) FROM test) LIMIT 1 ");$row=mysqli_fetch_array($Waktu_Terkini);$Waktu_Terkini = $row['Waktu'];echo ($Waktu_Terkini);?></div>
                    <div class="suhu" ><span id="datasuhu" style="font-family: OpenSans-Semibold"><?php $Suhu = mysqli_query($koneksi,"SELECT (Suhu) AS Suhu FROM test WHERE ID IN (SELECT MAX(ID) FROM test) LIMIT 1 ");$row=mysqli_fetch_array($Suhu);$Suhu = $row['Suhu'];echo ($Suhu);?></span>°C</div> 
                    <div class="humidity" style="line-height: 0">Humidity : <?php $Kelembaban = mysqli_query($koneksi,"SELECT (Kelembaban) AS Kelembaban FROM test WHERE ID IN (SELECT MAX(ID) FROM test) LIMIT 1 ");$row=mysqli_fetch_array($Kelembaban);$Kelembaban = $row['Kelembaban'];echo ($Kelembaban);?>% </div>
                </div>
                
            </div> 
            
            <div class="statistik">
                 <?php
                date_default_timezone_set('Asia/Jakarta');
                $tgl_hari_ini = mysqli_query($koneksi,"SELECT (Tanggal) AS Tanggal FROM test WHERE ID IN (SELECT MAX(ID) FROM test) LIMIT 1 ");
                $row=mysqli_fetch_array($tgl_hari_ini);
                $tgl_hari_ini = $row['Tanggal'];
                $show= mysqli_query($koneksi," SELECT * FROM test WHERE Tanggal='$tgl_hari_ini' ORDER BY Suhu DESC LIMIT 1");
                $datas = mysqli_fetch_assoc($show);
                $show2= mysqli_query($koneksi," SELECT * FROM test WHERE Tanggal='$tgl_hari_ini' ORDER BY Suhu ASC LIMIT 1");
                $datas2 = mysqli_fetch_assoc($show2);
                $show3= mysqli_query($koneksi," SELECT * FROM test WHERE Tanggal='$tgl_hari_ini' ORDER BY Kelembaban DESC LIMIT 1");
                $datas3 = mysqli_fetch_assoc($show3);
                $show4= mysqli_query($koneksi," SELECT * FROM test WHERE Tanggal='$tgl_hari_ini' ORDER BY Kelembaban ASC LIMIT 1");
                $datas4 = mysqli_fetch_assoc($show4);
              ?>
             <div class="max-min">
                <div class="keterangan">
                  <span id="datasuhu" >
                    <ul style="list-style-type:none;">
                      <li style="width:210px;"><img src="assets/img/temp2.png" width="10">&nbsp;Suhu Max. &emsp;:&nbsp;<?=$datas['Suhu'] ?>°C<hr width="230px" left></li>
                      <li style="width:205px;">&emsp;Suhu Min.&emsp;&nbsp;:&nbsp;<?=$datas2['Suhu'] ?>°C<hr width="230px" left></li>
                      <li style="width:205px;"><img src="assets/img/humidity2.png" width="12">&nbsp;Kelembaban Max.&nbsp;:&nbsp;&nbsp;<?=$datas3['Kelembaban'] ?>%<hr width="230px" left></li>
                      <li style="width:205px;">&emsp;Kelembaban Min.&nbsp;:&nbsp;&nbsp;&nbsp;<?=$datas4['Kelembaban'] ?>%<hr width="230px" left></li>
                      <li style="width:205px;"><p align="right" style="font-size:12px;">data per <?=$datas4['Tanggal']?></p></li>
                    </ul>
                  </span>
                </div>  
              </div>
              <div class="rata-rata">
                <div class="rata_rata" id="suhu">
                  <div class="sub-text" style="color:black;font-size:12px;">
                    <span style="margin-left:20px;"><p align="left">Rata-rata<br>suhu</p></span>
                    <!-- <img src="assets/img/temp.png" width="10" style="float: right;"> -->
                  </div>
                  <div class="sub-text" style="margin-top:-20px;">
                    <ul style="list-style-type:none;align=left;">
                      <li><span style="font-family: OpenSans-Semibold;font-size:50px;color:#524e55;margin-left:-0.5em;"><?php 
                          $Rata_Suhu = mysqli_query($koneksi,"SELECT Tanggal, AVG(Suhu) AS average FROM test WHERE Tanggal='$tgl_hari_ini'");$row= mysqli_fetch_array($Rata_Suhu);$average = $row['average'];echo''.round($average).'';?>°C</span>
                    </ul>
                  </div>
                  <div class="sub-text">
                    <p style="color:black;font-size:12px;margin-left:20px;">data per <?=$datas4['Tanggal']
                         ?></p>
                  </div> 
                </div>

                <div class="rata_rata" id="kelembaban" >
                  
                <div class="sub-text" style="color:black;font-size:12px;">
                    <span style="margin-left:20px;"><p align="left">Rata-rata<br>kelembaban</p> </span>
                    <!-- <img src="assets/img/temp.png" width="10" style="float: right;"> -->
                  </div>
                  <div class="sub-text" style="margin-top:-20px;">
                    <ul style="list-style-type:none;align=left;">
                      <li><span style="font-family: OpenSans-Semibold;font-size:50px;color:#524e55;margin-left:-0.5em;"><?php 
                          $Rata_Kelembaban = mysqli_query($koneksi,"SELECT Tanggal, AVG(Kelembaban) AS average FROM test WHERE Tanggal='$tgl_hari_ini' ");$row=mysqli_fetch_array($Rata_Kelembaban);$average = $row['average'];echo ''.round($average).'';?>%</span>
                    </ul>
                  </div>
                  <div class="sub-text">
                    <p style="color:black;font-size:12px;margin-left:20px;">data per <?=$datas4['Tanggal']
                         ?></p>
                  </div> 
                </div>
              </div>
             </div>
            <div class="datarow" style="justify-content: center; padding: 15px;">
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
                  
               <div id="responsecontainer" style="width: 500px; " >
               </div>  
            </div>
        <div class="datarow" style="justify-content: center; padding: 15px;">
          <?php 
           $Waktu = mysqli_query($koneksi,"SELECT * FROM test ORDER BY ID DESC LIMIT 12");
           $Grafik_Kelembaban = mysqli_query($koneksi,"SELECT * FROM test ORDER BY ID DESC LIMIT 12");
           
           ?>
              <!-- <div class="">
                  <div class="grafik">
                      <center>
                        <h2>Grafik Hasil Pengukuran Suhu</h2> -->
                        <div style="width: 500px; height: 264.64px;">
                            <canvas id="linechart"></canvas>
                        </div>
                      <!-- </center>
                  </div>
              </div> -->
            </div> 
        </div>
        <aside>
          <div class="list">
            <div id="date">
              <p><?php 
              date_default_timezone_set('Asia/Jakarta');
              echo date('l, d-m-Y');?></p>
            </div>
            <table id="wntable" cellpadding="20">                  
      <?php
        include "koneksi.php";
        $query =mysqli_query($koneksi, "SELECT * FROM test ORDER BY ID DESC  LIMIT 12");
        while($data=mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?=$data['Waktu']?></td>
            <td><?=$data['Suhu']?>°C</td>
            <td><?=$data['Kelembaban']?>%</td>
        </tr>
        <?php
        }
        ?>
              </table>
          </div>
        </aside>  
  </div>
</main>
<footer> Laboratorium Oseanografi Fisis Dan Sains Atmosfer, Jurusan Fisika &#169; 2021, 
      Fakultas Matematika dan Ilmu Pengetahuan Alam &copy; 2021, Universitas Sriwijaya, Inderalaya<br><span><a style="color: white;" href="logout.php" ><i>logout</i></a></span></footer>
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
            data: [<?php while($p= mysqli_fetch_array($Grafik_Kelembaban)){ echo '"' . $p['Kelembaban'].'",';} ?>]
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
</body>
</html>