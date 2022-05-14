<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Doanh thu bán hàng
    </h6>
  </div>

  <div class="card-body">
  <?php
             $cnn = mysqli_connect("localhost", "root", "" , "dota") or die (" khong ket noi duoc");
             mysqli_query($cnn, 'SET NAMES UTF8');
             $limit = 4;
             $page = "";
             $y ="";
             $m ="";
             $d ="";
             $startT="";
             $end="";
             if(isset($_GET['action']))
             {  
                 if(isset($_GET['startTime']) || isset($_GET['endTime']) || isset($_GET['year']) || isset($_GET['date']) || isset($_GET['month']))
                 {
                    

                    if(isset($_GET['startTime'])&&isset($_GET['endTime'])&&$_GET['startTime']!=""&&$_GET['endTime']!="")
                    {
                        $startT=$_GET['startTime'];
                        $end=$_GET['endTime'];
                    }
                    else if(isset($_GET['year'])&&$_GET['year']!="")
                    {
                        $y = $_GET['year'];
                    }
                    else if(isset($_GET['date'])&&$_GET['date']!="")
                    {
                        $d = $_GET['date'];
                    }
                    else if(isset($_GET['month'])&&$_GET['month']!="")
                    {
                        $m = $_GET['month'];
                    }
                 }
            }
             if(isset($_POST['page']))
                 {
                     $page = $_POST['page'];       
                 }
                 else{
                     $page = 1;   
                 }
                 $start = ($page - 1)*$limit; 
                    if($startT!="" && $end!="")
                    {
                    $sql = "SELECT *,count(iddonhang) as soluong , created_time,SUM(totalbill) AS doanhthu FROM donhang WHERE status LIKE '%đã xử lí%' and created_time <='$end' and created_time >='$startT' LIMIT {$start} , {$limit}";

                    }
                    else if($d!="")
                    {
                    $sql = "SELECT *,count(iddonhang) as soluong , DAY(created_time),SUM(totalbill) AS doanhthu FROM donhang WHERE status LIKE '%đã xử lí%' and DAY(created_time) = $d LIMIT {$start} , {$limit}";

                    }
                    else if($m !=""){
                    $sql = "SELECT *,count(iddonhang) as soluong ,MONTH(created_time),SUM(totalbill) AS doanhthu FROM donhang WHERE status LIKE '%đã xử lí%' and    MONTH(created_time) = $m LIMIT {$start} , {$limit}";

                    }
                    else if($y!=""){
                    $sql = "SELECT *,count(iddonhang) as soluong ,YEAR(created_time),SUM(totalbill) AS doanhthu FROM donhang WHERE status LIKE '%đã xử lí%' and YEAR(created_time) = $y LIMIT {$start} , {$limit}";
                    
                 }else{
                 $sql = "SELECT *,count(iddonhang) as soluong ,SUM(totalbill) AS doanhthu FROM donhang WHERE status LIKE '%đã xử lí%' LIMIT {$start} , {$limit}";
                }
              if($sql){
             $result = mysqli_query($cnn, $sql);
              }else{
                  echo "loi";
                  
              }
             $output = "";
             if(mysqli_num_rows($result)>0){
                $output.='<div class="table-responsive">
                <form action="DAO.php">
                <h4>Lọc theo mốc thời gian </h4>
                <select name="select">
                    <option value="date">
                    Ngày 
                    </option>
                    <option value="month">
                    Tháng
                    </option>
                    <option value="year" selected>
                   Năm
                    </option>
                </select>
                <input name="data"> 
               
                <input hidden name="action" value="sort">
                <button class="btn btn-primary"> Lọc</button>
        <h4>Lọc theo khoảng thời gian </h4>
         </form>
         <form action="DAO.php" >
         <div  class="form-group">
         <label for="myDate2">Từ </label>
         <input type="date" id="myDate2" class="form-control col-md-6"
             min="2018-05-01" max="2050-12-31" value="" name="startTime">
        </div>
        <div>
            <label for="myDate2">Đến </label>
            <input type="date" id="myDate3" class="form-control col-md-6"
            min="2018-05-01" max="2050-12-31" value="" name="endTime">
        </div>
        <div class="form-group">
         <input hidden name="action" value="sort">
         <button class="btn btn-primary"> Xem</button>
         </div>
         </form>
                               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                         <thead>
                                             <tr>
                                                 <th>Số lượng đơn hàng </th>
                                                 
                                                 <th>Tổng tiền</th>
                                                 <th>Thao tác</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                ';
                 while($row = mysqli_fetch_assoc($result)){
                     $row['doanhthu'] = number_format($row['doanhthu']);
                    $output.="
                    <tr>
                    <td>{$row['soluong']}</td>
                    <td>{$row['doanhthu']}VNĐ</td>
                    <td>
                    </td>
                </tr>
                    ";
                 }
             $sql_total = "SELECT *,sum(iddonhang) as soluong ,SUM(totalbill) AS doanhthu FROM donhang WHERE status LIKE '%đã xử lí%'";
             $records = mysqli_query( $cnn, $sql_total) or die ("sai");
              $total_records = mysqli_num_rows($records);
              $total_page = ceil($total_records/$limit);
              $output .="              </tbody>
                                 </table>
                         </div>   
               <ul  class='pagination home-product__pagination'>";
              for($i=1 ; $i<=$total_page; $i++){
                  if($i == $page){
                      $class_name = "pagination-item--active";
                  }
                  else {
                      $class_name = "";
                  }
                  $output .="
                  
                  <li class='pagination-item {$class_name}'>
                      <a href='' id={$i} class='pagination-item__link' >
                          <i class='pagination-item__icon'>{$i}</i>
                      </a>
                   </li>";
                  
              }
              $output .= "</ul>
              ";
         
               
         echo $output;
             }
             
         ?>
         
         <!-- pagination -->
     
</div>
</div>