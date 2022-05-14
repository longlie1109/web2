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
    <h6 class="m-0 font-weight-bold text-primary">Thông tin Danh sách đơn hàng
    </h6>
  </div>


  <div class="card-body">
  <!-- Content Row -->
  <?php
    $cnn = mysqli_connect("localhost", "root", "" , "dota") or die (" khong ket noi duoc");
    mysqli_query($cnn, 'SET NAMES UTF8');
    $limit = 4;
    $page = "";
    if(isset($_POST['page']))
        {
            $page = $_POST['page'];       
        }
        else{
            $page = 1;   
        }
        $start = ($page - 1)*$limit;    
    $sql = "SELECT s.fullname as hoten, d.* FROM donhang d , user1 s where s.id = d.idkhachhang order by s.fullname  LIMIT {$start} , {$limit}";
     
    $result = mysqli_query($cnn, $sql);
   

    $output = "";
    if(mysqli_num_rows($result)>0){
       $output.='<div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID đơn hàng</th>
                                        <th>Tên khách hàng </th>
                                        <th>phone number</th>
                                        <th>Address</th>
                                        <th>Ngày tạo</th>
                                        <th>Tình trạng </th>
                                        <th>Thao tác</th>

                                    </tr>
                                </thead>
                                <tbody>
       ';
        while($row = mysqli_fetch_assoc($result)){

           $output.="
           <tr>
           <td> {$row['iddonhang']}</td>
           <td> {$row['hoten']}</td>
           <td> {$row['phonenumber']}</td>
           <td> {$row['address']}</td>
           <td> {$row['created_time']}</td>
           <td> <a class='badge' href='../admi/DAO.php?action=edit_status&id={$row["iddonhang"]}'>{$row['status']} </a></td>
           <td  >
                <div>
                    <div>
                        <a  class='badge' href='../admi/DAO.php?action=show_detail_cart&id={$row["iddonhang"]}'>Xem chi tiết đơn hàng</i>
                        </a>
                     </div>
                </div>
           </td>
       </tr>
           ";
        }
    $sql_total = "SELECT d.* FROM donhang d , user1 s where s.id = d.idkhachhang";
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

  