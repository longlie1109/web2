<!-- DataTales Example -->
<?php
          include("../../../admi/check_permissions.php");
    ?>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Thông tin Danh sách thể loại
    <?php
    if(check_Privilege("../admi/DAO.php?action=add_type"))
    {
      ?>
        <a href="../admi/DAO.php?action=add_type">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Thêm thể loại
          </button>
        </a>
        <?php
      }
        ?>
    </h6>
  </div>

  <div class="card-body">
  
    <!-- <div class="table-responsive"> -->
      <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Username </th>
            <th>Email </th>
            <th>Password</th>
            <th>EDIT </th>
            <th>DELETE </th>
          </tr>
        </thead>
        <tbody>
     
          <tr>
            <td> 1 </td>
            <td> Funda of WEb IT</td>
            <td> funda@example.com</td>
            <td> *** </td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="edit_id" value="">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>
        
        </tbody>
      </table> -->
    <!-- </div> -->
  <!-- </div> -->
<!-- </div> -->

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
    $sql = "SELECT * FROM theloai LIMIT {$start} , {$limit}";
     
    $result = mysqli_query($cnn, $sql);
   

    $output = "";
    if(mysqli_num_rows($result)>0){
       $output.='<div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Thể loại</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
       ';
        while($row = mysqli_fetch_assoc($result)){
           $output.="
           <tr>
           <td>{$row['id']}</td>
           <td>{$row['tentheloai']}</td>
           <td>
                <div class='admin_setting_product'>";
                  if(check_Privilege("../admi/DAO.php?action=edit_type&id={$row['id']}")){
                    $output.=" 
                    <div>
                        <button class= 'editBtn btn btn-primary'> edit </button>
                     </div>";
                  }
                  if(check_Privilege("../admi/DAO.php?action=edit_type&id={$row['id']}")){
                    $output.="
                    <div>
                      <button class= 'deleteBtn btn btn-danger'> delete </button>
                    </div>";
                  }
                  $output .="
                </div>
           </td>
       </tr>
           ";
        }
    $sql_total = "SELECT * FROM theloai";
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
                               <button type="submit" name="action" value="delete_type" class="btn btn-danger">DELETE</button>

                           </form>


                       </div>
                   </div>
               </div>
           </div>

           <!-- form edit -->
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
                       <form method="POST" action="./includes/manager_type/edit_theloai.php" enctype="multipart/form-data">
                          <div class="form-group row">
                              <label for="type">ID</label>
                              <input type="text"  readonly id="id_type" class="form-control" value="<?php echo $row['id']; ?>" name="id_type" placeholder="Nhập id ">
                              <span class="form-message"></span>
                          </div> 
                          <div class="form-group row">
                              <label for="idproduct">Tên thể loại:</label>
                              <input type="text" id="ten_the_loai" class="form-control" value="<?php echo $row['tentheloai']; ?>" name="ten_the_loai" placeholder="Nhập tên thể loại">
                              <span class="form-message"></span>
                          </div> 
                          
                        
                          <div >
                              <input type="text" hidden name="action" value="edit_type">
                              <button class="btn btn--primary">
                                  Sửa
                              </button>
                              <div class="btn btn--primary">
                                  <a href="?action=view_type&noedit">Hủy</a>
                              </div>
                          </div>
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
            console.log(data);
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
            $('#id_type').val(data[0]);
            $('#ten_the_loai').val(data[1]);
        });

    });
</script>