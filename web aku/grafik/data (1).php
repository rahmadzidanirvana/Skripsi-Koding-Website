<?php 
include('koneksi.php');
$Waktu = mysqli_query($koneksi,"SELECT * FROM test ORDER BY ID DESC LIMIT 12");
$Suhu = mysqli_query($koneksi,"SELECT * FROM test ORDER BY ID DESC LIMIT 12");

?>
 <div class="panel panel-primary">
    <div class="panel-heading">
    </div>

    <div class="panel-body">
      <canvas id="myChart"></canvas>
      <script>
       var canvas = document.getElementById('myChart');
        var data = {
            labels: [<?php while($p= mysqli_fetch_array($Waktu)){ echo '"' . $p['Waktu'].'",';} ?>],
            datasets: [
            {
                label: "Suhu",
                fill: true,
                lineTension: 0.5,
                backgroundColor: "rgba(105, 0, 132, .2)",
                borderColor: "rgba(200, 99, 132, .7)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(200, 99, 132, .7)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(200, 99, 132, .7)",
                pointHoverBorderColor: "rgba(200, 99, 132, .7)",
                pointHoverBorderWidth: 2,
                pointRadius: 5,
                pointHitRadius: 10,
                data: [<?php while($p= mysqli_fetch_array($Suhu)){ echo '"' . $p['Suhu'].'",';} ?>],
            },
            ]
        };

        var option = 
        {
          showLines: true,
          animation: {duration: 15.0}
        };
        
        var myLineChart = Chart.Line(canvas,{
          data:data,
          options:option
        });

      </script>          
    </div>    
  </div>
        </tbody>
      </table>   
    </div>
  </div>