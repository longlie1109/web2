<!-- DataTales Example -->
<!-- <div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Thông tin Danh sách thể loại
        <a href="../admi/DAO.php?action=add_type">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Thêm thể loại
          </button>
        </a>
    </h6>
  </div> -->
  <div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="index.php?action=view_cart">
         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                Trở lại
        </button>
    </a>
    <h6 class="m-0 font-weight-bold text-primary">Thông tin Danh sách đơn hàng chi tiết
    </h6>
  </div>


  <div class="card-body">
   
  <!-- Content Row -->
  <?php
    $cnn = mysqli_connect("localhost", "root", "" , "dota") or die (" khong ket noi duoc");
    mysqli_query($cnn, 'SET NAMES UTF8');
    $limit = 4;
    $page = "";
    if( isset($_GET['action']) && ($_GET['id'] !="")){
        $id = $_GET['id'];
    }
    else echo "rong";
    if(isset($_POST['page']))
        {
            $page = $_POST['page'];       
        }
        else{
            $page = 1;   
        }
        $start = ($page - 1)*$limit;    
    $sql = "SELECT * FROM chitietdonhang as hd, sach as s  where hd.iddonhang = $id and hd.idsach = s.id LIMIT {$start} , {$limit}";
     
    $result = mysqli_query($cnn, $sql);
//    print_r($result);
//    exit();

    $output = "";
    if(mysqli_num_rows($result)>0){
        $total=0;
       $output.='<div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID đơn hàng</th>
                                        <th>ID đơn hàng chi tiết </th>
                                        <th>Tên sách</th>
                                        <th>số lượng </th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày tạo </th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
       ';
        while($row = mysqli_fetch_assoc($result)){
            $current =($row['dongia'] - ($row['dongia']*($row['sale']/100)))*$row['soluong'];

            $total += $current;
            $current = number_format($current);
           $output.="
           <tr>
           <td> {$row['iddonhang']}</td>
           <td> {$row['idchitiethoadon']}</td>
           <td> {$row['tensach']}</td>
           <td> {$row['soluong']}</td>
           <td> {$current}đ</td>
           <td> {$row['created_time']}</td>
           <td>
           </td>
       </tr>
           ";
        }
    $sql_total = "SELECT * FROM chitietdonhang as hd, sach as s  where hd.iddonhang = $id and hd.idsach = s.id";
    $records = mysqli_query( $cnn, $sql_total) or die ("sai");
     $total_records = mysqli_num_rows($records);
     $total_page = ceil($total_records/$limit);
     $total =number_format($total);
     $output .="              </tbody>
                        </table>
                </div>   
                <div> Tổng tiền: {$total}đ</div>
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
</div>
<!-- pagination -->

  