<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>
<div class="container-fluid">
  <!-- Biểu đồ -->
  <?php 
      if(!isset($_GET['action']))
      {
        $_GET['action']="view_statistical_chart";
      }
      
  ?>
    <div style="display:flex;width:100%;padding-bottom:100px">
        <?php
            if(isset($_GET['action']))
            {
              if($_GET['action']=="view_statistical_chart")
              {
              ?>
              <div style="width:100%">
              <?php
                include_once("includes/manager_statistical/vechart.php");
              ?>
              </div>
              <div  style="width:100%">
              <?php
                include_once("includes/manager_statistical/vechart2.php");
              ?>
              </div>
              <?php
              }
            }
        ?>
    </div>
    <div id="home-product-show-pagination">
               
                                        
    </div>
          <!-- phân quyền -->
          <?php if(!empty($_GET['action'])&& $_GET['action']=="save")
  {  
      $data = $_POST;
      $insertString ="";
      // $deleteOldPrivileges = mysqli_query($cnn,"DELETE FROM `user_privilege` WHERE userID =".$data['userID']);
      // var_dump($deleteOldPrivileges);
      // exit();
      foreach ($data['privileges'] as $insert_privileges){
        $insertString .= !empty($insertString) ?  ","   :""; 
        $insertString .= "(NULL , ".$data['userID']." , ".$insert_privileges." , '1619803326', '1619803326')";
      }
      $insert_privilege = mysqli_query($cnn, "INSERT INTO `user_privilege` (`id`, `userID`, `privilegeID`, `created_time`, `last_update`) VALUES ".$insertString);
      if(!$insert_privilege){
        $error ="Phân quyền không thành công vui lòng thử lại";
      }
}
  ?>
  <?php
        if(!isset($error)&&!empty($_GET['action'])&& $_GET['action']=="save"){
  ?>
        <h1>Phân quyền thành công</h1> <a class="badge" href="index.php?action=view_user"> Quay lại trang phân quyền</a>
  <?php
        }
        else if(isset($error)){
  ?>
        <h1> <?php echo $error ?></h1>
  <?php
        }
  ?>
    <!-- để cái này vì nó cần gửi qua cho tk bên kia -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
      <script type="text/javascript">
    function loadCartDetail() {
    $(document).ready(function (){
    function load_data(page)
    {
        $.ajax({
        url:"./includes/manager_cart/show_cart_detail.php?action=show_detail_cart&id=<?php if(isset($_GET['id'])){  echo $_GET['id'];}?>",
        method:"POST",
        data:{
            page: page
        },
        success : function(data){                            
            $('#home-product-show-pagination').html(data);
        }

        });
    }   
    load_data();                                      
    $(document).on('click', 'a.pagination-item__link', function (e){
        e.preventDefault();
        var pageId = $(this).attr('id');  
        load_data(pageId);
        });
    });
  }  
  function loadStatisticalS() {
    $(document).ready(function (){
    function load_data(page)
    {
        $.ajax({
        url:"./includes/manager_statistical/doanhthu.php?action=view_statistical&data=<?php if(isset($_GET['startTime'])||isset($_GET['endTime'])||isset($_GET['date'])||isset($_GET['month'])||isset($_GET['year'])){
          if(isset($_GET['endTime'])||isset($_GET['startTime'])) 
          {
            echo "&startTime=".$_GET['startTime'];
            echo "&endTime=".$_GET['endTime'];
          }
           else if(isset($_GET['date']))
           {
            echo "&date=".$_GET['date'];
           }else if(isset($_GET['month'])){
            echo "&month=".$_GET['month'];
           }else {
             echo "&year=".$_GET['year'];
           }
           
           }?>",
        method:"POST",
        data:{
            page: page
        },
        success : function(data){                            
            $('#home-product-show-pagination').html(data);
        }

        });
    }   
    load_data();                                      
    $(document).on('click', 'a.pagination-item__link', function (e){
        e.preventDefault();
        var pageId = $(this).attr('id');  
        load_data(pageId);
        });
    });
  }  
 </script>
 <?php
      include("function.php");
?>
  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>