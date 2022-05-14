<?php
  // $cnn = mysqli_connect("localhost","root","","dota");
  // if($cnn){
  //   echo "connected1";
  // }
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart1);
     
      function drawChart1() {

        var data = google.visualization.arrayToDataTable([
          ['tensach', 'tongsoluong'],

         <?php
         
  
         $sql = "SELECT idsach, tensach , sum(soluong) as tongsoluong FROM donhang as dh,sach as s ,`chitietdonhang` as ct where s.id = ct.idsach and ct.iddonhang = dh.iddonhang and dh.status like '%đã xử lí%' GROUP BY tensach";
           
         $fire = mysqli_query($cnn,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['tensach']."',".$result['tongsoluong']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Số sách bán chạy nhất'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 100%; height: 500px;"></div>
  </body>
</html>