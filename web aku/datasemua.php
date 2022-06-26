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
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <title>Sistem Monitoring Suhu dan Kelembaban</title>
    <link rel="stylesheet" href="font/OpenSans/OpenSans.css">
    <link rel="stylesheet" href="font/OpenSans/OpenSans-SemiBold.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,600;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="font/Rimouski/Rimouski.css">  

    <!-- Bootstrap core CSS -->
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    
</head>

<body>
  <header>
      <div class="jumbotron"> 
          <p lang="id" translte=no >LABORATORIUM <img class="mb-4" src="assets//img/logo2.png" width="200" style="float: right;"><img class="mb-4" src="assets/img/logo3.png" width="60" style="float: right; position: relative;"><img class="mb-4" src="assets//img/logo1.png" width="90" style="float: right;"><br>ELEKTRONIKA INSTRUMENTASI<br>KOMPUTASI & NUKLIR</p>
      </div >
      <div class="teks-berjalan">
         <marquee scrolldelay="10" style="word-spacing: 5px;">MONITORING SUHU DAN KELEMBABAN MENGGUNAKAN WEMOS D1 R1 DAN SENSOR SHT31-D LABORATORIUM ELEKTRONIKA INSTRUMENTASI KOMPUTASI DAN NUKLIR JURUSAN FISIKA FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM UNIVERSITAS  SRIWIJAYA INDERALAYA</marquee><!-- <p><div class="logout"><a id="logout" href="logout.php">LOGOUT</a></div></p> -->
      </div> 
       <nav>
        <ul>
          <li  id="hover"><a href="index.php">HOME</a></li>
          <li  class="active" id="hover"><a href="datasemua.php">DATA HARIAN</a></li>
          <li  id="hover"><a href ="details.php">DETAILS</a></li>
        </ul>
    </nav>
  </header>

  <main>
    <div class="box">
    <ul syle="list-style:none;">
      <li style="display:inline;margin-left:0px;"><a style="text-decoration:none;color:white;background-color:#337AB7;padding:5px;border-radius:6px;" href="download_dataharian.php">Unduh Data Harian</a></li>
      <li style="display:inline;margin-left:0px;"><a style="text-decoration:none;color:white;background-color:#337AB7;padding:5px;border-radius:6px;" href="download_semuadata.php">Unduh Semua Data</a></li>
      </ul>
      <div id="cards" class="cards" align="center">
        <table id="wnntable" style="border-radius:12px;">
          <tr>
            <th colspan="4" style="text-align: center; background-color: #413C69; border-top-right-radius: 12px; border-top-left-radius: 12px;">
              Data Sensor Suhu Dan Kelembaban Jurusan Fisika Universitas Sriwijaya
            </th>
          </tr>
          <tr >
            <th>No</th>
            <th>Suhu (°C)</th>
            <th>Kelembaban (%)</th>
            <th>Waktu</th>
          </tr>
          <?php
                    $Tanggal_Terkini=mysqli_query($koneksi,"SELECT (Tanggal) AS Tanggal FROM test WHERE ID IN (SELECT MAX(ID) FROM test) LIMIT 1 ");
                    $row=mysqli_fetch_array($Tanggal_Terkini);
                    $Tanggal_Terkini = $row['Tanggal'];
                    $tampil = mysqli_query($koneksi, "SELECT * FROM test");
                    $data = mysqli_fetch_assoc($tampil);
                    $jumlahdataperhalaman= 20;
                    $jumlahdata = mysqli_num_rows($tampil);
                    $jumlahhalaman = ceil($jumlahdata/$jumlahdataperhalaman);
                    $halamanaktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
                    $awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
                    $show = mysqli_query($koneksi,"SELECT * FROM test WHERE Tanggal='$Tanggal_Terkini' ORDER BY ID DESC LIMIT $awaldata, $jumlahdataperhalaman");
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
    				    <td><?php echo $i; ?></td>
    				    <td><?=$data['Suhu']?></td>
    				    <td><?=$data['Kelembaban']?>%</td>
    				    <td><?=$data['Waktu']?></td>
    				</tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
        </table>
        
        
        <!--<a target="blank" href="download_data.php" style="float: right; margin-top: 5px;"><img class="mb-4" src="assets/img/printing.png" width="25" style="float: right;"></a>-->
        
        <!--<form method="POST" action='' align="center">-->
        <!--<input type="button" class="btnsasa" value="Download Data" onclick="document.location.href='download_data.php'" />-->
        <!--</form>-->
          
        <!-- navigator -->
        <div class="navigator" style="margin-top: 20px; margin-bottom: 0px; text-align: center; ">
                    <?php if($halamanaktif > 1): ?>
                <a href="?hal=<?=$halamanaktif-1; ?>" style="font-size:12px; color: white; text-decoration: none; margin-right: 20px;" > Previous </a>
            <?php endif; ?>
            <?php if($halamanaktif > 3): ?>
                <a href="?hal=<?=1 ?>" style="font-weight: bold; font-size:12px; color: white; text-decoration: none; margin-right: 15px;"> << </a>
            <?php endif; ?>    
            <?php for($i=$start_number; $i <= $end_number; $i++) : ?>
                <?php if($i == $halamanaktif) : ?>
                    <a href="?hal=<?=$i;?>" style="font-weight: bold; font-size: 12px;text-decoration: none; margin-right: 15px;"><?=$i;?></a>
                <?php else : ?>
                    <a href="?hal=<?=$i;?>" style="color: white; font-size: 12px; text-decoration: none; margin-right: 15px;"><?=$i;?></a>
                <?php endif; ?>
            <?php endfor; ?>
               <?php if($halamanaktif < $jumlahhalaman): ?>
                <a href="?hal=<?=$jumlahhalaman ?>" style="font-weight: bold; font-size:12px; color: white; text-decoration: none; margin-right: 20px;"> >> </a>
            <?php endif; ?>
            <?php if($halamanaktif < $jumlahhalaman): ?>
                <a href="?hal=<?=$halamanaktif+1; ?>" style="font-size:12px; color: white; text-decoration: none;"> Next </a>
            <?php endif; ?>
        </div>


      </div>
    </div>
  <footer> Laboratorium Oseanografi Fisis Dan Sains Atmosfer, Jurusan Fisika &#169; 2021, 
      Fakultas Matematika dan Ilmu Pengetahuan Alam &copy; 2021, Universitas Sriwijaya, Inderalaya <br><span><a style="color: white;" href="logout.php" ><i>logout</i></a></span></footer>  
  </main>
</body>
</html>


