<?php
  $cnn = mysqli_connect("localhost","root","","dota");
  // if($cnn){
  //   echo "connected2";
  // }
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['tentheloai', 'tong'],
         <?php
         mysqli_query($cnn, 'SET NAMES UTF8');
         $sql = "SELECT t.tentheloai , sum(ct.soluong) as tong FROM `theloai` as t ,`chitietdonhang` as ct, `sach` as s WHERE ct.idsach = s.id and s.matheloai =t.id GROUP by t.tentheloai";
         $fire = mysqli_query($cnn,$sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            echo"['".$result['tentheloai']."',".$result['tong']."],";
          }

         ?>
        ]);

        var options = {
          title: 'Thể loại bán chạy nhất'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart1" style="width: 100%; height: 500px;"></div>
  </body>
</html>