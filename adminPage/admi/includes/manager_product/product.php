<!-- DataTales Example -->
<?php
        include("../../../admi/check_permissions.php");
?>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Thông tin Danh sách sản phẩm
    <?php
       if(check_Privilege("../admi/DAO.php?action=add_sach")){
    ?>
        <a href="../admi/DAO.php?action=add_sach">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Thêm sách mới
          </button>
        </a>
        <?php
       }
        ?>
    </h6>
  </div>
  <div class="card-body">
  
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
    $sql = "SELECT * FROM SACH s order by id LIMIT {$start} , {$limit}";
     
    $result = mysqli_query($cnn, $sql);


    $output = "";
    if(mysqli_num_rows($result)>0){
       
       $output.='<div class="table-responsive">
                      <table class="table table-bordered table-image" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Sách</th>
                                        <th>Tên tác giả</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá đã sale</th>
                                        <th>Đơn giá</th>
                                        <th>Sale</th>
                                        <th>Tên thể loại </th>
                                        <th>Số lượng </th>
                                        <th>Mô tả </th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
       ';
        while($row = mysqli_fetch_assoc($result)){
            $tacgia = $row['idtacgia'];
            $theloai = $row['matheloai'];
            $sql1 = " SELECT * from tacgia where id = '$tacgia'";
            $result1 = mysqli_query($cnn, $sql1);


            $sql2 = "SELECT * from theloai where id = '$theloai'";

            $result2 = mysqli_query($cnn, $sql2);
            if($result2){
                $row2 = mysqli_fetch_assoc($result2);
                $tentheloai= $row2['tentheloai']; 
                }
            if($result1){
                while($row1 = mysqli_fetch_assoc($result1)){
                    
            $current =$row['dongia'] - ($row['dongia']*($row['sale']/100));
            // $row['dongia'] = number_format ($row['dongia'],0,'','.');
            // $current = number_format ($row['dongia'],0,'','.');
           $output.="
           <tr>
           <td>{$row['id']}</td>
           <td>{$row['tensach']}</td>
           <td>{$row1['tentacgia']}</td>
           <td><img src='/web/adminPage/admi/img/book/{$row["matheloai"]}/{$row["image"]}'class='product_ajax-img '></div></td>
           <td>$current đ</td>
           <td>{$row['dongia']}</td>
           <td>{$row['sale']}%</td>
           <td>{$tentheloai}</td>";
           if($row['soluongs']<=0)
           {
            $output.="
           <td class='text-danger'>Hết hàng</td>
           ";
           }else
           $output.="
           <td>{$row['soluongs']}</td>
           ";
           $output.="
           <td>{$row['mota']}</td>
           <td>
                <div class='admin_setting_product'>";
                   if(check_Privilege("../admi/DAO.php?action=edit_sach&id={$row['id']}")){
                   $output.=" <div>
                   <button class= 'editBtn btn btn-success'>  Edit </button>
                 
                     </div>";
                   }
                   if(check_Privilege("../admi/DAO.php?action=delete_sach&id={$row['id']}")){
                    $output.=" 
                    <div class='admin_setting_delete' >
                        <button class= 'deleteBtn btn btn-danger'> delete </button>
                    </div>
                </div>";
                   }
                $output .="
           </td>
       </tr>
           ";
}
            }
        }
    $sql_total = "SELECT * FROM sach";
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


<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Sửa sản phẩm</h5>
                           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">×</span>
                           </button>
                       </div>
                       <!-- <div class="modal-body"></div> -->
                       <div class="modal-footer">
                           
                           <form action="./includes/manager_product/edit_sach.php" method="POST" enctype="multipart/form-data" >
                           <!-- <div class="form-group row">
                           
                                    <label  for="theloai">Mã thể loại</label>
                                    <input  class="form-control" readonly type="text" name="type" id="theloai" >
                       
                                    <span class="form-message"></span>
                                </div>  -->
                                <div class="form-group row">
                                    <label  for="idproduct">Mã sản phẩm:</label>
                                    <input class="form-control" readonly type="text" id="idproduct" class="form__input" name="id" placeholder="Nhập Mã">
                                    <span class="form-message"></span>
                                </div> 
                                
                                <div class="form-group row">
                                    <label  for="name">Tên sản phẩm:</label>
                                    <input class="form-control" type="text" id="tensach" class="form__input" name="tensach" placeholder="Nhập tên">
                                    <span class="form-message"></span>
                                </div> 
                                <div class="form-group row">
                                    <label  for="price">Price: </label>
                                    <input class="form-control" type="text" rules="" id="price" class="form__input" placeholder="Nhập giá" name="dongia">
                                    <span class="form-message"></span>
                                </div> 
                                <div class="form-group row">
                                    <label  for="img">Img: </label>
                                    <input class="form-control" type="file" rules="" id="img" class="form__input" placeholder="add img" name="img" accept="image/png, image/jpeg">
                                    <span class="form-message"></span>
                                </div> 
                                <!-- <div class="form-group row">
                                    <label for="author">Mã tác giả:</label>
                                    <input class="form-control" readonly type="text" rules="" id="author" class="form__input" placeholder="" name="author">
                                    <span class="form-message"></span>
                       
                        <span class="form-message"></span>
                                </div>  -->
                                <div class="form-group row">
                                    <label  for="password">Sale</label>
                                    <input class="form-control" type="text" id="sale" class="form__input" placeholder="Nhập sale" name="sale" >
                                    <span class="form-message"></span>
                                    <!-- rules="required|min:6 -->
                                </div>     
                                <div class="form-group row">
                                    <label  for="repassword">Nhập số lượng:</label>
                                    <input class="form-control" type="text" rules="" id="quantyti" class="form__input" placeholder="Nhập mô tả" name="quantyti">
                                    <span class="form-message"></span>
                                </div>
                                <div >
                                    <input class="form-control" type="text" hidden name="edit_sach">
                                    <button class="btn btn-primary">
                                        Sửa
                                    </button>
                                    <div class="btn btn-secondary">
                                        <a class="badge" href="?action=view_sach&no_edit">Hủy</a>
                                    </div>
                                </div>
                                <!-- <input type="text" hidden id="delete_id" name='id'> -->
                               <!-- <button type="submit" name="action" value="delete_sach" class="btn btn-primary">DELETE</button> -->

                           </form>
                           <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> -->

                       </div>
                   </div>
               </div>
           </div>
<!--  -->
 <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">×</span>
                           </button>
                       </div>
                       <div class="modal-body">DELETE ?</div>
                       <div class="modal-footer">
                           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                           <form action="DAO.php" method="GET">
                                <input type="text" hidden id="delete_id" name='id'>
                               <button type="submit" name="action" value="delete_sach" class="btn btn-danger">DELETE</button>

                           </form>


                       </div>
                   </div>
               </div>
           </div>
<script>
      $(document).ready(function(){
        $('.deleteBtn').on('click' , function(){
            $('#deletemodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function (){
                return $(this).text();
            }).get();
            $('#delete_id').val(data[0]);
            
            
        });

    });
    $(document).ready(function(){
        $('.editBtn').on('click' , function(){
            $('#editmodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function (){
                return $(this).text();
            }).get();
            console.log(data);

            $('#idproduct').val(data[0]);
            $('#tensach').val(data[1]);
            $('#author').val(data[2]);
            $('#img').val(data[3]);
            $('#price').val(data[5]);
            $('#sale').val(data[6]);
            // var temp = (data[3]).lastIndexOf("/");
            // console.log(temp);
            $('#theloai').val(data[7]);
            $('#quantyti').val(data[8]);

        });

    });

</script>
<!--   <a href='../admi/DAO.php?action=delete_sach&id={$row['id']}' onclick='delete_sach()'>Delete</a> \
 -->


 <!--   <a class='btn btn-primary' href='../admi/DAO.php?action=edit_sach&id={$row['id']}'>edit</a> -->